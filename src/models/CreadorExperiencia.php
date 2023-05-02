<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CreadorExperiencia extends Model{

    private int $_idCreador;
    private array $_idExperiencia;

    public function __construct(int $idCreador, array $idExperiencia = []){
        parent::__construct();
        $this->_idCreador = $idCreador;
        $this->_idExperiencia = $idExperiencia;
    }

    public static function getExperienciaCreador($id){
        try{
            $_db = new Database();
            $sql = "SELECT e.descripcion as Experiencia FROM experiencia_profesional e
            INNER JOIN creador_experiencia_profesional ce ON e.experiencia_id = ce.experiencia_id
            INNER JOIN creador c ON c.creador_id = $id and c.creador_id = ce.creador_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function createCreadorExperiencia(){
        try{
            foreach($this->_idExperiencia as $key => $value){
                $idExperiencia = intval($this->_idExperiencia[$key]['id_experiencia']);
                $sql = 'INSERT INTO creador_experiencia_profesional(creador_id, experiencia_id) VALUES(?,?)';
                $query = $this->prepare($sql);
                $data = [$this->_idCreador,$idExperiencia];
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