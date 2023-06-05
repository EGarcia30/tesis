<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class EvaluacionPresencial extends Model{
    private int $_id;
    private string $_evaluacion;

    public function __construct($evaluacion){
        parent::__construct();
        $this->_evaluacion = $evaluacion;
    }

    //CRUD
    //Crear
    public function createSpresencial(){
        try{
            $sql = "INSERT INTO evaluacion_presencial(evaluacion) VALUES(?)";
            $query = $this->prepare($sql);
            $data = [$this->_evaluacion];
            $query->execute($data);
            $res = $this->getLastId();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(epresencial_id) as epresencial_id from evaluacion_presencial ORDER BY epresencial_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
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

    public function getEvaluacion(){
        return $this->_evaluacion;
    }

    public function setEvaluacion(string $value){
        return $this->_evaluacion = $value;
    }
}