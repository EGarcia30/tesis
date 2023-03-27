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

    public function getPlan(){

        $id = $this->post('id');
        $user = $_SESSION['user'];

        if(!is_null($id)){
            $studyPlan = StudyPlan::getPlan($id);

            if(!$studyPlan){
                header("location:/tesis/plan");
            }
            else{
                $data = [
                    'title' => 'Plan de Estudio',
                    'user' => $user,
                    'studyPlan' => $studyPlan
                ];
                $this->render('plan/search', $data);
            }
        }
        else{
            header("location:/tesis/plan");
        }
    }

    public function create(){
        $title = $this->post('titulo');
        $content = $this->post('contenido');

        if(!is_null($title) && !is_null($content)){
            
            $studyPlan = new StudyPlan($title, $content);
            $res = $studyPlan->createPlan();
            if($res){
                $_SESSION['color'] = 'success';
                $_SESSION['message'] = 'Datos ingresados con exito';
            }
            else{
                $_SESSION['color'] = 'warning';
                $_SESSION['message'] = 'Datos no ingresados en el proceso';
            }
            header('location:/tesis/create');
        }
        else{
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Datos no ingresados';
            header('location:/tesis/create');
        }
    }

    public function update(int $id){
        $title = $this->post('titulo');
        $content = $this->post('contenido');

        if(!is_null($id) &&
            !is_null($title) && 
            !is_null($content)){

            $studyPlan = new StudyPlan($title, $content);
            $studyPlan->setId($id);
            $res = $studyPlan->updatePlan();
            if($res){
                $_SESSION['color'] = 'success';
                $_SESSION['message'] = 'Se realizaron cambios con exito';
            }
            else{
                $_SESSION['color'] = 'warning';
                $_SESSION['message'] = 'No se realizaron cambios en el proceso';
            }
            header("location:/tesis/update/$id");
        }
        else{
            $_SESSION['color'] = 'danger';
            $_SESSION['message'] = 'Los datos vienen nulos';
            header("location:/tesis/update/$id");
        }
    }

    public function word(int $id){
        $req = StudyPlan::getPlan($id);
        require_once __DIR__ . '/../lib/word.php';
    }
}