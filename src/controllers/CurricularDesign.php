<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\StudyPlan;
use Penad\Tesis\models\User;

class CurricularDesign extends Controller{

    private User $_user;
    
    public function __construct(){
        parent::__construct();
    }

    public function getPlans(){
        $user = $_SESSION['user'];
        $studyPlan = StudyPlan::getPlans();
        $data = [
            'title' => 'Planes de Estudio',
            'user' => $user,
            'studyPlan' => $studyPlan
        ];

        $this->render('plan/index', $data);
    }

    public function searchPlan(){

        $search = $this->post('buscar');
        $user = $_SESSION['user'];

        //validar campo
        if(is_null($search)){
            error_log('No recibio el input buscar');
            header("location:/tesis/plan");
            exit();
        }

        //traemos objeto StudyPlan de bd con su funcion estatica
        $studyPlan = StudyPlan::searchPlan($search);

        //si no nos regresa el objeto regresamos a la vista inicial
        if(is_null($studyPlan)){
            error_log('No se pudo buscar en bd');
            header("location:/tesis/plan");
            exit();
        }

        //pasamos los datos
        $data = [
            'title' => 'Plan de Estudio',
            'user' => $user,
            'studyPlan' => $studyPlan
        ];
        // renderizamos nueva vista con sus datos
        $this->render('plan/search', $data);
    }

    public function create(){
        $title = $this->post('titulo');
        $content = $this->post('contenido');

        //validacion de campos
        if(is_null($title) && is_null($content)){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Datos no ingresados';
            header('location:/tesis/create');
            exit();
        }

        //traemos objeto StudyPlan de bd con su funcion para ingreso de datos
        $studyPlan = new StudyPlan($title, $content);
        $res = $studyPlan->createPlan();

        //si es false envia una advertencia que no se ingresaron datos
        if(!$res){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Datos no ingresados en el proceso';
            header('location:/tesis/create');
            exit();
        }

        //variables de session que confirman nuestro ingreso de datos y redirecciona a la vista
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Datos ingresados con exito';
        header('location:/tesis/create');
    }

    public function update(int $id){
        $title = $this->post('titulo');
        $content = $this->post('contenido');

        //validación de campos
        if(is_null($id) &&
            is_null($title) && 
            is_null($content)
        ){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Los datos vienen nulos';
            header("location:/tesis/update/$id");
            exit();
        }

        //traemos objeto StudyPlan de bd con su funcion para actualizar datos
        $studyPlan = new StudyPlan($title, $content);
        //asignamos al objeto el id correspondiente
        $studyPlan->setId($id);
        $res = $studyPlan->updatePlan();

        //si es false retorna advertencia de no hay actualización de datos
        if(!$res){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se realizaron cambios en el proceso';
            header("location:/tesis/update/$id");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se realizaron cambios con exito';
        header("location:/tesis/update/$id");
    }

    public function word(int $id){
        //traemos un plan de estudio
        $req = StudyPlan::getPlan($id);
        //requerimos nuestra libreria PHPWord para poder descargar el docx
        require_once __DIR__ . '/../lib/word.php';
    }
}