<?php

class HorarioADAO
{

    private $Codigo_FK;
    
    private $CodigoM_FK1;
    
    private $Grupo;

    private $Dia;

    private $Hora_ini;

    private $Hora_fin;

    function HorarioADAO($pCodigo_FK, $pCodigoM_FK1, $pGrupo, $pDia, $pHora_ini, $pHora_fin)
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->Dia = $pDia;
        $this->Hora_ini = $pHora_ini;
        $this->Hora_fin = $pHora_fin;
    }

    function crear()
    {
        return "insert into horarioa(Codigo_FK, CodigoM_FK1, Grupo, Dia, Hora_ini, Hora_fin)
                values ('" . $this->Codigo_FK . "','" . $this->CodigoM_FK1 . "','" . $this->Grupo . "','" . 
                $this->Dia . "','" . $this->Hora_ini . "','" . $this->Hora_fin . "')";
    }

    function consultar(){
        return "select Codigo_FK, CodigoM_FK1 
                from horarioa
                where Codigo_FK = '" . $this->Codigo_FK . "' and CodigoM_FK1 = '" . $this->CodigoM_FK1 . "'";
    }

    function consultar1()
    {
        return "select Codigo_FK
                from horarioa
                where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "'
                and Grupo = '" . $this->Grupo . "'
                and Dia = '" . $this->Dia . "'
                and Hora_ini='" . $this->Hora_ini . "'
                and Hora_fin ='" . $this->Hora_fin . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo)
    {
        if ($orden == "" || $dir == "") {
            return "select distinct CodigoM_FK1, Grupo
                    from horarioa where Codigo_FK = '" . $codigo . "'
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select distinct CodigoM_FK1, Grupo
                    from horarioa where Codigo_FK = '" . $codigo . "'
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarPorPagina1($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select distinct Codigo_FK, CodigoM_FK1, Grupo
                    from horarioa
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select distinct Codigo_FK, CodigoM_FK1, Grupo
                    from horarioa
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarPorPagina2($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select distinct Codigo_FK
                    from horarioa where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "'
                    and Grupo = '" . $this->Grupo . "'
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select distinct Codigo_FK
                    from horarioa where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "'
                    and Grupo = '" . $this->Grupo . "'
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }
    
    function consultarPorPagina3($cantidad, $pagina, $orden, $dir, $id)
    {
        if ($orden == "" || $dir == "") {
            return "select distinct Codigo_FK, CodigoM_FK1, Grupo 
                    from horarioa where Codigo_FK = '" . $id . "'
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select distinct Codigo_FK, CodigoM_FK1, Grupo 
                    from horarioa where Codigo_FK = '" . $id . "'
                    order by " . $orden . " " . $dir . "
                    limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }
    function consultarTotalRegistros()
    {
        return "select count(Codigo_FK)
                from horarioa";
    }
    
    function consultarTotalRegistrosA($codigo)
    {
        return "select count(distinct CodigoM_FK1)
                from horarioa where Codigo_FK = '" . $codigo . "'";
    }
    
    function validarCantidadMaterias($codigo){
        return "select count(distinct CodigoM_FK1)
                from horarioa where Codigo_FK = '" . $codigo . "'";
    }
    
    function consultarMas(){
        return "select Dia, Hora_ini, Hora_fin 
                from horarioa where Codigo_FK= '" . $this->Codigo_FK . "' and CodigoM_FK1 = '" . $this->CodigoM_FK1 . "' and Grupo = '" . $this->Grupo . "'";
    }

    function consultarTotalRegistros1()
    {
        return "select count(Codigo_FK)
                from horarioa where CodigoM_FK1 = '" . $this->CodigoM_FK1 . "'
                and Grupo = '" . $this->Grupo . "'
                and Dia = '" . $this->Dia . "'
                and Hora_ini='" . $this->Hora_ini . "'
                and Hora_fin ='" . $this->Hora_fin . "'";
    }
    
    function eliminar($codigo,$materia){
        return "delete from alumnocurso where Codigo_FK = '".$codigo."' and CodigoM= '" . $materia . "';
        delete from horarioa where Codigo_FK = '".$codigo."' and CodigoM_FK1= '" . $materia . "'";
    }
}
?>