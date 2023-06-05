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
}
