<?php
require "persistencia/chatDAO.php";

class chat
{

    private $id;

    private $nombre;

    private $destinatario;

    private $mensaje;

    private $fecha;

    private $hora;

    private $conexion;

    private $chatDAO;

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDestinatario()
    {
        return $this->destinatario;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    function chat($pId = "", $pNombre = "", $pDestinatario = "", $pMensaje = "", $pfecha = "", $phora = "")
    {
        $this->id = $pId;
        $this->nombre = $pNombre;
        $this->destinatario = $pDestinatario;
        $this->mensaje = $pMensaje;
        $this->fecha = $pfecha;
        $this->hora = $phora;
        $this->conexion = new Conexion();
        $this->chatDAO = new chatDAO($pId, $pNombre, $pDestinatario, $pMensaje, $pfecha, $phora);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->chatDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar($nombreD, $nombreA)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->chatDAO->consultar($nombreD, $nombreA));
        $this->conexion->cerrar();
        $mensajes = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($mensajes, new chat($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]));
        }
        return $mensajes;
    }

    function registros($nombreD, $nombreA)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->chatDAO->registros($nombreD, $nombreA));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }

    function Totalregistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->chatDAO->Totalregistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }

    function fecha($fecha)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->chatDAO->fecha($fecha));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>