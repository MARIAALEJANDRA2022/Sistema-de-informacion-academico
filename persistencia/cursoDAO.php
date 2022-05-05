<?php

class cursoDAO
{

    private $CodigoM;
    
    private $Grupo;
    
    private $ID_Docente;

    private $Nombre;
    
    private $Semestre_curso;
    
    private $Cupos_totales;

    private $Cantidad_estudiantes;

    private $Cupos_disponibles;

    function cursoDAO($pCodigoM, $pGrupo, $pID_Docente, $pNombre, $pSemestre_curso, $pCupos_totales, $pCantidad_estudiantes, $pCupos_disponibles)
    {
        $this->CodigoM = $pCodigoM;
        $this->Grupo = $pGrupo;
        $this->ID_Docente = $pID_Docente;
        $this->Nombre = $pNombre;
        $this->Semestre_curso = $pSemestre_curso;
        $this->Cupos_totales = $pCupos_totales;
        $this->Cantidad_estudiantes = $pCantidad_estudiantes;
        $this->Cupos_disponibles = $pCupos_disponibles;
    }

    function crear()
    {
        return "insert into curso(CodigoM, Grupo, ID_Docente, Nombre, Semestre_curso, Cupos_totales, Cantidad_estudiantes, Cupos_disponibles)
                values ('" . $this->CodigoM . "','" . $this->Grupo . "','" . $this->ID_Docente . "','" . $this->Nombre . "','" . $this->Semestre_curso . "','" . $this->Cupos_totales . "','" . $this->Cantidad_estudiantes . "','" . $this->Cupos_disponibles . "')";
    }

    function consultar()
    {
        return "select ID_Docente, Nombre, Semestre_curso, Cupos_totales, Cantidad_estudiantes, Cupos_disponibles
                from curso
                where CodigoM = '" . $this->CodigoM . "' and Grupo = '" . $this->Grupo . "'";
    }

    function codigo($nombre)
    {
        return "select CodigoM
                from curso
                where Nombre = '" . $nombre . "'";
    }
    
    function consultarExiste($id, $grupo)
    {
        return "select CodigoM, Grupo
            from curso
            where CodigoM = '" . $id . "' and Grupo = '" . $grupo . "'";
    }
    
    function trabajos(){
        return "select CodigoM, Grupo
                from curso
                where Nombre = '" . $this->Nombre . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $i, $semestre_curso, $materia)
    {
        if ($i==0 || $i==1){
            if ($orden == "" || $dir == "") {
                return "select CodigoM, Grupo, ID_Docente, Nombre, Semestre_curso, Cupos_totales, Cantidad_estudiantes, Cupos_disponibles
                    from curso where CodigoM= '" . $materia . "' and Semestre_curso= '" . $semestre_curso . "'
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            } else {
                return "select CodigoM, Grupo, ID_Docente, Nombre, Semestre_curso, Cupos_totales, Cantidad_estudiantes, Cupos_disponibles
                    from curso where CodigoM= '" . $materia . "' and Semestre_curso= '" . $semestre_curso . "'
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            }
        }else{
            if ($orden == "" || $dir == "") {
                return "select CodigoM, Grupo, ID_Docente, Nombre, Semestre_curso, Cupos_totales, Cantidad_estudiantes, Cupos_disponibles
                    from curso
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            } else {
                return "select CodigoM, Grupo, ID_Docente, Nombre, Semestre_curso, Cupos_totales, Cantidad_estudiantes, Cupos_disponibles
                    from curso
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            }
        }
    }

    function consultarTotalRegistros()
    {
        return "select count(CodigoM)
                from curso";
    }
    
    function actualizar($estudiantes, $cupos, $codigo, $grupo)
    {
        return "update curso set Cantidad_estudiantes = '" . $estudiantes . "', Cupos_disponibles = '" . $cupos . "' where CodigoM = '" . $codigo . "' and Grupo ='" . $grupo . "'";
    }
    
    function actualizarIdDocente($docente, $codigo, $grupo){
        return "update curso set ID_Docente = '" . $docente . "' where CodigoM = '" . $codigo . "' and Grupo ='" . $grupo . "'";
    }
}
?>