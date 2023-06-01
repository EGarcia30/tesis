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

    //vista todos los creadores
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

    //buscar creadores
    public function getSearchCreador($page){
        $buscar = $this->post('buscar');
        $_SESSION['busquedad'] = $buscar;
        $user = $_SESSION['user'];

        if(empty($buscar)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            header('location:/tesis/creadores/1');
            exit();
        }
        $totalItems = CreadorModel::rowSearchCreadores($buscar);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$totalItems){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No existe ningún creador.';
            header('location:/tesis/creadores/1');
            exit();
        }

        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $creador = CreadorModel::getSearchCreadores($buscar,$start,$itemShow);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$creador){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: vuelve a intentar.';
            header('location:/tesis/creadores/1');
            exit();
        }
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

    //buscar creadores paginacion
    public function getSearchCreadores($page){
        $user = $_SESSION['user'];

        $totalItems = CreadorModel::rowSearchCreadores($_SESSION['busquedad']);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$totalItems){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No existe ningún creador.';
            header('location:/tesis/creadores/1');
            exit();
        }

        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $creador = CreadorModel::getSearchCreadores($_SESSION['busquedad'],$start,$itemShow);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$creador){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: vuelve a intentar.';
            header('location:/tesis/creadores/1');
            exit();
        }
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

    //creando un creador
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

        if(is_array($res)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = $res[0];
            header('location: /tesis/creadores/1');
            exit();
        }

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: No se creo el usuario';
            header('location: /tesis/creadores/1');
            exit();
        }
        $id_creador = $res["id_creador"];
        header("location: /tesis/creador/editor/$id_creador");
    }

    //actualizando un creador
    public function updateCreador($id){
        $name = $this->post('nombre');

        if(empty($name)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location: /tesis/creador/editor/$id");
            error_log('campos vacios');
            exit();
        }

        $creador = new CreadorModel($name);
        $creador->setId($id);
        $res = $creador->updateCreador();

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: No se cambió el nombre.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios en el nombre.';
        header("location: /tesis/creador/editor/$id");
    }

    //eliminando un creador
    public function deleteCreador($id){
        $creador = CreadorModel::deleteCreador($id);

        if(!$creador){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: No se realizó la eliminación.';
            header("location: /tesis/creadores/1");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = "Se eliminó el creador.";
        header("location: /tesis/creadores/1");
    }

    //creacion grado
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

        if(is_array($res)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = $res[0];
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: No se creó el grado académico';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se creó correctamente el grado académico.';
        header("location: /tesis/creador/editor/$id");
    }

    //actualizacion grado
    public function updateGrado($idGrado, $idCreador){
        $grado = $this->post('grado');

        if(empty($grado)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $updateGrado = new GradoAcademico($grado);
        $updateGrado->setId($idGrado);
        $updateGrado->updateGradoAcademico();

        if(!$updateGrado){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: No se realizaron los cambios.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se cambió el grado académico.';
        header("location: /tesis/creador/editor/$idCreador");

    }

    //eliminar Grado
    public function deleteGrado($idGrado, $idCreador){
        $deleteGrado = GradoAcademico::deleteGradoAcademico($idGrado);

        if(!$deleteGrado){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: No se realizaron los cambios.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se eliminó el grado académico.';
        header("location: /tesis/creador/editor/$idCreador");

    }

    //CREADOR-GRADO
    //ingresar/crear vinculación
    public function creadorGrado($id){
        $grados = $this->post('opcionGrado');

        $idCreador = intval($id);
        $validity = intval($grados[0]);

        if(empty($validity)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se seleccionó ningún grado académico.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        $creadorGrado = new CreadorGradoAcademico($idCreador,$grados);
        $creadorGrado->createCreadorGrado();

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se asoció el grado académico con el creador.';
        header("location: /tesis/creador/editor/$id");

    }

    //desvinculación grado/Creador
    public function deleteGradoCreador($idGrado, $idCreador){
        $deleteGradoCreador = CreadorGradoAcademico::deleteGradoCreador($idGrado,$idCreador);

        if(!$deleteGradoCreador){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: No se realizaron los cambios.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se desvinculó el grado académico.';
        header("location: /tesis/creador/editor/$idCreador");

    }

    //CREADOR-EXPERIENCIA
    //ingresar y vincular
    public function creadorExperiencia($id){
        $experiencia = $this->post('experiencia');
        $idCreador = intval($id);
        $res = [];

        if(empty($experiencia[0])){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        foreach($experiencia as $key => $value){
            $exp = new Experiencia($value);
            $resExp = $exp->createExperiencia();

            if(!$resExp){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: NO se creó la experiencia profesional.';
                header("location: /tesis/creador/editor/$id");
                exit();
            }
            array_push($res, $resExp);
        }

        $creadorExp = new CreadorExperiencia($idCreador,$res);
        $resExp = $creadorExp->createCreadorExperiencia();

        if(!$resExp){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al asociar experiencia con el creador.';
            header("location: /tesis/creador/editor/$id");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se asoció la experiencia con el creador.';
        header("location: /tesis/creador/editor/$id");
    }

    //actualizar la experiencia profesional
    public function updateExperiencia($idExperiencia, $idCreador){
        $experiencia = $this->post('experiencia');

        if(empty($experiencia)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar Datos.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $updateExp = new Experiencia($experiencia);
        $updateExp->setId($idExperiencia);
        $res = $updateExp->updateExperiencia();

        if(!$res){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'ERROR: No se realizaron los cambios.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location: /tesis/creador/editor/$idCreador");
    }

    //eliminar experiencia profesional
    public function deleteExperiencia($idExperiencia, $idCreador){
        $deleteExperiencia = Experiencia::deleteExperiencia($idExperiencia);

        if(!$deleteExperiencia){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'ERROR: No se realizaron los cambios.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se realizaron los cambios.';
        header("location: /tesis/creador/editor/$idCreador");
    }

    //PARTICIPACION
    //ingresar participacion
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

    //actualizar participacion
    public function updateParticipacion($idParticipacion,$idCreador){
        $participacion = $this->post('participacion');

        if(empty($participacion)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar Datos.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $updatePar = new Participacion($participacion);
        $updatePar->setId($idParticipacion);
        $res = $updatePar->updateParticipacion();

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Ocurrio un error inesperado.';
            header("location: /tesis/creador/editor/$idCreador");
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se realizaron los cambios.';
        header("location: /tesis/creador/editor/$idCreador");
    }

    //eliminar participacion
    public function deleteParticipacion($idParticipacion,$idCreador){
        $deleteParticipacion = Participacion::deleteParticipacion($idParticipacion);

        if(!$deleteParticipacion){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se realizaron los cambios.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se realizaron los cambios.';
        header("location: /tesis/creador/editor/$idCreador");
    }

    //vincular participacion con creador
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

    //desvincular participacion con el creador
    public function deleteParticipacionCreador($idParticipacion,$idCreador){
        $delete = CreadorParticipacion::deleteCreadorParticipacion($idParticipacion,$idCreador);

        if(!$delete){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se realizaron los cambios.';
            header("location: /tesis/creador/editor/$idCreador");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se realizaron los cambios.';
        header("location: /tesis/creador/editor/$idCreador");
    }

}