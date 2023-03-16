<?php

namespace Penad\Tesis\lib;

class Model{

    private Database $_db;
    // protected $conectar;

    public function __construct(){
        $this->_db = new Database();
    }

    public function query($query){
        return $this->_db->connect()->query($query);
    }

    public function prepare($query){
        return $this->_db->connect()->prepare($query);
    }

}