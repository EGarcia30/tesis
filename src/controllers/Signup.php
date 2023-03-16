<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\User;

class Signup extends Controller{

    private string $_usuario;
    private string $_clave;
    private string $_rol_usuario;
    private string $_nombre;

    public function __construct(){
        parent::__construct();      
        $this->_usuario = '';
        $this->_clave = '';
        $this->_rol_usuario = '';
        $this->_nombre = '';
    }

    public function register(){
        $this->_usuario = $this->post('usuario');
        $this->_clave = $this->post('clave');
        $this->_rol_usuario = $this->post('rol_usuario');
        $this->_nombre = $this->post('nombre');

        if(
            !is_null($this->_usuario) &&
            !is_null($this->_clave) &&
            !is_null($this->_rol_usuario)&&
            !is_null($this->_nombre)
        ){
            $user = new User($this->_usuario, $this->_clave, $this->_rol_usuario, $this->_nombre);
            $user->save();
            header('location: /tesis/login');
        }
        else{
            $this->render('errors/index');
        }
    }
}