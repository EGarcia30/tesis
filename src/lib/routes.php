<?php

//Uso de controladores
use Penad\Tesis\controllers\Signup;
use Penad\Tesis\controllers\Login;
use Penad\Tesis\controllers\Home;

$router = new \Bramus\Router\Router();
session_start();

//Inicializando archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../config');
$dotenv->load();

//Autenticacion de vistas
function notAuth(){
    if(!isset($_SESSION['user'])){
        header('location: /tesis/');
        exit();
    }
}
function Auth(){
    if(isset($_SESSION['user'])){
        header('location: /tesis/home');
        exit();
    }
}


$router->get('/', function(){
    Auth();
    $controller = new Login;
    $controller->render('login/index');
});

$router->post('/auth', function(){
    Auth();
    $controller = new Login;
    $controller->auth();
});

$router->get('/home', function(){
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->index();
});

$router->get('/signup', function(){
    $controller = new Signup;
    $controller->render('signup/index');
});

$router->get('/signout', function(){
    notAuth();
    unset($_SESSION['user']);
    header('location: /tesis/');
});

$router->post('/register', function(){
    $controller = new Signup;
    $controller->register();
});

$router->run();