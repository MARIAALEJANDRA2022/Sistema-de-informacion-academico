<?php
require "persistencia/carrera_gradoDAO.php";

class carrera_grado
{

    private $Codigo;

    private $Nombre;

    private $conexion;

    private $carrera_gradoDAO;

    public function getCodigo()
    {
        return $this->Codigo;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    function carrera_grado($pCodigo = "", $pNombre = "")
    {
        $this->Codigo = $pCodigo;
        $this->Nombre = $pNombre;
        $this->conexion = new Conexion();
        $this->carrera_gradoDAO = new carrera_gradoDAO($pCodigo, $pNombre);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->carrera_gradoDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->carrera_gradoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Nombre = $resultado[0];
    }
    
    function buscar($Nombre){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->carrera_gradoDAO->buscar($Nombre));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo = $resultado[0];
    }
    
    function consultarTodos(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->carrera_gradoDAO->consultarTodos());
        $this->conexion->cerrar();
        $carrera_grados = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($carrera_grados, new carrera_grado("", $resultado[0]));
        }
        return $carrera_grados;
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->carrera_gradoDAO->editar());
        $this->conexion->cerrar();
    }
    
    function TotalRegistros(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->carrera_gradoDAO->TotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>