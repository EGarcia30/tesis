<?php

namespace Penad\Tesis\lib;

class View{

    public function __construct(){
        
    }

    public function render(string $name, array $data = []){
        $this->d = $data;
        require 'src/views/'. $name . '.php';
    }
}