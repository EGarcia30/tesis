<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Habilidades extends Model{
    private int $_id;
    private string $_habilidad;
    private int $_contenido_id;

    public function __construct($habilidad,$contenido_id){
        parent::__construct();
        $this->_habilidad = $habilidad;
        $this->_contenido_id = intval($contenido_id);
    }

    public static function getHabilidades($id){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM habilidades WHERE contenido_id={$id}";
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
    public function createHabilidades(){
        try{
            $sql = "INSERT INTO habilidades(habilidad,contenido_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_habilidad, $this->_contenido_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteHabilidades($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM habilidades WHERE contenido_id={$id}";
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

    public function getHabilidad(){
        return $this->_habilidad;
    }

    public function setHabilidad(string $value){
        return $this->_habilidad = $value;
    }

    public function getContenidoId(){
        return $this->_contenido_id;
    }

    public function setContenidoId(int $value){
        return $this->_contenido_id = $value;
    }
}