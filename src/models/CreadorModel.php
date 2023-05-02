<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CreadorModel extends Model{

    private int $_id;
    private string $_name;
    private int $_status;

    public function __construct(string $name){
        parent::__construct();
        $this->_name = $name;
    }

    public static function getCreadores($start, $end){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM creador ORDER BY creador_id DESC LIMIT $start, $end";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function rowCreadores(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM creador WHERE status=1";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $rows = $query->rowCount();       
            return $rows;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return NULL;
        }
    }

    public static function getCreador($data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM creador WHERE creador_id=$int";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(!$res){
                return null;
                exit();
            }
            $creador = new CreadorModel($res['nombre_creador']);
            $creador->setId($res['creador_id']);
            $creador->setStatus($res['status']);
            return $creador; 
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    //obtener Creador
    public static function existsCreador(string $data){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM creador WHERE nombre_creador=$data";
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
    public function createCreador(){
        try{
            //TODO: validar si existe creador
            $data = $this->existsCreador($this->_name);
            $validation = intval($data['num']);
            if(!empty($data['num'])){
                $message = array('Creador ya existente.');
                return $message;
                exit();
            }
            $sql = 'INSERT INTO creador (nombre_creador, status) VALUES(?, ?)';
            $query = $this->prepare($sql);
            $data = [$this->_name,1];
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
            $sql = "SELECT LAST_INSERT_ID(creador_id) as id_creador from creador Where status=1 ORDER BY creador_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    //funciones de acceso get y set

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