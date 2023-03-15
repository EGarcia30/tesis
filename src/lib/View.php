<?php

namespace Penad\tesis\lib;

class View{

    function render(string $name, array $data = []){
        $this->d = $data;
        require_once 'src/views/'. $name . '.php';
    }
}