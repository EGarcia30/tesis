<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class ImagenMateria extends Model{
    private int $_id;
    private string $_ruta;
    private int $_materia_id;

    public function __construct($ruta,$materia_id){
        parent::__construct();
        $this->_ruta = $ruta;
        $this->_materia_id = intval($materia_id);
    }

    public static function getImagen($id){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM imagen_materia WHERE materia_id={$id}";
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
    //Crear
    public function createImagen(){
        try{
            $sql = "INSERT INTO imagen_materia(img_materia,materia_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_ruta, $this->_materia_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteImagen($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM imagen_materia WHERE materia_id={$id}";
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

    public function getRuta(){
        return $this->_ruta;
    }

    public function setRuta(string $value){
        return $this->_ruta = $value;
    }

    public function getMateriaId(){
        return $this->_materia_id;
    }

    public function setMateriaId(int $value){
        return $this->_materia_id = $value;
    }
}