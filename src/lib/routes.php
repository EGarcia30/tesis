<?php

$router = new \Bramus\Router\Router();
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../config');
$dotenv->load();

$router->get('/', function(){
    echo "<h1>ALEJANDRO ME LA PELASSSSSSS</h1>";
});

$router->get('/login', function(){
    echo "Hola soy Login";
});

$router->get('/signup', function(){
    $controller = new Penad\Tesis\controllers\Signup;
    $controller->render('signup/index');
});

$router->post('/register', function(){
    $controller = new Penad\Tesis\controllers\Signup;
    $controller->register();
});

$router->run();