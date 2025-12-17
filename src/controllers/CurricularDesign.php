<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\StudyPlan;
use Penad\Tesis\models\CarreraModel;
use Penad\Tesis\models\FacultadModel;
use Penad\Tesis\models\PlanEstudioCreador;
use Penad\Tesis\models\CreadorModel;
use Penad\Tesis\models\CreadorGradoAcademico;
use Penad\Tesis\models\CreadorExperiencia;
use Penad\Tesis\models\CreadorParticipacion;
use Penad\Tesis\models\GeneralidadesCarrera;
use Penad\Tesis\models\PlanEstudioGeneralidadesCarrera;
use Penad\Tesis\models\PropositoCarrera;
use Penad\Tesis\models\PlanEstudioPropositoCarrera;
use Penad\Tesis\models\CompetenciaGeneral;
use Penad\Tesis\models\PlanEstudioCompetenciaGeneral;
use Penad\Tesis\models\CompetenciaBasica;
use Penad\Tesis\models\PlanEstudioCompetenciaBasica;
use Penad\Tesis\models\CompetenciaEspecialidad;
use Penad\Tesis\models\PlanEstudioCompetenciaEspecialidad;
use Penad\Tesis\models\Areas;

class CurricularDesign extends Controller{

    private User $_user;
    
    public function __construct(){
        parent::__construct();
    }

