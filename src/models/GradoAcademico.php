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
            $sql = "SELECT * FROM grado_academico ORDER BY grado_id DESC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    //obtener Grado
    public static function existsGrado(string $data){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM grado_academico WHERE nombre_grado=$data";
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
            if(!empty($data['num'])){
                $message = array('Grado ya existente.');
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
}