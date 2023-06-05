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
}