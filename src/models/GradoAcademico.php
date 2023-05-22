<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class GradoAcademico extends Model{

    private int $_id;
    private string $_name;
    private int $_status;

    public function __construct(string $name){
        parent::__construct();
        $this->_name = $name;
    }

    public static function getGradoAcademico(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM grado_academico WHERE status=1 ORDER BY grado_id DESC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener Grado
    public static function existsGrado(string $data){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM grado_academico WHERE nombre_grado='$data' ";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }        
    }

    //CRUD
    //insertar grado
    public function createGradoAcademico(){
        try{
            //TODO: validar si existe grado
            $data = $this->existsGrado($this->_name);
            $validation = intval($data['num']);
            if(!empty($validation)){
                $message = array(0 => 'Grado ya existente.');
                return $message;
                exit();
            }
            $sql = 'INSERT INTO grado_academico(nombre_grado, status) VALUES(?, ?)';
            $query = $this->prepare($sql);
            $data = [$this->_name,1];
            $res = $query->execute($data);
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //actualizar grado
    public function updateGradoAcademico(){
        try{
            $sql = 'UPDATE grado_academico SET nombre_grado=? WHERE grado_id=?';
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_id];
            $res = $query->execute($data);
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //actualizar grado
    public static function deleteGradoAcademico($id){
        try{
            $_db = new Database();
            $sql = "UPDATE grado_academico SET status=0 WHERE grado_id=$id";
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