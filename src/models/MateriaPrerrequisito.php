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

    public static function getMateriaPrerrequisitos($id){
        try{
            $_db = new Database();
            $sql = "SELECT p.* FROM prerrequisito p
            INNER JOIN materia_prerrequisito mp ON p.prerrequisito_id = mp.prerrequisito_id
            INNER JOIN materia m ON m.materia_id = {$id} AND m.materia_id = mp.materia_id";
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

    public static function deleteMateriaPrerrequisito($idPrerrequisito,$idMateria){
        try{
            $_db = new Database();
            $sql = "DELETE FROM materia_prerrequisito WHERE materia_id={$idMateria} AND prerrequisito_id={$idPrerrequisito}";
            $query = $_db->connect()->query($sql);
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