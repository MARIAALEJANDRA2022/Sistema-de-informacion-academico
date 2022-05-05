<?php
require "persistencia/TrabajoDAO.php";

class Trabajo
{

    private $CodigoM_FK1;
    
    private $Grupo;

    private $ID_Trabajo;

    private $ID_Alumno;

    private $Trabajo;

    private $Estado;

    private $Fecha_entrega;

    private $Nota;

    private $Observacion;

    private $conexion;

    private $TrabajoDAO;

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

    public function getEstado()
    {
        return $this->Estado;
    }

    public function getFecha_entrega()
    {
        return $this->Fecha_entrega;
    }

    public function getNota()
    {
        return $this->Nota;
    }

    public function getObservacion()
    {
        return $this->Observacion;
    }

    function Trabajo($pCodigoM_FK1 = "", $pGrupo = "", $pID_Trabajo = "", $pID_Alumno = "", $pTrabajo = "", $pEstado = "", $pFecha_entrega = "", $pNota = "", $pObservacion = "")
    {
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->ID_Trabajo = $pID_Trabajo;
        $this->ID_Alumno = $pID_Alumno;
        $this->Trabajo = $pTrabajo;
        $this->Estado = $pEstado;
        $this->Fecha_entrega = $pFecha_entrega;
        $this->Nota = $pNota;
        $this->Observacion = $pObservacion;
        $this->conexion = new Conexion();
        $this->TrabajoDAO = new TrabajoDAO($pCodigoM_FK1, $pGrupo, $pID_Trabajo, $pID_Alumno, $pTrabajo, $pEstado, $pFecha_entrega, $pNota, $pObservacion);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Trabajo = $resultado[0];
        $this->Estado = $resultado[1];
        $this->Fecha_entrega = $resultado[2];
        $this->Nota = $resultado[3];
        $this->Observacion = $resultado[4];
    }

    function editar($nota, $obs, $estado)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->editar($nota, $obs, $estado));
        $this->conexion->cerrar();
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $Trabajos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Trabajos, new Trabajo($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6], $resultado[7], $resultado[8]));
        }
        return $Trabajos;
    }

    function consultarTrabajos($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->consultarTrabajos($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $Trabajos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Trabajos, new Trabajo($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6], $resultado[7], $resultado[8]));
        }
        return $Trabajos;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }

    function eliminar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->eliminar());
        $this->conexion->cerrar();
    }  
    
    function actualizarNota($nota)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TrabajoDAO->actualizarNota($nota));
        $this->conexion->cerrar();
    }
    
    
}
?>