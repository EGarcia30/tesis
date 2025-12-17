<?php

use Penad\Tesis\controllers\CurricularDesign;
use Penad\Tesis\controllers\CarreraController;
use Penad\Tesis\models\StudyPlan;
use Penad\Tesis\models\CreadorModel;
use Penad\Tesis\models\PlanEstudioCreador;
use Penad\Tesis\models\GeneralidadesCarrera;
use Penad\Tesis\models\PlanEstudioGeneralidadesCarrera;
use Penad\Tesis\models\PropositoCarrera;
use Penad\Tesis\models\PlanEstudioPropositoCarrera;
use Penad\Tesis\models\PlanEstudioCompetenciaGeneral;
use Penad\Tesis\models\PlanEstudioCompetenciaBasica;
use Penad\Tesis\models\PlanEstudioCompetenciaEspecialidad;
use Penad\Tesis\models\Areas;
use Penad\Tesis\models\ValorInstitucional;
use Penad\Tesis\models\PlanEstudioMateria;

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

//vista de buscar planes de estudio vigentes
$router->post('/planes/{pagina}', function($page){
    notAuth();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'searchPlan';
    $_GET['regresar'] = 'planes/1';
    $controller = new CurricularDesign;
    $controller->getSearchPlan($page);
});

//vista de buscar planes de estudio vigentes en paginacion
$router->get('/searchPlan/{pagina}', function($page){
    notAuth();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'searchPlan';
    $_GET['regresar'] = 'planes/1';
    $controller = new CurricularDesign;
    $controller->getSearchPlans($page);
});

//VER HISTORIAL PLANES DE ESTUDIO DE LA CARRERA
$router->get('/{carrera}/historial/{pagina}', function($carrera,$page){
    notAuth();
    $controller = new CarreraController;
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = $carrera.'/planes';
    $_GET['regresar'] = 'planes/1';
    $controller->getCarreraPlanes($carrera,$page);
});


//vista al crear un plan de estudio
$router->get('/plan/editor/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $user = $_SESSION['user'];
    $plan = StudyPlan::getPlan($id);
    $creadores = CreadorModel::getCreadoresPlan();
    $creador = PlanEstudioCreador::getCreadorPlan($id);
    $generalidades = PlanEstudioGeneralidadesCarrera::getPlanGeneralidad($id);
    $generalidad = GeneralidadesCarrera::getGeneralidad(is_array($generalidades) && !empty($generalidades) ? (int)$generalidades[0]['Id'] : 0);
    $proId = PlanEstudioPropositoCarrera::getPlanPropositoId($id);
    $proposito = PropositoCarrera::getProposito($proId == NULL ? 0 : $proId[0]['Id']);
    $comGeneral = PlanEstudioCompetenciaGeneral::getPlanComGenerales($id);
    $comBasica = PlanEstudioCompetenciaBasica::getPlanComBasicas($id);
    $comEspecialidad = PlanEstudioCompetenciaEspecialidad::getPlanComEspecialidades($id);
    $areas = Areas::getAreasPlan($id);
    $data = [
        'title' => 'Editor Plan Estudio',
        'user' => $user,
        'plan' => $plan,
        'creadores' => $creadores,
        'creador' => $creador,
        'generalidad' => $generalidad,
        'proposito' => $proposito,
        'comGeneral' => $comGeneral,
        'comBasica' => $comBasica,
        'comEspecialidad' => $comEspecialidad,
        'areas' => $areas,
        'color' => isset($_SESSION['color']) ? $_SESSION['color'] : null,
        'message' => isset($_SESSION['message']) ? $_SESSION['message'] : null
    ];
    $controller->render('plan/editor', $data);
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
    IsUser();
    $controller = new CurricularDesign;
    $controller->createPlan();
});

$router->post('/plan/editor/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->savePlan($id);
});

$router->post('/plan/portada/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->guardarPortada($id);
});

$router->post('/plan/fundamentacion/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->guardarFundamentacion($id);
});

$router->post('/plan/creador/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->guardarCreador($id);
});

$router->post('/plan/generalidades/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->guardarGeneralidades($id);
});

$router->put('/plan/generalidades/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->actualizarGeneralidades($id);
});

$router->put('/plan/proposito/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->actualizarProposito($id);
});


$router->post('/plan/proposito/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->guardarProposito($id);
});

//eliminar plan de estudio o desactivar
$router->get('/deletePlan/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CurricularDesign;
    $controller->deletePlan($id);
});

//PLAN-CREADOR
$router->delete('/creador/plan/{idCreador}/{idPlan}', function($idCreador,$idPlan){ 
    notAuth();
    $controller = new CurricularDesign;
    $controller->deletePlanCreador($idCreador,$idPlan);
});

//PLAN-COMPETENCIA GENERAL
$router->post('/plan/competencias-generales/{idPlan}', function($idPlan){
    notAuth();
    $controller = new CurricularDesign;
    $controller->guardarComGeneral($idPlan);
});

$router->delete('/plan/competencias-generales/{idPlan}/{idComGeneral}', function($idPlan, $idComGeneral){
    notAuth();
    $controller = new CurricularDesign;
    $controller->eliminarComGeneral($idPlan, $idComGeneral);
});

//PLAN-COMPETENCIA ESPECIALIDAD
$router->post('/plan/competencias-especialidad/{idPlan}', function($idPlan){
    notAuth();
    $controller = new CurricularDesign;
    $controller->guardarComEspecialidad($idPlan);
});

$router->delete('/plan/competencias-especialidad/{idPlan}/{idComEspecialidad}', function($idPlan, $idComEspecialidad){
    notAuth();
    $controller = new CurricularDesign;
    $controller->eliminarComEspecialidad($idPlan, $idComEspecialidad);
});

//PLAN-COMPETENCIA BASICA
$router->post('/plan/competencias-basicas/{idPlan}', function($idPlan){
    notAuth();
    $controller = new CurricularDesign;
    $controller->guardarComBasica($idPlan);
});

$router->delete('/plan/competencias-basicas/{idPlan}/{idComBasica}', function($idPlan, $idComBasica){
    notAuth();
    $controller = new CurricularDesign;
    $controller->eliminarComBasica($idPlan, $idComBasica);
});

//PLAN-AREAS
$router->post('/plan/areas/{idPlan}', function($idPlan){
    notAuth();
    $controller = new CurricularDesign;
    $controller->guardarArea($idPlan);
});

$router->delete('/plan/areas/{idPlan}/{idArea}', function($idPlan, $idArea){
    notAuth();
    $controller = new CurricularDesign;
    $controller->eliminarArea($idPlan, $idArea);
});