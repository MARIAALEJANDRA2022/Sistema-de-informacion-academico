<?php

class MateriaDAO
{

    private $CodigoM;

    private $Nombre;
    
    private $Semestre_curso;
    
    private $Clasificacion;

    function MateriaDAO($pCodigoM, $pNombre, $pSemestre_curso, $pClasificacion)
    {
        $this->CodigoM = $pCodigoM;
        $this->Nombre = $pNombre;
        $this->Semestre_curso = $pSemestre_curso;
        $this->Clasificacion = $pClasificacion;
    }

    function crear()
    {
        return "insert into materia(CodigoM, Nombre, Semestre_curso, Clasificacion)
                values ('" . $this->CodigoM . "','" . $this->Nombre . "','" . $this->Semestre_curso . "','" . $this->Clasificacion . "')";
    }

    function consultar()
    {
        return "select Nombre, Semestre_curso, Clasificacion
                from materia
                where CodigoM = '" . $this->CodigoM . "'";
    }
    
    function consultarExiste($id)
    {
        return "select CodigoM
            from materia
            where CodigoM = '" . $id . "'";
    }

    function codigo($nombre)
    {
        return "select CodigoM
                from materia
                where Nombre = '" . $nombre . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $i, $semestre_curso)
    {
        if ($i==0 || $i==1){
            if ($orden == "" || $dir == "") {
                return "select CodigoM, Nombre, Semestre_curso, Clasificacion
                    from materia where Semestre_curso= '" . $semestre_curso . "' 
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            } else {
                return "select CodigoM, Nombre, Semestre_curso, Clasificacion
                    from materia where Semestre_curso= '" . $semestre_curso . "' 
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            }
        }else{
            if ($orden == "" || $dir == "") {
                return "select CodigoM, Nombre, Semestre_curso, Clasificacion
                    from materia
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            } else {
                return "select CodigoM, Nombre, Semestre_curso, Clasificacion
                    from materia
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
            }
        }
    }

    function consultarTotalRegistros()
    {
        return "select count(CodigoM)
                from materia";
    }
}
?>