<?php

//Uso de controladores
use Penad\Tesis\controllers\Error;

$router = new \Bramus\Router\Router();
session_start();

//Inicializando archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../config');
$dotenv->load();

//Requrimos las autenticaciones
require_once __DIR__.'/auth.php';

//requerimos la rutas
require __DIR__.'/../routes/login/index.php';
require __DIR__.'/../routes/home/index.php';
require __DIR__.'/../routes/curricularDesign/index.php';
require __DIR__.'/../routes/facultad/index.php';

//manejador de error 404
$router->set404(function() {
    // header('HTTP/1.1 404 Not Found');
    http_response_code(404);
    $data = [
        'status' => '404',
        'message' => 'Pagina no encontrada'
    ];

    $controller = new Error();
    $controller->render('404/index', $data);
});

//funcion que corre la aplicación
$router->run();