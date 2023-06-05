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
}