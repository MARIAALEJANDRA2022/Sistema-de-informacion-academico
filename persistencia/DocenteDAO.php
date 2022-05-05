<?php

class DocenteDAO
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

    function DocenteDAO($pCodigo, $pNombre, $pCorreoP, $pID_proyecto, $pSemestre_curso, $pCorreoI, $pContrasena, $pNumero_ID, $pFecha_ID, $pTipoSangre, $pRH, $pDireccion, $pFechaNacimiento, $pID_Nacionalidad, $pID_LugarNacimiento, $pID_MunicipioResidencia, $pEstado)
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
    }

    function crear()
    {
        return "insert into docente(codigo, Nombre, CorreoP, ID_proyecto, Semestre_curso, CorreoI, Contrasena, Numero_ID, Fecha_ID, TipoSangre, RH, Direccion, FechaNacimiento, ID_Nacionalidad, ID_LugarNacimiento,
                ID_MunicipioResidencia, Estado)
                values ('" . $this->Codigo . "','" . $this->Nombre . "', '" . $this->CorreoP . "',
                '" . $this->ID_proyecto . "','" . $this->Semestre_curso . "','" . $this->CorreoI . "','" . md5($this->Contrasena) . "','" . $this->Numero_ID . "','" . $this->Fecha_ID . "','" . $this->TipoSangre . "','" . $this->RH . "','" . $this->Direccion . "','" . $this->FechaNacimiento . "','" . $this->ID_Nacionalidad . "','" . $this->ID_LugarNacimiento . "','" . $this->ID_MunicipioResidencia . "','" . $this->Estado . "')";
    }

    function autenticar()
    {
        return "SELECT Codigo FROM docente WHERE CorreoI='" . $this->CorreoI . "' AND Contrasena = md5('" . $this->Contrasena ."') ";
    }

    function consultar()
    {
        return "select Nombre, CorreoP, ID_proyecto, Semestre_curso, CorreoI, Contrasena, Numero_ID, Fecha_ID, TipoSangre, RH, Direccion, FechaNacimiento, ID_Nacionalidad, ID_LugarNacimiento, ID_MunicipioResidencia, Estado
            from docente
            where Codigo = '" . $this->Codigo . "'";
    }
    
    function consultarE()
    {
        return "select Codigo
                from docente
                where Codigo = '" . $this->Codigo . "'";
    }

    function editar()
    {
        return "update docente
                set Nombre = '" . $this->Nombre . "', CorreoP = '" . $this->CorreoP . "', 
                ID_proyecto = '" . $this->ID_proyecto . "', Semestre_curso = '" . $this->Semestre_curso . "', 
                CorreoI = '" . $this->CorreoI . "', Contrasena = '" . $this->Contrasena . "', 
                Numero_ID = '" . $this->Numero_ID . "', Fecha_ID = '" . $this->Fecha_ID . "', 
                TipoSangre = '" . $this->TipoSangre . "', RH = '" . $this->RH . "', 
                Direccion = '" . $this->Direccion . "', FechaNacimiento = '" . $this->FechaNacimiento . "', 
                ID_Nacionalidad = '" . $this->ID_Nacionalidad . "', 
                ID_LugarNacimiento = '" . $this->ID_LugarNacimiento . "', 
                ID_MunicipioResidencia = '" . $this->ID_MunicipioResidencia . "', Estado = '" . $this->Estado . "' 
                where Codigo = '" . $this->Codigo . "'";
    }

    function consultarPorPagina($cantidad, $pagina, $orden, $dir)
    {
        if ($orden == "" || $dir == "") {
            return "select Codigo, Nombre, CorreoP, ID_proyecto, Semestre_curso, CorreoI, Contrasena, Numero_ID, Fecha_ID, TipoSangre, RH, Direccion, FechaNacimiento, ID_Nacionalidad, ID_LugarNacimiento, 
                ID_MunicipioResidencia, Estado
                from docente
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        } else {
            return "select Codigo, Nombre, CorreoP, ID_proyecto, Semestre_curso, CorreoI, Contrasena, Numero_ID, Fecha_ID, TipoSangre, RH, Direccion, FechaNacimiento, ID_Nacionalidad, ID_LugarNacimiento, 
                ID_MunicipioResidencia, Estado
                from docente
                order by " . $orden . " " . $dir . "
                limit " . strval(($pagina - 1) * $cantidad) . ", " . $cantidad;
        }
    }

    function consultarTotalRegistros()
    {
        return "select count(Codigo)
                from docente";
    }

    function eliminar()
    {
        return "delete from docentemateria where Codigo_FK = '" . $this->Codigo . "';
        delete from docentealumno where Codigo_FKD = '" . $this->Codigo . "';
        delete from horariod where Codigo_FK = '" . $this->Codigo . "';
        delete from telefonod where Codigo_FK = '" . $this->Codigo . "';
        delete from docente where Codigo = '" . $this->Codigo . "'";
    }

    function consultarCorreo($correo)
    {
        return "select CorreoI
                from docente where CorreoI = '" . $correo . "'";
    }

    function editarClave($clave, $correo)
    {
        return "update docente
                set Contrasena = '" . md5($clave) . "'
                where CorreoI = '" . $correo . "'";
    }

    function consultarNombre()
    {
        return "select Nombre
                from docente where Codigo = '" . $this -> Codigo . "'";
    }
    
    function cambiarEstado($estado) {
        return "update docente set Estado = '" . $estado . "' 
                where Codigo = '" . $this -> Codigo . "'";
    }
}
?>