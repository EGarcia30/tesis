<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CompetenciaEspecialidad extends Model{

    private int $_id;
    private string $_comEspecialidad;
    private string $_nvlCiclo;

    public function __construct($comEspecialidad, $nvlCiclo){
        parent::__construct();
        $this->_comEspecialidad = $comEspecialidad;
        $this->_nvlCiclo = $nvlCiclo;
    }

    public function createComEspecialidad(){
        try{
            $sql = "INSERT INTO competencia_especialidad(descripcion,ciclo) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_comEspecialidad,$this->_nvlCiclo];
            $query->execute($data);
            $id = $this->getLastId();
            return $id;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(especialidad_id) as id_especialidad from competencia_especialidad ORDER BY especialidad_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function updateComEspecialidad($id,$des,$ciclo){
        try{
            $_db = new Database();
            $sql = "UPDATE competencia_especialidad SET descripcion='$des', ciclo=$ciclo WHERE especialidad_id=$id";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteComEspecialidad($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM competencia_especialidad WHERE especialidad_id=$id";
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