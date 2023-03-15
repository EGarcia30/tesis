<?php

namespace Penad\tesis\lib;

use PDO;
use PDOException;

class Database{
    private string $_host;
    private string $_db;
    private string $_user;
    private string $_password;
    private string $_charset;

    public function __construct(){
        $this->_host = $_ENV['HOST'];
        $this->_db = $_ENV['DB'];
        $this->_user = $_ENV['USER'];
        $this->_password = $_ENV['PASSSWORD'];
        $this->_charset = $_ENV['CHARSET'];
    }

    public function connect():PDO{
        try{
            $connection = "mysql:host=".$this->_host.";dbname=".$this->_db.";charset=".$this->_charset;
            $options = [
                PDO::ATTR_ERRMODE  === PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES === false,
            ];
            $pdo = new PDO(
                $connection,
                $this->_user,
                $this->_password,
                $options
            );

            return $pdo;
        }
        catch(PDOException $e){
            //throw exception
            throw $e;
        }
    }

}