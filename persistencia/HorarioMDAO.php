<?php

class HorarioMDAO
{

    private $Codigo_FK;
    
    private $Grupo;

    private $Dia;

    private $Hora_ini;

    private $Hora_fin;

    function HorarioMDAO($pCodigo_FK, $pGrupo, $pDia, $pHora_ini, $pHora_fin)
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->Grupo = $pGrupo;
        $this->Dia = $pDia;
        $this->Hora_ini = $pHora_ini;
        $this->Hora_fin = $pHora_fin;
    }

    function crear()
    {
        return "insert into horariom(Codigo_FK, Grupo, Dia, Hora_ini, Hora_fin)
                values ('" . $this->Codigo_FK . "','" . $this->Grupo . "','" . $this->Dia . "', 
                '" . $this->Hora_ini . "','" . $this->Hora_fin . "')";
    }

    function consultar()
    {
        return "select Grupo, Dia, Hora_ini, Hora_fin
                from horariom
                where Codigo_FK = '" . $this->Codigo_FK . "'";
    }

    function consultar1()
    {
        return "select Codigo_FK, Grupo
                from horariom
                where Dia = '" . $this->Dia . "'
                and Hora_ini='" . $this->Hora_ini . "'
                and Hora_fin ='" . $this->Hora_fin . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select distinct Codigo_FK, Grupo
                from horariom
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select distinct Codigo_FK, Grupo
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarPorPagina1($cantidad, $pagina, $orden, $dir, $idM, $grupo)
    {
        if ($orden == "" || $dir == "") {
            return "select distinct Codigo_FK, Grupo
                from horariom where Codigo_FK = '" . $idM . "' and Grupo= '" . $grupo . "'
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select distinct Codigo_FK, Grupo
                from horariom where Codigo_FK = '" . $idM . "' and Grupo= '" . $grupo . "'
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }
    
    function consultarE($idM, $grupo)
    {
        return "select Dia, Hora_ini, Hora_fin
                from horariom where Codigo_FK = '" . $idM . "' and Grupo= '" . $grupo . "'";
    }
    
    function asignarHorario($idM, $grupo)
    {
        return "select Codigo_FK, Grupo, Dia, Hora_ini, Hora_fin
                from horariom 
                where Codigo_FK = '" . $idM . "' and Grupo= '" . $grupo . "'";
    }

    function consultarMas(){
        return "select Dia, Hora_ini, Hora_fin 
                from horariom 
                where Codigo_FK = '" . $this->Codigo_FK . "' and Grupo = '" . $this->Grupo . "'";
    }

    function consultarTotalRegistros()
    {
        return "select count(Codigo_FK)
                from horariom";
    }
}
?>