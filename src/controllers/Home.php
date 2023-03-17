<?php

namespace Penad\Tesis\controllers;

use Penad\Tesis\lib\Controller;
use Penad\Tesis\models\User;

class Home extends Controller{

    private User $_user;

    public function __construct(User $user){
        parent::__construct();
        $this->_user = $user;
    }

    public function index(){

        $data = [
            'title' => 'Home',
            'user' => $this->_user
        ];
        $this->render('home/index', $data);
    }
}