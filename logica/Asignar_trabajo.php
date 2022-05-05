<?php
require "persistencia/Asignar_trabajoDAO.php";

class Asignar_trabajo
{

    private $CodigoM_FK1;
    
    private $Grupo;

    private $ID_Trabajo;

    private $Trabajo;

    private $Fecha_asignacion;

    private $Fecha_entrega;

    private $Descripcion;

    private $conexion;

    private $Asignar_trabajoDAO;

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

    public function getTrabajo()
    {
        return $this->Trabajo;
    }

    public function getFecha_asignacion()
    {
        return $this->Fecha_asignacion;
    }

    public function getFecha_entrega()
    {
        return $this->Fecha_entrega;
    }

    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    function Asignar_trabajo($pCodigoM_FK1 = "", $pGrupo = "", $pID_Trabajo = "", $pTrabajo = "", $pFecha_asignacion = "", $pFecha_entrega = "", $pDescripcion = "")
    {
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->ID_Trabajo = $pID_Trabajo;
        $this->Trabajo = $pTrabajo;
        $this->Fecha_asignacion = $pFecha_asignacion;
        $this->Fecha_entrega = $pFecha_entrega;
        $this->Descripcion = $pDescripcion;
        $this->conexion = new Conexion();
        $this->Asignar_trabajoDAO = new Asignar_trabajoDAO($pCodigoM_FK1, $pGrupo, $pID_Trabajo, $pTrabajo, $pFecha_asignacion, $pFecha_entrega, $pDescripcion);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->Asignar_trabajoDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->Asignar_trabajoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Trabajo = $resultado[0];
        $this->Fecha_asignacion = $resultado[1];
        $this->Fecha_entrega = $resultado[2];
        $this->Descripcion = $resultado[3];
    }

    function consultarAlumno($codigo, $grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->Asignar_trabajoDAO->consultarAlumno($codigo, $grupo));
        $this->conexion->cerrar();
        $Trabajos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Trabajos, new Asignar_trabajo($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6]));
        }
        return $Trabajos;
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->Asignar_trabajoDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $Trabajos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Trabajos, new Asignar_trabajo($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6]));
        }
        return $Trabajos;
    }
    
    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->Asignar_trabajoDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>