<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioCompetenciaEspecialidad extends Model{

    private int $_idPlan;
    private int $_idComEspecialidad;

    public function __construct(int $idPlan, int $idComEspecialidad){
        parent::__construct();
        $this->_idPlan = $idPlan;
        $this->_idComEspecialidad = $idComEspecialidad;
    }

    public static function getPlanComEspecialidades($id){
        try{
            $_db = new Database();
            $sql = "SELECT ce.* FROM competencia_especialidad ce
            INNER JOIN plan_estudio_competencia_especialidad pce ON ce.especialidad_id = pce.especialidad_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id AND pe.plan_estudio_id = pce.plan_estudio_id
            ORDER BY ce.ciclo ASC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function createPlanComEspecialidad(){
        try{
            $sql = 'INSERT INTO plan_estudio_competencia_especialidad(plan_estudio_id, especialidad_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idPlan,$this->_idComEspecialidad];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //desvinculando plan de estudio con competencia general
    public static function deletePlanComEspecialidad($idComEspecialidad,$idPlan){
        try{
            $_db = new Database();
            $sql = "DELETE FROM plan_estudio_competencia_especialidad WHERE plan_estudio_id=$idPlan AND especialidad_id=$idComEspecialidad";
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