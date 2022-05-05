<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$alumno = new Alumno($_SESSION["id"]);
$alumno->consultar();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand"
		href="index.php?pid=<?php echo base64_encode("presentacion/sesionAlumno.php")?>"><i
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
					Horario </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/horario/consultarHorarioA.php")?>">Consultar
						Horario</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
					Trabajo </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/trabajo/consultarTrabajo.php")?>">Consultar
						trabajos</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
					Cursos </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/cursos/consultarInfoCursosA.php")?>">Cursos</a>
				</div></li>
				<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
					Notas </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/nota/consultarNotas.php")?>">Consultar notas</a>
						<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/nota/notasMaterias.php")?>">Consultar notas finales</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
          Alumno: <?php echo $alumno -> getNombre()?>
        </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/alumno/editarAlumno.php")."&idAlumno=".$_SESSION["id"]?>">Editar
						Perfil</a> <a class="dropdown-item" href="index.php?sesion=0">Cerrar
						Sesión</a>
				</div></li>
		</ul>

	</div>
</nav>
