<?php
require "persistencia/DocentealumnoDAO.php";

class Docentealumno
{

    private $Codigo_FKD;

    private $Codigo_FKA;

    private $conexion;

    private $DocentealumnoDAO;

    public function getCodigo_FKD()
    {
        return $this->Codigo_FKD;
    }

    public function getCodigo_FKA()
    {
        return $this->Codigo_FKA;
    }

    function Docentealumno($pCodigo_FKD = "", $pCodigo_FKA = "")
    {
        $this->Codigo_FKD = $pCodigo_FKD;
        $this->Codigo_FKA = $pCodigo_FKA;
        $this->conexion = new Conexion();
        $this->DocentealumnoDAO = new DocentealumnoDAO($pCodigo_FKD, $pCodigo_FKA);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->DocentealumnoDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->DocentealumnoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo_FKA = $resultado[0];
    }

    function consultar1($id)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->DocentealumnoDAO->consultar1($id));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo_FKD = $resultado[0];
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->DocentealumnoDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $Docentealumnos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Docentealumnos, new Docentealumno($resultado[0], $resultado[1]));
        }
        return $Docentealumnos;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->DocentealumnoDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>