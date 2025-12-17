<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CompetenciaBasica extends Model{

    private int $_id;
    private string $_comBasica;
    private string $_nvlCiclo;

    public function __construct($comBasica, $nvlCiclo){
        parent::__construct();
        $this->_comBasica = $comBasica;
        $this->_nvlCiclo = $nvlCiclo;
    }

    public function createComBasica(){
        try{
            $sql = "INSERT INTO competencia_basica(descripcion,ciclo) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_comBasica,$this->_nvlCiclo];
            $query->execute($data);
            $id = $this->getLastId();
            return $id;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(basico_id) as id_basico from competencia_basica ORDER BY basico_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function updateComBasica($id,$des,$ciclo){
        try{
            $_db = new Database();
            $sql = "UPDATE competencia_basica SET descripcion='$des', ciclo=$ciclo WHERE basico_id=$id";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteComBasica($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM competencia_basica WHERE basico_id=$id";
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