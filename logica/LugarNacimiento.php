<?php
require "persistencia/LugarNacimientoDAO.php";

class LugarNacimiento
{

    private $ID_LugarNacimiento;

    private $LugarNacimiento;

    private $conexion;

    private $LugarNacimientoDAO;

    public function getID_LugarNacimiento()
    {
        return $this->ID_LugarNacimiento;
    }

    public function getLugarNacimiento()
    {
        return $this->LugarNacimiento;
    }

    function LugarNacimiento($pID_LugarNacimiento = "", $pLugarNacimiento = "")
    {
        $this->ID_LugarNacimiento = $pID_LugarNacimiento;
        $this->LugarNacimiento = $pLugarNacimiento;
        $this->conexion = new Conexion();
        $this->LugarNacimientoDAO = new LugarNacimientoDAO($pID_LugarNacimiento, $pLugarNacimiento);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->LugarNacimientoDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->LugarNacimientoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->LugarNacimiento = $resultado[0];
    }

    function mostrar($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->LugarNacimientoDAO->mostrar($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $this->LugarNacimiento = $resultado[0];
    }

    function buscar($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->LugarNacimientoDAO->buscar($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $this->ID_LugarNacimiento = $resultado[0];
    }
    
    function consultarTodos()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->LugarNacimientoDAO->consultarTodos());
        $this->conexion->cerrar();
        $lugares = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($lugares, new LugarNacimiento("", $resultado[0]));
        }
        return $lugares;
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->LugarNacimientoDAO->editar());
        $this->conexion->cerrar();
    }
}
?>