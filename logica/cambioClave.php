<?php
require "persistencia/cambioClaveDAO.php";

class cambioClave
{

    private $CorreoI;

    private $cambioClaveDAO;

    public function getCorreoI()
    {
        return $this->CorreoI;
    }

    function cambioClave($pCorreoI = "")
    {
        $this->CorreoI = $pCorreoI;
        $this->conexion = new Conexion();
        $this->cambioClaveDAO = new cambioClaveDAO($pCorreoI);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cambioClaveDAO->crear());
        $this->conexion->cerrar();
    }

    function eliminar($CorreoI)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cambioClaveDAO->eliminar($CorreoI));
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->cambioClaveDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->CorreoI = $resultado[0];
        return $resultado[0];
    }
}
?>