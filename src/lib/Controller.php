<?php

namespace Penad\tesis\lib;

use Penad\tesis\lib\View;

class Controller{

    private View $_view;

    public function __construct(){
        $this->_view = new View();
    }

    public function render(string $name, array $data = []){
        $this->_view->render($name,$data);
    }

    public function get(string $params){
        if(!isset($_GET[$param])){
            return NULL;
        }
        return $_GET[$param];
    }

    public function post(string $params){
        if(!isset($_POST[$param])){
            return NULL;
        }
        return $_POST[$param];
    }
}