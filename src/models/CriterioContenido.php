<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CriterioContenido extends Model{
    private int $_id;
    private string $_criterioContenido;
    private int $_contenido_id;

    public function __construct($criterioContenido,$contenido_id){
        parent::__construct();
        $this->_criterioContenido = $criterioContenido;
        $this->_contenido_id = intval($contenido_id);
    }

    public static function getCriterios($id){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM criterio_contenido WHERE contenido_id={$id}";
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
    public function createCriterioContenido(){
        try{
            $sql = "INSERT INTO criterio_contenido(descripcion,contenido_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_criterioContenido, $this->_contenido_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteCriterioContenido($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM criterio_contenido WHERE contenido_id={$id}";
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

    public function getCriterioContenido(){
        return $this->_criterioContenido;
    }

    public function setCriterioContenido(string $value){
        return $this->_criterioContenido = $value;
    }

    public function getContenidoId(){
        return $this->_contenido_id;
    }

    public function setContenidoId(int $value){
        return $this->_contenido_id = $value;
    }
}