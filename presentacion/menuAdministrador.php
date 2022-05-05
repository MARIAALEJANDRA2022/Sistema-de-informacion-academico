<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$administrador = new Administrador($_SESSION["id"]);
$administrador->consultar();
$materia = new Materia();
$materias = $materia->consultarTotalRegistros();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand"
		href="index.php?pid=<?php echo base64_encode("presentacion/sesionAdministrador.php")?>"><i
		class="fas fa-home"></i></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
					Alumno</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/alumno/consultarAlumno.php")?>">Consultar</a>
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/alumno/crearAlumno.php")?>">Crear</a>
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/horario/consultarHorarioA.php")?>">Consultar
						horarios</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
					Docente </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/docente/consultarDocente.php")?>">Consultar</a>
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/docente/crearDocente.php")?>">Crear</a>
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/horario/consultarHorarioD.php")?>">Horarios</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
					Materia </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/materia/consultarMateria.php") . "&i=" . "2" ?>">Consultar</a>
					    <a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/materia/crearMateria.php")?>">Crear</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
					Cursos </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&i=" . "2" . "&semestre=" . "" . "&idMateria=" . "" ?>">Cursos</a>
						<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/horario/consultarHorarioM.php")?>">Consultar
						horarios</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
              Administrador: <?php echo $administrador -> getNombre()?>
            </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/administrador/editarAdministrador.php")."&idAdministrador=".$_SESSION["id"]?>">Editar
						Perfil</a> <a class="dropdown-item" href="index.php?sesion=0">Cerrar
						Sesión</a>
				</div></li>
		</ul>
	</div>
</nav>
