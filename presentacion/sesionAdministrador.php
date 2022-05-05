<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "administrador") {
    $administrador = new Administrador($_SESSION["id"]);
    $administrador->consultar();
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
						<strong>Administrador: </strong> <?php echo $administrador -> getNombre()?></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }else{
    echo "Lo siento. Usted no tiene permisos";
}?>