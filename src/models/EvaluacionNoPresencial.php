<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class EvaluacionNoPresencial extends Model{
    private int $_id;
    private string $_evaluacion;

    public function __construct($evaluacion){
        parent::__construct();
        $this->_evaluacion = $evaluacion;
    }

    //CRUD
    //Crear
    public function createSNopresencial(){
        try{
            $sql = "INSERT INTO evaluacion_nopresencial(evaluacion) VALUES(?)";
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
            $sql = "SELECT LAST_INSERT_ID(enopresencial_id) as enopresencial_id from evaluacion_nopresencial ORDER BY enopresencial_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteEvaluacionNoPresencial($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM evaluacion_nopresencial WHERE enopresencial_id={$id}";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
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