<?php

error_reporting(E_ALL); // Habilitar el reporte

ini_set('ignore_repeated_errors', TRUE); //ignorar si un error se repite

ini_set('display_errors', FALSE); // muestra de errores 

ini_set('log_errors', TRUE); // nivel de log

ini_set("error_log", "php-error.log");
error_log("Inicia App");

require 'vendor/autoload.php';
require 'src/lib/routes.php';