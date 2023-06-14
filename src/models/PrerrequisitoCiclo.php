<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PrerrequisitoCiclo extends Model{
    private int $_idPrerrequisito;
    private int $_idCiclo;

    public function __construct($idPrerrequisito, $idCiclo){
        parent::__construct();
        $this->_idPrerrequisito = intval($idPrerrequisito);
        $this->_idCiclo = intval($idCiclo);
    }

    public static function getPrerrequisitosCiclos($id){
        try{
            $_db = new Database();
            $sql = "SELECT p.* FROM prerrequisito p
            INNER JOIN prerrequisito_cicloExtraordinario pc ON p.prerrequisito_id = pc.prerrequisito_id
            INNER JOIN cicloExtraordinario c ON c.extra_id = {$id} AND c.extra_id = pc.extra_id";
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
    public function createPrerrequisitoCiclo(){
        try{
            $sql = 'INSERT INTO prerrequisito_cicloExtraordinario(prerrequisito_id, extra_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idPrerrequisito,$this->_idCiclo];
            $res = $query->execute($data);;
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deletePrerrequisitoCiclo($idPrerrequisito,$idCiclo){
        try{
            $_db = new Database();
            $sql = "DELETE FROM prerrequisito_cicloExtraordinario WHERE prerrequisito_id={$idPrerrequisito} AND extra_id={$idCiclo}";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getIdPrerrequisito(){
        return $this->_idPrerrequisito;
    }

    public function setIdPrerrequisito(int $value){
        return $this->_idPrerrequisito = $value;
    }

    public function getIdCiclo(){
        return $this->_idCiclo;
    }

    public function setIdCiclo(int $value){
        return $this->_idCiclo = $value;
    }
}