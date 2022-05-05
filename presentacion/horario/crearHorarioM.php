<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$codigo = $_GET["codigoM"];
$grupo = $_GET["grupo"];
$creado = false;
if (isset($_POST["crear"])) {
    $horario_existe = new HorarioM();
    $horarios = $horario_existe->consultarE($_POST["codigo"], $_POST["grupo"]);
    if (empty($horarios)){
        $horario = new HorarioM($_POST["codigo"], $_POST["grupo"],$_POST["dia"], $_POST["hora_ini"], $_POST["hora_fin"]);
        $horario->crear();
        $creado = true;
    }else{
        foreach($horarios as $horarioActual){
            if ($_POST["dia"] == $horarioActual->getDia() && $_POST["hora_ini"] == $horarioActual->getHora_ini() && $_POST["hora_fin"] == $horarioActual->getHora_fin()) {
                echo "<script>alert('El horario ya se encuentra registrado');</script>";
                echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&i=" . "2" . "&semestre=" . "" . "';\",100);</script>";
                break;
            }else{
                $horario = new HorarioM($_POST["codigo"], $_POST["grupo"],$_POST["dia"], $_POST["hora_ini"], $_POST["hora_fin"]);
                $horario->crear();
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
					<h3>Asignar horario curso</h3>
				</div>
				<div class="card-body">
    					<?php if ($creado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
            echo "Datos ingresados";
            echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioM.php") . "';\",1500);</script>";
            ?>
    						</div>
    					<?php }?>
    					<form
						action="<?php echo "index.php?pid=" . base64_encode("presentacion/horario/crearHorarioM.php") . "&codigoM=" . $codigo . "&grupo=" . $grupo ?>"
						method="post">
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="codigo" class="form-control" placeholder="<?php echo $codigo?>" disabled>
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="hidden" name="codigo" class="form-control" value="<?php echo $codigo?>">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="grupo" class="form-control" placeholder="<?php echo $grupo?>" disabled>
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="hidden" name="grupo" class="form-control" value="<?php echo $grupo?>">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="dia" class="form-control" pattern="[A-Za-z]{5,9}" title="Ingrese un dia valido" placeholder="Dia" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="time" name="hora_ini" class="form-control" placeholder="Hora de inicio" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="time" name="hora_fin" class="form-control" placeholder="Hora de finalizacion" required="required">
						</div>
						<button type="submit" name="crear" class="btn btn-primary">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>