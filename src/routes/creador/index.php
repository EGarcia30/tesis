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

//vista buscar creador
$router->post('/creadores/{pagina}', function($page){
    notAuth();
    $controller = new CreadorController;
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'creador';
    $_GET['regresar'] = 'creadores/1';
    $controller->getSearchCreador($page);
});

//vista buscar creador paginacion
$router->get('/resultado/creador/{pagina}', function($page){
    notAuth();
    $controller = new CreadorController;
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = '/resultado/creador';
    $_GET['regresar'] = 'creadores/1';
    $controller->getSearchCreadores($page);
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
    notAuth();
    $controller = new CreadorController;
    $controller->createCreador();
});

//  actualizar nombre usuario
$router->post('/creador/nombre/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $controller->updateCreador($id);
});

//eliminar creador
$router->get('/deleteCreador/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $controller->deleteCreador($id);
});

//GRADO
//Ingresar Grado
$router->post('/grado/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $controller->createGrado($id);
});

//actualizar Grado
$router->post('/updateGrado/{idGrado}/{idCreador}', function($idGrado, $idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->updateGrado($idGrado, $idCreador);
});

//eliminar Grado
$router->get('/deleteGrado/{idGrado}/{idCreador}', function($idGrado,$idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->deleteGrado($idGrado, $idCreador);
});

//CREADOR-GRADO
//crear vinculación
$router->post('/creador/grado/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $controller->creadorGrado($id);
});

//eliminar vinculacion de Grado/Creador
$router->get('/deleteGradoCreador/{idGrado}/{idCreador}', function($idGrado,$idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->deleteGradoCreador($idGrado, $idCreador);
});


//CREADOR-EXPERIENCIA
//ingresar y vincular
$router->post('/creador/experiencia/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $controller->creadorExperiencia($id);
});

//actualizar la información de experiencia
$router->post('/updateExperiencia/{idExperiencia}/{idCreador}', function($idExperiencia,$idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->updateExperiencia($idExperiencia,$idCreador);
});

//eliminar Experiencia profesional
$router->get('/deleteExperiencia/{idExperiencia}/{idCreador}', function($idExperiencia,$idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->deleteExperiencia($idExperiencia,$idCreador);
});

//PARTICIPACION
//Ingresar participacion
$router->post('/participacion/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $controller->createParticipacion($id);
});

//actualizar participación
$router->post('/updateParticipacion/{idParticipacion}/{idCreador}', function($idParticipacion,$idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->updateParticipacion($idParticipacion,$idCreador);
});

//eliminar participación
$router->get('/deleteParticipacion/{idParticipacion}/{idCreador}', function($idParticipacion,$idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->deleteParticipacion($idParticipacion,$idCreador);
});

//CREADOR-PARTICIPACION
//vincular participacion con el creador
$router->post('/creador/participacion/{id}', function($id){
    notAuth();
    $controller = new CreadorController;
    $controller->creadorParticipacion($id);
});

//desvincular participacion con el creador
$router->get('/creador/participacion/{idParticipacion}/{idCreador}', function($idParticipacion,$idCreador){
    notAuth();
    $controller = new CreadorController;
    $controller->deleteParticipacionCreador($idParticipacion,$idCreador);
});