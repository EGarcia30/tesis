<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CompetenciaEspecialidad extends Model{

    private int $_id;
    private array $_comEspecialidad = [];
    private array $_nvlCiclo = [];

    public function __construct(array $data = []){
        parent::__construct();
        for($i = 0; $i < count($data); $i++){
            if($i % 2 == 0){
                array_push($this->_comEspecialidad, $data[$i]);
            }else{
                array_push($this->_nvlCiclo, $data[$i]);
            }
        }
    }

    public function createComEspecialidad(){
        try{
            $arrRes = [];
            for($i = 0; $i < count($this->_comEspecialidad); $i++){
                $idCiclo = $this->_nvlCiclo[$i];
                $sql = "INSERT INTO competencia_especialidad(descripcion,ciclo) VALUES(?,?)";
                $query = $this->prepare($sql);
                $data = [$this->_comEspecialidad[$i],$this->_nvlCiclo[$i]];
                $query->execute($data);
                array_push($arrRes, $this->getLastId());
            }
            return $arrRes;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(especialidad_id) as id_especialidad from competencia_especialidad ORDER BY especialidad_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }
}