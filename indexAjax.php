<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script type="text/javascript">
$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
<?php 
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

$pid = base64_decode($_GET["pid"]);
include $pid;
?>