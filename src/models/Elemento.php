<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Elemento extends Model{
    private int $_id;
    private string $_elemento;
    private int $_materia_id;

    public function __construct($elemento,$materia_id){
        parent::__construct();
        $this->_elemento = $elemento;
        $this->_materia_id = intval($materia_id);
    }

    //CRUD
    //Crear
    public function createElemento(){
        try{
            $sql = "INSERT INTO elemento_competencia(elemento,materia_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_elemento, $this->_materia_id];
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

    public function getElemento(){
        return $this->_elemento;
    }

    public function setElemento(string $value){
        return $this->_elemento = $value;
    }

    public function getMateriaId(){
        return $this->_materia_id;
    }

    public function setMateriaId(int $value){
        return $this->_materia_id = $value;
    }
}