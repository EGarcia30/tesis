<?php

//Uso de controladores
use Penad\Tesis\controllers\Signup;
use Penad\Tesis\controllers\Login;
use Penad\Tesis\controllers\Home;
use Penad\Tesis\controllers\CurricularDesign;
use Penad\Tesis\models\StudyPlan;
use Penad\Tesis\controllers\Error;

$router = new \Bramus\Router\Router();
session_start();

//Inicializando archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../config');
$dotenv->load();

//Autenticacion de vistas
function notAuth(){
    if(!isset($_SESSION['user'])){
        header('location: /tesis/');
        exit();
    }
}
function Auth(){
    if(isset($_SESSION['user'])){
        header('location: /tesis/home');
        exit();
    }
}

//login
$router->get('/', function(){
    Auth();
    $controller = new Login;
    $data = [
        'color' => $_SESSION['color'],
        'message' => $_SESSION['message']
    ];
    $controller->render('login/index', $data);
});

//verficacion de datos
$router->post('/auth', function(){
    Auth();
    $controller = new Login;
    $controller->auth();
});

//Pagina Principal
$router->get('/home', function(){
    notAuth();
    $controller = new Home();
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Home',
        'user' => $user
    ];
    $controller->render('home/index', $data);
});

//Cerrar Sesión
$router->get('/signout', function(){
    notAuth();
    unset($_SESSION['user']);
    header('location: /tesis/');
});

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
    $controller->getPlan();
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

//vista crear Usuario
$router->get('/signup', function(){
    $controller = new Signup;
    $controller->render('signup/index');
});

//Craeción de usuario bd
$router->post('/register', function(){
    $controller = new Signup;
    $controller->register();
});

//manejador de error 404
$router->set404(function() {
    // header('HTTP/1.1 404 Not Found');
    http_response_code(404);
    $data = [
        'status' => '404',
        'message' => 'Pagina no encontrada'
    ];

    $controller = new Error();
    $controller->render('404/index', $data);
});

//funcion que corre la aplicación
$router->run();