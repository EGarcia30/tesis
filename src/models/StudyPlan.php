<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class StudyPlan extends Model{

    private int $_id;
    private int $_idFac;
    private string $_nameFac;
    private int $_idCar;
    private string $_nameCar;
    private string $_modalityCar;
    private string $_startValidity;
    private string $_endValidity;
    private string $_reviewDate;
    private string $_creation;
    private string $_fundamentacion;
    private int $_idUser;
    private string $_user;




    public function __construct(int $idFac, string $nameFac, int $idCar, string $nameCar, string $modalityCar){
        parent::__construct();
        $this->_idFac = $idFac;
        $this->_nameFac = $nameFac;
        $this->_idCar  =$idCar;
        $this->_nameCar = $nameCar;
        $this->_modalityCar = $modalityCar;
    }

    //Search

    public static function getPlans($start, $end){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM plan_estudio ORDER BY plan_estudio_id DESC LIMIT $start, $end";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function searchPlan($data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM datos WHERE documento_id=$int OR titulo LIKE '%".$data."%' OR contenido LIKE '%".$data."%'";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            if(!$res){
                return null;
                exit();
            }
            return $res; 
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function rowPlans(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM plan_estudio WHERE status=1";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $rows = $query->rowCount();       
            return $rows;            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return NULL;
        }
    }

    public static function getPlan(int $data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT * FROM plan_estudio WHERE plan_estudio_id=$int";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(!$res){
                return null;
                exit();
            }
            $StudyPlan = new StudyPlan($res['facultad_id'], $res['nombre_facultad'], $res['carrera_id'], $res['nombre_carrera'], $res['modalidad_carrera']);
            $StudyPlan->setId($res['plan_estudio_id']);
            $StudyPlan->setStartValidity($res['vigencia_inicio'] == null ? '' : $res['vigencia_inicio']);
            $StudyPlan->setEndValidity($res['vigencia_final'] == null ? '' : $res['vigencia_final']);
            $StudyPlan->setReviewDate($res['fecha_presentacion'] == null ? '' : $res['fecha_presentacion']);
            $StudyPlan->setFundamentacion($res['fundamentacion'] == null ? '' : $res['fundamentacion']);
            $StudyPlan->setIdUser($res['usuario_id']);
            $StudyPlan->setUser($res['creadoPor']);
            $StudyPlan->setCreation($res['fechaCreacion']);
            return $StudyPlan; 
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
            $sql = "CALL createPlan(?,?,?,?,?,?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_idFac, $this->_nameFac, $this->_idCar, $this->_nameCar,
            $this->_modalityCar, $this->_idUser, $this->_user];
            $query->execute($data);
            $res = $this->getLastId();
            return $res;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(plan_estudio_id) as id_plan from plan_estudio Where status=1 ORDER BY plan_estudio_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public static function savePlan(array $data){
        try{
            $_db = new Database();
            $sql = "CALL savePlanProgress(?,?,?,?,?,?)";
            $query = $_db->connect()->prepare($sql);
            $info = [$data['id'],$data['inicio'],$data['final'],$data['review'],$data['fundamento'],$data['user']];
            $res = $query->execute($info);
            error_log($res);
            return $res; 
        }
        catch(PDOException $e){
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
            return $res;
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

    public function getIdFac(){
        return $this->_idFac;
    }

    public function setIdFac(int $value){
        return $this->_idFac = $value;
    }

    public function getNameFac(){
        return $this->_nameFac;
    }

    public function setNameFac(string $value){
        return $this->_nameFac = $value;
    }

    public function getIdCar(){
        return $this->_idCar;
    }

    public function setIdCar(int $value){
        return $this->_idCar = $value;
    }

    public function getNameCar(){
        return $this->_nameCar;
    }

    public function setNameCar(string $value){
        return $this->_nameCar = $value;
    }

    public function getModalityCar(){
        return $this->_modalityCar;
    }

    public function setModalityCar(string $value){
        return $this->_modalityCar = $value;
    }

    public function getStartValidity(){
        return $this->_startValidity;
    }

    public function setStartValidity(string $value){
        return $this->_startValidity = $value;
    }

    public function getEndValidity(){
        return $this->_endValidity;
    }

    public function setEndValidity(string $value){
        return $this->_endValidity = $value;
    }

    public function getReviewDate(){
        return $this->_reviewDate;
    }

    public function setReviewDate(string $value){
        return $this->_reviewDate = $value;
    }

    public function getCreation(){
        return $this->_creation;
    }

    public function setCreation(string $value){
        return $this->_creation = $value;
    }

    public function getFundamentacion(){
        return $this->_fundamentacion;
    }

    public function setFundamentacion(string $value){
        return $this->_fundamentacion = $value;
    }

    public function getIdUser(){
        return $this->_idUser;
    }

    public function setIdUser(int $value){
        return $this->_idUser = $value;
    }

    public function getUser(){
        return $this->_ser;
    }

    public function setUser(string $value){
        return $this->_user = $value;
    }
}