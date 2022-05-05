<?php

class Conexion
{

    private $mysqli;

    private $resultado;

    function abrir()
    {
        $this->mysqli = new mysqli("localhost", "u100380916_root", "NPmm120605", "u100380916_infoacademica");
        $this->mysqli->set_charset("utf8");
    }

    function cerrar()
    {
        $this->mysqli->close();
    }

    function ejecutar($sentencia)
    {
        $this->resultado = $this->mysqli->query($sentencia);
    }

    function ejecutarM($sentencia)
    {
        $this->resultado = $this->mysqli->multi_query($sentencia);
    }

    function extraer()
    {        
        return $this->resultado->fetch_row();
    }

    function numFilas()
    {
        return ($this->resultado != null) ? $this->resultado->num_rows : 0;
    }
}
?>