<?php

class chatDAO
{

    private $id;

    private $nombre;

    private $destinatario;

    private $mensaje;

    private $fecha;

    private $hora;

    function chatDAO($pId, $pNombre, $pDestinatario, $pMensaje, $pfecha, $phora)
    {
        $this->id = $pId;
        $this->nombre = $pNombre;
        $this->destinatario = $pDestinatario;
        $this->mensaje = $pMensaje;
        $this->fecha = $pfecha;
        $this->hora = $phora;
    }

    function crear()
    {
        return "insert into chat(ID, Nombre, Destinatario, Mensaje, Fecha, Hora)
                values ('" . $this->id . "','" . $this->nombre . "','" . $this->destinatario . "','" . $this->mensaje . "','" . $this->fecha . "','" . $this->hora . "')";
    }

    function consultar($nombreD, $nombreA)
    {
        return "select ID, Nombre, Destinatario, Mensaje, Fecha, Hora
                from chat
                where Nombre = '" . $nombreD . "' and Destinatario = '" . $nombreA . "'
                or Nombre = '" . $nombreA . "' and Destinatario = '" . $nombreD . "'";
    }

    function registros($nombreD, $nombreA)
    {
        return "select count(ID)
                from chat where Nombre = '" . $nombreD . "' and Destinatario = '" . $nombreA . "'
                or Nombre = '" . $nombreA . "' and Destinatario = '" . $nombreD . "'";
    }

    function Totalregistros()
    {
        return "select count(ID)
                from chat";
    }

    function fecha($fecha)
    {
        return "select count(Fecha)
                from chat where Fecha = '" . $fecha . "'";
    }
}
?>