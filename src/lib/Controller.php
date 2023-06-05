<?php

namespace Penad\Tesis\lib;

use Penad\Tesis\lib\View;

class Controller{

    private View $_view;

    public function __construct(){
        $this->_view = new View();
    }

    public function render(string $name, array $data = []){
        $this->_view->render($name,$data);
    }

    protected function get(string $param){
        if(!isset($_GET[$param])){
            return NULL;
        }
        return $_GET[$param];
    }

    protected function post(string $param){
        if(!isset($_POST[$param])){
            return NULL;
        }
        return $_POST[$param];
    }

    protected function files(string $param){
        if(!isset($_FILES[$param])){
            return NULL;
        }
        return $_FILES[$param];
    }
}