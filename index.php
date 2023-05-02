<?php

date_default_timezone_set("America/El_Salvador");

error_reporting(E_ALL); // Habilitar el reporte

ini_set('ignore_repeated_errors', TRUE); //ignorar si un error se repite

ini_set('display_errors', FALSE); // muestra de errores 

ini_set('log_errors', TRUE); // nivel de log

ini_set("error_log", "php-error.log");
error_log("Start App");

require 'vendor/autoload.php';
require 'src/config/__init__.php';
require 'src/lib/routes.php';