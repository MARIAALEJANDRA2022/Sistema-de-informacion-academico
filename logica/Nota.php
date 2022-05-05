<?php
require "persistencia/NotaDAO.php";

class Nota
{

    private $CodigoM_FK1;
    
    private $Grupo;

    private $ID_Trabajo;

    private $Trabajo;

    private $ID_Alumno;

    private $Nota;

    private $conexion;

    private $NotaDAO;

    public function getCodigoM_FK1()
    {
        return $this->CodigoM_FK1;
    }
    
    public function getGrupo()
    {
        return $this->Grupo;
    }

    public function getID_Trabajo()
    {
        return $this->ID_Trabajo;
    }
    
    public function getID_Alumno()
    {
        return $this->ID_Alumno;
    }

    public function getTrabajo()
    {
        return $this->Trabajo;
    }

    public function getNota()
    {
        return $this->Nota;
    }

    function Nota($pCodigoM_FK1 = "", $pGrupo = "", $pID_Trabajo = "", $pID_Alumno = "", $pTrabajo = "", $pNota = "")
    {
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->ID_Trabajo = $pID_Trabajo;
        $this->ID_Alumno = $pID_Alumno;
        $this->Trabajo = $pTrabajo;
        $this->Nota = $pNota;
        $this->conexion = new Conexion();
        $this->NotaDAO = new NotaDAO($pCodigoM_FK1, $pGrupo, $pID_Trabajo, $pID_Alumno, $pTrabajo, $pNota);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->crear());
        $this->conexion->cerrar();
    }
    
    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->ID_Alumno = $resultado[0];
        $this->Trabajo = $resultado[1];
        $this->Nota = $resultado[2];
    }

    function editar($nota)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->editar($nota));
        $this->conexion->cerrar();
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo));
        $this->conexion->cerrar();
        $Notas = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Notas, new Nota($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]));
        }
        return $Notas;
    }
    
    function consultarPorPaginaD($cantidad, $pagina, $orden, $dir, $codigo, $grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->consultarPorPaginaD($cantidad, $pagina, $orden, $dir, $codigo, $grupo));
        $this->conexion->cerrar();
        $Notas = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Notas, new Nota($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]));
        }
        return $Notas;
    }
    
    function consultarPorPaginaNF($cantidad, $pagina, $orden, $dir, $codigo, $grupo, $alumno)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->consultarPorPaginaNF($cantidad, $pagina, $orden, $dir, $codigo, $grupo, $alumno));
        $this->conexion->cerrar();
        $Notas = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Notas, new Nota($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]));
        }
        return $Notas;
    }

    function consultarTotalRegistros($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->consultarTotalRegistros($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function consultarTotalRegistrosD($codigo, $grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->consultarTotalRegistrosD($codigo, $grupo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function consultarTotalRegistrosNF($codigo, $grupo, $alumno)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->consultarTotalRegistrosD($codigo, $grupo, $alumno));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function promedio($codigo, $grupo, $alumno){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NotaDAO->promedio($codigo, $grupo, $alumno));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>