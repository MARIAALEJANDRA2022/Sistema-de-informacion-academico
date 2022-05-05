<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$creado = false;
if (isset($_POST["crear"])) {
    $horario_existe = new HorarioD($_POST["codigoD"], $_POST["codigo"], $_POST["grupo"]);
    $horario_existe->consultar();
    if ($_POST["codigoD"] == $horario_existe->getCodigo_FK() && $_POST["codigo"] == $horario_existe->getCodigoM_FK1()) {
        echo "<script>alert('El curso ya se encuentra registrado');</script>";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/materia/consultarMateria.php") . "&semestre_curso" . $_GET["semestre"] . "&i=" . $_GET["id"] . "&idDocente=" . $_GET["idDocente"] . "';\",50);</script>";
        $creado = false;
    } else {
        $materia = new HorarioM();
        $horarios = $materia -> asignarHorario($_POST["codigo"], $_POST["grupo"]);
        foreach ($horarios as $horarioActual){
            $horario = new HorarioD($_POST["codigoD"],$_POST["codigo"], $_POST["grupo"], $horarioActual->getDia(), $horarioActual->getHora_ini(), $horarioActual->getHora_fin());
            $horario->crear();
        }
        $alumnomateria = new Alumnocurso($_POST["codigo"], $_POST["grupo"]);
        $alumnos=$alumnomateria->consultarA();
        foreach ($alumnos as $a){
            if ($a->getCodigo_FK() != ""){
                $docentealumno = new docentealumno($a->getCodigo_FK(),$_POST["codigoD"]);
                $docentealumno->crear();
            }
        }
        $actualizarIdCurso = new curso();
        $actualizarIdCurso -> actualizarIdDocente($_POST["codigoD"], $_POST["codigo"], $_POST["grupo"]);
        $eliminarP = new HorarioD();
        $eliminarP -> eliminarP($_SESSION["id"]);
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
					<h3>Asignar horario docente</h3>
				</div>
				<div class="card-body">
    					<?php if ($creado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
            echo "Datos ingresados";
            echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioD.php") . "';\",1500);</script>";
            ?>
    						</div>
    					<?php } ?>
    					<form
						action="<?php echo "index.php?pid=" . base64_encode("presentacion/horario/crearHorarioD.php") . "&codigo=" . $_GET["codigo"] . "&idMateria=" .  $_GET["idMateria"] . "&i=" . $_GET["i"] . "&idAlumno=" . $_GET["idAlumno"] . "&semestre=" . $_GET["semestre"] . "&idDocente=" . $_GET["&idDocente"]?>"
						method="post">
    					<div class="form-group" style="margin: 5px;">
						    <div class="input-group">
    						    <input type="text" name="codigoA" class="form-control" placeholder="Codigo del docente: " disabled>
    						    <input type="text" name="codigoD" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["idDocente"]?>"
								disabled>
							</div>
        				</div>
						<div class="form-group" style="margin: 5px;">
							<input type="hidden" name="codigoD" class="form-control"
								placeholder="Codigo" value="<?php echo $_GET["idDocente"]?>">
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