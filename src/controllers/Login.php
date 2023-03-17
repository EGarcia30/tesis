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
        $data = $username !== '' ? User::getExists($username) : ['num' => '0'];

        //inputs vacios
        if(empty($username) || empty($password)){
            error_log('Incomplete Data');
            header('location: /tesis/');
        }
        //busar usuario en bd
        else if(empty($data['num'])){
            error_log('User not found');
            header('location: /tesis/');
        }
        else{
            $user = User::getUser($username);
            //comparacion de contraseña
            if(!$user->comparePassword($password)){
                error_log('Password Incorrect');
                header('location: /tesis/');
            }
            else{
                $_SESSION['user'] = serialize($user);
                
                error_log('User loggedd in');
                header('location: /tesis/home');
            }
        }
    }
}