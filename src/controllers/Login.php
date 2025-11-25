<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\User;

class Login extends Controller{
    
    public function __construct(){
        parent::__construct();
    }

    public function auth(){
        $username = $this->post('usuario');
        $password= $this->post('clave');

        //inputs vacios
        if(empty($username) || empty($password)){
            $_SESSION['color'] = "warning";
            $_SESSION['message'] = "Datos Incompletos";
            
            error_log('Incomplete Data');
            header('location: /tesis/');
            exit();
        }
        //Validar campo de usuario
        $data = $username != null ? User::existsUser($username) : ['num' => '0'];
        //busar usuario en bd
        if(empty($data['num'])){
            $_SESSION['color'] = "warning";
            $_SESSION['message'] = "Usuario no encontrado";

            error_log('User not found');
            header('location: /tesis/');
            exit();
        }
        //Obtener usuario
        $user = User::getUser($username);
        //comparacion de contraseña
        if(!$user->comparePassword($password)){
            $_SESSION['color'] = "danger";
            $_SESSION['message'] = "Contraseña Incorrecta";

            error_log('Password Incorrect');
            header('location: /tesis/');
            exit();
        }
        //Asignar a variable de sesion el modelo user
        $_SESSION['user'] = $user;
        
        error_log('User loggedd in');
        header('location: /tesis/home');
    }
}