<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
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

class PlanMateria extends Controller{

    public function __construct(){
        parent::__construct();
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
        if(empty(trim($materia[0])) || 
            empty(trim($materia[1])) ||
            empty(trim($prerrequisito[0])) ||
            empty(trim($elemento[0])) ||
            empty(trim($valores[0])) ||
            empty(trim($apoyo[0])) ||
            empty(trim($recurso[0])) ||
            empty(trim($img['name']))){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese los datos requeridos.';
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

                print_r($value);
                exit();
                if($value != 'br'){
                    $data = Materia::getMateria($value);

                    $prerrequisitoBD = new Prerrequisito($data['nombre_asignatura'],$data['no_orden']);
                    $resBD = $prerrequisitoBD->createPrerrequisito();

                    //verificacion de retorno de id de prerrequistio
                    if(!$resBD){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al ingresar prerrequisito.';
                        error_log('No se pudo recuperar el id de prerrequisito');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
                }
                else{
                    $prerrequisitoBD = new Prerrequisito('Bachiller',$value);
                    $resBD = $prerrequisitoBD->createPrerrequisito();

                    //verificacion de retorno de id de prerrequistio
                    if(!$resBD){
                        $_SESSION['color'] = 'danger';
                        $_SESSION['message'] = 'ERROR: al ingresar prerrequisito.';
                        error_log('No se pudo recuperar el id de prerrequisito');
                        header("location:/tesis/plan/materia/$id");
                        exit();
                    }
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
            $habilidades = $this->post("habilidades{$x}");
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

    public function deleteMateria($idPlan,$idMateria){
        $ruta = ImagenMateria::getImagen($idMateria);

        $rutaImg= $ruta['img_materia'];

        if($rutaImg){
            $unlink = unlink($rutaImagen);

            $deleteImg = ImagenMateria::deleteImagen($idMateria);

            if(!$deleteImg || !$unlink){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar imagen.';
                error_log('no se pudo eliminar imagen');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }
        }

        $deleteRecurso = Recursos::deleteRecursos($idMateria);

        if(!$deleteRecurso){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al eliminar recursos.';
            error_log('no se pudo eliminar recurso');
            header("location:/tesis/plan/materia/$idPlan");
            exit();
        }

        $dltApoyo = MaterialApoyo::deleteApoyo($idMateria);

        if(!$dltApoyo){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al eliminar material de apoyo.';
            error_log('no se pudo eliminar recurso');
            header("location:/tesis/plan/materia/$idPlan");
            exit();
        }

        $indicadores = Indicador::getIndicadores($idMateria);

        foreach($indicadores as $key => $value){
            $indicador_id = $value['indicador_id'];

            $dltCriterioE = CriterioEvaluacion::deleteCriterioEvaluacion($indicador_id);

            if(!$dltCriterioE){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar criterio evaluación.';
                error_log('no se pudo eliminar recurso');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }

            $getIndicadorEpresencial = IndicadorEvaluacionPresencial::getIndicadorSpresencial($indicador_id);

            foreach($getIndicadorEpresencial as $key => $value){

                $epresencial_id = intval($value['epresencial_id']);

                $dltIndicadorEpresencial = IndicadorEvaluacionPresencial::deleteIndicadorSpresencial($indicador_id,$epresencial_id);

                if(!$dltIndicadorEpresencial){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al desvincular evaluación presencial.';
                    error_log('no se pudo desvincular con materia');
                    header("location:/tesis/plan/materia/$idPlan");
                    exit();
                }

                $dltEpresencial = EvaluacionPresencial::deleteEvaluacionPresencial($epresencial_id);

                if(!$dltEpresencial){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al eliminar evaluación presencial.';
                    error_log('no se pudo eliminar evaluacion presencial con materia');
                    header("location:/tesis/plan/materia/$idPlan");
                    exit();
                }
            }

            $getIndicadorENopresencial = IndicadorEvaluacionNoPresencial::getIndicadorSNopresencial($indicador_id);

            foreach($getIndicadorENopresencial as $key => $value){

                $enopresencial_id = intval($value['enopresencial_id']);

                $dltIndicadorEnopresencial = IndicadorEvaluacionNoPresencial::deleteIndicadorSNopresencial($indicador_id,$enopresencial_id);

                if(!$dltIndicadorEnopresencial){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al desvincular evaluación no presencial.';
                    error_log('no se pudo desvincular con materia');
                    header("location:/tesis/plan/materia/$idPlan");
                    exit();
                }

                $dltEnopresencial = EvaluacionNoPresencial::deleteEvaluacionNoPresencial($enopresencial_id);

                if(!$dltEnopresencial){
                    $_SESSION['color'] = 'danger';
                    $_SESSION['message'] = 'ERROR: al eliminar evaluación presencial.';
                    error_log('no se pudo eliminar evaluacion no presencial con materia');
                    header("location:/tesis/plan/materia/$idPlan");
                    exit();
                }
            }

            $dltIndicador = Indicador::deleteIndicador($indicador_id,$idMateria);

            if(!$dltIndicador){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar indicador.';
                error_log('no se pudo eliminar recurso');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }
        }

        $contenidoAsignaturas = ContenidoAsignatura::getContenidoAsignaturas($idMateria);

        foreach($contenidoAsignaturas as $key => $value){
            $contenido_id = intval($value['contenido_id']);

            $dlt = Habilidades::deleteHabilidades($contenido_id);

            if(!$dlt){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar habilidades.';
                error_log('no se pudo eliminar habilidades');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }

            $dlt = Conocimientos::deleteConocimientos($contenido_id);

            if(!$dlt){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar conocimientos.';
                error_log('no se pudo eliminar conocimientos');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }

            $dlt = Metodologia::deleteMetodologia($contenido_id);

            if(!$dlt){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar metodologia.';
                error_log('no se pudo eliminar metodologia');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }

            $dlt = CriterioContenido::deleteCriterioContenido($contenido_id);

            if(!$dlt){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar criterio contenido.';
                error_log('no se pudo eliminar criterio contenido');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }

            $dlt = ContenidoAsignatura::deleteContenidoAsignatura($contenido_id,$idMateria);
        }

        $valorInstitucional = MateriaValorInstitucional::getMateriaValores($idMateria);

        foreach($valorInstitucional as $key => $value){
            $valor_id = intval($value['valor_id']);

            $dlt = MateriaValorInstitucional::deleteMateriaValor($idMateria,$valor_id);
            if(!$dlt){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al desvincular valores institucionales.';
                error_log('no se pudo desvincular valores institucionales');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }
        }

        $dlt = Elemento::deleteElemento($idMateria);
        if(!$dlt){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al desvincular elementos de competencia.';
            error_log('no se pudo desvincular elementos de competencia');
            header("location:/tesis/plan/materia/$idPlan");
            exit();
        }

        $prerrequisitos = MateriaPrerrequisito::getMateriaPrerrequisitos($idMateria);

        foreach($prerrequisitos as $key => $value){
            $prerrequisito_id = intval($value['prerrequisito_id']);

            $dlt = MateriaPrerrequisito::deleteMateriaPrerrequisito($prerrequisito_id,$idMateria);

            if(!$dlt){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al desvincular prerrequisito.';
                error_log('no se pudo desvincular prerrequisito');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }

            $dlt = Prerrequisito::deletePrerrequisito($prerrequisito_id);
            if(!$dlt){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al eliminar prerrequisito.';
                error_log('no se pudo eliminar prerrequisito');
                header("location:/tesis/plan/materia/$idPlan");
                exit();
            }
        }

        $dlt = PlanEstudioMateria::deletePlanMateria($idPlan,$idMateria);

        if(!$dlt){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al desvincular materia.';
            error_log('no se pudo desvincular materia');
            header("location:/tesis/plan/materia/$idPlan");
            exit();
        }

        $dlt = Materia::deleteMateria($idMateria);

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Se eliminó la materia seleccionada';
        error_log('eliminación de materia');
        header("location:/tesis/plan/materia/$idPlan");

    }
}