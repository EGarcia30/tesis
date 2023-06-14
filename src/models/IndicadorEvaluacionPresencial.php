<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class IndicadorEvaluacionPresencial extends Model{
    private int $_idIndicador;
    private string $_idPresencial;

    public function __construct($idIndicador,$idPresencial){
        parent::__construct();
        $this->_idIndicador = $idIndicador;
        $this->_idPresencial  =$idPresencial;
    }

    public static function getIndicadorSpresencial($id){
        try{
            $_db = new Database();
            $sql = "SELECT ep.* FROM evaluacion_presencial ep
            INNER JOIN indicador_logro_evaluacion_presencial iep ON ep.epresencial_id = iep.epresencial_id
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
    public function createIndicadorSpresencial(){
        try{
            $sql = "INSERT INTO indicador_logro_evaluacion_presencial(indicador_id,epresencial_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_idIndicador,$this->_idPresencial];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteIndicadorSpresencial($idIndicador,$idEpresencial){
        try{
            $_db = new Database();
            $sql = "DELETE FROM indicador_logro_evaluacion_presencial WHERE indicador_id=$idIndicador AND epresencial_id=$idEpresencial";
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
