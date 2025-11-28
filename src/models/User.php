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
    private int $_status;

    public function __construct(string $username, string $password, string $user_role, string $name){
        parent::__construct(); 
        $this->_username = $username;
        $this->_password = $password;
        $this->_user_role = $user_role;
        $this->_name = $name;
    }

    public static function getUsers(int $start,int $end){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM usuarios WHERE status=1 ORDER BY usuario_id DESC LIMIT $start, $end";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $res = $query->fetchAll(PDO::FETCH_ASSOC);       
            return $res;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function rowUsers(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM usuarios WHERE status=1";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $rows = $query->rowCount();       
            return $rows;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function searchUser($data,int $start,int $end){
        try{

            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM usuarios WHERE status=1 AND (usuario_id=$int 
            OR nombre_usuario LIKE '%$data%' 
            OR usuario LIKE '%$data%' 
            OR rol_usuario LIKE '%$data%')
            ORDER BY usuario_id DESC
            LIMIT $start, $end ";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);      
            return $res;   

        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //contar resultados de busqueda
    public static function rowSearchUsers($data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM usuarios WHERE status=1 AND (usuario_id=$int 
            OR nombre_usuario LIKE '%$data%' 
            OR usuario LIKE '%$data%' OR rol_usuario LIKE '%$data%') ";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $rows = $query->rowCount();       
            return $rows;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getUser($value){
        try{
            $id = intval($value);
            $_db = new Database();
            $sql = "SELECT * FROM usuarios WHERE usuario_id=$id OR usuario='$value' ";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            
            $user = new User($res['usuario'], $res['clave'], $res['rol_usuario'], $res['nombre_usuario']);
            $user->setId($res['usuario_id']);
            $user->setStatus($res['status']);
            
            return $user;
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener usuario
    public static function existsUser(string $user){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) as num FROM usuarios WHERE usuario='$user' AND status=1 ";
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
    public function createUser(){
        try{
            //TODO: validar si existe usuario
            $data = $this->existsUser($this->_username);
            $validation = intval($data['num']);
            if(!empty($validation)){
                $message = array('Usuario ya existente.');
                return $message;
                exit();
            }
            $hash = $this->getHashedPassword($this->_password);
            $sql = 'INSERT INTO usuarios (nombre_usuario, usuario, clave, rol_usuario, status) VALUES(?, ?, ?, ?, ?)';
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_username,$hash,$this->_user_role,1];
            $res = $query->execute($data);
            return $res;           
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateUser(){
        try{
            $sql = 'UPDATE usuarios SET nombre_usuario=?, usuario=?, clave=?, rol_usuario=? WHERE usuario_id=?';
            $query = $this->prepare($sql);
            $data = [$this->_name,$this->_username,$this->_password,$this->_user_role,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function updatePassword(){
        try{
            $newHash = $this->getHashedPassword($this->_password);
            $sql = 'UPDATE usuarios SET clave=? WHERE usuario_id=?';
            $query = $this->prepare($sql);
            $data = [$newHash,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOexception $e){
            error_log($e->getMessage());
            return false;
        }

    }

    public static function deleteUser($id){
        try{
            $_db = new Database();
            $sql = "UPDATE usuarios SET status=? WHERE usuario_id=?";
            $query = $_db->connect()->prepare($sql);
            $data = [0,$id];
            $res = $query->execute($data);
            return $res;
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

    //comparar contraseña
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

    public function getPassword(){
        return $this->_password;
    }

    public function setPassword(string $value){
        return $this->_password = $value;
    }

    public function getStatus(){
        return $this->_status;
    }

    public function setStatus(int $value){
        return $this->_status = $value;
    }
}