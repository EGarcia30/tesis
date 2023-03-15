<?php

namespace Penad\tesis\lib;

class Model{

    private Database $_db;

    public function __construct(){
        $this->_db = new Database();
    }

    public function query($query){
        return $this->db->connect()->query($query);
    }

    public function prepare($query){
        return $this->db->connect()->prepare($query);
    }

}