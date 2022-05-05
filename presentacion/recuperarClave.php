<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$enviado = false;
if (isset($_POST["enviar"])) {
    $alumno = new Alumno();
    $correoAlumno = $alumno->consultarCorreo($_POST["correoI"]);
    $docente = new Docente();
    $correoDocente = $docente->consultarCorreo($_POST["correoI"]);
    if ($correoAlumno == $_POST["correoI"]) {
        $nombre = $alumno->consultarNombre($_POST["correoI"]);
        $enviado = true;
    } elseif ($correoDocente == $_POST["correoI"]){
        $nombre = $docente->consultarNombre($_POST["correoI"]);
        $enviado = true;
    } else {
        $enviado = false;
        echo "<script>alert('El correo no se encuentra registrado');</script>";
    }
}
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-3"></div>
		<div class="col-7">
			<div class="card">
				<div class="card-header">
					<h3>SOLICITUD CAMBIO DE CONTRASE&#209;A</h3>
				</div>
				<div class="card-body">
    					<?php if ($enviado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
                            echo "<script>alert('Datos enviados');window.location = 'index.php?pid=" . base64_encode("presentacion/enviarCorreo.php") . "&correoI=" . $_POST["correoI"] . "&nombre=" . $nombre . "';</script>";
            ?>
    						</div>
    					<?php } ?>    					
    					<form
						action=<?php echo "index.php?pid=" . base64_encode("presentacion/recuperarClave.php") ?>
						method="post" class="form_contact">
						<div class="form-group">
							<input type="text" name="correoI" class="form-control"
								placeholder="Correo institucional" required="required">
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

