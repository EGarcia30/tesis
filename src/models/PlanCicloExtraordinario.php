<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanCicloExtraordinario extends Model{
    private int $_idPlan;
    private int $_idCiclo;

    public function __construct($idPlan, $idCiclo){
        parent::__construct();
        $this->_idPlan = intval($idPlan);
        $this->_idCiclo = intval($idCiclo);
    }

    public static function getPlanCiclo($id){
        try{
            $id = intval($id);
            $_db = new Database();
            $sql = "SELECT c.* FROM cicloExtraordinario c
            INNER JOIN plan_estudio_cicloExtraordinario pc ON c.extra_id = pc.extra_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = {$id} AND pe.plan_estudio_id = pc.plan_estudio_id 
            ORDER BY c.ciclo ASC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getPlanExtraordinario($id,$ciclo){
        try{
            $id = intval($id);
            $_db = new Database();
            $sql = "SELECT c.* FROM cicloExtraordinario c
            INNER JOIN plan_estudio_cicloExtraordinario pc ON c.extra_id = pc.extra_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = {$id} AND pe.plan_estudio_id = pc.plan_estudio_id 
            WHERE c.ciclo ={$ciclo} ORDER BY c.no_orden ASC";
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
    public function createPlanCicloExtraordinario(){
        try{
            $sql = 'INSERT INTO plan_estudio_cicloExtraordinario(plan_estudio_id, extra_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idPlan,$this->_idCiclo];
            $res = $query->execute($data);;
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deletePlanCicloExtraordinario($idPlan,$idCiclo){
        try{
            $_db = new Database();
            $sql = "DELETE FROM plan_estudio_cicloExtraordinario WHERE plan_estudio_id={$idPlan} AND extra_id={$idCiclo}";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
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

    public function getIdCiclo(){
        return $this->_idCiclo;
    }

    public function setIdCiclo(int $value){
        return $this->_idCiclo = $value;
    }
}