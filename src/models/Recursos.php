<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Recursos extends Model{

    private int $_id;
    private array $_titulo = [];
    private array $_link = [];
    private int $_materia_id;

    public function __construct(array $data = [],$materia_id){
        parent::__construct();
        for($i = 0; $i < count($data); $i++){
            if($i % 2 == 0){
                array_push($this->_titulo, $data[$i]);
            }else{
                array_push($this->_link, $data[$i]);
            }
        }
        $this->_materia_id = intval($materia_id);
    }

    public static function getRecursos($id){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM recursos WHERE materia_id={$id}";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function createRecurso(){
        try{
            for($i = 0; $i < count($this->_titulo); $i++){
                $sql = "INSERT INTO recursos(titulo,link,materia_id) VALUES(?,?,?)";
                $query = $this->prepare($sql);
                $data = [$this->_titulo[$i],$this->_link[$i], $this->_materia_id];
                $res = $query->execute($data);
            }
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteRecursos($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM recursos WHERE materia_id={$id}";
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