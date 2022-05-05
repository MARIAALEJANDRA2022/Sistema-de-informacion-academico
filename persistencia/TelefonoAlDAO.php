<?php

class TelefonoAlDAO
{

    private $Codigo_FK;

    private $Telefono;
    
    function TelefonoAlDAO($pCodigo_FK, $pTelefono)
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->Telefono = $pTelefono;
    }

    function crear()
    {
        return "insert into telefonoal(codigo_fk, telefono)
                values ('" . $this->Codigo_FK . "','" . $this->Telefono . "')";
    }

    function consultar()
    {
        return "SELECT Telefono FROM telefonoal
                WHERE Codigo_FK = '" . $this->Codigo_FK . "'";
    }

    function mostrar()
    {
        return "SELECT Codigo_FK, Telefono FROM telefonoal where Codigo_FK = '" . $this->Codigo_FK . "'";
    }

    function editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1)
    {
        if ($telefonoguardado2 == $telefonoactual2 && $telefonoguardado1 != $telefonoactual1) {
            return "update telefonoal
                set Telefono = '" . $telefonoactual1 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado1 . "'";
        } elseif ($telefonoguardado2 != $telefonoactual2 && $telefonoguardado1 == $telefonoactual1) {
            return "update telefonoal
                set Telefono = '" . $telefonoactual2 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado2 . "'";
        } elseif ($telefonoguardado2 != $telefonoactual2 && $telefonoguardado1 != $telefonoactual1) {
            return "update telefonoal
                set Telefono = '" . $telefonoactual2 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado2 . "';
                update TelefonoAl set Telefono = '" . $telefonoactual1 . "' where Codigo_FK = '" . $this->Codigo_FK . "'
                and Telefono='" . $telefonoguardado1 . "'";
        } elseif ($telefonoguardado2 == $telefonoactual2 && $telefonoguardado1 == $telefonoactual1) {
            return "update telefonoal
                set Telefono = '" . $telefonoactual2 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado2 . "'
                and set Telefono = '" . $telefonoactual1 . "' where Codigo_FK = '" . $this->Codigo_FK . "'
                and Telefono='" . $telefonoguardado1 . "'";
        }
    }
}
?>