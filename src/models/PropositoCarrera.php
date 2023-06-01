<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PropositoCarrera extends Model{
    private int $_id;
    private string $_descripcion;

    public function __construct(string $descripcion){
        parent::__construct();
        $this->_descripcion = $descripcion;
    }

    public static function getProposito($id){
        try{
            $idPro = intval($id);
            $_db = new Database();
            $sql = "SELECT * FROM proposito_carrera WHERE proposito_id=$idPro";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            if(!$res){
                return false;
                exit();
            }
            $proposito = new PropositoCarrera($res[0]['descripcion'] == null ? '' : $res[0]['descripcion'] );
            $proposito->setId($res[0]['proposito_id'] == null ? 0 : $res[0]['proposito_id']);
            return $proposito;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //CRUD
    //Crear
    
    public function createProposito(){
        try{
            $sql = "INSERT INTO proposito_carrera(descripcion) VALUES(?)";
            $query = $this->prepare($sql);
            $data = [$this->_descripcion];
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
            $sql = "SELECT LAST_INSERT_ID(proposito_id) as id_proposito FROM proposito_carrera ORDER BY proposito_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }

    }

    //actualizar
    public function updateProposito(){
        try{
            $sql = "UPDATE proposito_carrera
            SET descripcion=? WHERE proposito_id=?";
            $query = $this->prepare($sql);
            $data = [$this->_descripcion,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //metodos de acceso
    public function getId(){
        return $this->_id;
    }

    public function setId(int $value){
        return $this->_id = $value;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function setDescripcion(string $value){
        return $this->_descripcion = $value;
    }
}