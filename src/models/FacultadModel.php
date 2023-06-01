<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class FacultadModel extends Model{

    private int $_id;
    private string $_name;
    private string $_acronym;
    private int $_status;

    public function __construct(string $name, string $acronym){
        parent::__construct();
        $this->_name = $name;
        $this->_acronym = $acronym;
    }

    public static function getAllFacultad(int $start, int $end){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM facultad WHERE status=1 ORDER BY facultad_id DESC LIMIT $start, $end";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getFacultades(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM facultad WHERE status=1";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function rowFacultad(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM facultad WHERE status=1";
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

    public static function searchFacultad($data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM facultad WHERE status=1 AND 
            (facultad_id=$int 
            OR nombre_facultad LIKE '$data%' 
            OR acronimo_facultad LIKE '%$data%') ";
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

    public static function getFacultad(int $data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM facultad WHERE facultad_id=$int";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(!$res){
                return false;
                exit();
            }
            $facultadModel = new FacultadModel($res['nombre_facultad'], $res['acronimo_facultad']);
            $facultadModel->setId($res['facultad_id']);
            $facultadModel->setStatus($res['status']);
            return $facultadModel; 
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener facultad
    public static function existsFacultad(string $data){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM facultad WHERE nombre_facultad='$data' ";
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
    //insertar facultad
    public function createFacultad(){
        try{
            //TODO: validar si existe facultad
            $data = $this->existsFacultad($this->_name);
            $validation = intval($data['num']);
            if(!empty($validation)){
                $message = array('Facultad ya existente.');
                return $message;
                exit();
            }
            $sql = 'INSERT INTO facultad (nombre_facultad, acronimo_facultad, status) VALUES(?, ?, ?)';
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_acronym,1];
            $res = $query->execute($data);
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateFacultad(){
        try{
            $sql = 'UPDATE facultad SET nombre_facultad=?, acronimo_facultad=? WHERE facultad_id=?';
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_acronym,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteFacultad($id){
        try{
            $_db = new Database();
            $sql = "UPDATE facultad SET status=? WHERE facultad_id=?";
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