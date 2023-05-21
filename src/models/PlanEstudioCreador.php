<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioCreador extends Model{

    private int $_idPlan;
    private array $_idCreador;

    public function __construct(int $idPlan , array $idCreador = []){
        parent::__construct();
        $this->_idPlan = $idPlan;
        $this->_idCreador = $idCreador;
    }

    public static function getCreadorPlan($id){
        try{
            $_db = new Database();
            $sql = "SELECT c.creador_id, c.nombre_creador as Creador FROM creador c
            INNER JOIN plan_estudio_creador pc ON c.creador_id = pc.creador_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id and pe.plan_estudio_id = pc.plan_estudio_id
            WHERE c.status=1";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getCreadorPlanId($id){
        try{
            $_db = new Database();
            $sql = "SELECT c.creador_id as id FROM creador c
            INNER JOIN plan_estudio_creador pc ON c.creador_id = pc.creador_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id and pe.plan_estudio_id = pc.plan_estudio_id
            WHERE c.status=1";
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
    public function createPlanCreador(){
        try{
            foreach($this->_idCreador as $key => $value){
                $idCreador = intval($this->_idCreador[$key]);
                $sql = 'INSERT INTO plan_estudio_creador(plan_estudio_id, creador_id) VALUES(?,?)';
                $query = $this->prepare($sql);
                $data = [$this->_idPlan,$idCreador];
                $res = $query->execute($data);
            }            
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //eliminar o desvincular
    public static function deletePlanCreador($idCreador,$idPlan){
        try{
            $_db = new Database();
            $sql = "DELETE FROM plan_estudio_creador WHERE creador_id=$idCreador AND plan_estudio_id=$idPlan";
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