<?php

class Asignar_trabajoDAO
{

    private $CodigoM_FK1;
    
    private $Grupo;

    private $ID_Trabajo;

    private $Trabajo;

    private $Fecha_asignacion;

    private $Fecha_entrega;

    private $Descripcion;    

    function Asignar_trabajoDAO($pCodigoM_FK1, $pGrupo, $pID_Trabajo, $pTrabajo, $pFecha_asignacion, $pFecha_entrega, $pDescripcion)
    {
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->ID_Trabajo = $pID_Trabajo;
        $this->Trabajo = $pTrabajo;
        $this->Fecha_asignacion = $pFecha_asignacion;
        $this->Fecha_entrega = $pFecha_entrega;
        $this->Descripcion = $pDescripcion;
    }

    function crear()
    {
        return "insert into asignar_trabajo(CodigoM_FK1, Grupo, ID_Trabajo, Trabajo, Fecha_asignacion, Fecha_entrega, Descripcion)
                values ('" . $this->CodigoM_FK1 . "','" . $this->Grupo . "','" . $this->ID_Trabajo . "','" . $this->Trabajo . "', 
                '" . $this->Fecha_asignacion . "','" . $this->Fecha_entrega . "','" . $this->Descripcion . "')";
    }

    function consultar()
    {
        return "select Trabajo, Fecha_asignacion, Fecha_entrega, Descripcion
                from asignar_trabajo
                where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "' and ID_Trabajo = '" . $this->ID_Trabajo . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, Trabajo, Fecha_asignacion, Fecha_entrega, Descripcion
                from asignar_trabajo
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select CodigoM_FK1, Grupo, ID_Trabajo, Trabajo, Fecha_asignacion, Fecha_entrega, Descripcion
                from asignar_trabajo
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }    
    
    function consultarAlumno($codigo, $grupo){
        return "select distinct CodigoM_FK1, Grupo, ID_Trabajo, Trabajo, Fecha_asignacion, Fecha_entrega, Descripcion
                from asignar_trabajo where CodigoM_FK1 = '" . $codigo . "' and Grupo = '" . $grupo . "'";
    }

    function consultarTotalRegistros()
    {
        return "select count(CodigoM_FK1)
                from asignar_trabajo";
    }
}
?>