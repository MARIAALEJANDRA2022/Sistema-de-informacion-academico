<?php
require "persistencia/AlumnoDAO.php";

class Alumno
{

    private $Codigo;

    private $Nombre;

    private $CorreoP;

    private $ID_proyecto;
    
    private $Semestre_curso;

    private $CorreoI;

    private $Contrasena;

    private $Numero_ID;

    private $Fecha_ID;

    private $TipoSangre;

    private $RH;

    private $Direccion;

    private $FechaNacimiento;

    private $ID_Nacionalidad;

    private $ID_LugarNacimiento;

    private $ID_MunicipioResidencia;
    
    private $Estado;

    private $conexion;

    private $AlumnoDAO;

    public function getCodigo()
    {
        return $this->Codigo;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getCorreoP()
    {
        return $this->CorreoP;
    }

    public function getID_proyecto()
    {
        return $this->ID_proyecto;
    }
    
    public function getSemestre_curso(){
        return $this->Semestre_curso;
    }

    public function getCorreoI()
    {
        return $this->CorreoI;
    }

    public function getContrasena()
    {
        return $this->Contrasena;
    }

    public function getNumero_ID()
    {
        return $this->Numero_ID;
    }

    public function getFecha_ID()
    {
        return $this->Fecha_ID;
    }

    public function getTipoSangre()
    {
        return $this->TipoSangre;
    }

    public function getRH()
    {
        return $this->RH;
    }

    public function getDireccion()
    {
        return $this->Direccion;
    }

    public function getFechaNacimiento()
    {
        return $this->FechaNacimiento;
    }

    public function getID_Nacionalidad()
    {
        return $this->ID_Nacionalidad;
    }

    public function getID_LugarNacimiento()
    {
        return $this->ID_LugarNacimiento;
    }

    public function getID_MunicipioResidencia()
    {
        return $this->ID_MunicipioResidencia;
    }
    
    public function getEstado(){
        return $this->Estado;
    }

    function Alumno($pCodigo = "", $pNombre = "", $pCorreoP = "", $pID_proyecto = "", $pSemestre_curso = "", $pCorreoI = "", $pContrasena = "", $pNumero_ID = "", $pFecha_ID = "", $pTipoSangre = "", $pRH = "", $pDireccion = "", $pFechaNacimiento = "", $pID_Nacionalidad = "", $pID_LugarNacimiento = "", $pID_MunicipioResidencia = "", $pEstado = "")
    {
        $this->Codigo = $pCodigo;
        $this->Nombre = $pNombre;
        $this->CorreoP = $pCorreoP;
        $this->ID_proyecto = $pID_proyecto;
        $this->Semestre_curso = $pSemestre_curso;
        $this->CorreoI = $pCorreoI;
        $this->Contrasena = $pContrasena;
        $this->Numero_ID = $pNumero_ID;
        $this->Fecha_ID = $pFecha_ID;
        $this->TipoSangre = $pTipoSangre;
        $this->RH = $pRH;
        $this->Direccion = $pDireccion;
        $this->FechaNacimiento = $pFechaNacimiento;
        $this->ID_Nacionalidad = $pID_Nacionalidad;
        $this->ID_LugarNacimiento = $pID_LugarNacimiento;
        $this->ID_MunicipioResidencia = $pID_MunicipioResidencia;
        $this->Estado = $pEstado;
        $this->conexion = new Conexion();
        $this->AlumnoDAO = new AlumnoDAO($pCodigo, $pNombre, $pCorreoP, $pID_proyecto, $pSemestre_curso, $pCorreoI, $pContrasena, $pNumero_ID, $pFecha_ID, $pTipoSangre, $pRH, $pDireccion, $pFechaNacimiento, $pID_Nacionalidad, $pID_LugarNacimiento, $pID_MunicipioResidencia, $pEstado);
    }

    function consultarCorreo($correo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->consultarCorreo($correo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }

    function editarClave($clave, $correo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->editarClave($clave, $correo));
        $this->conexion->cerrar();
    }

    function crear()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->crear());
        $this->conexion->cerrar();
    }
    
    function cambiarEstado($estado){        
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AlumnoDAO -> cambiarEstado($estado));
        $this -> conexion -> cerrar();
    }

    function autenticar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->autenticar());
        $this->conexion->cerrar();
        if ($this->conexion->numFilas() == 1) {
            $this->Codigo = $this->conexion->extraer()[0];
            return true;
        } else {
            return false;
        }
    }

    function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Nombre = $resultado[0];
        $this->CorreoP = $resultado[1];
        $this->ID_proyecto = $resultado[2];
        $this->Semestre_curso = $resultado[3];
        $this->CorreoI = $resultado[4];
        $this->Contrasena = $resultado[5];
        $this->Numero_ID = $resultado[6];
        $this->Fecha_ID = $resultado[7];
        $this->TipoSangre = $resultado[8];
        $this->RH = $resultado[9];
        $this->Direccion = $resultado[10];
        $this->FechaNacimiento = $resultado[11];
        $this->ID_Nacionalidad = $resultado[12];
        $this->ID_LugarNacimiento = $resultado[13];
        $this->ID_MunicipioResidencia = $resultado[14];
        $this->Estado = $resultado[15];
    }
    
    function consultarE()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->consultarE());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->Codigo = $resultado[0];
    }


    function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->editar());
        $this->conexion->cerrar();
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->consultarPorPagina($cantidad, $pagina, $orden, $dir));
        $this->conexion->cerrar();
        $alumnos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($alumnos, new Alumno($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6], $resultado[7], $resultado[8], $resultado[9], $resultado[10], $resultado[11], $resultado[12], $resultado[13], $resultado[14], $resultado[15], $resultado[16]));
        }
        return $alumnos;
    }

    function consultarPorPagina1($cantidad, $pagina, $orden, $dir, $codigo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->consultarPorPagina1($cantidad, $pagina, $orden, $dir, $codigo));
        $this->conexion->cerrar();
        $alumnos = array();
        while (($resultado = $this->conexion->extraer()) != null) {
            array_push($alumnos, new Alumno($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6], $resultado[7], $resultado[8], $resultado[9], $resultado[10], $resultado[11], $resultado[12], $resultado[13], $resultado[14], $resultado[15], $resultado[16]));
        }
        return $alumnos;
    }

    function consultarTotalRegistros()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->consultarTotalRegistros());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }

    function eliminar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutarM($this->AlumnoDAO->eliminar());
        $this->conexion->cerrar();
    }

    function consultarNombre($correo)
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->AlumnoDAO->consultarNombre($correo));
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        return $resultado[0];
    }
}
?>