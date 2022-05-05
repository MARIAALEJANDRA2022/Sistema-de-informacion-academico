<?php

class NacionalidadDAO
{

    private $ID_Nacionalidad;

    private $Nacionalidad;

    function NacionalidadDAO($pID_Nacionalidad, $pNacionalidad)
    {
        $this->ID_Nacionalidad = $pID_Nacionalidad;
        $this->Nacionalidad = $pNacionalidad;
    }

    function crear()
    {
        return "insert into nacionalidad(ID_Nacionalidad, Nacionalidad)
                values ('" . $this->ID_Nacionalidad . "','" . $this->Nacionalidad . "')";
    }

    function consultar()
    {
        return "select Nacionalidad
                from nacionalidad
                where ID_Nacionalidad = '" . $this->ID_Nacionalidad . "'";
    }

    function mostrar($codigo)
    {
        return "select Nacionalidad
                from nacionalidad
                where ID_Nacionalidad = '" . $codigo . "'";
    }
    
    function consultarTodos()
    {
        return "select Nacionalidad from nacionalidad";
    }

    function buscar($codigo)
    {
        return "select ID_Nacionalidad
                from nacionalidad
                where Nacionalidad = '" . $codigo . "'";
    }

    function editar()
    {
        return "update nacionalidad
                set Nacionalidad = '" . $this->Nacionalidad . "'
                where ID_Nacionalidad = '" . $this->ID_Nacionalidad . "'";
    }
}
?>