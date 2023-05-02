<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class CreadorParticipacion extends Model{

    private int $_idCreador;
    private array $_idParticipacion;

    public function __construct(int $idCreador, array $idParticipacion = []){
        parent::__construct();
        $this->_idCreador = $idCreador;
        $this->_idParticipacion = $idParticipacion;
    }

    public static function getParticipacionCreador($id){
        try{
            $_db = new Database();
            $sql = "SELECT p.descripcion as Participacion FROM participacion p
            INNER JOIN creador_participacion cp ON p.participacion_id = cp.participacion_id
            INNER JOIN creador c ON c.creador_id = $id and c.creador_id = cp.creador_id";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function createCreadorParticipacion(){
        try{
            foreach($this->_idParticipacion as $key => $value){
                $idParticipacion = intval($this->_idParticipacion[$key]);
                $sql = 'INSERT INTO creador_participacion(creador_id, participacion_id) VALUES(?,?)';
                $query = $this->prepare($sql);
                $data = [$this->_idCreador,$idParticipacion];
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