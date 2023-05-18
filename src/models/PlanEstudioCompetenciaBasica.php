<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioCompetenciaBasica extends Model{

    private int $_idPlan;
    private array $_idComBasica;

    public function __construct(int $idPlan, array $data = []){
        parent::__construct();
        $this->_idPlan = $idPlan;
        $this->_idComBasica = $data;
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
            return $e->getMessage();
        }
    }

    public function createPlanComBasica(){
        try{
            foreach($this->_idComBasica as $key => $value){
                $sql = 'INSERT INTO plan_estudio_competencia_basica(plan_estudio_id, basico_id) VALUES(?,?)';
                $query = $this->prepare($sql);
                $data = [$this->_idPlan,$value['id_basico']];
                $res = $query->execute($data);
            }
            return $res;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }
}