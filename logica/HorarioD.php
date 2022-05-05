<?php
require "persistencia/HorarioDDAO.php";

class HorarioD
{

    private $Codigo_FK;
    
    private $CodigoM_FK1;
    
    private $Grupo;
    
    private $Dia;

    private $Hora_ini;

    private $Hora_fin;

    private $conexion;

    private $HorarioDDAO;

    public function getCodigo_FK()
    {
        return $this->Codigo_FK;
    }
    
    public function getCodigoM_FK1()
    {
        return $this->CodigoM_FK1;
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

    function HorarioD($pCodigo_FK = "", $pCodigoM_FK1 = "", $pGrupo="", $pDia = "", $pHora_ini = "", $pHora_fin = "")
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->Dia = $pDia;
        $this->Hora_ini = $pHora_ini;
        $this->Hora_fin = $pHora_fin;
        $this->conexion = new Conexion();
        $this->HorarioDDAO = new HorarioDDAO($pCodigo_FK, $pCodigoM_FK1, $pGrupo, $pDia, $pHora_ini, $pHora_fin);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo_FK = $resultado[0];
        $this->CodigoM_FK1 = $resultado[1];
        $this->Grupo = $resultado[2];
    }

    function consultar1()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultar1());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo_FK = $resultado[0];
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->editar());
        $this->conexion->cerrar();
    }

    function consultarTodos($id)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultarTodos($id));
        $this->conexion->cerrar();
        $HorarioDs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioDs, new HorarioD($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]));
        }
        return $HorarioDs;
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo));
        $this->conexion->cerrar();
        $HorarioDs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioDs, new HorarioD($resultado[0], $resultado[1], $resultado[2],"", "", ""));
        }
        return $HorarioDs;
    }

    function consultarPorPagina1($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultarPorPagina1($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $HorarioDs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioDs, new HorarioD($resultado[0], $resultado[1], $resultado[2], "", "", ""));
        }
        return $HorarioDs;
    }
    
    function consultarMas(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultarMas());
        $this->conexion->cerrar();
        $HorarioAs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioAs, new HorarioD("", "", "", $resultado[0], $resultado[1], $resultado[2]));
        }
        return $HorarioAs;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function consultarTotalRegistros1($dia,$inicio,$fin)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->consultarTotalRegistros1($dia,$inicio,$fin));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function eliminar($codigo,$materia, $grupo){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutarM($this -> HorarioDDAO -> eliminar($codigo,$materia, $grupo));
        $this -> conexion -> cerrar();
    }
    
    function eliminarP($docente){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioDDAO->eliminarP($docente));
        $this->conexion->cerrar();
    }
}
?>