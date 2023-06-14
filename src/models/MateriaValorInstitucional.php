<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class MateriaValorInstitucional extends Model{

    private int $_idMateria;
    private int $_idValor;

    public function __construct($idMateria,$idValor){
        parent::__construct();
        $this->_idMateria = intval($idMateria);
        $this->_idValor = intval($idValor);
    }

    public static function getMateriaValores($id){
        try{
            $_db = new Database();
            $sql = "SELECT vi.* FROM valor_institucional vi
            INNER JOIN materia_valor_institucional mvi ON vi.valor_id = mvi.valor_id
            INNER JOIN materia m ON m.materia_id = {$id} AND m.materia_id = mvi.materia_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function createMateriaValor(){
        try{
            $sql = "INSERT INTO materia_valor_institucional(materia_id,valor_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_idMateria,$this->_idValor];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteMateriaValor($id,$valor_id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM materia_valor_institucional WHERE materia_id={$id} AND valor_id={$valor_id}";
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