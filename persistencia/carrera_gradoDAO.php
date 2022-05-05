<?php

class carrera_gradoDAO
{

    private $Codigo;

    private $Nombre;

    function carrera_gradoDAO($pCodigo, $pNombre)
    {
        $this->Codigo = $pCodigo;
        $this->Nombre = $pNombre;
    }

    function crear()
    {
        return "insert into carrera_grado(Codigo, Nombre)
                values ('" . $this->Codigo . "','" . $this->Nombre . "')";
    }

    function consultar()
    {
        return "select Nombre
                from carrera_grado
                where Codigo = '" . $this->Codigo . "'";
    }
    
    function consultarTodos()
    {
        return "select Nombre
                from carrera_grado";
    }
    
    function buscar($Nombre)
    {
        return "select Codigo
                from carrera_grado
                where Nombre = '" . $Nombre . "'";
    }

    function editar()
    {
        return "update carrera_grado
                set Nombre = '" . $this->Nombre . "'
                where Codigo = '" . $this->Codigo . "'";
    }
    
    function TotalRegistros()
    {
        return "select count(Codigo)
                from carrera_grado";
    }
}
?>