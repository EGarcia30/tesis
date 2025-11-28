<?php

use Penad\Tesis\controllers\FacultadController; 
use Penad\Tesis\models\FacultadModel;

//vista principal facultades
$router->get('/facultades/{pagina}', function($page){
    notAuth();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'facultades';
    $_GET['regresar'] = 'facultades';
    $controller = new FacultadController;
    $controller->getAllFacultad($page);
});

//buscando una facultad especifica
$router->get('/searchFacultades/{busqueda}/{pagina}', function($busqueda,$page){
    notAuth();
    IsUser();
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'searchFacultades/'. $busqueda;
    $_GET['regresar'] = 'facultades';
    $_GET['busqueda'] = $busqueda;
    $controller = new FacultadController;
    $controller->searchFacultades($page);
});

//vista create
$router->get('/createFacultad', function(){
    notAuth();
    IsUser();
    $controller = new FacultadController;
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Crear Facultad',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message'],
    ];
    $controller->render('facultad/create', $data);
});

//vista update facultad
$router->get('/updateFacultad/{id}', function($id){
    notAuth();
    IsUser();
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
//CREAR
$router->post('/createFacultad', function(){
    notAuth();
    IsUser();
    $controller = new FacultadController;
    $controller->createFacultad();
});
//UPDATE
$router->post('/updateFacultad/{id}',function($id){
    notAuth();
    IsUser();
    $controller = new FacultadController;
    $controller->updateFacultad($id);
});

//delete
$router->get('/deleteFacultad/{id}', function($id){
    notAuth();
    IsAdmin();
    IsUser();
    $controller = new FacultadController;
    $controller->deleteFacultad($id);
});