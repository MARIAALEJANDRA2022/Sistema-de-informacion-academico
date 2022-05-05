<?php

class AdministradorDAO
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

    function AdministradorDAO($pCodigo, $pNombre, $pCorreoP, $pCorreoI, $pContrasena, $pNumero_ID, $pFecha_ID, $pTipoSangre, $pRH, $pDireccion, $pFechaNacimiento, $pID_Nacionalidad, $pID_LugarNacimiento, $pID_MunicipioResidencia)
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
    }

    function autenticar()
    {
        return "select Codigo 
                from administrador 
                where CorreoI = '" . $this->CorreoI . "' and Contrasena = md5('" . $this->Contrasena . "')";
    }

    function consultar()
    {
        return "select Nombre, CorreoP, CorreoI, Contrasena, Numero_ID, Fecha_ID, 
                TipoSangre, RH, Direccion, FechaNacimiento, ID_Nacionalidad, ID_LugarNacimiento, 
                ID_MunicipioResidencia
                from administrador
                where Codigo = '" . $this->Codigo . "'";
    }

    function editar()
    {
        return "update administrador
                set Nombre = '" . $this->Nombre . "', CorreoP = '" . $this->CorreoP . "', 
                CorreoI = '" . $this->CorreoI . "',
                Contrasena = '" . $this->Contrasena . "', Numero_ID = '" . $this->Numero_ID . "', 
                Fecha_ID = '" . $this->Fecha_ID . "', TipoSangre = '" . $this->TipoSangre . "', 
                RH = '" . $this->RH . "', Direccion = '" . $this->Direccion . "', 
                FechaNacimiento = '" . $this->FechaNacimiento . "', ID_Nacionalidad = '" . $this->ID_Nacionalidad . "', 
                ID_LugarNacimiento = '" . $this->ID_LugarNacimiento . "', ID_MunicipioResidencia = '" . $this->ID_MunicipioResidencia . "'
                where Codigo = '" . $this->Codigo . "'";
    }
}
?>