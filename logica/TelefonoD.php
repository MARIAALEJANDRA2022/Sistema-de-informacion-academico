<?php
require "persistencia/TelefonoDDAO.php";

class TelefonoD
{

    private $Codigo_FK;

    private $Telefono;

    private $conexion;

    private $TelefonoDDAO;

    public function getCodigo_FK()
    {
        return $this->Codigo_FK;
    }

    public function getTelefono()
    {
        return $this->Telefono;
    }

    function TelefonoD($pCodigo_FK = "", $pTelefono = "")
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->Telefono = $pTelefono;
        $this->conexion = new Conexion();
        $this->TelefonoDDAO = new TelefonoDDAO($pCodigo_FK, $pTelefono);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoDDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoDDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Telefono = $resultado[0];
    }

    function mostrar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->TelefonoDDAO->mostrar());
        $this->conexion->cerrar();
        $telefonos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($telefonos, new TelefonoD($resultado[0], $resultado[1]));
        }
        return $telefonos;
    }

    function editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutarM($this->TelefonoDDAO->editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1));
        $this->conexion->cerrar();
    }
}
?>