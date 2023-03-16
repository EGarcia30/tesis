<?php

namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use PDO;
use PDOException;

class User extends Model{

    private int $_id;
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
    public function insertUser(){
        try{
            //TODO: validar si existe usuario
            $data = $this->getExists($this->_usuario);
            $validation = intval($data[0]['num']);
            if($validation === 0){
                $hash = $this->getHashedPassword($this->_clave);
                $sql = 'INSERT INTO usuarios (usuario, clave, rol_usuario, nombre) VALUES(:usuario, :clave, :rol_usuario, :nombre)';
                $query = $this->prepare($sql);
                $query->bindValue(':usuario',$this->_usuario);
                $query->bindValue(':clave',$hash);
                $query->bindValue(':rol_usuario',$this->_rol_usuario);
                $query->bindValue(':nombre',$this->_nombre);
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
    public function getExists(string $user){
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

    public function getId(){
        return $this->_id;
    }

    public function setId(int $value){
        return $this->_id = $value;
    }

    public function getUser(){
        return $this->_usuario;
    }

    public function setUser(string $value){
        return $this->_usuario = $value;
    }

    public function getRol(){
        return $this->_id;
    }

    public function setRol(string $value){
        return $this->_rol_usuario = $value;
    }

    public function getName(){
        return $this->_nombre;
    }

    public function setName(string $value){
        return $this->_nombre = $value;
    }
}