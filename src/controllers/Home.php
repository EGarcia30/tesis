<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\User;

class Home extends Controller{


    public function __construct(){
        parent::__construct();
    }

    public function getUsers($page){
        $user = $_SESSION['user'];
        $totalItems = User::rowUsers();
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $users = User::getUsers($start,$itemShow);
        $data = [
            'title' => 'Usuarios',
            'user' => $user,
            'users' => $users,
            'rows' => $totalItems,
            'itemShow' => $itemShow
        ];

        $this->render('home/users', $data);
    }

    public function searchUser(){
        $search = $this->post('buscar');
        $user = $_SESSION['user'];

        //validar campo
        if(is_null($search)){
            error_log('No recibio el input buscar');
            header("location:/tesis/Users");
            exit();
        }

        //traemos objeto User de bd con su funcion estatica
        $userBD = User::searchUser($search);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(is_null($userBD)){
            error_log('No se pudo buscar en bd');
            header("location:/tesis/Users");
            exit();
        }

        //pasamos los datos
        $data = [
            'title' => 'Usuario',
            'user' => $user,
            'users' => $userBD
        ];
        // renderizamos nueva vista con sus datos
        $this->render('home/search', $data);

    }

    public function createUsers(){

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
            header('location: /tesis/createUsers');
            exit();
        }

        //instancia objeto user y su metodo createUser Para agregar nuevo usuario
        $user = new User($userName,$password,$user_role,$name);
        $res = $user->createUser();

        //si es false retorna error
        if(is_array($res)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = $res[0];
            header('location: /tesis/createUsers');
            exit();
        }

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: usuario no creado.';
            header('location: /tesis/createUsers');
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Usuario creado.';
        header('location: /tesis/createUsers');
    }

    public function updateUsers($id){

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
            $_SESSION['message'] = 'Ingresar datos.';
            header("location: /tesis/updateUsers/$id");
            exit();
        }

        //instancia objeto user y su metodo createUser Para agregar nuevo usuario
        $user = new User($userName,$password,$user_role,$name);
        $user->setId($id);
        $res = $user->updateUser();

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: cambios no realizados.';
            header("location: /tesis/updateUsers/$id");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location: /tesis/updateUsers/$id");
    }

    public function updatePassword($id){
        $name = $this->post('nombre');
        $userName = $this->post('usuario');
        $newPassword = $this->post('clave');
        $user_role = $this->post('radio');

        //validación de campos
        if(empty($newPassword)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            header("location: /tesis/updateUsers/$id");
            exit();
        }

        $user = new  User($userName,$newPassword,$user_role,$name);
        $user->setId($id);
        $res = $user->updatePassword();

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: cambios no realizados.';
            header("location: /tesis/updateUsers/$id");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location: /tesis/updateUsers/$id");

    }

    public function deleteUser($id){

        $res = User::deleteUser($id);
        header('location:/tesis/users/1');
    }
}