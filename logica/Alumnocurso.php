<?php
require "persistencia/AlumnocursoDAO.php";

class Alumnocurso
{

    private $Codigo_FK;

    private $CodigoM;
    
    private $Grupo;

    private $Nota;

    private $conexion;

    private $AlumnocursoDAO;

    public function getCodigo_FK()
    {
        return $this->Codigo_FK;
    }

    public function getCodigoM()
    {
        return $this->CodigoM;
    }
    
    public function getGrupo()
    {
        return $this->Grupo;
    }
    
    public function getNota()
    {
        return $this->Nota;
    }

    function Alumnocurso($pCodigo_FK = "", $pCodigoM = "", $pGrupo = "", $pNota = "")
    {
        $this->Codigo_FK = $pCodigo_FK;
        $this->CodigoM = $pCodigoM;
        $this->Grupo = $pGrupo;
        $this->Nota = $pNota;
        $this->conexion = new Conexion();
        $this->AlumnocursoDAO = new AlumnocursoDAO($pCodigo_FK, $pCodigoM, $pGrupo, $pNota);
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->crear());
        $this->conexion->cerrar();
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->CodigoM = $resultado[0];
    }
    
    function consultarA()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->consultarA());
        $this->conexion->cerrar();
        $Alumnomaterias = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Alumnomaterias, new Alumnocurso($resultado[0], $resultado[1], $resultado[2], $resultado[3]));
        }
        return $Alumnomaterias;
    }
    
    function consultarNF(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->consultarNF());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Nota = $resultado[0];
    }

    function editar($nota)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->editar($nota));
        $this->conexion->cerrar();
    }
    
    function consultarPorPagina($cantidad, $pagina, $orden, $dir, $materia,$grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir, $materia,$grupo));
        $this->conexion->cerrar();
        $Alumnomaterias = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Alumnomaterias, new Alumnocurso($resultado[0], $resultado[1], $resultado[2], $resultado[3]));
        }
        return $Alumnomaterias;
    }
    
    function consultarPorPagina1($cantidad, $pagina, $orden, $dir, $id)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->consultarPorPagina1($cantidad, $pagina, $orden, $dir, $id));
        $this->conexion->cerrar();
        $Alumnomaterias = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($Alumnomaterias, new Alumnocurso($resultado[0], $resultado[1], $resultado[2], $resultado[3]));
        }
        return $Alumnomaterias;
    }

    function consultarTotalRegistros($materia,$grupo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->consultarTotalRegistros($materia,$grupo));
        $this->conexion->cerrar();
        return $resultado[0];
    }
    
    function consultarTotalRegistros1($id)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnocursoDAO->consultarTotalRegistros1($id));
        $this->conexion->cerrar();
        return $resultado[0];
    }
}
?>