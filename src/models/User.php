<?php

namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use PDO;
use PDOException;

class User extends Model{

    private string $_usuario; 
    private string $_clave;
    private string $_rol_usuario;
    private string $_nombre;

    public function __construct(string $usuario, string $clave, string $rol_usuario, string $nombre){
        parent::__construct(); 
        $this->_usuario = $usuario;
        $this->_clave = $clave;
        $this->_rol_usuario = $rol_usuario;
        $this->_nombre = $nombre;
        // $this->db = $this->_db->connect();
    }

    //insertar usuarios
    public function save(){
        try{
            //TODO: validar si existe usuario
            $data = $this->getUserVlaidation($this->_usuario);
            $validation = intval($data[0]['num']);
            if($validation === 0){
                $hash = $this->getHashedPassword($this->_clave);
                $sql = 'INSERT INTO usuarios (usuario, clave, tipo_usuario) VALUES(:usuario, :clave, :tipo_usuario)';
                $query = $this->prepare($sql);
                $query->bindValue(':usuario',$this->_usuario);
                $query->bindValue(':clave',$hash);
                $query->bindValue(':tipo_usuario',$this->_rol_usuario);
                $res = $query->execute();
                return $res;
            }
            else{
                $message = array('Usuario ya existente.');
                return $message;
            }            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }


    //obtener usuario
    public function getUserValidation(string $user){
        try{
            $sql = "SELECT COUNT(*) as num FROM usuarios WHERE usuario=$user";
            $query = $this->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;

        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }        
    }

    //encriptar contraseñas
    private function getHashedPassword($clave){
        return password_hash($clave, PASSWORD_DEFAULT, ['cost' == 10]);
    }
}