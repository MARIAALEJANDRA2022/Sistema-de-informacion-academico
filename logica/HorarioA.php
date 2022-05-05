<?php
require "persistencia/HorarioADAO.php";

class HorarioA
{

    private $Codigo_FK;

    private $CodigoM_FK1;
    
    private $Grupo;

    private $Dia;

    private $Hora_ini;

    private $Hora_fin;

    private $conexion;

    private $HorarioADAO;

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

    function HorarioA($pCodigo_FK = "", $pCodigoM_FK1 = "", $pGrupo = "", $pDia = "", $pHora_ini = "", $pHora_fin = "")
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->CodigoM_FK1 = $pCodigoM_FK1;
        $this->Grupo = $pGrupo;
        $this->Dia = $pDia;
        $this->Hora_ini = $pHora_ini;
        $this->Hora_fin = $pHora_fin;
        $this->conexion = new Conexion();
        $this->HorarioADAO = new HorarioADAO($pCodigo_FK, $pCodigoM_FK1, $pGrupo, $pDia, $pHora_ini, $pHora_fin);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo_FK = $resultado[0];
        $this->CodigoM_FK1 = $resultado[1];
        $this->Grupo = $resultado[2];
    }

    function consultar1()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultar1());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo_FK = $resultado[0];
    }

    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->editar());
        $this->conexion->cerrar();
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarPorPagina($cantidad, $pagina, $orden, $dir, $codigo));
        $this->conexion->cerrar();
        $HorarioAs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioAs, new HorarioA("", $resultado[0], $resultado[1], "", "", ""));
        }
        return $HorarioAs;
    }

    function consultarPorPagina1($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarPorPagina1($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $HorarioAs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioAs, new HorarioA($resultado[0], $resultado[1], $resultado[2], "", "", ""));
        }
        return $HorarioAs;
    }

    function consultarPorPagina2($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarPorPagina2($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $HorarioAs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioAs, new HorarioA($resultado[0]));
        }
        return $HorarioAs;
    }
    
    function consultarPorPagina3($cantidad, $pagina, $orden, $dir, $id)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarPorPagina3($cantidad, $pagina, $orden, $dir, $id));
        $this->conexion->cerrar();
        $HorarioAs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioAs, new HorarioA($resultado[0], $resultado[1], $resultado[2], "", "", ""));
        }
        return $HorarioAs;
    }
    
    function consultarMas(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarMas());
        $this->conexion->cerrar();
        $HorarioAs = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($HorarioAs, new HorarioA("", "", "", $resultado[0], $resultado[1], $resultado[2]));
        }
        return $HorarioAs;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function validarCantidadMaterias($codigo){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->validarCantidadMaterias($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function consultarTotalRegistrosA($codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarTotalRegistrosA($codigo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }

    function consultarTotalRegistros1()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->HorarioADAO->consultarTotalRegistros1());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
    
    function eliminar($codigo,$materia){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutarM($this -> HorarioADAO -> eliminar($codigo,$materia));
        $this -> conexion -> cerrar();
    }  
}
?>