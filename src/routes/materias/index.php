<?php

use Penad\Tesis\controllers\PlanMateria;
use Penad\Tesis\models\ValorInstitucional;
use Penad\Tesis\models\PlanEstudioMateria;
use Penad\Tesis\models\StudyPlan;


//vista materias o 2da parte de un plan de estudio
$router->get('/plan/materia/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new PlanMateria;
    $user = $_SESSION['user'];
    $plan = StudyPlan::getPlan($id);
    $valores = ValorInstitucional::getValores();
    $materias = PlanEstudioMateria::getPlanMaterias($id);
    $data = [
        'title' => 'Editor Plan Estudio',
        'user' => $user,
        'plan' => $plan,
        'valores' => $valores,
        'materias' => $materias,
        'color' => $_SESSION['color'] == '' ? '' : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? '' : $_SESSION['message']
    ];
    $controller->render('plan/materia', $data);
});

//vista update materia
$router->get('/plan/updateMateria/{idPlan}/{idMateria}', function($idPlan,$idMateria){
    notAuth();
    IsUser();
    $controller = new PlanMateria;
    $user = $_SESSION['user'];
    $plan = StudyPlan::getPlan($id);
    $valores = ValorInstitucional::getValores();
    $materias = PlanEstudioMateria::getPlanMaterias($id);
    $data = [
        'title' => 'Editor Plan Estudio',
        'user' => $user,
        'plan' => $plan,
        'valores' => $valores,
        'materias' => $materias,
        'color' => $_SESSION['color'] == '' ? '' : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? '' : $_SESSION['message']
    ];
    $controller->render('plan/updateMateria', $data);
});

$router->post('/plan/materia/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new PlanMateria;
    $controller->saveMateria($id);
});

$router->get('/plan/deleteMateria/{idplan}/{idMateria}', function($idPlan, $idMateria){
    notAuth();
    IsUser();
    $controller = new PlanMateria;
    $controller->deleteMateria($idPlan,$idMateria);
});