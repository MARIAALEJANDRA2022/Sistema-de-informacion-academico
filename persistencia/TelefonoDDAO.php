<?php

class TelefonoDDAO
{

    private $Codigo_FK;

    private $Telefono;

    function TelefonoDDAO($pCodigo_FK, $pTelefono)
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->Telefono = $pTelefono;
    }

    function crear()
    {
        return "insert into telefonod(codigo_fk, telefono)
                values ('" . $this->Codigo_FK . "','" . $this->Telefono . "')";
    }

    function consultar()
    {
        return "select Telefono
                from telefonod
                where Codigo_FK = '" . $this->Codigo_FK . "'";
    }

    function mostrar()
    {
        return "select Codigo_FK, Telefono
                from telefonod
                where Codigo_FK = '" . $this->Codigo_FK . "'";
    }

    function editar($telefonoguardado2, $telefonoguardado1, $telefonoactual2, $telefonoactual1)
    {
        if ($telefonoguardado2 == $telefonoactual2 && $telefonoguardado1 != $telefonoactual1) {
            return "update telefonod
                set Telefono = '" . $telefonoactual1 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado1 . "'";
        } elseif ($telefonoguardado2 != $telefonoactual2 && $telefonoguardado1 == $telefonoactual1) {
            return "update telefonod
                set Telefono = '" . $telefonoactual2 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado2 . "'";
        } elseif ($telefonoguardado2 != $telefonoactual2 && $telefonoguardado1 != $telefonoactual1) {
            return "update telefonod
                set Telefono = '" . $telefonoactual2 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado2 . "';
                update TelefonoD set Telefono = '" . $telefonoactual1 . "' where Codigo_FK = '" . $this->Codigo_FK . "'
                and Telefono='" . $telefonoguardado1 . "'";
        } elseif ($telefonoguardado2 == $telefonoactual2 && $telefonoguardado1 == $telefonoactual1) {
            return "update telefonod
                set Telefono = '" . $telefonoactual2 . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and Telefono='" . $telefonoguardado2 . "'
                and set Telefono = '" . $telefonoactual1 . "' where Codigo_FK = '" . $this->Codigo_FK . "'
                and Telefono='" . $telefonoguardado1 . "'";
        }
    }
}
?>