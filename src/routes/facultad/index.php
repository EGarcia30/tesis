<?php

use Penad\Tesis\models\FacultadModel;
use Penad\Tesis\controllers\FacultadController; 

//vista principal facultades
$router->get('/facultades/{pagina}', function($page){
    notAuth();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $controller = new FacultadController;
    $controller->getAllFacultad($page);
});