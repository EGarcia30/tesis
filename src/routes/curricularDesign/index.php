<?php

use Penad\Tesis\controllers\CurricularDesign;
use Penad\Tesis\models\StudyPlan;

//vista plan de estudio
$router->get('/plan', function(){
    notAuth();
    $controller = new CurricularDesign();
    $controller->getPlans();
});

//Vista plan de estudio por medio de busquedad
$router->post('/plan', function(){
    notAuth();
    $controller = new CurricularDesign();
    $controller->searchPlan();
});

//vista create plan de estudio
$router->get('/create', function(){
    notAuth();
    $controller = new CurricularDesign();
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Crear Plan de Estudio',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
    ];
    $controller->render('plan/create', $data);
});

//vista update plan de estudio
$router->get('/update/{id}', function($id){
    notAuth();
    $controller = new CurricularDesign();
    $req = StudyPlan::getPlan($id);
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Modificar Plan de Estudio',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message'],
        'studyPlan' => $req
    ];
    $controller->render('plan/update', $data);

});

//vista delete plan de estudio
$router->get('/delete/{id}', function($id){
    notAuth();
    $controller = new CurricularDesign();
    $req = StudyPlan::getPlan($id);
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Eliminar Plan de Estudio',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message'],
        'studyPlan' => $req
    ];
    $controller->render('plan/delete', $data);

});

//descargar documento de word
$router->get('/word/{id}', function($id){
    $controller = new CurricularDesign;
    $controller->word($id);
});

//CRUD plan de estudio
//Ingresar
$router->post('/create', function(){
    notAuth();
    $controller = new CurricularDesign();
    $controller->create();
});

//Modificar
$router->post('/update/{id}', function($id){
    notAuth();
    $controller = new CurricularDesign();
    $controller->update($id);
});