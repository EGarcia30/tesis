<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class MaterialApoyo extends Model{
    private int $_id;
    private string $_material;
    private int $_materia_id;

    public function __construct($material,$materia_id){
        parent::__construct();
        $this->_material = $material;
        $this->_materia_id = intval($materia_id);
    }

    //CRUD
    //Crear
    public function createMaterialApoyo(){
        try{
            $sql = "INSERT INTO material_apoyo(material,materia_id) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_material, $this->_materia_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getId(){
        return $this->_id;
    }

    public function setId(int $value){
        return $this->_id = $value;
    }

    public function getMaterialApoyo(){
        return $this->_material;
    }

    public function setMaterialApoyo(string $value){
        return $this->_material = $value;
    }

    public function getMateriaId(){
        return $this->_materia_id;
    }

    public function setMateriaId(int $value){
        return $this->_materia_id = $value;
    }
}