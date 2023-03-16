<?php

//Uso de controladores
use Penad\Tesis\controllers\Signup;
use Penad\Tesis\controllers\Login;

$router = new \Bramus\Router\Router();
session_start();

//Inicializando archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../config');
$dotenv->load();

$router->get('/', function(){
    $controller = new Login;
    $controller->render('login/index');
});

$router->get('/signup', function(){
    $controller = new Signup;
    $controller->render('signup/index');
});

$router->post('/register', function(){
    $controller = new Penad\Tesis\controllers\Signup;
    $controller->register();
});

$router->run();