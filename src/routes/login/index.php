<?php

use Penad\Tesis\controllers\Login;

//login
$router->get('/', function(){
    Auth();
    $controller = new Login;
    $data = [
        'color' => $_SESSION['color'],
        'message' => $_SESSION['message']
    ];
    $controller->render('login/index', $data);
});

//verficacion de datos
$router->post('/auth', function(){
    Auth();
    $controller = new Login;
    $controller->auth();
});