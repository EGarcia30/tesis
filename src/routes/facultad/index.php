<?php

use Penad\Tesis\controllers\FacultadController; 
use Penad\Tesis\models\FacultadModel;

//vista principal facultades
$router->get('/facultades/{pagina}', function($page){
    notAuth();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'facultades';
    $controller = new FacultadController;
    $controller->getAllFacultad($page);
});

//buscando una facultad especifica
$router->post('/facultades', function(){
    notAuth();
    $controller = new FacultadController;
    $controller->searchFacultades();
});

//vista update facultad
$router->get('/updateFacultad/{id}', function($id){
    notAuth();
    $controller = new FacultadController;
    $req = FacultadModel::getFacultad($id);
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Modificar Facultad',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message'],
        'facultad' => $req
    ];
    $controller->render('facultad/update', $data);
});

//CRUD
//UPDATE
$router->post('/updateFacultad/{id}',function($id){
    notAuth();
    $controller = new FacultadController;
    $controller->updateFacultad($id);
});

//delete
$router->get('/deleteFacultad/{id}', function($id){
    $controller = new FacultadController;
    $controller->deleteFacultad($id);
});