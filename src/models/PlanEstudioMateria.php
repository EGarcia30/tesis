<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioMateria extends Model{
    private int $_idPlan;
    private int $_idMateria;

    public function __construct($idPlan, $idMateria){
        parent::__construct();
        $this->_idPlan = intval($idPlan);
        $this->_idMateria = intval($idMateria);
    }

    public static function getPlanMaterias($id){
        try{
            $id = intval($id);
            $_db = new Database();
            $sql = "SELECT m.* FROM materia m
            INNER JOIN plan_estudio_materia pm ON m.materia_id = pm.materia_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = {$id} AND pe.plan_estudio_id = pm.plan_estudio_id ";
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
    public function createPlanMateria(){
        try{
            $sql = 'INSERT INTO plan_estudio_materia(plan_estudio_id, materia_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idPlan,$this->_idMateria];
            $res = $query->execute($data);;
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }


    public function getIdPlan(){
        return $this->_idPlan;
    }

    public function setIdPlan(int $value){
        return $this->_idPlan = $value;
    }

    public function getIdMateria(){
        return $this->_idMateria;
    }

    public function setIdMateria(int $value){
        return $this->_idMateria = $value;
    }
}