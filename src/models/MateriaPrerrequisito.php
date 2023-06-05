<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class MateriaPrerrequisito extends Model{
    private int $_idMateria;
    private int $_idPrerrequisito;

    public function __construct($idMateria, $idPrerrequisito){
        parent::__construct();
        $this->_idMateria = intval($idMateria);
        $this->_idPrerrequisito = intval($idPrerrequisito);
    }

    //CRUD
    //crear
    public function createMateriaPrerrequisito(){
        try{
            $sql = 'INSERT INTO materia_prerrequisito(materia_id, prerrequisito_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idMateria,$this->_idPrerrequisito];
            $res = $query->execute($data);
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }


    public function getIdMateria(){
        return $this->_idMateria;
    }

    public function setIdMateria(int $value){
        return $this->_idMateria = $value;
    }

    public function getIdPrerrequisito(){
        return $this->_idPrerrequisito;
    }

    public function setIdPrerrequisito(int $value){
        return $this->_idPrerrequisito = $value;
    }
}