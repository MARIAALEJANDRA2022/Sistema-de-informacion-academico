<?php
require "persistencia/AdministradorDAO.php";

class Administrador
{

    private $Codigo;

    private $Nombre;

    private $CorreoP;

    private $CorreoI;

    private $Contrasena;

    private $Numero_ID;

    private $Fecha_ID;

    private $TipoSangre;

    private $RH;

    private $Direccion;

    private $FechaNacimiento;

    private $ID_Nacionalidad;

    private $ID_LugarNacimiento;

    private $ID_MunicipioResidencia;

    private $conexion;

    private $AdministradorDAO;

    public function getCodigo()
    {
        return $this->Codigo;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getCorreoP()
    {
        return $this->CorreoP;
    }

    public function getCorreoI()
    {
        return $this->CorreoI;
    }

    public function getContrasena()
    {
        return $this->Contrasena;
    }

    public function getNumero_ID()
    {
        return $this->Numero_ID;
    }

    public function getFecha_ID()
    {
        return $this->Fecha_ID;
    }

    public function getTipoSangre()
    {
        return $this->TipoSangre;
    }

    public function getRH()
    {
        return $this->RH;
    }

    public function getDireccion()
    {
        return $this->Direccion;
    }

    public function getFechaNacimiento()
    {
        return $this->FechaNacimiento;
    }

    public function getID_Nacionalidad()
    {
        return $this->ID_Nacionalidad;
    }

    public function getID_LugarNacimiento()
    {
        return $this->ID_LugarNacimiento;
    }

    public function getID_MunicipioResidencia()
    {
        return $this->ID_MunicipioResidencia;
    }

    function Administrador($pCodigo = "", $pNombre = "", $pCorreoP = "", $pCorreoI = "", $pContrasena = "", $pNumero_ID = "", $pFecha_ID = "", $pTipoSangre = "", $pRH = "", $pDireccion = "", $pFechaNacimiento = "", $pID_Nacionalidad = "", $pID_LugarNacimiento = "", $pID_MunicipioResidencia = "")
    {
        $this->Codigo = $pCodigo;
        $this->Nombre = $pNombre;
        $this->CorreoP = $pCorreoP;
        $this->CorreoI = $pCorreoI;
        $this->Contrasena = $pContrasena;
        $this->Numero_ID = $pNumero_ID;
        $this->Fecha_ID = $pFecha_ID;
        $this->TipoSangre = $pTipoSangre;
        $this->RH = $pRH;
        $this->Direccion = $pDireccion;
        $this->FechaNacimiento = $pFechaNacimiento;
        $this->ID_Nacionalidad = $pID_Nacionalidad;
        $this->ID_LugarNacimiento = $pID_LugarNacimiento;
        $this->ID_MunicipioResidencia = $pID_MunicipioResidencia;
        $this->conexion = new Conexion();
        $this->AdministradorDAO = new AdministradorDAO($pCodigo, $pNombre, $pCorreoP, $pCorreoI, $pContrasena, $pNumero_ID, $pFecha_ID, $pTipoSangre, $pRH, $pDireccion, $pFechaNacimiento, $pID_Nacionalidad, $pID_LugarNacimiento, $pID_MunicipioResidencia);
    }

    function autenticar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AdministradorDAO->autenticar());
        $this->conexion->cerrar();
        if ($this->conexion->numFilas() == 1) {
            $this->Codigo = $this->conexion->extraer()[0];
            return true;
        } else {
            return false;
        }
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AdministradorDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Nombre = $resultado[0];
        $this->CorreoP = $resultado[1];
        $this->CorreoI = $resultado[2];
        $this->Contrasena = $resultado[3];
        $this->Numero_ID = $resultado[4];
        $this->Fecha_ID = $resultado[5];
        $this->TipoSangre = $resultado[6];
        $this->RH = $resultado[7];
        $this->Direccion = $resultado[8];
        $this->FechaNacimiento = $resultado[9];
        $this->ID_Nacionalidad = $resultado[10];
        $this->ID_LugarNacimiento = $resultado[11];
        $this->ID_MunicipioResidencia = $resultado[12];
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AdministradorDAO->editar());
        $this->conexion->cerrar();
    }
}
?>