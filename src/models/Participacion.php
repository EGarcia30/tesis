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
            $sql = "SELECT * FROM participacion ORDER BY participacion_id DESC";
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
            $sql = "SELECT COUNT(*) as num FROM participacion WHERE descripcion=$data";
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
}