<?php

use Penad\Tesis\controllers\Home;
use Penad\Tesis\controllers\Perfil;
use Penad\Tesis\models\User;

//Pagina Principal
$router->get('/home', function(){
    notAuth();
    $controller = new Home;
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Home',
        'user' => $user
    ];
    $controller->render('home/index', $data);
});

//Vista Administración de usuarios
$router->get('/users/{pagina}', function($page){
    notAuth();
    IsUser();
    $page == 0 ? 1 : $page;
    $_GET['pagina'] = $page;
    $_GET['nombrePagina'] = 'users';
    $controller = new Home;
    $controller->getUsers($page);
});

//buscando un usuario especifico
$router->post('/users', function(){
    notAuth();
    IsUser();
    $controller = new Home;
    $controller->searchUser();
});

//vista perfil
$router->get('/perfil', function(){
    notAuth();
    $controller = new Home;
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Perfil',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
    ];
    $controller->render('home/perfil', $data);
});
//vista sign
// $router->get('/sign', function(){
//     $controller = new Home;
//     $controller->render('sign');
// });

//Vista creacion de usuarios
$router->get('/createUsers',function(){
    notAuth();
    IsAdmin();
    IsUser();
    $controller = new Home;
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Crear nuevo Usuario',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
    ];
    $controller->render('home/create', $data);

});

//Vista update de usuarios
$router->get('/updateUsers/{id}',function($id){
    notAuth();
    IsUser();
    $controller = new Home;
    $req = User::getUser($id);
    $user = $_SESSION['user'];
    $data = [
        'title' => 'Modificar Usuario',
        'user' => $user,
        'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
        'message' => $_SESSION['message'] == '' ? null : $_SESSION['message'],
        'userDB' => $req
    ];
    $controller->render('home/update', $data);

});

//CRUD
//ingresar nuevo usuario
$router->post('/createUsers',function(){
    notAuth();
    IsAdmin();
    IsUser();
    $controller = new Home;
    $controller->createUsers();
});

//modificar Usuarios generales
$router->post('/updateUsers/{id}',function($id){
    notAuth();
    IsUser();
    $controller = new Home;
    $controller->updateUsers($id);

});

//Modificar contraseña de usuarios generales
$router->post('/updatePassword/{id}',function($id){
    notAuth();
    IsUser();
    $controller = new Home;
    $controller->updatePassword($id);

});

//Eliminar usuario(Cambio de estatus 0 significa eliminar)
$router->get('/deleteUser/{id}', function($id){
    notAuth();
    IsUser();
    $controller = new Home;
    $controller->deleteUser($id);
});

//actualizar perfil
$router->post('/updatePerfil/{id}', function($id){
    $controller = new Perfil;
    $controller->updatePerfil($id);
});

//actualizar contraseña del perfil
$router->post('/updatePasswordPerfil/{id}', function($id){
    $controller = new Perfil;
    $controller->updatePasswordPerfil($id);
});

//Cerrar Sesión
$router->get('/signout', function(){
    notAuth();
    unset($_SESSION['user']);
    header('location: /tesis/');
});