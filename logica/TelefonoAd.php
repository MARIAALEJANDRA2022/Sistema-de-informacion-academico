<?php
require "persistencia/TelefonoAdDAO.php";

class TelefonoAd
{

    private $Codigo_FK;

    private $Telefono;

    private $conexion;

    private $TelefonoAdDAO;

    public function getCodigo_FK()
    {
        return $this->Codigo_FK;
    }

    public function getTelefono()
    {
        return $this->Telefono;
    }

    function TelefonoAd($pCodigo_FK = "", $pTelefono = "")
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->Telefono = $pTelefono;
        $this->conexion = new Conexion();
        $this->TelefonoAdDAO = new TelefonoAdDAO($pCodigo_FK, $pTelefono);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoAdDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoAdDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Telefono = $resultado[0];
    }

    function mostrar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoAdDAO->mostrar());
        $this->conexion->cerrar();
        $telefonos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($telefonos, new TelefonoAd($resultado[0], $resultado[1]));
        }
        return $telefonos;
    }

    function editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutarM($this->TelefonoAdDAO->editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1));
        $this->conexion->cerrar();
    }
}
?>