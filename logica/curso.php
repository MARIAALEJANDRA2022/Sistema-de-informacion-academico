<?php
require "persistencia/cursoDAO.php";

class curso
{

    private $CodigoM;
    
    private $Grupo;
    
    private $ID_Docente;

    private $Nombre;

    private $Semestre_curso;
    
    private $Cupos_totales;

    private $Cantidad_estudiantes;

    private $Cupos_disponibles;

    private $conexion;

    private $cursoDAO;

    public function getCodigoM()
    {
        return $this->CodigoM;
    }
    
    public function getGrupo()
    {
        return $this->Grupo;
    }
    
    public function getID_Docente()
    {
        return $this->ID_Docente;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }
    
    public function getSemestre_curso(){
        return $this->Semestre_curso;
    }
    
    public function getCupos_totales()
    {
        return $this->Cupos_totales;
    }

    public function getCantidad_estudiantes()
    {
        return $this->Cantidad_estudiantes;
    }

    public function getCupos_disponibles()
    {
        return $this->Cupos_disponibles;
    }

    function curso($pCodigoM = "", $pGrupo = "", $pID_Docente = "", $pNombre = "", $pSemestre_curso="", $pCupos_totales = "", $pCantidad_estudiantes = "", $pCupos_disponibles = "")
    {
        $this->CodigoM = $pCodigoM;
        $this->Grupo = $pGrupo;
        $this->ID_Docente = $pID_Docente;
        $this->Nombre = $pNombre;
        $this->Semestre_curso = $pSemestre_curso;
        $this->Cupos_totales = $pCupos_totales;
        $this->Cantidad_estudiantes = $pCantidad_estudiantes;
        $this->Cupos_disponibles = $pCupos_disponibles;
        $this->conexion = new Conexion();
        $this->cursoDAO = new cursoDAO($pCodigoM, $pGrupo, $pID_Docente, $pNombre,  $pSemestre_curso, $pCupos_totales, $pCantidad_estudiantes, $pCupos_disponibles);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->ID_Docente = $resultado[0];
        $this->Nombre = $resultado[1];
        $this->Semestre_curso = $resultado[2];
        $this->Cupos_totales = $resultado[3];
        $this->Cantidad_estudiantes = $resultado[4];
        $this->Cupos_disponibles = $resultado[5];
    }
    
    function consultarExiste($id, $grupo){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->consultarExiste($id, $grupo));
        $this->conexion->cerrar();
        $codigos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($codigos, new curso($resultado[0], $resultado[1], "", "", "", "", "", ""));
        }
        return $codigos;
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->editar());
        $this->conexion->cerrar();
    }

    function codigo($nombre)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->codigo($nombre));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->CodigoM = $resultado[0];
    }
    
    function trabajos(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->trabajos());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->CodigoM = $resultado[0];
        $this->Grupo = $resultado[1];
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $i, $semestre_curso, $materia)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir, $i, $semestre_curso, $materia));
        $this->conexion->cerrar();
        $Materias = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Materias, new curso($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6], $resultado[7]));
        }
        return $Materias;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    

    function actualizar($estudiantes, $cupos, $codigo, $grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->actualizar($estudiantes, $cupos, $codigo, $grupo));
        $this->conexion->cerrar();
    }
    
    function actualizarIdDocente($docente, $codigo, $grupo){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cursoDAO->actualizarIdDocente($docente,$codigo, $grupo));
        $this->conexion->cerrar();
    }
}
?>