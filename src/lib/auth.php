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