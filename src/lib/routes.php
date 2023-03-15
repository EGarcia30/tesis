<?php

$router = new \Bramus\Router\Router();
session_start();

$router->get('/', function(){
    echo "Inicio";
});

$router->get('/login', function(){
    echo "Hola soy Login";
});

$router->get('/signup', function(){
    echo "Hola soy signup";
});

$router->run();