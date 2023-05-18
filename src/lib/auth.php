<?php

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

function IsAdmin(){
    if($_SESSION['user']->getRol() == "Administrador"){
        header('location: /tesis/home');
        exit();
    }
}

function IsUser(){
    if($_SESSION['user']->getRol() == "Usuario"){
        header('location: /tesis/home');
        exit();
    }
}