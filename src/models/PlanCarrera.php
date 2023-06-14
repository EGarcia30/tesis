<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class PlanCarrera extends Model{

    public function __construct(){
        parent::__construct();
    }

    public static function getCarreraPlanes($name,$start,$end){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM plan_estudio WHERE nombre_carrera='$name' ORDER BY status DESC LIMIT $start, $end";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function rowCarreraPlanes($name){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM plan_estudio WHERE nombre_carrera='$name'";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $rows = $query->rowCount();       
            return $rows;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}