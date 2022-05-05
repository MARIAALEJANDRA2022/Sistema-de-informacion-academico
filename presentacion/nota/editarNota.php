<?php
if ($_SESSION["rol"] == "docente"){
$t = new Trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["idTrabajo"], $_GET["idAlumno"]);
$t->consultar();
$materia = new curso($_GET["codigoM"]);
$materia->consultar();
$idM = $materia->getNombre();
$docente = new Docente($_SESSION["id"]);
$docente->consultar();
$asignar = new Asignar_trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["idTrabajo"]);
$asignar->consultar();
$editado = false;
if (isset($_POST["editar"])) {
    $trabajo = new Trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["idTrabajo"], $_GET["idAlumno"]);
    $trabajo->actualizarNota($_POST["nota"]);
    $nota = new Nota($_GET["codigoM"], $_GET["grupo"], $_GET["idTrabajo"], $_GET["idAlumno"]);
    $nota ->editar($_POST["nota"]);
    $editado = true;
}
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
				<?php if ($editado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
        echo "Nota editada";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/nota/consultarNotas.php") .  "&materia=" . $_GET["codigoM"] . "&grupo=" . $_GET["grupo"] . "';\",1500);</script>";
        ?>
    						</div>
    					<?php } ?>
					<h2>
						<b> <?php echo $idM?> </b>
					</h2>
					<h4>
						<b><?php echo $asignar->getTrabajo() . ": " . $_GET["idTrabajo"] ?></b>
					</h4>
					<h6><?php echo  $docente->getNombre() . " | " . $asignar->getFecha_asignacion() ?></h6>		
					<?php
                    $t = new Trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["idTrabajo"], $_GET["idAlumno"]);
                    $t->consultar();
                        ?>	
						<form
							action="<?php echo "index.php?pid= " . base64_encode("presentacion/nota/editarNota.php") . "&codigoM=" . $_GET["codigoM"] . "&grupo=" . $_GET["grupo"] . "&idTrabajo=" . $_GET["idTrabajo"] . "&trabajo=" . $_GET["trabajo"] . "&idAlumno=" . $_GET["idAlumno"]?>"
							method="post">
							<div class="form-group" style="margin: 5px;">
							    <div class="input-group">
    								<input type="text" name="nota" class="form-control" placeholder="<?php echo $t->getNota()?>" pattern="[10-50]{2}" title="Ingrese una nota valida (Entre 10 y 50)"  required="required">
    								<input type="text" name="texto" class="form-control" placeholder="<?php echo "/50 | " . $asignar->getFecha_entrega()?>"disabled>
    								<button type="submit" name="editar" class="btn btn-primary">
									    <b> EDITAR NOTA </b>
								    </button>
								</div>
							</div>
						</form>	
				</div>
				<div class="card-body">
					<h5> <?php echo $asignar->getDescripcion() ?></h5>
				</div>
				<br>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card" style="height: 300px;">
				<div class="card-header">
					<h3>
						<b> <?php
						echo $t->getEstado()?>
                        </b>
					</h3>
				</div>
				<div class="card-body text-center">
    				<iframe src="<?php echo $t->getTrabajo()?>" width="100%" height="100%"></iframe>
				</div>
			</div>
			<br>
			<div class="col-lg-12 d-flex justify-content-center">
				<div class="card">
					<div class="card-header" style="height: 50px;">
						<h3>
							<b> <?php
                            echo "Observacion"?>
                        </b>
						</h3>
					</div>
					<div class="card-body" style="height: 50px;">
						<h5><?php echo $t->getObservacion()?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>        