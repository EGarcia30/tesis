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
use Penad\Tesis\models\CompetenciaGeneral;
use Penad\Tesis\models\PlanEstudioCompetenciaGeneral;
use Penad\Tesis\models\CompetenciaBasica;
use Penad\Tesis\models\PlanEstudioCompetenciaBasica;
use Penad\Tesis\models\CompetenciaEspecialidad;
use Penad\Tesis\models\PlanEstudioCompetenciaEspecialidad;
use Penad\Tesis\models\Areas;
use Penad\Tesis\models\Materia;
use Penad\Tesis\models\PlanEstudioMateria;
use Penad\Tesis\models\Prerrequisito;
use Penad\Tesis\models\MateriaPrerrequisito;
use Penad\Tesis\models\Elemento;
use Penad\Tesis\models\MateriaValorInstitucional;
use Penad\Tesis\models\ContenidoAsignatura;
use Penad\Tesis\models\Habilidades;
use Penad\Tesis\models\Conocimientos;
use Penad\Tesis\models\Metodologia;
use Penad\Tesis\models\CriterioContenido;
use Penad\Tesis\models\Indicador;
use Penad\Tesis\models\CriterioEvaluacion;
use Penad\Tesis\models\EvaluacionPresencial;
use Penad\Tesis\models\IndicadorEvaluacionPresencial;
use Penad\Tesis\models\EvaluacionNoPresencial;
use Penad\Tesis\models\IndicadorEvaluacionNoPresencial;
use Penad\Tesis\models\MaterialApoyo;
use Penad\Tesis\models\Recursos;
use Penad\Tesis\models\ImagenMateria;

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
            'color' => $_SESSION['color'] == '' ? null : $_SESSION['color'],
            'message' => $_SESSION['message'] == '' ? null : $_SESSION['message']
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
        $id_facultad = intval($this->post('opcion'));
        $id_carrera = intval($this->post('opcionCarrera'));
        $id_status = intval($this->post('radio'));
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
            $ids = $competenciaEspecialidad->createAreas();

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

    public function saveMateria($id){
        $materia = $this->post('materia');
        $prerrequisito = $this->post('prerrequisito');
        $elemento = $this->post('elemento');
        $valores = $this->post('valores');
        $apoyo = $this->post('apoyo');
        $recurso = $this->post('recurso');
        $img = $this->files('img');

        //verificando que el campo tipo y nombre asignatura no venga vacios
        if(empty(trim($materia[0])) || empty(trim($materia[1]))){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese el ciclo o nombre de la materia.';
            error_log('No se pudo guardar en bd');
            header("location:/tesis/plan/materia/$id");
            exit();
        }

        //creando materia
        $materiaBD = new Materia($materia);
        $res = $materiaBD->createMateria();

        //verificando que nos devuelva nuestro id de respuesta
        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al ingresar materia.';
            error_log('No se pudo recuperar el id');
            header("location:/tesis/plan/materia/$id");
            exit();
        }

        //creando relacion con el plan de estudio
        $planMateriaBD = new PlanEstudioMateria($id,$res['materia_id']);
        $resPM = $planMateriaBD->createPlanMateria();

        if(!$resPM){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al vincular materia.';
            error_log('No se pudo vincular con el plan la materia');
            header("location:/tesis/plan/materia/$id");
            exit();
        }

        $materia_id = $res['materia_id'];

        //verificando que prerrequisito traiga informacion
        if(!empty(trim($prerrequisito[0]))){
            //por cada valor en el array hacer el ingreso de datos y vinculacion a la materia
            foreach($prerrequisito as $key => $value){
                $prerrequisitoBD = new Prerrequisito($value);
                $resBD = $prerrequisitoBD->createPrerrequisito();

                //verificacion de retorno de id de prerrequistio
                if(!$resBD){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al ingresar prerrequisito.';
                    error_log('No se pudo recuperar el id de prerrequisito');
                    header("location:/tesis/plan/materia/$id");
                    exit();
                }

                $materiaPrerrequisitoBD = new MateriaPrerrequisito($materia_id,$resBD['prerrequisito_id']);
                $resMP = $materiaPrerrequisitoBD->createMateriaPrerrequisito();

                //verificacion de que si se vincule la materia con el prerrequisito
                if(!$resMP){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al vincular materia con prerrequisito.';
                    error_log('No se pudo vincular');
                    header("location:/tesis/plan/materia/$id");
                    exit();
                }
            }
        }

        if(!empty(trim($elemento[0]))){
            foreach($elemento as $key => $value){
                $elementoBD = new Elemento($value,$materia_id);
                $resE = $elementoBD->createElemento();

                //verificacion de que se cree el elemento correctamente.
                if(!$resE){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al vincular materia con elemento.';
                    error_log('No se pudo vincular');
                    header("location:/tesis/plan/materia/$id");
                    exit();
                }
            }
        }
        if(!empty(trim($valores[0]))){
            foreach($valores as $key => $value){
                $materiaValoresBD = new MateriaValorInstitucional($materia_id,$value);
                $resMV = $materiaValoresBD->createMateriaValor();

                if(!$resMV){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al vincular materia con valor institucional.';
                    error_log('No se pudo vincular');
                    header("location:/tesis/plan/materia/$id");
                    exit();
                }
            }
        }
        $x = 1;
        while(count($contenido = $this->post("contenido{$x}")) >= 1){
            $contenido = $this->post("contenido{$x}");
            $habilidades = $this->post("habilidades");
            $conocimientos = $this->post("conocimientos{$x}");
            $metodologia = $this->post("metodologia{$x}");
            $criterioContenido = $this->post("criterioContenido{$x}");

            if(empty(trim($contenido[0])) || empty(trim($contenido[1]))){
                $_SESSION['color'] = 'warning';
                $_SESSION['message'] = 'Ingresar unidad de aprendizaje y/o compotencia.';
                error_log('llenar los campos de aprendizaje y competencia');
                header("location:/tesis/plan/materia/$id");
                exit();
            }

            $contenidoBD = new ContenidoAsignatura($contenido, $materia_id);
            $res = $contenidoBD->createContenidoAsignatura();
            $contenido_id = $res['contenido_id'];

            if(!empty(trim($habilidades[0]))){
                foreach($habilidades as $key => $value){
                    $habilidadesBD = new Habilidades($value,$contenido_id);
                    $resH = $habilidadesBD->createHabilidades();

                    if(!$resH){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al vincular contenido asignatura con habilidades.';
                        error_log('vinculacion habilidades');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
            }

            if(!empty(trim($conocimientos[0]))){
                foreach($conocimientos as $key => $value){
                    $conocimientosBD = new Conocimientos($value,$contenido_id);
                    $resC = $conocimientosBD->createConocimientos();

                    if(!$resC){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al vincular contenido asignatura con conocimientos.';
                        error_log('vinculacion conocimientos');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
            }

            if(!empty($metodologia[0])){
                foreach($metodologia as $key => $value){
                    $metodologiaBD = new Metodologia($value,$contenido_id);
                    $resM = $metodologiaBD->createMetodologia();

                    if(!$resM){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al vincular contenido asignatura con metodologia.';
                        error_log('vinculacion metodologia');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
            }

            if(!empty($criterioContenido[0])){
                foreach($criterioContenido as $key => $value){
                    $criterioContenidoBD = new CriterioContenido($value,$contenido_id);
                    $resCC = $criterioContenidoBD->createCriterioContenido();

                    if(!$resCC){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al vincular contenido asignatura con criterioContenido.';
                        error_log('vinculacion criterioContenido');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
            }

            $x++;
        }

        $i = 1;
        while(count($indicador = $this->post("indicador{$i}")) >= 1){
            $indicador = $this->post("indicador{$i}");
            $criterio = $this->post("criterio{$i}");
            $Spresencial = $this->post("Spresencial{$i}");
            $SNopresencial = $this->post("SNopresencial{$i}");

            if(empty(trim($indicador[0]))){
                $_SESSION['color'] = 'warning';
                $_SESSION['message'] = 'Ingresar indicador.';
                error_log('llenar los campos de aprendizaje y competencia');
                header("location:/tesis/plan/materia/$id");
                exit();
            }

            $indicadorBD = new Indicador($indicador[0], $materia_id);
            $res = $indicadorBD->createIndicador();
            $indicador_id = $res['indicador_id'];

            if(!empty(trim($criterio[0]))){
                foreach($criterio as $key => $value){
                    $criterioBD = new CriterioEvaluacion($value,$indicador_id);
                    $resCC = $criterioBD->createCriterioEvaluacion();

                    if(!$resCC){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al vincular indicador con criterio.';
                        error_log('vinculacion criterio');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
            }

            if(!empty(trim($Spresencial[0]))){
                foreach($Spresencial as $key => $value){
                    $SpresencialBD = new EvaluacionPresencial($value);
                    $resSP = $SpresencialBD->createSpresencial();

                    if(!$resSP){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al crear evaluacion presencial.';
                        error_log('no se creo evaluacion presencial');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }

                    $indicadorSpresencialBD = new IndicadorEvaluacionPresencial($indicador_id,$resSP['epresencial_id']);
                    $resISP = $indicadorSpresencialBD->createIndicadorSpresencial();

                    if(!$resISP){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al crear vincular evaluacion presencial con indicador.';
                        error_log('no se creo evaluacion presencial');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
            }

            if(!empty(trim($SNopresencial[0]))){
                foreach($SNopresencial as $key => $value){
                    $SNopresencialBD = new EvaluacionNoPresencial($value);
                    $resSNP = $SNopresencialBD->createSNopresencial();

                    if(!$resSNP){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al crear evaluacion no presencial.';
                        error_log('no se creo evaluacion no presencial');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }

                    $indicadorSNopresencialBD = new IndicadorEvaluacionNoPresencial($indicador_id,$resSNP['enopresencial_id']);
                    $resISNP = $indicadorSNopresencialBD->createIndicadorSNopresencial();

                    if(!$resISNP){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al crear vincular evaluacion no presencial con indicador.';
                        error_log('no se creo evaluacion no presencial');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
            }
            $i++;
        }

        if(!empty(trim($apoyo[0]))){
            foreach($apoyo as $key => $value){
                $apoyoBD = new MaterialApoyo($value,$materia_id);
                $resA = $apoyoBD->createMaterialApoyo();

                if(!$resA){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al vincular material de apoyo.';
                    error_log('no se material de apoyo');
                    header("location:/tesis/plan/materia/$id");
                    exit();
                }
            }
        }

        if(!empty(trim($recurso[0]))){
            $recursoBD = new Recursos($recurso,$materia_id);
            $res = $recursoBD->createRecurso();

            if(!$res){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al vincular recursos.';
                error_log('no se material de apoyo');
                header("location:/tesis/plan/materia/$id");
                exit();
            }
        }

        // Verificar que se haya subido la imagen correctamente
        if(!empty($img['name'])){
            // Mover la imagen a la carpeta "materia" en el servidor
            $rutaImagen = __DIR__.'/../../public/img/materia/'.$img['name'];
            move_uploaded_file($img['tmp_name'], $rutaImagen);

            // Obtener la ubicación de la imagen en el servidor
            $rutaImagen = realpath($rutaImagen);
            $imagenBD = new ImagenMateria($rutaImagen,$materia_id);
            $res = $imagenBD->createImagen();

            if(!$res){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al guardar imagen.';
                error_log('no se pudo guardar imagen');
                header("location:/tesis/plan/materia/$id");
                exit();
            }
        }        
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Materia guardada.';
        header("location:/tesis/plan/materia/$id");
    }

    public function deletePlan($id){

        $res = StudyPlan::deletePlan($id);

        header("location:/tesis/planes/1");
    }

    //VINCULACIONES CON EL PLAN DE ESTUDIO

    //CREADOR-PLAN DE ESTUDIO
    public function deletePlanCreador($idCreador,$idPlan){
        $delete = PlanEstudioCreador::deletePlanCreador($idCreador,$idPlan);

        if(!$delete){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: desvinculación del creador.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se desvinculo el creador.';
        header("location:/tesis/plan/editor/$idPlan");
    }

    //Competencia General - Plan de estudio
    public function updatePlanComGeneral($idComGeneral,$idPlan){
        $funcion = $this->post('descripcion');
        $ciclo = $this->post('ciclo');

        if(empty($descripcion) || empty($ciclo)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $updateComGeneral = CompetenciaGeneral::updateComGeneral($idComGeneral,$descripcion,$ciclo);

        if(!$updateComGeneral){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al actualizar competencia general.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location:/tesis/plan/editor/$idPlan");

    }
    
    public function deletePlanComGeneral($idComGeneral,$idPlan){
        $deletePC = PlanEstudioCompetenciaGeneral::deletePlanComGeneral($idComGeneral,$idPlan);

        if(!$deletePC){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al eliminar competencia general.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $delete = CompetenciaGeneral::deleteComGeneral($idComGeneral);

        if(!$delete){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al eliminar competencia general.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        error_log('funciona');
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se eliminó la competencia general.';
        header("location:/tesis/plan/editor/$idPlan");
    }

    //Competencia Basica - Plan de estudio
    public function updatePlanComBasica($idComBasica,$idPlan){
        $descripcion = $this->post('descripcion');
        $ciclo = $this->post('ciclo');

        if(empty($descripcion) || empty($ciclo)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $updateComBasica = CompetenciaBasica::updateComBasica($idComBasica,$descripcion,$ciclo);

        if(!$updateComBasica){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al actualizar competencia basica.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location:/tesis/plan/editor/$idPlan");

    }
    
    public function deletePlanComBasica($idComBasica,$idPlan){
        $deletePC = PlanEstudioCompetenciaBasica::deletePlanComBasica($idComBasica,$idPlan);

        if(!$deletePC){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al eliminar competencia basica.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $delete = CompetenciaBasica::deleteComBasica($idComBasica);

        if(!$delete){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al eliminar competencia basica.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        error_log('funciona');
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se eliminó la competencia basica.';
        header("location:/tesis/plan/editor/$idPlan");
    }

    //Competencia Basica - Plan de estudio
    public function updatePlanComEspecialidad($idComEspecialidad,$idPlan){
        $descripcion = $this->post('descripcion');
        $ciclo = $this->post('ciclo');

        if(empty($descripcion) || empty($ciclo)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $updateComEspecialidad = CompetenciaEspecialidad::updateComEspecialidad($idComEspecialidad,$descripcion,$ciclo);

        if(!$updateComEspecialidad){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al actualizar competencia especialidad.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location:/tesis/plan/editor/$idPlan");

    }
    
    public function deletePlanComEspecialidad($idComEspecialidad,$idPlan){
        $deletePC = PlanEstudioCompetenciaEspecialidad::deletePlanComEspecialidad($idComEspecialidad,$idPlan);

        if(!$deletePC){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al eliminar competencia especialidad.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $delete = CompetenciaEspecialidad::deleteComEspecialidad($idComEspecialidad);

        if(!$delete){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al eliminar competencia especialidad.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        error_log('funciona');
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se eliminó la competencia especialidad.';
        header("location:/tesis/plan/editor/$idPlan");
    }

    //Areas - Plan de estudio
    public function updatePlanAreas($idAreas,$idPlan){
        $area = $this->post('area');
        $puesto = $this->post('puesto');
        $funcion = $this->post('funcion');
        $tipo = $this->post('tipo');

        if(empty($area) || empty($puesto) || empty($funcion) || empty($tipo)){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese datos.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $updateAreas = Areas::updateAreas($idAreas,$area,$puesto,$funcion,$tipo);

        if(!$updateAreas){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al actualizar área de desempeño.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Cambios realizados.';
        header("location:/tesis/plan/editor/$idPlan");

    }
    
    public function deletePlanAreas($idAreas,$idPlan){
        $delete = Areas::deleteAreas($idAreas);

        if(!$delete){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: Al eliminar área de desempeño.';
            header("location:/tesis/plan/editor/$idPlan");
            exit();
        }

        error_log('funciona');
        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se eliminó la área de desempeño.';
        header("location:/tesis/plan/editor/$idPlan");
    }

    //descargar documento de word
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
        $generalidades = PlanEstudioBasicaidadesCarrera::getPlanGeneralidad($id);
        $gen = GeneralidadesCarrera::getGeneralidad($generalidades[0]['Id']);
        //traemos Proposito de carrera
        $proId = PlanEstudioPropositoCarrera::getPlanPropositoId($id); 
        $pro = PropositoCarrera::getProposito($proId[0]['Id']);

        //traemos nuestras competencias de bd relacionadas con el plan de estudio
        $comGeneral = PlanEstudioCompetenciaGeneral::getPlanComGenerales($id);
        $comBasica = PlanEstudioCompetenciaBasica::getPlanComBasicas($id);
        $comEspecialidad = PlanEstudioCompetenciaEspecialidad::getPlanAreases($id);

        //traemos las areas de desempeño del plkan de estudio
        $areas = Areas::getAreasPlan($id);


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