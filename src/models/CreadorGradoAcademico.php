<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CreadorGradoAcademico extends Model{

    private int $_idCreador;
    private array $_idGrado = [];

    public function __construct(int $idCreador, array $idGrado = []){
        parent::__construct();
        $this->_idCreador = $idCreador;
        $this->_idGrado = $idGrado;
    }

    public static function getGradoCreador($id){
        try{
            $_db = new Database();
            $sql = "SELECT g.grado_id, g.nombre_grado as Grados_Academicos FROM grado_academico g
            INNER JOIN creador_grado_academico cg ON g.grado_id = cg.grado_id
            INNER JOIN creador c ON c.creador_id = $id and c.creador_id = cg.creador_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function createCreadorGrado(){
        try{
            foreach($this->_idGrado as $key => $value){
                $idGrado = intval($this->_idGrado[$key]);
                $sql = 'INSERT INTO creador_grado_academico(creador_id, grado_id) VALUES(?,?)';
                $query = $this->prepare($sql);
                $data = [$this->_idCreador,$idGrado];
                $res = $query->execute($data);
            }            
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteGradoCreador($idGrado,$idCreador){
        try{
            $_db = new Database();
            $sql = "DELETE FROM creador_grado_academico WHERE creador_id=$idCreador AND grado_id=$idGrado";
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