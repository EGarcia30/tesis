<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Areas extends Model{

    private int $_id;
    private string $_area;
    private string $_puesto;
    private string $_funciones;
    private string $_tipo;
    private int $_idPlan;

    public function __construct($area, $areaPuesto, $areaFunciones, $areaOrganizacion, int $idPlan){
        parent::__construct();
        $this->_area = $area;
        $this->_puesto = $areaPuesto;
        $this->_funciones = $areaFunciones;
        $this->_tipo = $areaOrganizacion;
        $this->_idPlan = intval($idPlan);
    }

    public static function getAreasPlan($id){
        try{
            $_db = new Database();
            $sql = "SELECT ad.* FROM area_desempenio ad
            INNER JOIN plan_estudio pe ON pe.plan_estudio_id = $id AND pe.plan_estudio_id = ad.plan_estudio_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function createAreas(){
        try{
            $sql = "INSERT INTO area_desempenio(area,puesto,funciones_puesto,tipo_organizacion,plan_estudio_id) VALUES(?,?,?,?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_area,$this->_puesto,$this->_funciones,$this->_tipo,$this->_idPlan];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function updateAreas($id,$area,$puesto,$funcion,$tipo){
        try{
            $_db = new Database();
            $sql = "UPDATE area_desempenio SET area='$area', puesto='$puesto', funciones_puesto='$funcion', tipo_organizacion='$tipo' WHERE area_id=$id";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteAreas($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM area_desempenio WHERE area_id=$id";
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