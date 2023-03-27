<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\User;

class Login extends Controller{
    
    public function __construct(){
        parent::__construct();
    }

    public function auth(){
        $username = $this->post('usuario') != '' ? $this->post('usuario') : '';
        $password= $this->post('clave') != '' ? $this->post('clave') : '';
        $data = $username !== '' ? User::existsUser($username) : ['num' => '0'];

        //inputs vacios
        if(empty($username) || empty($password)){
            $_SESSION['color'] = "warning";
            $_SESSION['message'] = "Datos Incompletos";
            
            error_log('Incomplete Data');
            header('location: /tesis/');
        }
        //busar usuario en bd
        else if(empty($data['num'])){
            $_SESSION['color'] = "warning";
            $_SESSION['message'] = "Usuario no encontrado";

            error_log('User not found');
            header('location: /tesis/');
        }
        else{
            $user = User::getUser($username);
            //comparacion de contraseña
            if(!$user->comparePassword($password)){
                $_SESSION['color'] = "danger";
                $_SESSION['message'] = "Contraseña Incorrecta";

                error_log('Password Incorrect');
                header('location: /tesis/');
            }
            else{
                $_SESSION['user'] = $user;
                
                error_log('User loggedd in');
                header('location: /tesis/home');
            }
        }
    }
}