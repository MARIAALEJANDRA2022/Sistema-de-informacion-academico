<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "alumno") {
    $t = new Trabajo($_GET["materia"], $_GET["grupo"], $_GET["id"], $_SESSION["id"]);
    $t->consultar();
    $docentemateria = new curso($_GET["materia"], $_GET["grupo"]);
    $docentemateria -> consultar();
    $docente = new Docente ($docentemateria->getID_Docente());
    $docente->consultar();
    $error = 0;    
    if (isset($_POST["anular"])) {
        $t = new Trabajo($_GET["materia"], $_GET["grupo"], $_GET["id"], $_SESSION["id"]);
        $t->eliminar();
        echo "<script>alert('Entrega anulada');</script>";
        
    } elseif (isset($_POST["uploadBtn"])) {
        $documento = $_FILES["uploadedFile"];
        $tipo = $documento["type"];        
        if ($tipo == "application/pdf") {
            $urlServidor = "documentos/" . $documento["name"];
            $urlLocal = $documento["tmp_name"];
            copy($urlLocal, $urlServidor);
            date_default_timezone_set('America/Bogota');
            if (date('Y-m-d') > $_GET["fechaE"]) {
                $trabajo = new Trabajo($_GET["materia"], $_GET["grupo"], $_GET["id"], $_SESSION["id"], $urlServidor, "Entregado con retraso", date('Y-m-d'), 0, "");
                $trabajo->consultar();
                $trabajo->crear();
            } else {
                $trabajo = new Trabajo($_GET["materia"], $_GET["grupo"], $_GET["id"], $_SESSION["id"], $urlServidor, "Entregado", date('Y-m-d'), 0,"");
                $trabajo->consultar();
                $trabajo->crear();
            }
        } else {
            $error = 1;
        }
    }
    ?>
<div class="container">
	<div class="row mt-3">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
					<?php if (isset($_POST["uploadBtn"]) && $error == 0) { ?>						
    					<div class="alert alert-success alert-dismissible fade show"
						role="alert">
                			<?php
        echo "Trabajo subido";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "';\",1500);</script>";
        ?>
            			</div>
    				<?php } elseif(isset($_POST["uploadBtn"]) && $error == 1) { ?>
    					<div class="alert alert-danger alert-dismissible fade show"
						role="alert">
						<strong>Error. El archivo debe ser .pdf</strong>
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
    				<?php }?>
					<h2>
						<b> <?php echo $_GET["nombreM"] ?> </b>
					</h2>
					<h4>
						<b><?php echo $_GET["nombre"] . ": " . $_GET["id"] ?></b>
					</h4>
					<h6><?php echo  $docente->getNombre() . " | " . $_GET["fechaA"] ?></h6>		
					<?php
    if ($t->getEstado() == "" || $t->getEstado() == "Entregado" || $t->getEstado() == "Entregado con retraso") {
        ?>	
						<h6><?php echo "0/50" . " | " . "Fecha de entrega: " . $_GET["fechaE"] ?></h6>
					<?php }else{?>
					   <h6><?php

        echo $t->getNota() . "/50" . " | " . "Fecha de
						entrega: " . $_GET["fechaE"]?></h6>
					<?php } ?>
				</div>
				<div class="card-body">
					<h5> <?php echo $_GET["descripcion"] ?></h5>
				</div>
				<br>
			</div>
		</div>
		<div class="col-lg-6">
		<?php  if ($t->getEstado() == "Entregado" || $t->getEstado() == "Entregado con retraso") { ?>
			<div class="card" style="height: 400px;">
		<?php }else{?>
			<div class="card">
		<?php }?>
				<div class="card-header">
						<h3>
							<b> <?php
    if ($t->getEstado() == "") {
        echo "Sin entregar";
    } else {
        echo $t->getEstado();
    }
    ?></b>
						</h3>
					</div>
					<div class="card-body text-center">
				<?php
				
	            if ($t->getEstado() == ""){  ?>
					<form method="POST"
							action="<?php echo "index.php?pid= " . base64_encode("presentacion/trabajo/trabajoAlumno.php") . "&materia=" . $_GET["materia"] . "&grupo=" . $_GET["grupo"] . "&nombreM=" . $_GET["nombreM"] . "&id=" . $_GET["id"] . "&nombre=" . $_GET["nombre"] . "&fechaA=" . $_GET["fechaA"] . "&fechaE=" . $_GET["fechaE"] . "&descripcion=" . $_GET["descripcion"] ?>"
							enctype="multipart/form-data">
							<div>
								<input type="file" name="uploadedFile" class="form-control-file"
									required="required">
							</div>
							<br>
							<button type="submit" name="uploadBtn" class="btn btn-primary">
								<b> ENTREGAR </b>
							</button>
					</form>
					
    				<?php }elseif ($t->getEstado() == "Entregado" || $t->getEstado() == "Entregado con retraso") {?>
    						<iframe src="<?php echo $t->getTrabajo()?>" width="100%" height="80%"></iframe>
					<form method="post"
							action="<?php echo "index.php?pid= " . base64_encode("presentacion/trabajo/trabajoAlumno.php") . "&materia=" . $_GET["materia"] . "&grupo=" . $_GET["grupo"] . "&nombreM=" . $_GET["nombreM"] . "&id=" . $_GET["id"] . "&nombre=" . $_GET["nombre"] . "&fechaA=" . $_GET["fechaA"] . "&fechaE=" . $_GET["fechaE"] . "&descripcion=" . $_GET["descripcion"] . "&estado=" . "Sin entregar"?>">
							<br>
							<button type="submit" name="anular" class="btn btn-primary">
								<b> ANULAR ENTREGA </b>
							</button>
					</form>
    			<?php
    } elseif ($t->getEstado() == "Calificado") {?>
    						<iframe src="<?php echo $t->getTrabajo()?>" width="100%" height="100%"></iframe>
    			<?php }?>
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
							<h5> <?php echo $t ->getObservacion() ?></h5>
						</div>
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