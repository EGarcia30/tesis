<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\User;

class Perfil extends Controller{

    public function __construct(){
        parent::__construct();
    }


    public function updatePerfil($id){

        $name = $this->post('nombre');
        $userName = $this->post('usuario');
        $password = $this->post('clave');
        $user_role = $this->post('radio');

        //validación de campos
        if(
            is_null($name) &&
            is_null($userName) &&
            is_null($password) &&
            is_null($user_role)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Los campos no pueden estar vacios.';
            header("location: /tesis/perfil");
            exit();
        }

        //instancia objeto user y su metodo createUser Para agregar nuevo usuario
        $user = new User($userName,$password,$user_role,$name);
        $user->setId($id);
        $res = $user->updateUser();

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: Al actualizar tus datos.';
            header("location: /tesis/perfil");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Has Cambiado tu perfil con Exito.';
        header("location: /tesis/perfil");
    }

    public function updatePasswordPerfil($id){
        $name = $this->post('nombre');
        $userName = $this->post('usuario');
        $newPassword = $this->post('clave');
        $user_role = $this->post('radio');

        //validación de campos
        if(is_null($newPassword)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Los campos no pueden estar vacios.';
            header("location: /tesis/perfil");
            exit();
        }

        $user = new  User($userName,$newPassword,$user_role,$name);
        $user->setId($id);
        $res = $user->updatePassword();

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'has Cambiado tu contraseña con Exito.';
        header("location: /tesis/perfil");

    }
}