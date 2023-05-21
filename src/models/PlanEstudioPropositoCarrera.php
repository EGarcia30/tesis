<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\models\PropositoCarrera;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioPropositoCarrera extends Model{

    private int $_idPlan;
    private int $_idProposito;

    public function __construct($idPlan,$idProposito){
        parent::__construct();
        $this->_idPlan = $idPlan;
        $this->_idProposito = $idProposito;
    }

    public static function getPlanPropositoId($id){
        try{
            $_db = new Database();
            $sql = "SELECT pc.proposito_id as Id FROM proposito_carrera pc
            INNER JOIN plan_estudio_proposito_carrera ppc ON pc.proposito_id = ppc.proposito_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id and pe.plan_estudio_id = ppc.plan_estudio_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //CRUD
    //ingresar
    public function createPlanProposito(){
        try{
            $sql = 'INSERT INTO plan_estudio_proposito_carrera(plan_estudio_id, proposito_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idPlan,$this->_idProposito];
            $res = $query->execute($data);        
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}