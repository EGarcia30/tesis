<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioCompetenciaGeneral extends Model{

    private int $_idPlan;
    private array $_idComGeneral;

    public function __construct(int $idPlan, array $data = []){
        parent::__construct();
        $this->_idPlan = $idPlan;
        $this->_idComGeneral = $data;
    }

    public static function getPlanComGenerales($id){
        try{
            $_db = new Database();
            $sql = "SELECT cg.* FROM competencia_general cg
            INNER JOIN plan_estudio_competencia_general pcg ON cg.general_id = pcg.general_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id AND pe.plan_estudio_id = pcg.plan_estudio_id
            ORDER BY cg.ciclo ASC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function createPlanComGeneral(){
        try{
            foreach($this->_idComGeneral as $key => $value){
                $sql = 'INSERT INTO plan_estudio_competencia_general(plan_estudio_id, general_id) VALUES(?,?)';
                $query = $this->prepare($sql);
                $data = [$this->_idPlan,$value['id_general']];
                $res = $query->execute($data);
            }
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}