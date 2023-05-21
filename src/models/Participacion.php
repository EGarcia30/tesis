<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Participacion extends Model{

    private int $_id;
    private string $_name;
    private int $_status;

    public function __construct(string $name){
        parent::__construct();
        $this->_name = $name;
    }

    public static function getParticipaciones(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM participacion WHERE status=1 ORDER BY participacion_id DESC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    //obtener participacion
    public static function existsParticipacion(string $data){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM participacion WHERE descripcion=$data AND status=1";
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
    //insertar participacion
    public function createParticipacion(){
        try{
            //TODO: validar si existe participacion
            $data = $this->existsParticipacion($this->_name);
            $validation = intval($data['num']);
            if(!empty($data['num'])){
                $message = array('participacion ya existente.');
                return $message;
                exit();
            }
            $sql = 'INSERT INTO participacion(descripcion, status) VALUES(?, ?)';
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

    //actualizar participacion
    public function updateParticipacion(){
        try{
            $sql = "UPDATE participacion SET descripcion=? WHERE participacion_id=?";
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

    //eliminar participacion
    public static function deleteParticipacion($id){
        try{
            $_db = new Database();
            $sql = "UPDATE participacion SET status=0 WHERE participacion_id=$id";
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