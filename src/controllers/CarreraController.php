<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\CarreraModel;
use Penad\Tesis\models\FacultadModel;
use Penad\Tesis\models\PlanCarrera;

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
        // Obtenemos el término a buscar desde GET (no POST)
        $search = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;

        if(is_null($search) || $search === ''){
            error_log('No recibió el input buscar');
            header("Location: /tesis/carreras/1");
            exit();
        }
        $user = $_SESSION['user'];

        //validar campo
        if(empty($search)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            header("location: /tesis/carreras/1");
            exit();
        }

        $totalItems = CarreraModel::rowSearchCarreras($search);
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        //traemos objeto User de bd con su funcion estatica
        $carreras = CarreraModel::searchCarreras($search, $start, $itemShow);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$carreras){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Sin Carreras.';
            header("location: /tesis/carreras/1");
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

    //buscar carrera
    public function getSearchCarreras($page){
        $user = $_SESSION['user'];

        $totalItems = CarreraModel::rowSearchCarreras($_SESSION['busquedad']);
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        //traemos objeto User de bd con su funcion estatica
        $carreras = CarreraModel::searchCarreras($_SESSION['busquedad'], $start, $itemShow);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$carreras){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Sin Carreras.';
            header("location: /tesis/carreras/1");
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

    //crear carrera
    public function createCarrera(){
        $codigo = $this->post('codigo');
        $name = $this->post('nombre');
        $modality = $this->post('radio');
        $facultad_id = intval($this->post('opcion'));

        //validación de campos
        if(
            empty($codigo) ||
            empty($name) ||
            empty($modality) ||
            empty($facultad_id)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            header("location: /tesis/createCarreras");
            exit();
        }

        $facultad = FacultadModel::getFacultad($facultad_id);

        //validar objeto facultad
        if(empty($facultad)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = '.';
            header("location: /tesis/createCarreras");
            exit();
        }

        $acronym = $facultad->getAcronym();

        $carrera = new CarreraModel($codigo,$name,$modality,$facultad_id,$acronym);
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

    //actualizar carrera
    public function updateCarrera($id){

        $codigo = $this->post('codigo');
        $name = $this->post('nombre');
        $modality = $this->post('radio');
        $facultad_id = intval($this->post('opcion'));

        //validación de campos
        if(
            empty($codigo) ||
            empty($name) ||
            empty($modality) ||
            empty($facultad_id)
        ){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar Datos.';
            header("location: /tesis/updateCarrera/$id");
            exit();
        }

        $facultad = FacultadModel::getFacultad($facultad_id);

        //validar objeto facultad
        if(!$facultad){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'ERROR: acrónimo de facultad no encontrado.';
            header("location: /tesis/updateCarrera/$id");
            exit();
        }

        $acronym = $facultad->getAcronym();

        $carrera = new CarreraModel($codigo,$name,$modality,$facultad_id,$acronym);
        $carrera->setId($id);
        $res = $carrera->updateCarrera();

        //si es false retorna error
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Error: cambios no realizados.';
            header("location: /tesis/updateCarrera/$id");
            exit();
        }

        //cumplio las condiciones y se ha realizado el ingreso
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location: /tesis/updateCarrera/$id");
    }

    //eliminar carrera
    public function deleteCarrera($id){

        $res = CarreraModel::deleteCarrera($id);

        header('location:/tesis/carreras/1');
    }

    public function getCarreraPlanes($carrera,$page){
        $user = $_SESSION['user'];
        $carrera = str_replace('-', ' ',$carrera);
        $totalItems = PlanCarrera::rowCarreraPlanes($carrera);
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $studyPlan = PlanCarrera::getCarreraPlanes($carrera,$start,$itemShow);
        $data = [
            'title' => 'historial planes de estudio de '. $carrera,
            'studyPlan' => $studyPlan,
            'user' => $user,
            'rows' => $totalItems,
            'itemShow' => $itemShow,
            'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
            'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
        ];
        $this->render('carreraPlanes/index', $data);
    }
}
