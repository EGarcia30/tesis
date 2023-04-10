<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\FacultadModel;

class FacultadController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function getAllFacultad($page){
        $user = $_SESSION['user'];
        $totalItems = FacultadModel::rowFacultad();
        $itemShow = 6;
        $start =  ($page - 1)* $itemShow;
        $facultades = FacultadModel::getAllFacultad($start,$itemShow);
        $data = [
            'title' => 'Facultades',
            'user' => $user,
            'facultades' => $facultades,
            'rows' => $totalItems,
            'itemShow' => $itemShow
        ];

        $this->render('facultad/index', $data);
    }

}