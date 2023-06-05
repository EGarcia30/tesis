<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Prerrequisito extends Model{
    private int $_id;
    private string $_name;

    public function __construct(string $data){
        parent::__construct();
        $this->_name = $data;
    }

    //CRUD
    //crear
    public function createPrerrequisito(){
        try{
            $sql = 'INSERT INTO prerrequisito(prerrequisito) VALUES(?)';
            $query = $this->prepare($sql);
            $data = [$this->_name];
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