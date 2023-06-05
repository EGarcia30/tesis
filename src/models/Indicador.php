<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Indicador extends Model{
    private int $_id;
    private string $_indicador;
    private int $_materia_id;

    public function __construct($indicador,$materia_id){
        parent::__construct();
        $this->_indicador = $indicador;
        $this->_materia_id = intval($materia_id);
    }

    //CRUD
    //Crear
    public function createIndicador(){
        try{
            $sql = "INSERT INTO indicador_logro(indicador,materia_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_indicador, $this->_materia_id];
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
            $sql = "SELECT LAST_INSERT_ID(indicador_id) as indicador_id from indicador_logro ORDER BY indicador_id DESC";
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

    public function getIndicador(){
        return $this->_indicador;
    }

    public function setIndicador(string $value){
        return $this->_indicador = $value;
    }

    public function getMateriaId(){
        return $this->_materia_id;
    }

    public function setMateriaId(int $value){
        return $this->_materia_id = $value;
    }
}