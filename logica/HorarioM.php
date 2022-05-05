<?php
require "persistencia/HorarioMDAO.php";

class HorarioM
{

    private $Codigo_FK;
    
    private $Grupo;

    private $Dia;

    private $Hora_ini;

    private $Hora_fin;

    private $conexion;

    private $HorarioMDAO;

    public function getCodigo_FK()
    {
        return $this->Codigo_FK;
    }
    
    public function getGrupo()
    {
        return $this->Grupo;
    }

    public function getDia()
    {
        return $this->Dia;
    }

    public function getHora_ini()
    {
        return $this->Hora_ini;
    }

    public function getHora_fin()
    {
        return $this->Hora_fin;
    }


    function HorarioM($pCodigo_FK = "", $pGrupo = "", $pDia = "", $pHora_ini = "", $pHora_fin = "")
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->Grupo = $pGrupo;
        $this->Dia = $pDia;
        $this->Hora_ini = $pHora_ini;
        $this->Hora_fin = $pHora_fin;
        $this->conexion = new Conexion();
        $this->HorarioMDAO = new HorarioMDAO($pCodigo_FK, $pGrupo, $pDia, $pHora_ini, $pHora_fin);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Grupo = $resultado[0];
        $this->Dia = $resultado[1];
        $this->Hora_ini = $resultado[2];
        $this->Hora_fin = $resultado[3];
    }
    
    function consultar1()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->consultar1());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo_FK = $resultado[0];
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $HorarioMs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioMs, new HorarioM($resultado[0], $resultado[1], "", "", ""));
        }
        return $HorarioMs;
    }
    
    function consultarMas(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->consultarMas());
        $this->conexion->cerrar();
        $HorarioAs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioAs, new HorarioM("", "", $resultado[0], $resultado[1], $resultado[2]));
        }
        return $HorarioAs;
    }

    function consultarPorPagina1($cantidad, $pagina, $orden, $dir, $idM, $grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->consultarPorPagina1($cantidad, $pagina, $orden, $dir, $idM, $grupo));
        $this->conexion->cerrar();
        $HorarioMs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioMs, new HorarioM($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4]));
        }
        return $HorarioMs;
    }
    
    function consultarE($idM, $grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->consultarE($idM, $grupo));
        $this->conexion->cerrar();
        $HorarioMs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioMs, new HorarioM("", "", $resultado[0], $resultado[1], $resultado[2]));
        }
        return $HorarioMs;
    }
    
    function asignarHorario($idM, $grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->asignarHorario($idM, $grupo));
        $this->conexion->cerrar();
        $HorarioMs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioMs, new HorarioM($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4]));
        }
        return $HorarioMs;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioMDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>