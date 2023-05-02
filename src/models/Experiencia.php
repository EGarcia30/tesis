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
            return $e->getMessage();
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(experiencia_id) as id_experiencia from experiencia_profesional Where status=1 ORDER BY experiencia_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }
}