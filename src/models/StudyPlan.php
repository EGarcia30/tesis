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
    private int $_status;

    public function __construct(int $idFac, string $nameFac, int $idCar, string $nameCar, string $modalityCar, int $status){
        parent::__construct();
        $this->_idFac = $idFac;
        $this->_nameFac = $nameFac;
        $this->_idCar  =$idCar;
        $this->_nameCar = $nameCar;
        $this->_modalityCar = $modalityCar;
        $this->_status = $status;
    }

    //obtener todos los planes con limite de 6 x pagina
    public static function getPlanAnterior($final){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM plan_estudio WHERE status=0 AND vigencia_final LIKE '%$final%'";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener todos los planes con limite de 6 x pagina
    public static function getPlans($start, $end){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM plan_estudio WHERE status=1 ORDER BY plan_estudio_id DESC LIMIT $start, $end";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener planes que cumplan con la variable $data
    public static function getSearchPlan($data,$start,$end){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT p.* 
            FROM plan_estudio p 
            WHERE p.status = 1 AND (p.plan_estudio_id=$int OR p.nombre_facultad LIKE '%$data%' OR p.nombre_carrera LIKE '%$data%' OR p.vigencia_inicio LIKE '%$data%' OR p.vigencia_final LIKE '%$data%') 
            LIMIT $start, $end ";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res; 
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener numero de filas de planes de estudio en general
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
            return false;
        }
    }

    //obtener planes que cumplan con la variable $data
    public static function rowSearchPlan($data){
        try{
            $_db = new Database();
            $int = intval($data);
            $sql = "SELECT p.* 
            FROM plan_estudio p 
            WHERE p.status = 1 AND (p.plan_estudio_id=$int OR p.nombre_facultad LIKE '%$data%' OR p.nombre_carrera LIKE '%$data%' OR p.vigencia_inicio LIKE '%$data%' OR p.vigencia_final LIKE '%$data%')";
            $query = $_db->connect()->prepare($sql);
            $query->execute();
            $res = $query->rowCount();
            if(!$res){
                return false;
                exit();
            }
            return $res; 
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener un plan en especifico
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
            $StudyPlan = new StudyPlan($res['facultad_id'], $res['nombre_facultad'], $res['carrera_id'], $res['nombre_carrera'], $res['modalidad_carrera'], $res['status']);
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
            error_log($e->getMessage());
            return false;
        }
    }

    //comprobar si nuestro plan existe ya en nuestro proyecto
    // public static function existsPlan($data = []){
    //     try{
    //         $_db = new Database();
    //         $sql = "SELECT COUNT(*) FROM datos WHERE documento_id=? or titulo=? or content=?";
    //         $query = $_db->connect()->query($sql);
    //         $query-execute($data);
    //         $res = $query->fetch(PDO::FETCH_ASSOC);
    //         return $res; 
    //     }
    //     catch(Exception $e){
    //         error_log($e->getMessage());
    //         return false;
    //     }
    // }

    //CRUD
    //crear plan de estudio
    public function createPlan(){
        try{
            $sql = "CALL createPlan(?,?,?,?,?,?,?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_idFac, $this->_nameFac, $this->_idCar, $this->_nameCar,
            $this->_modalityCar, $this->_idUser, $this->_user,$this->_status];
            $query->execute($data);
            $res = $this->getLastId();
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //obtener el id del ultimo plan creado
    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(plan_estudio_id) as id_plan from plan_estudio ORDER BY plan_estudio_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //guardar las unicas secciones dentro de la tabla plan de estudio que contiene el editor
    public static function savePlan(array $data){
        try{
            $_db = new Database();
            $sql = "CALL savePlanProgress(?,?,?,?,?,?)";
            $query = $_db->connect()->prepare($sql);
            $info = [$data['id'],$data['inicio'],$data['final'],$data['review'],$data['fundamento'],$data['user']];
            $res = $query->execute($info);
            return $res; 
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function guardarPortada(array $data){
        try{
            $_db = new Database();
            $sql = "update plan_estudio set vigencia_inicio=?, vigencia_final=?, fecha_presentacion=? where plan_estudio_id=?";
            $query = $_db->connect()->prepare($sql);
            $info = [$data['inicio'],$data['final'],$data['presentacion'],$data['id']];
            $res = $query->execute($info);
            return $res; 
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function guardarFundamentacion(array $data){
        try{
            $_db = new Database();
            $sql = "update plan_estudio set fundamentacion=? where plan_estudio_id=?";
            $query = $_db->connect()->prepare($sql);
            $info = [$data['fundamentacion'],$data['id']];
            $res = $query->execute($info);
            return $res; 
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //eliminar plan de estudio
    public static function deletePlan($id){
        try{
            $_db = new Database();
            $sql = "UPDATE plan_estudio SET status=? WHERE plan_estudio_id=?";
            $query = $_db->connect()->prepare($sql);
            $data = [0,$id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
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

    public function getStatus(){
        return $this->_status;
    }

    public function setStatus(string $value){
        return $this->_status = $value;
    }
}