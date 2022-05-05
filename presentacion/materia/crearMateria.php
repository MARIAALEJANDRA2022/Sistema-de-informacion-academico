<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$creado = false;
if ($_SESSION["rol"]=="administrador"){
    if (isset($_POST["crear"])) {
        $materia_existe = new Materia();
        if ($materia_existe->consultarExiste($_POST["codigo"])){
            echo "<script>alert('La materia ya se encuentra registrada');</script>";
            $creado = false;
        }else{
            $crear = new Materia($_POST["codigo"], $_POST["nombre"], $_POST["semestre_curso"], $_POST["clasificacion"]);
            $crear->crear();
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
    					<h3>Crear materia</h3>
    				</div>
    				<div class="card-body">
        				<?php if ($creado) { ?>						
        					<div class="alert alert-success alert-dismissible fade show" role="alert">
        						<?php
                                    echo "Datos ingresados";
                                    echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/materia/consultarMateria.php") . "&i=" . "2". "';\",1500);</script>";
                                ?>
        					</div>
    					<?php } ?>
    					<form
        						action="<?php echo "index.php?pid=" . base64_encode("presentacion/materia/crearMateria.php") ?>" method="post">
        						<div class="form-group" style="margin: 5px;">
        							<input type="text" name="codigo" class="form-control" placeholder="Codigo" pattern="[0-9]{1,4}" title="Ingrese un codigo valido (Entre 1 y 4 digitos)" required="required">
        						</div>
        						<div class="form-group" style="margin: 5px;">
        							<input type="text" name="nombre" class="form-control" placeholder="Nombre" pattern="[A-Za-z ]{5,100}" title="Ingrese un nombre valido" required="required">
        						</div>
        						<div class="form-group" style="margin: 5px;">
							        <input type="text" name="semestre_curso" class="form-control" placeholder="Semestre" pattern="[A-Za-z]{5,7}" title="Escribir un semestre valido" required="required">
						        </div>
						        <div class="form-group" style="margin: 5px;">
        							<input type="text" name="clasificacion" class="form-control" placeholder="Clasificacion" pattern="[A-Za-z ]{5,100}" title="Ingrese una clasificacion valida" required="required">
        						</div>
        						<button type="submit" name="crear" class="btn btn-primary">Crear</button>
					    </form>
				    </div>
			    </div>
            </div>
	</div>
</div>
<?php }else{
    echo "Lo siento. Ud no tiene permisos";
}?>