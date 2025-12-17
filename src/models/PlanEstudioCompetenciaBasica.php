<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioCompetenciaBasica extends Model{

    private int $_idPlan;
    private int $_idComBasica;

    public function __construct(int $idPlan, int $idComBasica){
        parent::__construct();
        $this->_idPlan = $idPlan;
        $this->_idComBasica = $idComBasica;
    }

    public static function getPlanComBasicas($id){
        try{
            $_db = new Database();
            $sql = "SELECT cb.* FROM competencia_basica cb
            INNER JOIN plan_estudio_competencia_basica pcb ON cb.basico_id = pcb.basico_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id AND pe.plan_estudio_id = pcb.plan_estudio_id
            ORDER BY cb.ciclo ASC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function createPlanComBasica(){
        try{
            $sql = 'INSERT INTO plan_estudio_competencia_basica(plan_estudio_id, basico_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idPlan,$this->_idComBasica];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //desvinculando plan de estudio con competencia general
    public static function deletePlanComBasica($idComBasica,$idPlan){
        try{
            $_db = new Database();
            $sql = "DELETE FROM plan_estudio_competencia_basica WHERE plan_estudio_id=$idPlan AND basico_id=$idComBasica";
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