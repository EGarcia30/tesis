<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\models\GeneralidadesCarrera;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanEstudioGeneralidadesCarrera extends Model{

    private int $_idPlan;
    private int $_idGeneralidad;

    public function __construct(int $idPlan , int $idGeneralidad){
        parent::__construct();
        $this->_idPlan = $idPlan;
        $this->_idGeneralidad = $idGeneralidad;
    }

    public static function getPlanGeneralidad($id){
        try{
            $_db = new Database();
            $sql = "SELECT gc.generalidades_id as Id FROM generalidades_carrera gc
            INNER JOIN plan_estudio_generalidades_carrera pgc ON gc.generalidades_id = pgc.generalidades_id
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id and pe.plan_estudio_id = pgc.plan_estudio_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    //CRUD
    //ingresar
    public function createPlanGeneralidad(){
        try{
            $sql = 'INSERT INTO plan_estudio_generalidades_carrera(plan_estudio_id, generalidades_id) VALUES(?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_idPlan,$this->_idGeneralidad];
            $res = $query->execute($data);        
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}