<?php

namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class User extends Model{

    private int $_id;
    private string $_username; 
    private string $_password;
    private string $_user_role;
    private string $_name;

    public function __construct(string $username, string $password, string $user_role, string $name){
        parent::__construct(); 
        $this->_username = $username;
        $this->_password = $password;
        $this->_user_role = $user_role;
        $this->_name = $name;
    }

    public static function getUsers(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM usuarios";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);         
            return $res;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return NULL;
        }
    }

    public static function getUser(string $name):User{
        try{
            $_db = new Database();
            $sql = "SELECT * FROM usuarios WHERE usuario=$name";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            
            $user = new User($res['usuario'], $res['clave'], $res['rol_usuario'], $res['nombre']);
            $user->setId($res['usuario_id']);
            
            return $user;
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return NULL;
        }
    }

    //obtener usuario
    public static function existsUser(string $user){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM usuarios WHERE usuario=$user";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;

        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }        
    }


    //CRUD
    //insertar usuarios
    public function insertUser(){
        try{
            //TODO: validar si existe usuario
            $data = $this->getExists($this->_username);
            $validation = intval($data['num']);
            if(empty($data['num'])){
                $hash = $this->getHashedPassword($this->_password);
                $sql = 'INSERT INTO usuarios (usuario, clave, rol_usuario, nombre) VALUES(:usuario, :clave, :rol_usuario, :nombre)';
                $query = $this->prepare($sql);
                $query->bindValue(':usuario',$this->_username);
                $query->bindValue(':clave',$hash);
                $query->bindValue(':rol_usuario',$this->_user_role);
                $query->bindValue(':nombre',$this->_name);
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

    //Seguridad
    //encriptar contraseñas
    private function getHashedPassword(string $password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' == 10]);
    }

    //comprar contraseña
    public function comparePassword(string $password):bool{
        return password_verify($password, $this->_password);
    }

    //get y set de Objeto user
    public function getId(){
        return $this->_id;
    }

    public function setId(int $value){
        return $this->_id = $value;
    }

    public function getUsername(){
        return $this->_username;
    }

    public function setUsername(string $value){
        return $this->_username = $value;
    }

    public function getRol(){
        return $this->_user_role;
    }

    public function setRol(string $value){
        return $this->_user_role = $value;
    }

    public function getName(){
        return $this->_name;
    }

    public function setName(string $value){
        return $this->_name = $value;
    }
}