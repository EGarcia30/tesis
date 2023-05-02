<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\FacultadModel;

class FacultadController extends Controller{

    public function __construct(){
        parent::__construct();
    }

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

    public function searchFacultades(){
        $search = $this->post('buscar');
        $user = $_SESSION['user'];

        //validar campo
        if(is_null($search)){
            error_log('No recibio el input buscar');
            header("location:/tesis/facultades");
            exit();
        }

        //traemos objeto User de bd con su funcion estatica
        $facultades = FacultadModel::searchFacultad($search);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(is_null($facultades)){
            error_log('No se pudo buscar en bd');
            header("location:/tesis/facultades");
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

    public function updateFacultad($id){

        $name = $this->post('nombre');
        $acronym= $this->post('acronimo');

        //validación de campos
        if(
            is_null($name) ||
            is_null($acronym)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Los campos no pueden estar vacios.';
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
            $_SESSION['message'] = 'Error: en la Modificación de datos.';
            header("location: /tesis/updateFacultad/$id");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se cambiaron los datos de facultad con Exito.';
        header("location: /tesis/updateFacultad/$id");
    }

    public function deleteFacultad($id){

        $res = FacultadModel::deleteFacultad($id);

        $this->getAllFacultad(1);
    }
}