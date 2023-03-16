<?php

namespace Penad\Tesis\lib;

class View{

    public function render(string $name, array $data = []){
        $this->d = $data;
        require_once 'src/views/'. $name . '.php';
    }
}