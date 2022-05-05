<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$creado = false;
if (isset($_POST["crear"])) {
    $horario_existe = new HorarioA($_POST["codigoA"], $_POST["codigo"], $_POST["grupo"]);
    $horario_existe->consultar();
    if ($_POST["codigoA"] == $horario_existe->getCodigo_FK() && $_POST["codigo"] == $horario_existe->getCodigoM_FK1()) {
        echo "<script>alert('La materia ya se encuentra registrada');</script>";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/materia/consultarMateria.php") . "&i=" . "0" . "&idAlumno=" . $_GET["idAlumno"] . "&semestre_curso=" . $_GET["semestre"] .  "';\",50);</script>";
        $creado = false;
    } else {
        $materia = new HorarioM();
        $horarios = $materia -> asignarHorario($_POST["codigo"], $_POST["grupo"]);
        foreach ($horarios as $horarioActual){
            $horario = new HorarioA($_POST["codigoA"], $_POST["codigo"], $_POST["grupo"], $horarioActual->getDia(), $horarioActual->getHora_ini(), $horarioActual->getHora_fin());
            $horario->crear();
        }
        $alumnomateria = new Alumnocurso($_POST["codigoA"], $_POST["codigo"], $_POST["grupo"],"0"); 
        $alumnomateria->crear();
        $actualizar = new curso($_POST["codigo"], $_POST["grupo"]);
        $actualizar->consultar();
        $actualizar -> actualizar($actualizar->getCantidad_estudiantes()+1, $actualizar->getCupos_disponibles()-1, $_POST["codigo"], $_POST["grupo"]);
        if ($actualizar->getId_Docente()!="1"){
            $docentealumno = new Docentealumno($actualizar->getId_Docente(),$_GET["idAlumno"]);
            $docentealumno->crear();
        }
        $creado = true;
    }
}
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h3>Asignar horario alumno</h3>
				</div>
				<div class="card-body">
    					<?php if ($creado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
            echo "Datos ingresados";
            echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "';\",1500);</script>";
            ?>
    						</div>
    					<?php } ?>
    					<form
						action="<?php echo "index.php?pid=" . base64_encode("presentacion/horario/crearHorarioA.php") . "&codigo=" . $_GET["codigo"] . "&idMateria=" .  $_GET["idMateria"] . "&i=" . $_GET["i"] . "&idAlumno=" . $_GET["idAlumno"] . "&semestre=" . $_GET["semestre"] . "&idDocente=" . $_GET["&idDocente"] ?>"
						method="post">
    					<div class="form-group" style="margin: 5px;">
						    <div class="input-group">
    						    <input type="text" name="codigoA" class="form-control" placeholder="Codigo estudiantil: " disabled>
    						    <input type="text" name="codigoA" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["idAlumno"]?>" disabled>
							</div>
        				</div>
						<div class="form-group" style="margin: 5px;">
							<input type="hidden" name="codigoA" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["idAlumno"]?>">
						</div>
						<div class="form-group" style="margin: 5px;">
						    <div class="input-group">
    						    <input type="text" name="codigoA" class="form-control" placeholder="Codigo de la materia: " disabled>
    						    <input type="text" name="codigo" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["idMateria"]?>"
								disabled>
							</div>
        				</div>
						<div class="form-group" style="margin: 5px;">
							<input type="hidden" name="codigo" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["idMateria"]?>">
						</div>
						<div class="form-group" style="margin: 5px;">
						    <div class="input-group">
    						    <input type="text" name="codigoA" class="form-control" placeholder="Grupo: " disabled>
    						    <input type="text" name="grupo" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["codigo"]?>"
								disabled>
							</div>
        				</div>
						<div class="form-group" style="margin: 5px;">
							<input type="hidden" name="grupo" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["codigo"]?>">
						</div>
						<button type="submit" name="crear" class="btn btn-primary">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>