<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CompetenciaGeneral extends Model{

    private int $_id;
    private string $_comGeneral;
    private string $_nvlCiclo;

    public function __construct($competenciaGeneral = "", $nvlCiclo = ""){
        parent::__construct();
        $this->_comGeneral = $competenciaGeneral;
        $this->_nvlCiclo = $nvlCiclo;
    }

    public function createComGeneral(){
        try{
            $sql = "INSERT INTO competencia_general(descripcion,ciclo) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_comGeneral,$this->_nvlCiclo];
            $query->execute($data);
            $lastId = $this->getLastId();
            return $lastId;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(general_id) as id_general from competencia_general ORDER BY general_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function updateComGeneral($id,$des,$ciclo){
        try{
            $_db = new Database();
            $sql = "UPDATE competencia_general SET descripcion='$des', ciclo=$ciclo WHERE general_id=$id";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteComGeneral($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM competencia_general WHERE general_id=$id";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}