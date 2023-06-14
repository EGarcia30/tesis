<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\CicloExtraordinarioModel;
use Penad\Tesis\models\PlanCicloExtraordinario;
use Penad\Tesis\models\Materia;
use Penad\Tesis\models\PrerrequisitoCiclo;


class CicloExtraordinario extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function saveCicloExtraordinario($id){
        $ciclo = $this->post('ciclo');
        $prerrequisito = $this->post('prerrequisito');

        if(empty($ciclo[0]) ||
            empty($ciclo[1]) ||
            empty($prerrequisito[0])){
            $_SESSION['color'] = 'warning';
            $_SESSION['message'] = 'Ingrese los datos requeridos.';
            error_log('No se pudo guardar en bd');
            header("location:/tesis/plan/materia/$id");
            exit();
        }

        $cicloBD = new CicloExtraordinarioModel($ciclo);
        $res = $cicloBD->createCicloExtraordinario();

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al guardar ciclo extraordinario.';
            error_log('No se pudo guardar ciclo en bd');
            header("location:/tesis/plan/materia/$id");
            exit();
        }

        $extra_id = intval($res['extra_id']);

        $planCicloBD = new PlanCicloExtraordinario($id,$extra_id);
        $res = $planCicloBD->createPlanCicloExtraordinario();

        if(!$res){
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'ERROR: al vincular ciclo extraordinario con el plan.';
            error_log('No se pudo vincular ciclo en plan');
            header("location:/tesis/plan/materia/$id");
            exit();
        }

        foreach($prerrequisito as $key => $value){

            if($value == 'br'){
                $materia_id = 10;
            }
            else{
                $materiaBD = Materia::getMateria($value);
                $materia_id = intval($materiaBD['materia_id']);
            }

            $prerrequisitoBD = new PrerrequisitoCiclo($materia_id,$extra_id);
            $res = $prerrequisitoBD->createPrerrequisitoCiclo();

            if(!$res){
                $_SESSION['color'] = 'danger';
                $_SESSION['message'] = 'ERROR: al vincular prerrequisito.';
                error_log('No se pudo vincular prerrequisito en bd');
                header("location:/tesis/plan/materia/$id");
                exit();
            }
        }

        $_SESSION['color'] = 'success';
        $_SESSION['message'] = 'Ciclo extraordinario guardado.';
        header("location:/tesis/plan/extraordinario/{$id}");
    }
}