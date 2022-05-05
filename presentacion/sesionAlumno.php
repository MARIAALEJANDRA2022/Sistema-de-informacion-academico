<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "alumno") {
    date_default_timezone_set('America/Bogota');
    $alumno = new Alumno($_SESSION["id"]);
    $alumno->consultar();
    ?>
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3>Bienvenido</h3>
				</div>
				<div class="card-body">
					<h4>
						<strong>Alumno: </strong> <?php echo $alumno -> getNombre()?></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }else{
    echo "Lo siento. Usted no tiene permisos";
}?>