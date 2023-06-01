<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CarreraModel extends Model{

    private int $_id;
    private string $_name;
    private string $_modality;
    private int $_facultad_id;
    private string $_acronym;
    private int $_status;
    
    public function __construct(string $name, string $modality, int $facultad_id, $acronym){
        parent::__construct();
        $this->_name = $name;
        $this->_modality = $modality;
        $this->_facultad_id = $facultad_id;
        $this->_acronym = $acronym;
    }

    public static function getCarreras(int $start, int $end){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM carrera WHERE status=1 ORDER BY carrera_id DESC LIMIT $start, $end";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getCarrera(int $data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM carrera WHERE carrera_id=$int";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(!$res){
                return null;
                exit();
            }
            $carreraModel = new CarreraModel($res['nombre_carrera'], $res['modalidad_carrera'], $res['facultad_id'],$res['acronimo_facultad']);
            $carreraModel->setId($res['carrera_id']);
            $carreraModel->setStatus($res['status']);
            return $carreraModel; 
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function rowCarreras(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM carrera WHERE status=1";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $rows = $query->rowCount();       
            return $rows;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function searchCarreras($data,$start,$end){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM carrera WHERE status=1 AND 
            (carrera_id=$int 
            OR nombre_carrera LIKE '%$data%' 
            OR modalidad_carrera LIKE '%$data%'
            OR acronimo_facultad LIKE '%$data%') 
            LIMIT $start, $end";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            if(!$res){
                return false;
                exit();
            }
            return $res; 
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function rowSearchCarreras($data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM carrera WHERE carrera_id=$int 
            OR nombre_carrera LIKE '%".$data."%' 
            OR modalidad_carrera LIKE '%".$data."%'
            OR acronimo_facultad LIKE '%".$data."%' 
            AND status=1";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $rows = $query->rowCount();       
            return $rows;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getAllCarreras(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM carrera WHERE status=1";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener usuario
    public static function existsCarrera(string $data){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM carrera WHERE nombre_carrera=$data";
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
    //insertar carrera
    public function createCarrera(){
        try{
            //TODO: validar si existe carreras
            $data = $this->existsCarrera($this->_name);
            $validation = intval($data['num']);
            if(!empty($data['num'])){
                $message = array('Carrera ya existente.');
                return $message;
                exit();
            }
            $sql = 'INSERT INTO carrera (carrera_id, nombre_carrera, modalidad_carrera, facultad_id, acronimo_facultad, status) VALUES(?, ?, ?, ?, ?, ?)';
            $query = $this->prepare($sql);
            $data = [$this->_id,$this->_name,$this->_modality,$this->_facultad_id,$this->_acronym,1];
            $res = $query->execute($data);
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateCarrera(){
        try{
            $sql = 'UPDATE carrera SET nombre_carrera=?, modalidad_carrera=?, acronimo_facultad=? WHERE carrera_id=?';
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_modality,$this->_acronym,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteCarrera($id){
        try{
            $_db = new Database();
            $sql = "UPDATE carrera SET status=? WHERE carrera_id=?";
            $query = $_db->connect()->prepare($sql);
            $data = [0,$id];
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

    public function getName(){
        return $this->_name;
    }

    public function setName(string $value){
        return $this->_name = $value;
    }

    public function getModality(){
        return $this->_modality;
    }

    public function setModality(string $value){
        return $this->_modality = $value;
    }

    public function getFacultadId(){
        return $this->_facultad_id;
    }

    public function setFacultadId(int $value){
        return $this->_facultad_id = $value;
    }

    public function getAcronym(){
        return $this->_acronym;
    }

    public function setAcronym(string $value){
        return $this->_acronym = $value;
    }

    public function getStatus(){
        return $this->_status;
    }

    public function setStatus(int $value){
        return $this->_status = $value;
    }
}