<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Prerrequisito extends Model{
    private int $_id;
    private string $_name;
    private int $_no_orden;

    public function __construct(string $data, int $no_orden){
        parent::__construct();
        $this->_name = $data;
        $this->_no_orden = $no_orden;
    }

    //CRUD
    //crear
    public function createPrerrequisito(){
        try{
            $sql = 'INSERT INTO prerrequisito(prerrequisito,no_orden) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_no_orden];
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
            $sql = "SELECT LAST_INSERT_ID(prerrequisito_id) as prerrequisito_id from prerrequisito ORDER BY prerrequisito_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deletePrerrequisito($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM prerrequisito WHERE prerrequisito_id={$id}";
            $query = $_db->connect()->query($sql);
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
}