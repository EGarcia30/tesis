<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class StudyPlan extends Model{

    private int $_id;
    private string $_title;
    private string $_content;

    public function __construct(string $title, string $content){
        parent::__construct();
        $this->_title = $title;
        $this->_content = $content;
    }

    //Search

    public static function getPlans(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM datos ORDER BY documento_id DESC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function getPlan(int $data){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM datos WHERE documento_id=$data";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(!$res){
                return null;
            }else
            {
                $StudyPlan = new StudyPlan($res['titulo'], $res['contenido']);
                $StudyPlan->setId($res['documento_id']);
                return $StudyPlan; 
            }
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function existsPlan($data = []){
        try{
            $_db = new Database();
            $sql = "SELECT COUNT(*) FROM datos WHERE documento_id=? or titulo=? or content=?";
            $query = $_db->connect()->query($sql);
            $query-execute($data);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res; 
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    //CRUD
    public function createPlan(){
        try{
            $sql = "INSERT INTO datos(titulo, contenido) VALUES(?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_title, $this->_content];
            $res = $query->execute($data);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function updatePlan(){
        try{
            $sql = "UPDATE datos SET titulo=?, contenido=? WHERE documento_id=?";
            $query = $this->prepare($sql);
            $data = [$this->_title, $this->_content,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function deletePlan(){
        try{
            $sql = "DELETE FROM datos WHERE documento_id=?";
            $query = $this->prepare($sql);
            $data = [$this->_id];
            $res = $query->execute($data);
            var_dump($res->rowCount());
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    //Objeto
    public function getId(){
        return $this->_id;
    }

    public function setId(int $value){
        return $this->_id = $value;
    }

    public function getTitle(){
        return $this->_title;
    }

    public function setTitle(string $value){
        return $this->_title = $value;
    }

    public function getContent(){
        return $this->_content;
    }

    public function setContent(string $value){
        return $this->_content = $value;
    }
}