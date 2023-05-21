<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CompetenciaGeneral extends Model{

    private int $_id;
    private array $_comGeneral = [];
    private array $_nvlCiclo = [];

    public function __construct(array $data = []){
        parent::__construct();
        for($i = 0; $i < count($data); $i++){
            if($i % 2 == 0){
                array_push($this->_comGeneral, $data[$i]);
            }else{
                array_push($this->_nvlCiclo, $data[$i]);
            }
        }
    }

    public function createComGeneral(){
        try{
            $arrRes = [];
            for($i = 0; $i < count($this->_comGeneral); $i++){
                $idCiclo = $this->_nvlCiclo[$i];
                $sql = "INSERT INTO competencia_general(descripcion,ciclo) VALUES(?,?)";
                $query = $this->prepare($sql);
                $data = [$this->_comGeneral[$i],$this->_nvlCiclo[$i]];
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
}