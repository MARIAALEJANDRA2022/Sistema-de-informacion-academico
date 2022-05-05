<?php

class LugarNacimientoDAO
{

    private $ID_LugarNacimiento;

    private $LugarNacimiento;

    function LugarNacimientoDAO($pID_LugarNacimiento, $pLugarNacimiento)
    {
        $this->ID_LugarNacimiento = $pID_LugarNacimiento;
        $this->LugarNacimiento = $pLugarNacimiento;
    }

    function crear()
    {
        return "insert into lugarnacimiento(ID_LugarNacimiento, LugarNacimiento)
                values ('" . $this->ID_LugarNacimiento . "','" . $this->LugarNacimiento . "')";
    }

    function consultar()
    {
        return "select LugarNacimiento
                from lugarnacimiento
                where ID_LugarNacimiento = '" . $this->ID_LugarNacimiento . "'";
    }

    function mostrar($codigo)
    {
        return "select LugarNacimiento
                from lugarnacimiento
                where ID_LugarNacimiento = '" . $codigo . "'";
    }

    function buscar($codigo)
    {
        return "select ID_LugarNacimiento
                from lugarnacimiento
                where LugarNacimiento = '" . $codigo . "'";
    }
    
    function consultarTodos()
    {
        return "select LugarNacimiento
                from lugarnacimiento";
    }

    function editar()
    {
        return "update lugarnacimiento
                set LugarNacimiento = '" . $this->LugarNacimiento . "'
                where ID_LugarNacimiento = '" . $this->ID_LugarNacimiento . "'";
    }
}
?>