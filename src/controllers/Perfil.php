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
            empty($name) ||
            empty($userName) ||
            empty($password) ||
            empty($user_role)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar Datos.';
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
            $_SESSION['message'] = 'Error: Cambios no realizados.';
            header("location: /tesis/perfil");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location: /tesis/perfil");
    }

    public function updatePasswordPerfil($id){
        $name = $this->post('nombre');
        $userName = $this->post('usuario');
        $newPassword = $this->post('clave');
        $user_role = $this->post('radio');

        //validación de campos
        if(empty($newPassword)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar Datos.';
            header("location: /tesis/perfil");
            exit();
        }

        $user = new  User($userName,$newPassword,$user_role,$name);
        $user->setId($id);
        $res = $user->updatePassword();

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: Cambios no realizados.';
            header("location: /tesis/perfil");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location: /tesis/perfil");

    }
}