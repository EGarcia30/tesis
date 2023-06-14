<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class IndicadorEvaluacionNoPresencial extends Model{
    private int $_idIndicador;
    private string $_idNoPresencial;

    public function __construct($idIndicador,$idNoPresencial){
        parent::__construct();
        $this->_idIndicador = $idIndicador;
        $this->_idNoPresencial = $idNoPresencial;
    }

    public static function getIndicadorSNopresencial($id){
        try{
            $_db = new Database();
            $sql = "SELECT ep.* FROM evaluacion_nopresencial ep
            INNER JOIN indicador_logro_evaluacion_nopresencial iep ON ep.enopresencial_id = iep.enopresencial_id
            INNER JOIN indicador_logro i ON i.indicador_id = {$id} AND i.indicador_id = iep.indicador_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //CRUD
    //Crear
    public function createIndicadorSNopresencial(){
        try{
            $sql = "INSERT INTO indicador_logro_evaluacion_nopresencial(indicador_id,enopresencial_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_idIndicador,$this->_idNoPresencial];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteIndicadorSNopresencial($idIndicador,$idEnopresencial){
        try{
            $_db = new Database();
            $sql = "DELETE FROM indicador_logro_evaluacion_nopresencial WHERE indicador_id=$idIndicador AND enopresencial_id=$idEnopresencial";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}