<?php

class DocentealumnoDAO
{

    private $Codigo_FKD;

    private $Codigo_FKA;

    function DocentealumnoDAO($pCodigo_FKD, $pCodigo_FKA)
    {
        $this->Codigo_FKD = $pCodigo_FKD;
        $this->Codigo_FKA = $pCodigo_FKA;
    }

    function crear()
    {
        return "insert into docentealumno(Codigo_FKD, Codigo_FKA)
                values ('" . $this->Codigo_FKD . "','" . $this->Codigo_FKA . "')";
    }

    function consultar()
    {
        return "select Codigo_FKA
                from docentealumno
                where Codigo_FKD = '" . $this->Codigo_FKD . "'";
    }

    function consultar1($id)
    {
        return "select Codigo_FKD
                from docentealumno
                where Codigo_FKA = '" . $id . "'";
    }

    function editar()
    {
        return "update docentealumno
                set Codigo_FKA = '" . $this->Codigo_FKA . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select Codigo_FKD, Codigo_FKA
                from docentealumno
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select Codigo_FKD, Codigo_FKA
                from docentealumno
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarTotalRegistros()
    {
        return "select count(Codigo_FKD)
                from docentealumno";
    }
}
?>