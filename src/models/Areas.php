<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Areas extends Model{

    private int $_id;
    private array $_area = [];
    private array $_puesto = [];
    private array $_funciones = [];
    private array $_tipo = [];
    private int $_idPlan;

    public function __construct(array $data = [], int $idPlan){
        parent::__construct();
        $actualArrPar = $this->_area;
        $actualArrImpar = $this->_funciones;
        for ($i = 0; $i < count($data); $i++) {
            if ($i % 2 == 0) {
                if($actualArrPar === $this->_area){
                    array_push($this->_area, $data[$i]);
                    $actualArrPar = $this->_puesto;
                }else{
                    array_push($this->_puesto, $data[$i]);
                    $actualArrPar = $this->_area;
                }
            } else {
                if($actualArrImpar === $this->_funciones){
                    array_push($this->_funciones, $data[$i]);
                    $actualArrImpar = $this->_tipo;
                }else{
                    array_push($this->_tipo, $data[$i]);
                    $actualArrImpar = $this->_funciones;
                }
            }
        }
        $this->_idPlan = $idPlan;
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
            for($i = 0; $i < count($this->_area); $i++){
                $sql = "INSERT INTO area_desempenio(area,puesto,funciones_puesto,tipo_organizacion,plan_estudio_id) VALUES(?,?,?,?,?)";
                $query = $this->prepare($sql);
                $data = [$this->_area[$i],$this->_puesto[$i],$this->_funciones[$i],$this->_tipo[$i],$this->_idPlan];
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