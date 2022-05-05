<?php

class NotaDAO
{

    private $CodigoM_FK1;
    
    private $Grupo;

    private $ID_Trabajo;

    private $Trabajo;

    private $ID_Alumno;

    private $Nota;

    function NotaDAO($pCodigoM_FK1, $pGrupo, $pID_Trabajo, $pID_Alumno, $pTrabajo, $pNota)
    {
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->ID_Trabajo = $pID_Trabajo;
        $this->ID_Alumno = $pID_Alumno;
        $this->Trabajo = $pTrabajo;
        $this->Nota = $pNota;
    }

    function crear()
    {
        return "insert into nota(CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo, Nota)
                values ('" . $this->CodigoM_FK1 . "','" . $this->Grupo . "','" . $this->ID_Trabajo . "','" . 
                $this->ID_Alumno . "','" . $this->Trabajo . "','" . $this->Nota . "')";
    }

    function consultar()
    {
        return "select ID_Alumno, Trabajo, Nota
                from nota
                where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "'";
    }

    function editar($nota)
    {
        return "update nota
                set Nota = '" . $nota . "' where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "' and ID_Alumno = '" . $this->ID_Alumno . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo)
    {
        if ($orden == "" || $dir == "") {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno,Trabajo,  Nota 
                from nota where ID_Alumno = '" . $codigo . "'
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo,  Nota
                from nota where ID_Alumno = '" . $codigo . "'
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }
    
    function consultarPorPaginaD($cantidad, $pagina, $orden, $dir, $codigo, $grupo)
    {
        if ($orden == "" || $dir == "") {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo, Nota 
                from nota where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "'
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo, Nota
                from nota where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "'
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }
    
    function consultarPorPaginaNF($cantidad, $pagina, $orden, $dir, $codigo, $grupo, $alumno)
    {
        if ($orden == "" || $dir == "") {
            return "select CodigoM_FK1, Grupo, ID_Trabajo,  ID_Alumno, Trabajo,Nota 
                from nota where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "'
                and ID_alumno= '" . $alumno ."'
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo,  Nota 
                from nota where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "'
                and ID_alumno= '" . $alumno ."'
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarTotalRegistros($codigo)
    {
        return "select count(CodigoM_FK1)
                from nota where ID_Alumno = '" . $codigo . "'";
    }
    
    function consultarTotalRegistrosD($codigo, $grupo)
    {
        return "select count(CodigoM_FK1)
                from nota where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "'";
    }
    
    function consultarTotalRegistrosNF($codigo, $grupo, $alumno)
    {
        return "select count(CodigoM_FK1)
                from nota where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "' and ID_alumno= '" . $alumno ."'";
    }
    
    function promedio($codigo, $grupo, $alumno){
        return "select SUM(Nota)
                from nota where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "' and ID_alumno= '" . $alumno ."'";
    }
}
?>