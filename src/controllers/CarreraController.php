<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\CarreraModel;
use Penad\Tesis\models\FacultadModel;

class CarreraController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function getCarreras($page){
        $user = $_SESSION['user'];
        $totalItems = CarreraModel::rowCarreras();
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $carreras = CarreraModel::getCarreras($start,$itemShow);
        $data = [
            'title' => 'Carreras',
            'user' => $user,
            'carreras' => $carreras,
            'rows' => $totalItems,
            'itemShow' => $itemShow
        ];

        $this->render('carrera/index', $data);
    }

    public function searchCarreras($page){
        $search = $this->post('buscar');
        $user = $_SESSION['user'];

        $_SESSION['busquedad'] = $search;
        //validar campo
        if(is_null($search)){
            error_log('No recibio el input buscar');
            header("location:/tesis/carreras/1");
            exit();
        }

        $totalItems = CarreraModel::rowSearchCarreras($search);
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        //traemos objeto User de bd con su funcion estatica
        $carreras = CarreraModel::searchCarreras($search, $start, $itemShow);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(is_null($carreras)){
            error_log('No se pudo buscar en bd');
            header("location:/tesis/carreras/1");
            exit();
        }

        //pasamos los datos
        $data = [
            'title' => 'Carreras',
            'user' => $user,
            'carreras' => $carreras,
            'rows' => $totalItems,
            'itemShow' => $itemShow
        ];
        // renderizamos nueva vista con sus datos
        $this->render('carrera/search', $data);
    }

    public function getSearchCarreras($page){
        $user = $_SESSION['user'];

        $totalItems = CarreraModel::rowSearchCarreras($_SESSION['busquedad']);
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        //traemos objeto User de bd con su funcion estatica
        $carreras = CarreraModel::searchCarreras($_SESSION['busquedad'], $start, $itemShow);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(is_null($carreras)){
            error_log('No se pudo buscar en bd');
            header("location:/tesis/carreras/1");
            exit();
        }

        //pasamos los datos
        $data = [
            'title' => 'Carreras',
            'user' => $user,
            'carreras' => $carreras,
            'rows' => $totalItems,
            'itemShow' => $itemShow
        ];
        // renderizamos nueva vista con sus datos
        $this->render('carrera/search', $data);
    }

    public function createCarrera(){
        $id = $this->post('id');
        $name = $this->post('nombre');
        $modality = $this->post('radio');
        $facultad_id = intval($this->post('opcion'));

        //validación de campos
        if(
            is_null($id) ||
            is_null($name) ||
            is_null($modality) ||
            is_null($facultad_id)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Los campos no pueden estar vacios.';
            header("location: /tesis/createCarreras");
            exit();
        }

        $facultad = FacultadModel::getFacultad($facultad_id);

        //validar objeto facultad
        if(is_null($facultad)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se pudo encontrar el acronimo de la facultad seleccionada.';
            header("location: /tesis/createCarreras");
            exit();
        }

        $acronym = $facultad->getAcronym();

        $carrera = new CarreraModel($name,$modality,$facultad_id,$acronym);
        $carrera->setId($id);
        $res = $carrera->createCarrera();

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: en la creación de la carrera.';
            header("location: /tesis/createCarreras");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se ingreso una nueva Carrera con exito!.';
        header("location: /tesis/createCarreras");
    }

    public function updateCarrera($id){

        $name = $this->post('nombre');
        $modality = $this->post('radio');
        $facultad_id = intval($this->post('opcion'));

        //validación de campos
        if(
            is_null($name) ||
            is_null($modality) ||
            is_null($facultad_id)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Los campos no pueden estar vacios.';
            header("location: /tesis/updateCarrera/$id");
            exit();
        }

        $facultad = FacultadModel::getFacultad($facultad_id);

        //validar objeto facultad
        if(is_null($facultad)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se pudo encontrar el acronimo de la facultad seleccionada.';
            header("location: /tesis/updateCarrera/$id");
            exit();
        }

        $acronym = $facultad->getAcronym();

        $carrera = new CarreraModel($name,$modality,$facultad_id,$acronym);
        $carrera->setId($id);
        $res = $carrera->updateCarrera();

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: En la edición de los datos.';
            header("location: /tesis/updateCarrera/$id");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se cambiaron los datos de carrera con Exito.';
        header("location: /tesis/updateCarrera/$id");
    }

    public function deleteCarrera($id){

        $res = CarreraModel::deleteCarrera($id);

        $this->getCarreras(1);
    }
}
