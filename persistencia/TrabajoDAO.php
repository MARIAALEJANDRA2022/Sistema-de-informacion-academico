<?php

class TrabajoDAO
{

    private $CodigoM_FK1;
    
    private $Grupo;

    private $ID_Trabajo;

    private $ID_Alumno;

    private $Trabajo;

    private $Estado;

    private $Fecha_entrega;

    private $Nota;

    private $Observacion;

    function TrabajoDAO($pCodigoM_FK1, $pGrupo, $pID_Trabajo, $pID_Alumno, $pTrabajo, $pEstado, $pFecha_entrega, $pNota, $pObservacion)
    {
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->ID_Trabajo = $pID_Trabajo;
        $this->ID_Alumno = $pID_Alumno;
        $this->Trabajo = $pTrabajo;
        $this->Estado = $pEstado;
        $this->Fecha_entrega = $pFecha_entrega;
        $this->Nota = $pNota;
        $this->Observacion = $pObservacion;
    }

    function crear()
    {
        return "insert into trabajo(CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo, Estado, Fecha_entrega, Nota, Observacion)
                values ('" . $this->CodigoM_FK1 . "','" . $this->Grupo . "','" . $this->ID_Trabajo . "','" . $this->ID_Alumno . "','" . $this->Trabajo . "','" . $this->Estado . "','" . $this->Fecha_entrega . "','" . $this->Nota . "','" . $this->Observacion . "')";
    }

    function consultar()
    {
        return "select Trabajo, Estado, Fecha_entrega, Nota, Observacion
                from trabajo
                where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "'and ID_Trabajo = '" . $this->ID_Trabajo . "'and ID_Alumno = '" . $this->ID_Alumno . "'";
    }

    function editar($nota, $obs, $estado)
    {                          
        return "update trabajo
                set Estado = '" . $estado . "', Nota = '" . $nota . "', Observacion = '" . $obs . "'
                where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "' and ID_Alumno = '" . $this->ID_Alumno . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo, Estado, Fecha_entrega, Nota, Observacion
                from trabajo
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, ID_Alumno, Trabajo, Estado, Fecha_entrega, Nota, Observacion
                from trabajo
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarTotalRegistros()
    {
        return "select count(CodigoM_FK1)
                from trabajo";
    }

    function consultarTrabajos($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select CodigoM_FK1, Grupo, ID_Trabajo,ID_Alumno, Trabajo, Estado, Fecha_entrega, Nota, Observacion
                from trabajo where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "' limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select CodigoM_FK1, Grupo, ID_Trabajo,ID_Alumno, Trabajo, Estado, Fecha_entrega, Nota, Observacion
                from trabajo where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "' order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function eliminar()
    {
        return "delete 
                from trabajo
                where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "' and ID_Alumno = '" . $this->ID_Alumno . "'";
    }
    
    function actualizarNota($nota){
        return "update trabajo
                set Nota = '" . $nota . "'
                where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "' and ID_Alumno = '" . $this->ID_Alumno . "'";    
    }
}
?>