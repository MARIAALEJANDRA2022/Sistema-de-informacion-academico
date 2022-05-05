<?php
require "persistencia/MateriaDAO.php";

class Materia
{

    private $CodigoM;
    
    private $Nombre;

    private $Semestre_curso;
    
    private $Clasificacion;

    private $conexion;

    private $MateriaDAO;

    public function getCodigoM()
    {
        return $this->CodigoM;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }
    
    public function getSemestre_curso(){
        return $this->Semestre_curso;
    }

    public function getClasificacion()
    {
        return $this->Clasificacion;
    }

    function Materia($pCodigoM = "", $pNombre = "", $pSemestre_curso="", $pClasificacion = "")
    {
        $this->CodigoM = $pCodigoM;
        $this->Nombre = $pNombre;
        $this->Semestre_curso = $pSemestre_curso;
        $this->Clasificacion = $pClasificacion;
        $this->conexion = new Conexion();
        $this->MateriaDAO = new MateriaDAO($pCodigoM, $pNombre, $pSemestre_curso, $pClasificacion);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MateriaDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MateriaDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Nombre = $resultado[0];
        $this->Semestre_curso = $resultado[1];
        $this->Clasificacion = $resultado[2];
    }
    
    function consultarExiste($id){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MateriaDAO->consultarExiste($id));
        $this->conexion->cerrar();
        if ($this->conexion->numFilas() == 1) {
            $this->CodigoM = $this->conexion->extraer()[0];
            return true;
        } else {
            return false;
        }
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MateriaDAO->editar());
        $this->conexion->cerrar();
    }

    function codigo($nombre)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MateriaDAO->codigo($nombre));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->CodigoM = $resultado[0];
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $i, $semestre_curso)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MateriaDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir, $i, $semestre_curso));
        $this->conexion->cerrar();
        $Materias = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Materias, new Materia($resultado[0], $resultado[1], $resultado[2], $resultado[3]));
        }
        return $Materias;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MateriaDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>