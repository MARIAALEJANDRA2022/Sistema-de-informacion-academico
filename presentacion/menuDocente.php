<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$docente = new Docente($_SESSION["id"]);
$docente->consultar();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand"
		href="index.php?pid=<?php echo base64_encode("presentacion/sesionDocente.php")?>"><i
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
						href="index.php?pid= <?php echo base64_encode("presentacion/horario/consultarHorarioD.php")?>">Consultar
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
						href="index.php?pid= <?php echo base64_encode("presentacion/cursos/consultarInfoCursosD.php")?>">Cursos</a>
				</div></li>
			<li class="nav-item"><a class="nav-link dropdown-toggle" href="#"
				id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false" style="color: black;">
          Docente: <?php echo $docente -> getNombre()?>
        </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						href="index.php?pid= <?php echo base64_encode("presentacion/docente/editarDocente.php")."&idDocente=".$_SESSION["id"]?>">Editar
						Perfil</a> <a class="dropdown-item" href="index.php?sesion=0">Cerrar
						Sesión</a>
				</div></li>
		</ul>
	</div>
</nav>