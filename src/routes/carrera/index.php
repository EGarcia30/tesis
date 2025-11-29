<?php

use Penad\Tesis\controllers\CarreraController; 
use Penad\Tesis\models\CarreraModel;
use Penad\Tesis\models\FacultadModel;

//vista principal carreras
$router->get('/carreras/{pagina}', function($page){
    notAuth();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'carreras';
    $_GET['regresar'] = 'home';
    $controller = new CarreraController;
    $controller->getCarreras($page);
});

//vista buscar carreras
$router->get('/searchCarreras/{busqueda}/{page}', function($busqueda,$page){
    notAuth();
    $controller = new CarreraController;
    $page == 0 ? 1 : $page;
    $_GET['busqueda'] = $busqueda;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'searchCarreras/'.$busqueda;
    $_GET['regresar'] = 'carreras/1';
    $controller->searchCarreras($page);
});

//vista buscar carrera en paginacion
$router->get('/carrera/{pagina}', function($page){
    notAuth();
    $controller = new CarreraController;
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'carrera';
    $_GET['regresar'] = $_GET['nombrePagina'].'/1';
    $controller->getSearchCarreras($page);
});

//vista create Carrera
$router->get('/createCarreras', function(){
    notAuth();
    IsUser();
    $controller = new CarreraController;
    $facultades = FacultadModel::getFacultades();
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Crear nueva Carrera',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message'],
        'facultades' => $facultades

    ];
    $controller->render('carrera/create', $data);
});

//vista update Carrera
$router->get('/updateCarrera/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CarreraController;
    $facultades = FacultadModel::getFacultades();
    $carrera = CarreraModel::getCarrera($id);
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Editar Carrera',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message'],
        'facultades' => $facultades,
        'carrera' => $carrera

    ];
    $controller->render('carrera/update', $data);
});

//CRUD
//Crear carrera
$router->post('/createCarreras', function(){
    notAuth();
    IsUser();
    $controller = new CarreraController;
    $controller->createCarrera();
});

$router->post('/updateCarrera/{id}', function($id){
    notAuth();
    $controller = new CarreraController;
    $controller->updateCarrera($id);
});

//eliminar carreras
$router->get('/deleteCarrera/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CarreraController;
    $controller->deleteCarrera($id);
});

//VER PLANES DE ESTUDIO DE LA CARRERA
$router->get('/{carrera}/planes/{pagina}', function($carrera,$page){
    notAuth();
    $controller = new CarreraController;
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = $carrera.'/planes';
    $_GET['regresar'] = 'carrera/1';
    $controller->getCarreraPlanes($carrera,$page);
});