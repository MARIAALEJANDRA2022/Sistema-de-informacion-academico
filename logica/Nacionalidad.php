<?php
require "persistencia/NacionalidadDAO.php";

class Nacionalidad
{

    private $ID_Nacionalidad;

    private $Nacionalidad;

    private $conexion;

    private $NacionalidadDAO;

    public function getID_Nacionalidad()
    {
        return $this->ID_Nacionalidad;
    }

    public function getNacionalidad()
    {
        return $this->Nacionalidad;
    }

    function Nacionalidad($pID_Nacionalidad = "", $pNacionalidad = "")
    {
        $this->ID_Nacionalidad = $pID_Nacionalidad;
        $this->Nacionalidad = $pNacionalidad;
        $this->conexion = new Conexion();
        $this->NacionalidadDAO = new NacionalidadDAO($pID_Nacionalidad, $pNacionalidad);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NacionalidadDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NacionalidadDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Nacionalidad = $resultado[0];
    }

    function mostrar($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NacionalidadDAO->mostrar($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $this->Nacionalidad = $resultado[0];
    }

    function buscar($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NacionalidadDAO->buscar($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $this->ID_Nacionalidad = $resultado[0];
    }
    
    function consultarTodos()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NacionalidadDAO->consultarTodos());
        $this->conexion->cerrar();
        $lugares = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($lugares, new Nacionalidad("", $resultado[0]));
        }
        return $lugares;
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->NacionalidadDAO->editar());
        $this->conexion->cerrar();
    }
}
?>