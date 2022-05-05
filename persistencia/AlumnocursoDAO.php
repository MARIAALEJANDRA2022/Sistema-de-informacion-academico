<?php

class AlumnocursoDAO
{

    private $Codigo_FK;

    private $CodigoM;
    
    private $Grupo;
    
    private $Nota;

    function AlumnocursoDAO($pCodigo_FK, $pCodigoM, $pGrupo, $pNota)
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->CodigoM = $pCodigoM;
        $this->Grupo = $pGrupo;
        $this->Nota = $pNota;
    }

    function crear()
    {
        return "insert into alumnocurso(Codigo_FK, CodigoM, Grupo, Nota)
                values ('" . $this->Codigo_FK . "','" . $this->CodigoM . "','" . $this->Grupo . "','" . $this->Nota . "')";
    }

    function consultar()
    {
        return "select CodigoM, Grupo, Nota
                from alumnocurso
                where Codigo_FK = '" . $this->Codigo_FK . "'";
    }
    
    function consultarA()
    {
        return "select Codigo_FK, CodigoM, Grupo, Nota
                from alumnocurso
                where CodigoM = '" . $this->CodigoM . "' and Grupo = '" . $this->Grupo . "'";
    }
    
    function consultarNF()
    {
        return "select Nota
                from alumnocurso
                where Codigo_FK = '" . $this->Codigo_FK . "' and CodigoM = '" . $this->CodigoM . "' and Grupo = '" . $this->Grupo . "'";
    }

    function editar($nota)
    {
        return "update alumnocurso
                set Nota = '" . $nota . "'
                where Codigo_FK = '" . $this->Codigo_FK . "' and CodigoM = '" . $this->CodigoM . "' and Grupo = '" . $this->Grupo . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $materia,$grupo)
    {
        if ($orden == "" || $dir == "") {
            return "select Codigo_FK, CodigoM, Grupo, Nota
                from alumnocurso where CodigoM = '" . $materia . "' and Grupo = '" . $grupo . "'
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select Codigo_FK, CodigoM, Grupo, Nota
                from alumnocurso where CodigoM = '" . $materia . "' and Grupo = '" . $grupo . "'
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }
    
    function consultarPorPagina1($cantidad, $pagina, $orden, $dir, $id)
    {
        if ($orden == "" || $dir == "") {
            return "select Codigo_FK, CodigoM, Grupo, Nota
                from alumnocurso where Codigo_FK = '" . $id  . "'
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select Codigo_FK, CodigoM, Grupo, Nota
                from alumnocurso where Codigo_FK = '" . $id  . "'
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarTotalRegistros($materia,$grupo)
    {
        return "select count(Codigo_FK)
                from alumnocurso where CodigoM = '" . $materia . "' and Grupo = '" . $grupo . "'";
    }
    
    function consultarTotalRegistros1($id)
    {
        return "select count(Codigo_FK)
                from alumnocurso where where Codigo_FK = '" . $id  . "'";
    }
}
?>