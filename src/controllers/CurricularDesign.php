<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\StudyPlan;
use Penad\Tesis\models\CarreraModel;
use Penad\Tesis\models\FacultadModel;
use Penad\Tesis\models\PlanEstudioCreador;
use Penad\Tesis\models\CreadorGradoAcademico;
use Penad\Tesis\models\CreadorExperiencia;
use Penad\Tesis\models\CreadorParticipacion;
use Penad\Tesis\models\GeneralidadesCarrera;
use Penad\Tesis\models\PlanEstudioGeneralidadesCarrera;
use Penad\Tesis\models\PropositoCarrera;
use Penad\Tesis\models\PlanEstudioPropositoCarrera;

class CurricularDesign extends Controller{

    private User $_user;
    
    public function __construct(){
        parent::__construct();
    }

    public function getPlans($page){
        $user = $_SESSION['user'];
        $totalItems = StudyPlan::rowPlans();
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $plans = StudyPlan::getPlans($start,$itemShow);
        $facultades = FacultadModel::getFacultades();
        $carreras = CarreraModel::getAllCarreras();
        $data = [
            'title' => 'Planes de Estudio',
            'user' => $user,
            'studyPlan' => $plans,
            'facultades' => $facultades,
            'carreras' => $carreras,
            'rows' => $totalItems,
            'itemShow' => $itemShow,
            'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
            'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
        ];

        $this->render('plan/index', $data);
    }

    public function savePlan($id){
        // $id= $this->post('idPlan');
        $idPlan = intval($id);
        $vigInicio = $this->post('vigInicio');
        $vigFinal = $this->post('vigFinal');
        $reviewDate = $this->post('review');
        $fundamento = $this->post('fundamento');
        $creador = $this->post('creador');
        $generalidad = $this->post('generalidad');
        $proposito = $this->post('proposito');
        $user = $_SESSION['user'];

        //Pasando los id de string a int para la comprobacion en cada uno de sus objetos
        $idProposito = intval($proposito[0]);
        $val = intval($creador[0]);
        $idGeneralidad = intval($generalidad[0]);
        $data = [$generalidad[1],$generalidad[2],$generalidad[3],$generalidad[4],
        $generalidad[5],$generalidad[6],$generalidad[7],$generalidad[8]];

        //haciendo la relacion de plan de estudio con los creadores
        if(!empty($val)){
            $planCreador = new PlanEstudioCreador($idPlan,$creador);
            $planCreador->createPlanCreador();
        }

        //Creando nueva generalidad de la carrera en el plan de estudio
        if(empty($idGeneralidad) && !empty($generalidad[1])){
            $generalidadCarrera = new GeneralidadesCarrera($data);
            $idGenCarrera =  $generalidadCarrera->createGeneralidad();

            //Haciendo la relacion generdlidades de la carrera con el plan de estudio
            $idGC = intval($idGenCarrera['id_generalidades']);
            $PlanE_GeneralidadCar = new PlanEstudioGeneralidadesCarrera($idPlan,$idGC);
            $PlanE_GeneralidadCar->createPlanGeneralidad();
        }
        //actualizando la seccion de generalidades de la carrera en el plan de estudio
        if(!empty($idGeneralidad)){
            $generalidadCarrera = new GeneralidadesCarrera($data);
            $generalidadCarrera->setId($idGeneralidad);
            $generalidadCarrera->updateGeneralidad();
        }

        //Creando un Proposito de Carrera en el plan de estudio
        if(empty($idProposito) && !empty($proposito[1])){
            //se crea el proposito
            $propositoCarrera = new PropositoCarrera($proposito[1]);
            $idNew = $propositoCarrera->createProposito();

            $idNewPro = intval($idNew['id_proposito']);
            //se asocia al plan de estudio
            $planProposito = new PlanEstudioPropositoCarrera($idPlan,$idNewPro);
            $planProposito->createPlanProposito();
        }

        if(!empty($idProposito)){
            $propositoCarrera = new PropositoCarrera($proposito[1]);
            $propositoCarrera->setId($idProposito);
            $propositoCarrera->updateProposito();
        }

        $data=[
            'id' => $idPlan,
            'inicio' => $vigInicio,
            'final' => $vigFinal,
            'review' => $reviewDate,
            'fundamento' => $fundamento,
            'user' => $user->getName()
        ];

        //traemos objeto StudyPlan de bd con su funcion estatica
        $studyPlan = StudyPlan::savePlan($data);

        // si no nos regresa el objeto regresamos a la vista inicial
        if(!$studyPlan){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'No se pudo Guardar los datos';
            error_log('No se pudo guardar en bd');
            header("location:/tesis/plan/create/$id");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Datos Guardados!.';
        header("location:/tesis/plan/create/$id");
    }

    public function createPlan(){
        $id_facultad = intval($this->post('opcion'));
        $id_carrera = intval($this->post('opcionCarrera'));
        $facultad = [];
        $carrera = [];

        // var_dump($id_facultad);
        //validacion de campos
        if(empty($id_facultad) || empty($id_carrera)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No se recibieron los Datos.';
            header('location:/tesis/planes/1');
            exit();
        }

        //asignando obj de facultad y carrera para poder usar en el plan de estudio
        $facultad = FacultadModel::getFacultad($id_facultad);
        $carrera = CarreraModel::getCarrera($id_carrera);
        $nameFacultad = $facultad->getName();
        $nameCarrera = $carrera->getName();
        $modalityCarrera = $carrera->getModality();

        //validación por si un obj viene vacio y arrojar un error
        if( empty($facultad) || 
            empty($carrera) || 
            is_null($nameFacultad) || 
            is_null($nameCarrera) || 
            is_null($modalityCarrera)){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'No se encontro la facultad o carrera registrada.';
            header('location:/tesis/planes/1');
            exit();
        }

        //instanciamos nuestro obj plan de estudio
        $plan_estudio = new StudyPlan($id_facultad,$nameFacultad,$id_carrera,$nameCarrera,$modalityCarrera);
        $plan_estudio->setIdUser($_SESSION['user']->getId());
        $plan_estudio->setUser($_SESSION['user']->getName());
        $res = $plan_estudio->createPlan();
        $id_plan = $res["id_plan"];

        header("location:/tesis/plan/create/$id_plan");

    }

    public function word(int $id){
        $idCreadores = [];
        $creadores = [];
        $grado = [];
        $exp = [];
        $participacion = [];
        //traemos un plan de estudio
        $req = StudyPlan::getPlan($id);
        //traemos a los creadores(grado,experiencia,participacion)
        $idCreadores = PlanEstudioCreador::getCreadorPlanId($id);
        $creadores = PlanEstudioCreador::getCreadorPlan($id);
        //traemos generalidades de carrera
        $generalidades = PlanEstudioGeneralidadesCarrera::getPlanGeneralidad($id);
        $gen = GeneralidadesCarrera::getGeneralidad($generalidades[0]['Id']);
        //traemos Proposito de carrera
        $proId = PlanEstudioPropositoCarrera::getPlanPropositoId($id); 
        $pro = PropositoCarrera::getProposito($proId[0]['Id']);

        foreach($idCreadores as $key => $value){
            array_push($grado,CreadorGradoAcademico::getGradoCreador($value['id']));
        }

        foreach($idCreadores as $key => $value){
            array_push($exp,CreadorExperiencia::getExperienciaCreador($value['id']));
        }

        foreach($idCreadores as $key => $value){
            array_push($participacion,CreadorParticipacion::getParticipacionCreador($value['id']));
        }
        // nos nuestra libreria PHPWord para poder descargar el docx
        require_once __DIR__ . '/../lib/word.php';
    }
}