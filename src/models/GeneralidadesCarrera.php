<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class GeneralidadesCarrera extends Model{

    private int $_id;
    private string $_requisito;
    private int $_duration_years;
    private int $_duration_ciclos;
    private int $_num_Asignatura;
    private int $_num_Unidades_Valorativas;
    private string $_sede;
    private string $_responsible;
    private int $_anio_inicio;

    public function __construct(array $data = []){
        parent::__construct();
        $this->_requisito = $data[0];
        $this->_duration_years = intval($data[1]);
        $this->_duration_ciclos = intval($data[2]);
        $this->_num_Asignatura = intval($data[3]);
        $this->_num_Unidades_Valorativas = intval($data[4]);
        $this->_sede = $data[5];
        $this->_responsible = $data[6];
        $this->_anio_inicio = intval($data[7]);
    }

    public static function getGeneralidades(){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM generalidades_carrera ORDER BY generalidades_id DESC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getGeneralidad($id){
        try{
            $idGen = intval($id);
            $_db = new Database();
            $sql = "SELECT gc.generalidades_id as Id, gc.requisito_ingreso as ingreso,
            gc.duracion_anios as anios, gc.duracion_ciclos as ciclos,
            gc.numero_asignaturas as asignaturas, gc.numero_unidades_valorativas as valorativas,
            gc.sede as sede, gc.unidad_responsable as responsable, gc.anio_inicio as inicio FROM generalidades_carrera gc WHERE gc.generalidades_id=$idGen ORDER BY generalidades_id DESC";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchall(PDO::FETCH_ASSOC);
            if(!$res){
                return false;
                exit();
            }
            $data =[$res[0]['ingreso'] == null ? '': $res[0]['ingreso'],
            $res[0]['anios']== null ? 0 : $res[0]['anios'],
            $res[0]['ciclos']== null ? 0 :$res[0]['ciclos'],
            $res[0]['asignaturas']== null ? 0 :$res[0]['asignaturas'],
            $res[0]['valorativas']== null ? 0 :$res[0]['valorativas'],
            $res[0]['sede']== null ? '' :$res[0]['sede'],
            $res[0]['responsable']== null ? '' :$res[0]['responsable'],
            $res[0]['inicio']== null ? 0 :$res[0]['inicio']];
            $Generalidad = new GeneralidadesCarrera($data);
            $Generalidad->setId($res[0]['Id'] == null ? 0 : $res[0]['Id']);
            return $Generalidad;
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }


    //CRUD
    //crear
    public function createGeneralidad(){
        try{        
            $sql = "INSERT INTO generalidades_carrera(requisito_ingreso,duracion_anios, duracion_ciclos,numero_asignaturas, 
            numero_unidades_valorativas, sede, unidad_responsable, anio_inicio)
            VALUES(?,?,?,?,?,?,?,?)";
            $query = $this->prepare($sql);
            $data = [$this->_requisito,$this->_duration_years,$this->_duration_ciclos,
            $this->_num_Asignatura,$this->_num_Unidades_Valorativas,$this->_sede,$this->_responsible,$this->_anio_inicio];
            $query->execute($data);
            $res = $this->getLastId();
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getLastId(){
        try{
            $sql = "SELECT LAST_INSERT_ID(generalidades_id) as id_generalidades from generalidades_carrera ORDER BY generalidades_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //actualizar
    public function updateGeneralidad(){
        try{        
            $sql = "UPDATE generalidades_carrera
            SET requisito_ingreso=?,duracion_anios=?, 
            duracion_ciclos=?,numero_asignaturas=?, 
            numero_unidades_valorativas=?, sede=?, 
            unidad_responsable=?, anio_inicio=?
            WHERE generalidades_id=?";
            $query = $this->prepare($sql);
            $data = [$this->_requisito,$this->_duration_years,$this->_duration_ciclos,
            $this->_num_Asignatura,$this->_num_Unidades_Valorativas,$this->_sede,$this->_responsible,$this->_anio_inicio,$this->_id];
            $res = $query->execute($data);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function getId(){
        return $this->_id;
    }

    public function setId(int $value){
        return $this->_id = $value;
    }

    public function getRequisito(){
        return $this->_requisito;
    }

    public function setRequisito(string $value){
        return $this->_requisito = $value;
    }

    public function getYears(){
        return $this->_duration_years;
    }

    public function setYears(int $value){
        return $this->_duration_years = $value;
    }

    public function getCiclos(){
        return $this->_duration_ciclos;
    }

    public function setCiclos(int $value){
        return $this->_duration_ciclos = $value;
    }

    public function getAsignatura(){
        return $this->_num_Asignatura;
    }

    public function setAsignatura(int $value){
        return $this->_num_Asignatura = $value;
    }

    public function getValorativas(){
        return $this->_num_Unidades_Valorativas;
    }

    public function setValorativas(int $value){
        return $this->_num_Unidades_Valorativas = $value;
    }

    public function getSede(){
        return $this->_sede;
    }

    public function setSede(string $value){
        return $this->_sede = $value;
    }

    public function getResponsible(){
        return $this->_responsible;
    }

    public function setResponsible(string $value){
        return $this->_responsible = $value;
    }

    public function getInicio(){
        return $this->_anio_inicio;
    }

    public function setInicio(int $value){
        return $this->_anio_inicio = $value;
    }
}