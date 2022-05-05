<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$enviado = false;
if (isset($_POST["enviar"])) {
    $correoC = new cambioClave();
    $correo = $correoC->consultar();
    $alumno = new Alumno();
    $correoAlumno = $alumno->consultarCorreo($correo);
    $docente = new Docente();
    $correoDocente = $docente->consultarCorreo($correo);
    if ($_POST["clave"] == $_POST["clave1"]) {
        if ($correoAlumno == $correo) {
            $enviado = true;
            $alumno->editarClave($_POST["clave"], $correo);
            $correoC->eliminar($correo);
        } elseif ($correoDocente == $correo) {
            $enviado = true;
            $docente->editarClave($_POST["clave"], $correo);
            $correoC->eliminar($correo);
        } else {
            $enviado = false;
            echo "<script>alert('El correo no se encuentra registrado');</script>";
        }
    } else {
        $enviado = false;
        echo "<script>alert('Las claves no coinciden, intente de nuevo');</script>";
    }
}
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-3"></div>
		<div class="col-7; text-center">
			<div class="card">
				<div class="card-header">
					<h3>CAMBIO DE CONTRASE&#209;A</h3>
				</div>
				<div class="card-body">
    					<?php if ($enviado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
            echo "<script>alert('Datos enviados');window.location = 'index.php';</script>";
            ?>
    						</div>
    					<?php } ?>    					
    					<form
						araction=<?php echo "index.php?pid=" . base64_encode("presentacion/cambioContraseña.php") ?>
						method="post" class="form_contact">
						<div class="form-group">
							<input type="password" name="clave" class="form-control"
								placeholder="Contrase&#241;a nueva" required="required">
						</div>
						<div class="form-group">
							<input type="password" name="clave1" class="form-control"
								placeholder="Ingrese de nuevo la contrase&#241;a nueva"
								required="required">
						</div>
						<div class="form-group">
							<button type="submit" name="enviar"
								class="btn btn-primary btn-block">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>