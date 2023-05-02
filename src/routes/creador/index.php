<?php

use Penad\Tesis\controllers\CreadorController;
use Penad\Tesis\models\CreadorModel;
use Penad\Tesis\models\GradoAcademico;
use Penad\Tesis\models\CreadorGradoAcademico;
use Penad\Tesis\models\CreadorExperiencia;
use Penad\Tesis\models\Participacion;
use Penad\Tesis\models\CreadorParticipacion;


//vista principal
$router->get('/creadores/{pagina}', function($page){
    notAuth();
    $controller = new CreadorController;
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'creadores';
    $_GET['regresar'] = 'home';
    $controller->getCreadores($page);
});

//vista editor Creador 
$router->get('/creador/editor/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $user = $_SESSION['user'];
    $creador = CreadorModel::getCreador($id);
    $creadorGrados = CreadorGradoAcademico::getGradoCreador($id);
    $grado = GradoAcademico::getGradoAcademico();
    $experiencia = CreadorExperiencia::getExperienciaCreador($id);
    $participacion = Participacion::getParticipaciones();
    $participaciones = CreadorParticipacion::getParticipacionCreador($id);
    $data = [
        'title' => 'Editor de Creador',
        'user' => $user,
        'creador' => $creador,
        'grado' => $grado,
        'grados' => $creadorGrados,
        'experiencia' => $experiencia,
        'participacion' => $participacion,
        'participaciones' => $participaciones,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
    ];
    $controller->render('creador/editor', $data);
});

//CRUD
//Ingresar Usuario
$router->post('/creador', function(){
    $controller = new CreadorController;
    $controller->createCreador();
});

//Ingresar Grado
$router->post('/grado/{id}', function($id){
    $controller = new CreadorController;
    $controller->createGrado($id);
});

//Ingresar participacion
$router->post('/participacion/{id}', function($id){
    $controller = new CreadorController;
    $controller->createParticipacion($id);
});

//RELACIONAR
//CREADOR-GRADO
$router->post('/creador/grado/{id}', function($id){
    $controller = new CreadorController;
    $controller->creadorGrado($id);
});

//CREADOR-EXPERIENCIA
$router->post('/creador/experiencia/{id}', function($id){
    $controller = new CreadorController;
    $controller->creadorExperiencia($id);
});

//CREADOR-PARTICIPACION
$router->post('/creador/participacion/{id}', function($id){
    $controller = new CreadorController;
    $controller->creadorParticipacion($id);
});