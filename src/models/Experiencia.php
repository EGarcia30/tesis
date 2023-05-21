<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Experiencia extends Model{

    private int $_id;
    private string $_name;
    private int $_status;

    public function __construct(string $name){
        parent::__construct();
        $this->_name = $name;
    }

    //CRUD
    //ingresar experiencia
    public function createExperiencia(){
        try{
            $sql = "INSERT INTO experiencia_profesional(descripcion, status) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_name,1];
            $query->execute($data);
            $res = $this->getLastId();
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //devolver Id
    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(experiencia_id) as id_experiencia from experiencia_profesional Where status=1 ORDER BY experiencia_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //actualizar experiencia
    public function updateExperiencia(){
        try{
            $sql = "UPDATE experiencia_profesional SET descripcion=? WHERE experiencia_id=?";
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //eliminar experiencia
    public static function deleteExperiencia($id){
        try{
            $_db = new Database();
            $sql = "UPDATE experiencia_profesional SET status=0 WHERE experiencia_id=$id";
            $query =  $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOEception $e){
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

    public function getName(){
        return $this->_name;
    }

    public function setName(string $value){
        return $this->_name = $value;
    }

    public function getStatus(){
        return $this->_status;
    }

    public function setStatus(int $value){
        return $this->_status = $value;
    }
}