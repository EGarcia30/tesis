<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class ValorInstitucional extends Model{

    public function __construct(){
        parent::__construct();
    }

    public static function getValores(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM valor_institucional";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}