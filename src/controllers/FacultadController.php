<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\FacultadModel;

class FacultadController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    //obtener todas las facultades
    public function getAllFacultad($page){
        $user = $_SESSION['user'];
        $totalItems = FacultadModel::rowFacultad();
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $facultades = FacultadModel::getAllFacultad($start,$itemShow);
        $data = [
            'title' => 'Facultades',
            'user' => $user,
            'facultades' => $facultades,
            'rows' => $totalItems,
            'itemShow' => $itemShow
        ];

        $this->render('facultad/index', $data);
    }

    //buscar facultad
    public function searchFacultades(){
        $search = $this->post('buscar');
        $user = $_SESSION['user'];

        //validar campo
        if(empty($search)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            error_log('No recibio el input buscar');
            header("location:/tesis/facultades/1");
            exit();
        }

        //traemos objeto User de bd con su funcion estatica
        $facultades = FacultadModel::searchFacultad($search);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$facultades){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: no se encontro resultados.';
            error_log('No se pudo buscar en bd');
            header("location:/tesis/facultades/1");
            exit();
        }

        //pasamos los datos
        $data = [
            'title' => 'Facultad',
            'user' => $user,
            'facultades' => $facultades
        ];
        // renderizamos nueva vista con sus datos
        $this->render('facultad/search', $data);

    }

    //crear facultad
    public function createFacultad(){

        $name = $this->post('nombre');
        $acronym= $this->post('acronimo');

        //validación de campos
        if(
            empty($name) ||
            empty($acronym)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            header("location: /tesis/createFacultad");
            exit();
        }

        //instancia objeto facultad y su metodo createFacultad Para agregar nueva facultad
        $user = new FacultadModel($name,$acronym);
        $res = $user->createFacultad();

        if(is_array($res)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = $res[0];
            header("location: /tesis/createFacultad");
            exit();
        }

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: facultad no creada.';
            header("location: /tesis/createFacultad");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Facultad creada.';
        header("location: /tesis/createFacultad");
    }

    //actualizar facultad
    public function updateFacultad($id){

        $name = $this->post('nombre');
        $acronym= $this->post('acronimo');

        //validación de campos
        if(
            empty($name) ||
            empty($acronym)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            header("location: /tesis/updateFacultad/$id");
            exit();
        }

        //instancia objeto user y su metodo createUser Para agregar nuevo usuario
        $user = new FacultadModel($name,$acronym);
        $user->setId($id);
        $res = $user->updateFacultad();

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: cambios no realizados.';
            header("location: /tesis/updateFacultad/$id");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location: /tesis/updateFacultad/$id");
    }

    //eliminar facultad
    public function deleteFacultad($id){

        $res = FacultadModel::deleteFacultad($id);

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: cambios no realizados.';
            header("location: /tesis/updateFacultad/1");
            exit();
        }
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header('location:/tesis/facultades/1');
    }
}