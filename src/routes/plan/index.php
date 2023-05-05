<?php

use Penad\Tesis\controllers\CurricularDesign;
use Penad\Tesis\models\StudyPlan;
use Penad\Tesis\models\CreadorModel;
use Penad\Tesis\models\PlanEstudioCreador;
use Penad\Tesis\models\GeneralidadesCarrera;
use Penad\Tesis\models\PlanEstudioGeneralidadesCarrera;
use Penad\Tesis\models\PropositoCarrera;
use Penad\Tesis\models\PlanEstudioPropositoCarrera;

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
    $creadores = CreadorModel::getCreadoresPlan();
    $creador = PlanEstudioCreador::getCreadorPlan($id);
    $generalidades = PlanEstudioGeneralidadesCarrera::getPlanGeneralidad($id);
    $generalidad = GeneralidadesCarrera::getGeneralidad($generalidades == NULL ? 0 : $generalidades[0]['Id']);
    $proId = PlanEstudioPropositoCarrera::getPlanPropositoId($id);
    $proposito = PropositoCarrera::getProposito($proId == NULL ? 0 : $proId[0]['Id']);
    $data = [
        'title' => 'Editor Plan Estudio',
        'user' => $user,
        'plan' => $plan,
        'creadores' => $creadores,
        'creador' => $creador,
        'generalidad' => $generalidad,
        'proposito' => $proposito,
        'color' => $_SESSION['color'] == '' ? '' : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? '' : $_SESSION['message']
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