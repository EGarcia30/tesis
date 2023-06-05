<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CriterioEvaluacion extends Model{
    private int $_id;
    private string $_criterioEvaluacion;
    private int $_indicador_id;

    public function __construct($criterioEvaluacion,$indicador_id){
        parent::__construct();
        $this->_criterioEvaluacion = $criterioEvaluacion;
        $this->_indicador_id = intval($indicador_id);
    }

    //CRUD
    //Crear
    public function createCriterioEvaluacion(){
        try{
            $sql = "INSERT INTO criterio_evaluacion(criterio,indicador_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_criterioEvaluacion, $this->_indicador_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getId(){
        return $this->_id;
    }

    public function setId(int $value){
        return $this->_id = $value;
    }

    public function getCriterioEvaluacion(){
        return $this->_criterioEvaluacion;
    }

    public function setCriterioEvaluacion(string $value){
        return $this->_criterioEvaluacion = $value;
    }

    public function getIndicadorId(){
        return $this->_indicador_id;
    }

    public function setIndicadorId(int $value){
        return $this->_indicador_id = $value;
    }
}