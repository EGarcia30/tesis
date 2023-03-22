<?php

//Uso de controladores
use Penad\Tesis\controllers\Signup;
use Penad\Tesis\controllers\Login;
use Penad\Tesis\controllers\Home;
use Penad\Tesis\controllers\Error;

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
    $data = [
        'color' => unserialize($_SESSION['color']),
        'message' => unserialize($_SESSION['message'])
    ];
    $controller->render('login/index', $data);
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

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    $data = [
        'status' => '404',
        'message' => 'Pagina no encontrada'
    ];

    $controller = new Error();
    $controller->render('404/index', $data);
});

$router->run();