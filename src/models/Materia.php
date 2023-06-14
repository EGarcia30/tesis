<?php

Namespace Penad\Tesis\models;

use Penad\Tesis\lib\Model;
use Penad\Tesis\lib\Database;
use PDO;
use PDOException;

class Materia extends Model{
    private int $_id;
    private int $_ciclo;
    private string $_name;
    private int $_no_orden;
    private string $_codigo;
    private string $_formacion;
    private int $_horas;
    private int $_teorica_presencial;
    private int $_teorica_Nopresencial;
    private int $_practica_presencial;
    private int $_practica_Nopresencial;
    private int $_unidad_valorativa;
    private int $_ciclo_semanas;
    private int $_duracion_clase;
    private string $_modalidad;
    private string $_descripcion;
    private string $_funcion_clave;
    private string $_unidad_competencia;
    private string $_estrategia;

    public function __construct( array $data = []){
        parent::__construct();
        $this->_ciclo = intval($data[0]);
        $this->_name = strval($data[1]);
        $this->_no_orden = intval($data[2]);
        $this->_codigo = strval($data[3]);
        $this->_formacion = strval($data[4]);
        $this->_horas = intval($data[5]);
        if($data[7] !== "presencial"){
            $this->_teorica_presencial = 0;
            $this->_teorica_Nopresencial = intval($data[6]);
        }
        else{
            $this->_teorica_presencial = intval($data[6]);
            $this->_teorica_Nopresencial = 0;
        }
        if($data[9] !== "presencial"){
            $this->_practica_presencial = 0;
            $this->_practica_Nopresencial = intval($data[8]);
        }
        else{
            $this->_practica_presencial = intval($data[8]);
            $this->_practica_Nopresencial = 0;
        }
        $this->_unidad_valorativa = intval($data[10]);
        $this->_ciclo_semanas = intval($data[11]);
        $this->_duracion_clase = intval($data[12]);
        $this->_modalidad = strval($data[13]);
        $this->_descripcion = strval($data[14]);
        $this->_funcion_clave = strval($data[15]);
        $this->_unidad_competencia = strval($data[16]);
        $this->_estrategia = strval($data[17]);
    }

    public static function getMateria($id){
        try{
            $_db = new Database();
            $sql = "SELECT * FROM materia WHERE materia_id={$id}";
            $query = $_db->connect()->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    //CRUD
    //crear
    public function createMateria(){
        try{
            $sql = 'INSERT INTO materia(ciclo, nombre_asignatura, no_orden, codigo, horas_ciclo,
            horas_teoricas_presencial, horas_teoricas_nopresencial, horas_practicas_presencial, horas_practicas_nopresencial, 
            unidades_valorativas, ciclo_semanas, duracion_clase, descripcion, funcion_clave, unidad_competencia, estrategia,
            area_formacion, modalidad) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $query = $this->prepare($sql);
            $data = [$this->_ciclo, $this->_name, $this->_no_orden, $this->_codigo, $this->_horas,
            $this->_teorica_presencial,$this->_teorica_Nopresencial,$this->_practica_presencial,$this->_practica_Nopresencial,
            $this->_unidad_valorativa,$this->_ciclo_semanas,$this->_duracion_clase,$this->_descripcion,$this->_funcion_clave,$this->_unidad_competencia,$this->_estrategia, $this->_formacion,$this->_modalidad];
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
            $sql = "SELECT LAST_INSERT_ID(materia_id) as materia_id from materia ORDER BY materia_id DESC";
            $query = $this->query($sql);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteMateria($id){
        try{
            $_db = new Database();
            $sql = "DELETE FROM materia WHERE materia_id={$id}";
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

    public function getCiclo(){
        return $this->_ciclo;
    }

    public function setCiclo(int $value){
        return $this->_ciclo = $value;
    }

    public function getName(){
        return $this->_name;
    }

    public function setName(string $value){
        return $this->_name = $value;
    }

    public function getOrden(){
        return $this->_no_orden;
    }

    public function setOrden(int $value){
        return $this->_no_orden = $value;
    }

    public function getCodigo(){
        return $this->_codigo;
    }

    public function setCodigo(string $value){
        return $this->_codigo = $value;
    }

    public function getFormacion(){
        return $this->_formacion;
    }

    public function setFormacion(string $value){
        return $this->_formacion = $value;
    }

    public function getHoras(){
        return $this->_horas;
    }

    public function setHoras(int $value){
        return $this->_horas = $value;
    }

    public function getTeoricaPresencial(){
        return $this->_teorica_presencial;
    }

    public function setTeoricaPresencial(int $value){
        return $this->_teorica_presencial = $value;
    }

    public function getTeoricaNopresencial(){
        return $this->_teorica_Nopresencial;
    }

    public function setTeoricaNopresencial(int $value){
        return $this->_teorica_Nopresencial = $value;
    }

    public function getPracticaPresencial(){
        return $this->_practica_presencial;
    }

    public function setPracticaPresencial(int $value){
        return $this->_practica_presencial = $value;
    }

    public function getPracticaNopresencial(){
        return $this->_practica_Nopresencial;
    }

    public function setPracticaNopresencial(int $value){
        return $this->_practica_Nopresencial = $value;
    }

    public function getValorativa(){
        return $this->_unidad_valorativa;
    }

    public function setValorativa(int $value){
        return $this->_unidad_valorativa = $value;
    }

    public function getCicloSemanas(){
        return $this->_ciclo_semanas;
    }

    public function setCicloSemanas(int $value){
        return $this->_ciclo_semanas = $value;
    }

    public function getDuracionClase(){
        return $this->_duracion_clase;
    }

    public function setDuracionClase(int $value){
        return $this->_duracion_clase = $value;
    }

    public function getModalidad(){
        return $this->_modalidad;
    }

    public function setModalidad(string $value){
        return $this->_modalidad = $value;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function setDescripcion(string $value){
        return $this->_descripcion = $value;
    }

    public function getFuncionClave(){
        return $this->_funcion_clave;
    }

    public function setFuncionClave(string $value){
        return $this->_funcion_clave = $value;
    }

    public function getUnidadCompetencia(){
        return $this->_unidad_competencia;
    }

    public function setUnidadCompetencia(string $value){
        return $this->_unidad_competencia = $value;
    }

    public function getEstrategia(){
        return $this->_estrategia;
    }

    public function setEstrategia(string $value){
        return $this->_estrategia = $value;
    }
}