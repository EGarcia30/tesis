<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Conocimientos extends Model{
    private int $_id;
    private string $_conocimiento;
    private int $_contenido_id;

    public function __construct($conocimiento,$contenido_id){
        parent::__construct();
        $this->_conocimiento = $conocimiento;
        $this->_contenido_id = intval($contenido_id);
    }

    public static function getConocimientos($id){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM conocimientos WHERE contenido_id={$id}";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //CRUD
    //Crear
    public function createConocimientos(){
        try{
            $sql = "INSERT INTO conocimientos(conocimiento,contenido_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_conocimiento, $this->_contenido_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteConocimientos($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM conocimientos WHERE contenido_id={$id}";
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

    public function getConocimiento(){
        return $this->_conocimiento;
    }

    public function setConocimiento(string $value){
        return $this->_conocimiento = $value;
    }

    public function getContenidoId(){
        return $this->_contenido_id;
    }

    public function setContenidoId(int $value){
        return $this->_contenido_id = $value;
    }
}