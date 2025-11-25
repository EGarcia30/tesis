<?php

use Penad\Tesis\controllers\Login;

//login
$router->get('/', function(){
    Auth();
    $controller = new Login;
    $data = [
        'color' => isset($_SESSION['color']) ? $_SESSION['color'] : null,
        'message' => isset($_SESSION['message']) ? $_SESSION['message'] : null
    ];
    $controller->render('login/index', $data);
});

//verficacion de datos
$router->post('/auth', function(){
    Auth();
    $controller = new Login;
    $controller->auth();
});