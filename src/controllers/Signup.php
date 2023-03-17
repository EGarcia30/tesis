<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\User;

class Signup extends Controller{

    private string $_username;
    private string $_password;
    private string $_user_role;
    private string $_name;

    public function __construct(){
        parent::__construct();      
        $this->_username = '';
        $this->_password = '';
        $this->_user_role = '';
        $this->_name = '';
    }

    public function register(){
        $this->_username = $this->post('usuario');
        $this->_password = $this->post('clave');
        $this->_user_role = $this->post('rol_usuario');
        $this->_name = $this->post('nombre');

        if(
            !is_null($this->_username) &&
            !is_null($this->_password) &&
            !is_null($this->_user_role)&&
            !is_null($this->_name)
        ){
            $user = new User($this->_username, $this->_password, $this->_user_role, $this->_name);
            $user->insertUser();
            header('location: /tesis/');
        }
        else{
            $this->render('errors/index');
        }
    }
}