    //vista general todos los planes
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
            'color' => isset($_SESSION['color']) ? $_SESSION['color'] : null,
            'message' => isset($_SESSION['message']) ? $_SESSION['message'] : null
        ];

        $this->render('plan/index', $data);
    }

    //buscar planes
    public function getSearchPlan($page){
        $buscar = $this->post('buscar');
        $_SESSION['busquedad'] = $buscar;
        $user = $_SESSION['user'];

        if(empty($buscar)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingresar datos.';
            header('location:/tesis/planes/1');
            exit();
        }
        $totalItems = StudyPlan::rowSearchPlan($buscar);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$totalItems){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No existe ningún plan.';
            header('location:/tesis/planes/1');
            exit();
        }

        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $plans = StudyPlan::getSearchPlan($buscar,$start,$itemShow);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$plans){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: vuelve a intentar.';
            header('location:/tesis/planes/1');
            exit();
        }

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

    //buscar planes paginacion
    public function getSearchPlans($page){
        $user = $_SESSION['user'];

        $totalItems = StudyPlan::rowSearchPlan($_SESSION['busquedad']);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$totalItems){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'No existe ningún plan.';
            header('location:/tesis/planes/1');
            exit();
        }

        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $plans = StudyPlan::getSearchPlan($_SESSION['busquedad'],$start,$itemShow);
        //si no nos regresa el objeto regresamos a la vista inicial
        if(!$plans){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: vuelve a intentar.';
            header('location:/tesis/planes/1');
            exit();
        }

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

    //creamos plan de estudio
    public function createPlan(){
        $id_facultad = intval($this->post('opcionFacultad'));
        $id_carrera = intval($this->post('opcionCarrera'));
        $id_status = intval($this->post('radio'));
        $facultad = [];
        $carrera = [];

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
        $plan_estudio = new StudyPlan($id_facultad,$nameFacultad,$id_carrera,$nameCarrera,$modalityCarrera,$id_status);
        $plan_estudio->setIdUser($_SESSION['user']->getId());
        $plan_estudio->setUser($_SESSION['user']->getName());
        $res = $plan_estudio->createPlan();
        $id_plan = $res["id_plan"];

        header("location:/tesis/plan/editor/$id_plan");

    }

    //guardar informacion del editor del plan de estudio
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
        $comGeneral = $this->post('comGeneral');
        $comBasica = $this->post('comBasica');
        $comEspecialidad = $this->post('comEspecialidad');
        $areas = $this->post('areas');
        $user = $_SESSION['user'];

        //Pasando los id de string a int para la comprobacion en cada uno de sus objetos
        $val = intval($creador[0]);
        $idGeneralidad = intval($generalidad[0]);
        $idProposito = intval($proposito[0]);

        //quitamos el primer elemento del array en generalidades
        array_shift($generalidad);

        //haciendo la relacion de plan de estudio con los creadores
        if(!empty($val)){
            $planCreador = new PlanEstudioCreador($idPlan,$creador);
            $planCreador->createPlanCreador();
        }

        //Creando nueva generalidad de la carrera en el plan de estudio
        if(empty($idGeneralidad) && !empty($generalidad[0])){
            $generalidadCarrera = new GeneralidadesCarrera($generalidad);
            $idGenCarrera =  $generalidadCarrera->createGeneralidad();

            //Haciendo la relacion generdlidades de la carrera con el plan de estudio
            $idGC = intval($idGenCarrera['id_generalidades']);
            $PlanE_GeneralidadCar = new PlanEstudioGeneralidadesCarrera($idPlan,$idGC);
            $PlanE_GeneralidadCar->createPlanGeneralidad();
        }
        //actualizando la seccion de generalidades de la carrera en el plan de estudio
        if(!empty($idGeneralidad)){
            $generalidadCarrera = new GeneralidadesCarrera($generalidad);
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

        //actualizando Proposito de Carrera en el plan de estudio
        if(!empty($idProposito)){
            $propositoCarrera = new PropositoCarrera($proposito[1]);
            $propositoCarrera->setId($idProposito);
            $propositoCarrera->updateProposito();
        }

        //Ingresando nueva competencia general al plan de estudio
        if(!empty($comGeneral[0]) || !empty($comGeneral[1])){
            $ids = [];
            $competenciaGeneral = new CompetenciaGeneral($comGeneral);
            $ids = $competenciaGeneral->createComGeneral();

            $planCompetenciaGen = new PlanEstudioCompetenciaGeneral($idPlan, $ids);
            $planCompetenciaGen->createPlanComGeneral();
        }

        //Ingresando nueva competencia basica al plan de estudio
        if(!empty($comBasica[0]) || !empty($comBasica[1])){
            $ids = [];
            $competenciaBasica = new CompetenciaBasica($comBasica);
            $ids = $competenciaBasica->createComBasica();

            $planCompetenciaBas = new PlanEstudioCompetenciaBasica($idPlan, $ids);
            $planCompetenciaBas->createPlanComBasica();
        }

        //Ingresando nueva competencia especialidad al plan de estudio
        if(!empty($comEspecialidad[0]) || !empty($comEspecialidad[1])){
            $ids = [];
            $competenciaEspecialidad = new CompetenciaEspecialidad($comEspecialidad);
            $ids = $competenciaEspecialidad->createComEspecialidad();

            $planCompetenciaBas = new PlanEstudioCompetenciaEspecialidad($idPlan, $ids);
            $planCompetenciaBas->createPlanComEspecialidad();
        }

        //ingresando areas de desempeño en el plan de estudio
        if(!empty($areas[0]) ||
        !empty($areas[1]) ||
        !empty($areas[2]) ||
        !empty($areas[3])){
            $area_desempenio = new Areas($areas,$idPlan);
            $area_desempenio->createAreas();
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
            $_SESSION['message'] = 'ERROR: datos no guardados.';
            error_log('No se pudo guardar en bd');
            header("location:/tesis/plan/editor/$id");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Datos Guardados!.';
        header("location:/tesis/plan/editor/$id");
    }

    public function guardarPortada($id){
        $idPlan = intval($id);
        $vigInicio = $this->post('vigenciaInicio');
        $vigFinal = $this->post('vigenciaFinal');
        $presentacion = $this->post('fechaPresentacion');

        $data=[
            'id' => $idPlan,
            'inicio' => $vigInicio,
            'final' => $vigFinal,
            'presentacion' => $presentacion
        ];

        //traemos objeto StudyPlan de bd con su funcion estatica
        $studyPlan = StudyPlan::guardarPortada($data);

        // retornar respuesta
        if(!$studyPlan){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Datos guardados correctamente']);
    }

    public function guardarFundamentacion($id){
        $idPlan = intval($id);
        $fundamentacion = $this->post('fundamentacion');

        $data=[
            'id' => $idPlan,
            'fundamentacion' => $fundamentacion
        ];

        //traemos objeto StudyPlan de bd con su funcion estatica
        $studyPlan = StudyPlan::guardarFundamentacion($data);

        // retornar respuesta
        if(!$studyPlan){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Datos guardados correctamente']);
    }

    public function guardarCreador($id){
        $idPlan = intval($id);
        $creador = $this->post('opcionCreador');
        $data=[
            'creador' => $creador
        ];

        //traemos objeto StudyPlan de bd con su funcion estatica
        $planCreador = new PlanEstudioCreador($idPlan,$data);
        $planCreador->createPlanCreador();

        $creadorBD = CreadorModel::getCreador($creador);

        // retornar respuesta
        if(!$planCreador){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode([
        'status' => 'success', 
        'creador' => ['creador_id' => $creadorBD->getId(), 'nombre_creador' => $creadorBD->getName()]
        ]);
    }

    public function guardarGeneralidades($id){ 
        $idPlan = intval($id);
        $generalidad_id = intval($this->post('generalidad_id'));
        $generalidad_requisito = $this->post('generalidadRequisito');
        $generalidad_anios = intval($this->post('generalidadAnios'));
        $generalidad_ciclos = intval($this->post('generalidadCiclos'));
        $generalidad_asignatura = intval($this->post('generalidadAsignatura'));
        $generalidad_valorativas = intval($this->post('generalidadValorativas'));
        $generalidad_sede = $this->post('generalidadSede');
        $generalidad_responsable = $this->post('generalidadResponsable');
        $generalidad_inicio = intval($this->post('generalidadInicio'));

        //Creando nueva generalidad
        $generalidadCarrera = new GeneralidadesCarrera($generalidad_requisito,$generalidad_anios,$generalidad_ciclos,
        $generalidad_asignatura,$generalidad_valorativas,$generalidad_sede,$generalidad_responsable,$generalidad_inicio);
        $idGenCarrera =  $generalidadCarrera->createGeneralidad();
        //Haciendo la relacion generdlidades de la carrera con el plan de estudio
        $idGC = intval($idGenCarrera['id_generalidades']);
        $PlanE_GeneralidadCar = new PlanEstudioGeneralidadesCarrera($idPlan,$idGC);
        $PlanE_GeneralidadCar->createPlanGeneralidad();
        // retornar respuesta
        if(!$PlanE_GeneralidadCar){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Datos guardados correctamente', 'id_generalidad' => $idGC]);
    }

    public function actualizarGeneralidades($id) { 
        $idPlan = intval($id);
        
        // Leer JSON del body PUT
        $input = file_get_contents('php://input');
        $datos = json_decode($input, true);
        
        if (!$datos) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Datos JSON inválidos']);
            return;
        }
        
        $generalidad_id = intval($datos['generalidad_id'] ?? 0);
        $generalidad_requisito = $datos['generalidadRequisito'] ?? '';
        $generalidad_anios = intval($datos['generalidadAnios'] ?? 0);
        $generalidad_ciclos = intval($datos['generalidadCiclos'] ?? 0);
        $generalidad_asignatura = intval($datos['generalidadAsignatura'] ?? 0);
        $generalidad_valorativas = intval($datos['generalidadValorativas'] ?? 0);
        $generalidad_sede = $datos['generalidadSede'] ?? '';
        $generalidad_responsable = $datos['generalidadResponsable'] ?? '';
        $generalidad_inicio = intval($datos['generalidadInicio'] ?? 0);

        $generalidadCarrera = new GeneralidadesCarrera($generalidad_requisito, $generalidad_anios, $generalidad_ciclos,
            $generalidad_asignatura, $generalidad_valorativas, $generalidad_sede, $generalidad_responsable, $generalidad_inicio);
        $generalidadCarrera->setId($generalidad_id);
        $updateGen = $generalidadCarrera->updateGeneralidad();

        if (!$updateGen) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar en bd']);
            return;
        }
        
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Datos actualizados correctamente', 'id_generalidad' => $generalidad_id]);
    }

    public function actualizarProposito($id) { 
        $idPlan = intval($id);
        
        // Leer JSON del body PUT
        $input = file_get_contents('php://input');
        $datos = json_decode($input, true);
        
        if (!$datos) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Datos JSON inválidos']);
            return;
        }
        
        $proposito_id = intval($datos['proposito_id'] ?? 0);
        $descripcion = $datos['proposito'] ?? '';

        $propositoCarrera = new PropositoCarrera($descripcion);
        $propositoCarrera->setId($proposito_id);
        $updatePro = $propositoCarrera->updateProposito();

        if (!$updatePro) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar en bd']);
            return;
        }
        
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Datos actualizados correctamente', 'id_proposito' => $proposito_id]);
    }

    public function guardarProposito($id){ 
        $idPlan = intval($id);
        $proposito = $this->post('proposito');

        //Creando un Proposito de Carrera en el plan de estudio
        $propositoCarrera = new PropositoCarrera($proposito);
        $idNew = $propositoCarrera->createProposito();

        $idNewPro = intval($idNew['id_proposito']);
        //se asocia al plan de estudio
        $planProposito = new PlanEstudioPropositoCarrera($idPlan,$idNewPro);
        $planProposito->createPlanProposito();

        // retornar respuesta
        if(!$planProposito){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Datos guardados correctamente', 'id_proposito' => $idNewPro]);
    }

    public function guardarComGeneral($id){ 
        $idPlan = intval($id);
        $descripcion = $this->post('competenciaGeneral');
        $ciclo = intval($this->post('ciclo'));

        //Ingresando nueva competencia general al plan de estudio
        $competenciaGeneral = new CompetenciaGeneral($descripcion,$ciclo);
        $id = $competenciaGeneral->createComGeneral();

        $planCompetenciaGen = new PlanEstudioCompetenciaGeneral($idPlan, $id['id_general']);
        $planCompetenciaGen->createPlanComGeneral();

        // retornar respuesta
        if(!$planCompetenciaGen){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'descripcion' => $descripcion, 'ciclo' => $ciclo , 'general_id' => $id['id_general']]);
    }

    public function eliminarComGeneral($idPlan, $idComGeneral){ 
        $idPlan = intval($idPlan);
        $idComGeneral = intval($idComGeneral);

        $deletePC = PlanEstudioCompetenciaGeneral::deletePlanComGeneral($idComGeneral,$idPlan);

        if(!$deletePC){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la competencia general del plan de estudio']);
            exit();
        }

        $delete = CompetenciaGeneral::deleteComGeneral($idComGeneral);

        if(!$delete){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la competencia general']);
            exit();
        }

        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Competencia general eliminada correctamente']);
    }

    public function guardarComBasica($id){ 
        $idPlan = intval($id);
        $descripcion = $this->post('competenciaBasica');
        $ciclo = intval($this->post('cicloBasica'));

        //Ingresando nueva competencia basica al plan de estudio
        $competenciaBasica = new CompetenciaBasica($descripcion,$ciclo);
        $id = $competenciaBasica->createComBasica();

        $planCompetenciaBas = new PlanEstudioCompetenciaBasica($idPlan, $id['id_basico']);
        $planCompetenciaBas->createPlanComBasica();

        // retornar respuesta
        if(!$planCompetenciaBas){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'descripcion' => $descripcion, 'ciclo' => $ciclo , 'basica_id' => $id['id_basico']]);
    }

    public function eliminarComBasica($idPlan, $idComBasica){ 
        $idPlan = intval($idPlan);
        $idComBasica = intval($idComBasica);

        $deletePC = PlanEstudioCompetenciaBasica::deletePlanComBasica($idComBasica,$idPlan);

        if(!$deletePC){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la competencia basica del plan de estudio']);
            exit();
        }

        $delete = CompetenciaBasica::deleteComBasica($idComBasica);

        if(!$delete){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la competencia basica']);
            exit();
        }

        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Competencia basica eliminada correctamente']);
    }

    public function guardarComEspecialidad($id){ 
        $idPlan = intval($id);
        $descripcion = $this->post('competenciaEspecialidad');
        $ciclo = intval($this->post('cicloEspecialidad'));

        //Ingresando nueva competencia especialidad al plan de estudio
        $competenciaEspecialidad = new CompetenciaEspecialidad($descripcion,$ciclo);
        $id = $competenciaEspecialidad->createComEspecialidad();

        $planCompetenciaEsp = new PlanEstudioCompetenciaEspecialidad($idPlan, $id['id_especialidad']);
        $planCompetenciaEsp->createPlanComEspecialidad();

        // retornar respuesta
        if(!$planCompetenciaEsp){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'descripcion' => $descripcion, 'ciclo' => $ciclo , 'especialidad_id' => $id['id_especialidad']]);
    }

    public function eliminarComEspecialidad($idPlan, $idComEspecialidad){ 
        $idPlan = intval($idPlan);
        $idComEspecialidad = intval($idComEspecialidad);

        $deletePC = PlanEstudioCompetenciaEspecialidad::deletePlanComEspecialidad($idComEspecialidad,$idPlan);

        if(!$deletePC){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la competencia de especialidad del plan de estudio']);
            exit();
        }

        $delete = CompetenciaEspecialidad::deleteComEspecialidad($idComEspecialidad);

        if(!$delete){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la competencia de especialidad']);
            exit();
        }

        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Competencia de especialidad eliminada correctamente']);
    }

    public function guardarArea($id){ 
        $idPlan = intval($id);
        $area = $this->post('competenciaArea');
        $areaPuesto = $this->post('competenciaAreaPuesto');
        $areaFunciones = $this->post('competenciaAreaFunciones');
        $areaOrganizacion = $this->post('competenciaAreaOrganizacion');

        //ingresando areas de desempeño en el plan de estudio
        $area_desempenio = new Areas($area,$areaPuesto,$areaFunciones,$areaOrganizacion,$idPlan);
        $area_desempenio->createAreas();

        // retornar respuesta
        if(!$area_desempenio){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar en bd']);
            exit();
        }
        http_response_code(200);
        echo json_encode([
            'status' => 'success', 
            'area' => $area, 
            'puesto' => $areaPuesto,
            'funciones' => $areaFunciones,
            'organizacion' => $areaOrganizacion,
            'message' => 'Datos guardados correctamente'
        ]);
    }

    public function eliminarArea($idPlan, $idArea){ 
        $idPlan = intval($idPlan);
        $idArea = intval($idArea);

        $delete = Areas::deleteAreas($idArea);

        if(!$delete){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar el area de desempeño']);
            exit();
        }

        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Area de desempeño eliminada correctamente']);
    }

    //eliminar plan de estudio
    public function deletePlan($id){

        $res = StudyPlan::deletePlan($id);

        header("location:/tesis/planes/1");
    }

    //descargar documento de word
    public function word(int $id){
        //traemos un plan de estudio
        $req = StudyPlan::getPlan($id);
        //traemos generalidades de carrera
        $generalidades = PlanEstudioGeneralidadesCarrera::getPlanGeneralidad($id);
        $gen = GeneralidadesCarrera::getGeneralidad($generalidades[0]['Id']);
        //traemos Proposito de carrera
        $proId = PlanEstudioPropositoCarrera::getPlanPropositoId($id); 
        $pro = PropositoCarrera::getProposito($proId[0]['Id']);

        //traemos nuestras competencias de bd relacionadas con el plan de estudio
        $comGeneral = PlanEstudioCompetenciaGeneral::getPlanComGenerales($id);
        $comBasica = PlanEstudioCompetenciaBasica::getPlanComBasicas($id);
        $comEspecialidad = PlanEstudioCompetenciaEspecialidad::getPlanComEspecialidades($id);

        //traemos las areas de desempeño del plkan de estudio
        $areas = Areas::getAreasPlan($id);

        $idCreadores = [];
        $creadores = [];
        $grado = [];
        $exp = [];
        $participacion = [];
        //traemos a los creadores(grado,experiencia,participacion)
        $idCreadores = PlanEstudioCreador::getCreadorPlanId($id);
        $creadores = PlanEstudioCreador::getCreadorPlan($id);

        foreach($idCreadores as $key => $value){
            array_push($grado,CreadorGradoAcademico::getGradoCreador($value['id']));
            array_push($exp,CreadorExperiencia::getExperienciaCreador($value['id']));
            array_push($participacion,CreadorParticipacion::getParticipacionCreador($value['id']));
        }

        // nos nuestra libreria PHPWord para poder descargar el docx
        require_once __DIR__ . '/../lib/word.php';
    }
}