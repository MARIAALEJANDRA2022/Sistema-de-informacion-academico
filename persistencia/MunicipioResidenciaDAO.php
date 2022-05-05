<?php

class MunicipioResidenciaDAO
{

    private $ID_MunicipioResidencia;

    private $MunicipioResidencia;

    function MunicipioResidenciaDAO($pID_MunicipioResidencia, $pMunicipioResidencia)
    {
        $this->ID_MunicipioResidencia = $pID_MunicipioResidencia;
        $this->MunicipioResidencia = $pMunicipioResidencia;
    }

    function crear()
    {
        return "insert into municipioresidencia(ID_MunicipioResidencia, MunicipioResidencia)
                values ('" . $this->ID_MunicipioResidencia . "','" . $this->MunicipioResidencia . "')";
    }

    function consultar()
    {
        return "select MunicipioResidencia
                from municipioresidencia
                where ID_MunicipioResidencia = '" . $this->ID_MunicipioResidencia . "'";
    }

    function mostrar($codigo)
    {
        return "select MunicipioResidencia
                from municipioresidencia
                where ID_MunicipioResidencia = '" . $codigo . "'";
    }

    function consultarTodos()
    {
        return "select MunicipioResidencia
                from municipioresidencia";
    }

    function buscar($codigo)
    {
        return "select ID_MunicipioResidencia
                from municipioresidencia
                where MunicipioResidencia = '" . $codigo . "'";
    }

    function editar()
    {
        return "update municipioresidencia
                set MunicipioResidencia = '" . $this->MunicipioResidencia . "'
                where ID_MunicipioResidencia = '" . $this->ID_MunicipioResidencia . "'";
    }
}
?>