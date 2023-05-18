<?php

Namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\CreadorModel;
use Penad\Tesis\models\GradoAcademico;
use Penad\Tesis\models\CreadorGradoAcademico;
use Penad\Tesis\models\Experiencia;
use Penad\Tesis\models\CreadorExperiencia;
use Penad\Tesis\models\Participacion;
use Penad\Tesis\models\CreadorParticipacion;

class CreadorController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function getCreadores($page){
        $user = $_SESSION['user'];
        $totalItems = CreadorModel::rowCreadores();
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $creador = CreadorModel::getCreadores($start,$itemShow);
        $data = [
            'title' => 'Especialistas de los Planes de estudio',
            'user' => $user,
            'creador' => $creador,
            'rows' => $totalItems,
            'itemShow' => $itemShow,
            'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
            'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
        ];

        $this->render('creador/index', $data);
    }

    public function createCreador(){
        $name = $this->post('nombre');

        if(empty($name)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header('location: /tesis/creadores/1');
            error_log('campos vacios');
            exit();
        }

        $creador = new CreadorModel($name);
        $res = $creador->createCreador();
        $id_creador = $res["id_creador"];

        header("location: /tesis/creador/editor/$id_creador");
    }

    public function createGrado($id){
        $ArrId = $this->post('gradoAcademico');

        if(empty($ArrId)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location: /tesis/creador/editor/$id");
            error_log('campos vacios');
            exit();
        }
        $grado = new GradoAcademico($ArrId);
        $res = $grado->createGradoAcademico();
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se creo correctamente el grado academico.';
        header("location: /tesis/creador/editor/$id");
    }

    public function createParticipacion($id){
        $name = $this->post('participacion');

        if(empty($name)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location: /tesis/creador/editor/$id");
            error_log('campos vacios');
            exit();
        }

        $grado = new Participacion($name);
        $res = $grado->createParticipacion();

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Ocurrio un error inesperado.';
            header("location: /tesis/creador/editor/$id");
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se creo correctamente la participación.';
        header("location: /tesis/creador/editor/$id");
    }

    public function creadorGrado($id){
        $grados = $this->post('opcionGrado');

        $idCreador = intval($id);
        $validity = intval($grados[0]);

        if(empty($validity)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se selecciono ningun Grado Academico.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        $creadorGrado = new CreadorGradoAcademico($idCreador,$grados);
        $creadorGrado->createCreadorGrado();

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se Asocio el Grado Academico con el Creador.';
        header("location: /tesis/creador/editor/$id");

    }

    public function creadorExperiencia($id){
        $experiencia = $this->post('experiencia');
        $idCreador = intval($id);
        $res = [];

        if(empty($experiencia[0])){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Datos Vacios.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        foreach($experiencia as $key => $value){
            $exp = new Experiencia($value);
            array_push($res, $exp->createExperiencia());
        }

        $creadorExp = new CreadorExperiencia($idCreador,$res);
        $resExp = $creadorExp->createCreadorExperiencia();

        if(!$resExp){
            $_SESSION['color'] = 'success';
            $_SESSION['message'] = 'Se Asocio La experiencia con el Creador.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se Asocio la experiencia con el Creador.';
        header("location: /tesis/creador/editor/$id");
    }

    public function creadorParticipacion($id){
        $participacion = $this->post('opcionParticipacion');

        $idCreador = intval($id);
        $validity = intval($participacion[0]);

        if(empty($validity)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se selecciono ninguna Participación.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        $creadorParticipacion = new CreadorParticipacion($idCreador,$participacion);
        $creadorParticipacion->createCreadorParticipacion();

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se Asocio la Participación con el Creador.';
        header("location: /tesis/creador/editor/$id");

    }
}