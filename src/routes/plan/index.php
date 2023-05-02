<?php

use Penad\Tesis\controllers\CurricularDesign;
use Penad\Tesis\models\StudyPlan;

//vista de todos los planes de estudio vigentes
$router->get('/planes/{pagina}', function($page){
    notAuth();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'planes';
    $_GET['regresar'] = 'home';
    $controller = new CurricularDesign;
    $controller->getPlans($page);
});

//vista al crear un plan de estudio
$router->get('/plan/create/{id}', function($id){
    notAuth();
    $controller = new CurricularDesign;
    $user = $_SESSION['user'];
    $plan = StudyPlan::getPlan($id);
    $data = [
        'title' => 'Editor Plan Estudio',
        'user' => $user,
        'plan' => $plan,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
    ];
    $controller->render('plan/create', $data);
});

//Descargar documento en word
$router->get('/word/{id}', function($id){
    $controller = new CurricularDesign;
    $controller->word($id);
});

//CRUD
//Crear plan
$router->post('/planes', function(){
    notAuth();
    $controller = new CurricularDesign;
    $controller->createPlan();
});

$router->post('/plan/create/{id}', function($id){
    notAuth();
    $controller = new CurricularDesign;
    $controller->savePlan($id);
});