<?php
require "persistencia/MunicipioResidenciaDAO.php";

class MunicipioResidencia
{

    private $ID_MunicipioResidencia;

    private $MunicipioResidencia;

    private $conexion;

    private $MunicipioResidenciaDAO;

    public function getID_MunicipioResidencia()
    {
        return $this->ID_MunicipioResidencia;
    }

    public function getMunicipioResidencia()
    {
        return $this->MunicipioResidencia;
    }

    function MunicipioResidencia($pID_MunicipioResidencia = "", $pMunicipioResidencia = "")
    {
        $this->ID_MunicipioResidencia = $pID_MunicipioResidencia;
        $this->MunicipioResidencia = $pMunicipioResidencia;
        $this->conexion = new Conexion();
        $this->MunicipioResidenciaDAO = new MunicipioResidenciaDAO($pID_MunicipioResidencia, $pMunicipioResidencia);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MunicipioResidenciaDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MunicipioResidenciaDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->MunicipioResidencia = $resultado[0];
    }

    function mostrar($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MunicipioResidenciaDAO->mostrar($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $this->MunicipioResidencia = $resultado[0];
    }

    function buscar($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MunicipioResidenciaDAO->buscar($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $this->ID_MunicipioResidencia = $resultado[0];
    }
    
    function consultarTodos()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MunicipioResidenciaDAO->consultarTodos());
        $this->conexion->cerrar();
        $lugares = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($lugares, new MunicipioResidencia("", $resultado[0]));
        }
        return $lugares;
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->MunicipioResidenciaDAO->editar());
        $this->conexion->cerrar();
    }
}
?>