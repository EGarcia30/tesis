<?php

use Penad\Tesis\controllers\CicloExtraordinario;
use Penad\Tesis\models\PlanEstudioMateria;
use Penad\Tesis\models\StudyPlan;
use Penad\Tesis\models\PlanCicloExtraordinario;


//vista ciclo extraordinario o 2da parte de un plan de estudio
$router->get('/plan/extraordinario/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CicloExtraordinario;
    $user = $_SESSION['user'];
    $plan = StudyPlan::getPlan($id);
    $materias = PlanEstudioMateria::getPlanMaterias($id);
    $cicloExtraordinario = PlanCicloExtraordinario::getPlanCiclo($id);
    $data = [
        'title' => 'Editor Plan Estudio',
        'user' => $user,
        'plan' => $plan,
        'extraordinario' => $cicloExtraordinario,
        'materias' => $materias,
        'color' => $_SESSION['color'] == '' ? '' : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? '' : $_SESSION['message']
    ];
    $controller->render('plan/extraordinario', $data);
});

$router->post('plan/extraordinario/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new CicloExtraordinario;
    $controller->saveCicloExtraordinario($id);
});