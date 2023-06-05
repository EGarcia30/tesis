<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CompetenciaBasica extends Model{

    private int $_id;
    private array $_comBasica = [];
    private array $_nvlCiclo = [];

    public function __construct(array $data = []){
        parent::__construct();
        for($i = 0; $i < count($data); $i++){
            if($i % 2 == 0){
                array_push($this->_comBasica, $data[$i]);
            }else{
                array_push($this->_nvlCiclo, $data[$i]);
            }
        }
    }

    public function createComBasica(){
        try{
            $arrRes = [];
            for($i = 0; $i < count($this->_comBasica); $i++){
                $idCiclo = $this->_nvlCiclo[$i];
                $sql = "INSERT INTO competencia_basica(descripcion,ciclo) VALUES(?,?)";
                $query = $this->prepare($sql);
                $data = [$this->_comBasica[$i],$this->_nvlCiclo[$i]];
                $query->execute($data);
                array_push($arrRes, $this->getLastId());
            }
            return $arrRes;
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