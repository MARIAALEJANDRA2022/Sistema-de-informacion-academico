<?php
if ($_SESSION["rol"] == "docente"){
$t = new Trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["id"], $_GET["idAlumno"]);
$t->consultar();
$materia = new curso($_GET["codigoM"]);
$materia->consultar();
$idM = $materia->getNombre();
$docente = new Docente($_SESSION["id"]);
$docente->consultar();
$asignar = new Asignar_trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["id"]);
$asignar->consultar();
$calificado = false;
if (isset($_POST["calificar"])) {
    $trabajo = new Trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["id"], $_GET["idAlumno"]);
    $trabajo->editar($_POST["nota"], $_POST["obs"], "Calificado");
    $nota = new Nota($_GET["codigoM"], $_GET["grupo"], $_GET["id"], $t->getTrabajo(), $_GET["idAlumno"], $_POST["nota"]);
    $nota ->crear();
    $calificado = true;
}
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
				<?php if ($calificado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
        echo "Trabajo calificado";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "';\",1500);</script>";
        ?>
    						</div>
    					<?php } ?>
					<h2>
						<b> <?php echo $idM?> </b>
					</h2>
					<h4>
						<b><?php echo $asignar->getTrabajo() . ": " . $_GET["id"] ?></b>
					</h4>
					<h6><?php echo  $docente->getNombre() . " | " . $asignar->getFecha_asignacion() ?></h6>		
					<?php
    $t = new Trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["id"], $_GET["idAlumno"]);
    $t->consultar();
    if ($_GET["estado"] == "" || $_GET["estado"] == "Entregado" || $_GET["estado"] == "Entregado con retraso") {
        ?>	
						<h6><?php echo "0/50" . " | " . "Fecha de entrega: " . $asignar->getFecha_entrega() ?></h6>
					<?php }else{?>
					   <h6><?php

        echo $t->getNota() . "/50" . " | " . "Fecha de
						entrega: " . $asignar->getFecha_entrega()?></h6>
					<?php } ?>
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
						echo $_GET["estado"]?>
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
					<?php if ($t->getObservacion() == ""){?>
					<div class="card-body" style="height: 150px;">
						<form
							action="<?php echo "index.php?pid= " . base64_encode("presentacion/trabajo/calificarTrabajo.php") . "&codigoM=" . $_GET["codigoM"] . "&grupo=" . $_GET["grupo"] . "&id=" . $_GET["id"] . "&idAlumno=" . $_GET["idAlumno"] . "&estado=" . $_GET["estado"]?>"
							method="post">
							<div class="form-group" style="margin: 5px;">
								<input type="number" name="nota" class="form-control" placeholder="Escribir la calificacion" pattern="[0-9]{1,2}" title="Ingrese una nota valida (Entre 0 y 50)" min="0" max="50" required="required">
							</div>
							<div class="form-group" style="margin: 5px;">
								<input type="text" name="obs" class="form-control" pattern="[A-Za-z,. ]{4,100}" title="Ingrese una onservacion valida (Entre 4 y 100 caracteres)" placeholder="Escribir la observacion" required="required">
							</div>
							<div class="text-center">
								<button type="submit" name="calificar" class="btn btn-primary">
									<b> CALIFICAR </b>
								</button>
							</div>
						</form>					
						<?php }else{ ?>
							<div class="card-body" style="height: 50px;">
							<h5> <?php echo $t ->getObservacion() ?></h5>
						</div>
						<?php }?>
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