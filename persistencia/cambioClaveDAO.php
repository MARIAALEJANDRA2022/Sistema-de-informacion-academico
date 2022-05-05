<?php

class cambioClaveDAO
{

    private $CorreoI;

    function cambioClaveDAO($pCorreoI)
    {
        $this->CorreoI = $pCorreoI;
    }

    function crear()
    {
        return "insert into cambio_clave (CorreoI)
                values ('" . $this->CorreoI . "')";
    }

    function eliminar($correo)
    {
        return "delete from cambio_clave where correoI= '" . $correo . "'";
    }

    function consultar()
    {
        return "select CorreoI from cambio_clave";
    }
}
?>