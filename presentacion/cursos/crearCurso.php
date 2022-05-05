<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$codigo = $_GET["codigoM"];
$nombre = $_GET["nombre"];
$semestre = $_GET["semestre"];
$creado = false;
if ($_SESSION["rol"]=="administrador"){
    if (isset($_POST["crear"])) {
        $curso_existe = new curso();
        $existe = $curso_existe->consultarExiste($_POST["codigo"], $_POST["grupo"]);
        if (empty($existe)){
            $crear = new curso($_POST["codigo"], $_POST["grupo"], "1", $_POST["nombre"], $_POST["semestre"], $_POST["Cupos_totales"],"0",$_POST["Cupos_totales"]);
            $crear->crear();
            $creado = true;
        }else{
            foreach ($existe as $e){
                if ($e->getCodigoM()==$_POST["codigo"] && $e->getGrupo()==$_POST["grupo"]){
                    echo "<script>alert('El curso ya se encuentra registrado');</script>";
                    $creado = false;
                }else{
                    $crear = new curso($_POST["codigo"], $_POST["grupo"],"1", $_POST["nombre"], $_POST["semestre"], $_POST["Cupos_totales"],"0",$_POST["Cupos_totales"]);
                    $crear->crear();
                    $creado = true;
                }    
            }
        }
    }
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h3>Asignar curso a una materia</h3>
				</div>
				<div class="card-body">
    					<?php if ($creado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
                                    echo "Datos ingresados";
                                    echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&i=" . "2" . "&semestre=" . $_POST["semestre"] . "';\",1500);</script>";
                                ?>
    						</div>
    					<?php } ?>
    					<form
    						action="<?php echo "index.php?pid=" . base64_encode("presentacion/cursos/crearCurso.php") . "&codigoM=" . $codigo . "&nombre=" . $nombre . "&semestre=" . $semestre ?>"
    						method="post">
    						<div class="form-group" style="margin: 5px;">
    							<input type="text" name="codigo" class="form-control" placeholder="<?php echo $codigo?>" disabled>
    						</div>
    						<div class="form-group" style="margin: 5px;">
    							<input type="hidden" name="codigo" class="form-control" value="<?php echo $codigo?>">
    						</div>
    						<div class="form-group" style="margin: 5px;">
    							<input type="text" name="nombre" class="form-control" placeholder="<?php echo $nombre?>" disabled>
    						</div>
    						<div class="form-group" style="margin: 5px;">
    							<input type="hidden" name="nombre" class="form-control" value="<?php echo $nombre?>">
    						</div>
    						<div class="form-group" style="margin: 5px;">
    							<input type="text" name="semestre" class="form-control" placeholder="<?php echo $semestre?>" disabled>
    						</div>
    						<div class="form-group" style="margin: 5px;">
    							<input type="hidden" name="semestre" class="form-control" value="<?php echo $semestre?>">
    						</div>
    						<div class="form-group" style="margin: 5px;">
    							<input type="text" name="grupo" class="form-control" placeholder="Grupo" required="required">
    						</div>
    						<div class="form-group" style="margin: 5px;">
    							<input type="text" name="Cupos_totales" class="form-control" placeholder="Cupos totales" required="required">
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