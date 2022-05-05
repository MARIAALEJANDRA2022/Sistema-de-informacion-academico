<?php
require "persistencia/TelefonoAlDAO.php";

class TelefonoAl
{

    private $Codigo_FK;

    private $Telefono;

    private $conexion;

    private $TelefonoAlDAO;

    public function getCodigo_FK()
    {
        return $this->Codigo_FK;
    }

    public function getTelefono()
    {
        return $this->Telefono;
    }

    function TelefonoAl($pCodigo_FK = "", $pTelefono = "")
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->Telefono = $pTelefono;
        $this->conexion = new Conexion();
        $this->TelefonoAlDAO = new TelefonoAlDAO($pCodigo_FK, $pTelefono);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoAlDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoAlDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Telefono = $resultado[0];
    }

    function mostrar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoAlDAO->mostrar());
        $this->conexion->cerrar();
        $telefonos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($telefonos, new TelefonoAl($resultado[0], $resultado[1]));
        }
        return $telefonos;
    }

    function editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutarM($this->TelefonoAlDAO->editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1));
        $this->conexion->cerrar();
    }
}
?>