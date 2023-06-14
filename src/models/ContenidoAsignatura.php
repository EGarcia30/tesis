<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class ContenidoAsignatura extends Model{
    private int $_id;
    private string $_aprendizaje;
    private string $_competencia;
    private string $_descripcion_metodologia;
    private string $_descripcion_evaluacion;
    private int $_semana_inicio;
    private int $_semana_final;
    private int $_no_horas;
    private string $_actitudes;
    private int $_idMateria;

    public function __construct( array $data = [],$idMateria){
        parent::__construct();
        $this->_aprendizaje = $data[0];
        $this->_competencia = $data[1];
        $this->_descripcion_metodologia = $data[2];
        $this->_descripcion_evaluacion = $data[3];
        $this->_semana_inicio = $data[4];
        $this->_semana_final = $data[5];
        $this->_no_horas = $data[6];
        $this->_actitudes = $data[7];
        $this->_idMateria = intval($idMateria);
    }

    public static function getContenidoAsignaturas($id){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM contenido_asignatura WHERE materia_id={$id}";
            $query = $_db->connect()->query($sql);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }


    //CRUD
    //crear
    public function createContenidoAsignatura(){
        try{
            $sql = 'INSERT INTO contenido_asignatura(unidad_aprendizaje, competencia, descripcion_metodologia, descripcion_evaluacion,
            semana_inicio,semana_final, no_horas, actitudes, materia_id) VALUES(?,?,?,?,?,?,?,?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_aprendizaje, $this->_competencia, $this->_descripcion_metodologia, $this->_descripcion_evaluacion,
            $this->_semana_inicio, $this->_semana_final, $this->_no_horas, $this->_actitudes, $this->_idMateria];
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
            $sql = "SELECT LAST_INSERT_ID(contenido_id) as contenido_id from contenido_asignatura ORDER BY contenido_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteContenidoAsignatura($idContenido,$idMateria){
        try{
            $_db = new Database();
            $sql = "DELETE FROM contenido_asignatura WHERE contenido_id={$idContenido} AND materia_id={$idMateria}";
            $query = $_db->connect()->query($sql);
            $res = $query->execute();
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

    public function getAprendizaje(){
        return $this->_aprendizaje;
    }

    public function setAprendizaje(string $value){
        return $this->_aprendizaje = $value;
    }

    public function getCompetencia(){
        return $this->_competencia;
    }

    public function setCompetencia(string $value){
        return $this->_competencia = $value;
    }

    public function getDescripcionMetodologia(){
        return $this->_descripcion_metodologia;
    }

    public function setDescripcionMetodologia(string $value){
        return $this->_descripcion_metodologia = $value;
    }

    public function getDescripcionEvaluacion(){
        return $this->_descripcion_evaluacion;
    }

    public function setDescripcionEvaluacion(string $value){
        return $this->_descripcion_evaluacion = $value;
    }

    public function getSemanaInicio(){
        return $this->_semana_inicio;
    }

    public function setSemanaInicio(int $value){
        return $this->_semana_inicio = $value;
    }

    public function getSemanaFinal(){
        return $this->_semana_final;
    }

    public function setSemanaFinal(int $value){
        return $this->_semana_final = $value;
    }

    public function getNoHoras(){
        return $this->_no_horas;
    }

    public function setNoHoras(int $value){
        return $this->_no_horas = $value;
    }

    public function getActitudes(){
        return $this->_actitudes;
    }

    public function setActitudes(string $value){
        return $this->_actitudes = $value;
    }

    public function getIdMateria(){
        return $this->_idMateria;
    }

    public function setIdMateria(int $value){
        return $this->_idMateria = $value;
    }
}