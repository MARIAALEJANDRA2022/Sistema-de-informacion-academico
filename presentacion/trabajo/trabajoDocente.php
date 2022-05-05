<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "docente") {
    $asignado = false;
    if (isset($_POST["asignar"])) {
        $trabajo = new Asignar_trabajo($_POST["codigo"], $_POST["grupo"], $_POST["id"]);
        $trabajo -> consultar();
        if ($trabajo->getCodigoM_FK1()== $_POST["codigo"] && $trabajo->getGrupo()==$_POST["grupo"] && $trabajo->getID_Trabajo()==$_POST["id"]){
            echo "<script>alert('El trabajo ya se encuentra registrado');</script>";
            $asignado = false;
        }else{
            $trabajo = new Asignar_trabajo($_POST["codigo"], $_POST["grupo"], $_POST["id"], $_POST["nombre"], $_POST["fecha_asignacion"], $_POST["fecha_entrega"], $_POST["descripcion"]);
            $trabajo->crear();
            $asignado = true;
        }
    }
    ?>
<div class="container">
	<div class="row mt-3">
	    <div class="col-12">
	    <div class="card" style="width: 30rem;">
	        <div class="card-header">
	            <h2>Asignar trabajo</h2>
		<?php if ($asignado) { ?>							
			<div class="alert alert-success alert-dismissible fade show"
			role="alert">
				<?php
        echo "Datos ingresados";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "';\",90);</script>";
        ?>
    		</div>
    	<?php } ?>		
    	</div>
    	<div class="card-body" style="text-align:center">
    	<form
			action="<?php echo "index.php?pid=" . base64_encode("presentacion/trabajo/trabajoDocente.php") . "&codigo=" . $_GET["codigo"] . "&grupo=" . $_GET["grupo"] . "&materia=" . $_GET["materia"] ?>"
			method="post">
			<div class="col-lg-8">
				 <div class="form-group" style="margin: 5px;">
					<input type="text" class="form-control" placeholder="Codigo de la materia: <?php echo $_GET["codigo"] ?>" disabled> 
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="hidden" name="codigo" class="form-control" value="<?php echo $_GET["codigo"] ?>" >
				</div>
				<div class="form-group" style="margin: 5px;">
				    <input type="text" class="form-control" placeholder="Grupo: <?php echo $_GET["grupo"] ?>" disabled>
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="hidden" name="grupo" class="form-control" value="<?php echo $_GET["grupo"] ?>" >
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="text" name="materia"class="form-control" placeholder="<?php echo $_GET["materia"] ?>" disabled> 
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="text" name="id" class="form-control" placeholder="Identificacion del trabajo" pattern="[0-9]{4}" title="Ingrese una identificacion valida (4 digitos)" required="required">
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del trabajo" pattern="[A-Za-z. ]{7,100}" title="Ingrese un nombre valido (Minimo 7 caracteres)" required="required">
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="text" name="descripcion" class="form-control" placeholder="Descripcion del trabajo" pattern="[A-Za-z. ]{7,100}" title="Ingrese una descripcion valida (Minimo 7 caracteres)" required="required">
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="text" class="form-control" placeholder="Fecha de asignacion del trabajo" disabled> 
					<input type="date" name="fecha_asignacion" min="<?php echo date('Y-m-d')?>" class="form-control" required="required">
				</div>
				<div class="form-group" style="margin: 5px;">
					<input type="text" class="form-control" placeholder="Fecha de entrega del trabajo" disabled> 
					<input type="date" name="fecha_entrega" min="<?php echo date('Y-m-d')?>" class="form-control" required="required">
				</div>
				<div>
					<button type="submit" name="asignar" class="btn btn-primary">Asignar</button>
				</div>
			</div>
		</form>
		</div>
		</div>
	</div>
</div>
<?php
} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>        