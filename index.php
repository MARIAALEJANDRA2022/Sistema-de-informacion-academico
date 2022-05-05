<?php
session_start();
require "logica/Administrador.php";
require "logica/Alumno.php";
require "logica/Asignar_trabajo.php";
require "logica/Alumnocurso.php";
require "logica/cambioClave.php";
require "logica/carrera_grado.php";
require "logica/curso.php";
require "logica/Docente.php";
require "logica/Docentealumno.php";
require "logica/HorarioA.php";
require "logica/HorarioD.php";
require "logica/HorarioM.php";
require "logica/LugarNacimiento.php";
require "logica/Materia.php";
require "logica/MunicipioResidencia.php";
require "logica/Nacionalidad.php";
require "logica/Nota.php";
require "logica/TelefonoAd.php";
require "logica/TelefonoAl.php";
require "logica/TelefonoD.php";
require "logica/Trabajo.php";
require "persistencia/Conexion.php";
require "logica/chat.php";
$pagSinSesion=array(
    "presentacion/recuperarClave.php",
    "presentacion/enviarCorreo.php",
    "presentacion/autenticar.php",
    "presentacion/cambiarContrasena.php"
);
if(isset($_GET["sesion"])&&$_GET["sesion"]==0){
    $_SESSION["id"]=null;
}
$pid=null;
if(isset($_GET["pid"])){
    $pid = base64_decode($_GET["pid"]);
}
?>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />
<link href="https://bootswatch.com/5/yeti/bootstrap.css"
	rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script
	src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script
	src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script
	src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript"
	src="https://www.gstatic.com/charts/loader.js"></script>
<title>SISTEMA DE INFORMACI&OacuteN ACAD&EacuteMICO</title>
<link rel="icon" type="image/jpg" href="img/img1.JPG">
<script type="text/javascript">
$(function(){
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
</head>
<body>
<?php if(isset($pid)){
    if(isset($_SESSION["id"])){
        if ($_SESSION["rol"]=="administrador"){
            include"presentacion/menuAdministrador.php";
        }elseif($_SESSION["rol"]=="alumno"){
            include"presentacion/menuAlumno.php";
        }elseif($_SESSION["rol"]=="docente"){
            include"presentacion/menuDocente.php";
        }
        include $pid;
    }elseif(in_array($pid,$pagSinSesion)){
        include $pid;
    }else{ ?>
        <script>location.replace("index.php");</script>
<?php }
}else{
    include"presentacion/inicio.php";
}
?>
</body>
</html>