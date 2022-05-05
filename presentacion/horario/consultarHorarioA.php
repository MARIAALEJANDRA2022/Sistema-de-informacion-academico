<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "alumno") {
    $cantidad = 5;
    if (isset($_GET["cantidad"])) {
        $cantidad = $_GET["cantidad"];
    }
    $pagina = 1;
    if (isset($_GET["pagina"])) {
        $pagina = $_GET["pagina"];
    }
    $orden = "";
    if (isset($_GET["orden"])) {
        $orden = $_GET["orden"];
    }
    $dir = "";
    if (isset($_GET["dir"])) {
        $dir = $_GET["dir"];
    }

    $horario = new HorarioA();
    $horarios = $horario->consultarPorPagina3($cantidad, $pagina, $orden, $dir, $_SESSION["id"]);
    $totalRegistros = $horario->consultarTotalRegistrosA($_SESSION["id"]);
    $totalPaginas = intval(($totalRegistros / $cantidad));
    if ($totalRegistros % $cantidad != 0) {
        $totalPaginas ++;
    }
    ?>
<div class="container-fluid row justify-content-center">
	<div class="row mt-3 ">
		<div class="col-12">
			<div class="card text-center">
				<div class="card-header">
					<h3>Consultar Horario</h3>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
							    <th>Codigo</th>
							    <th>Grupo</th>
								<th>Materia</th>
								<th>D&iacutea</th>
								<th>Hora de inicio</th>
								<th>Hora de finalizaci&oacuten</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    foreach ($horarios as $horarioActual) {
        echo "<tr>";
        $materia = new curso($horarioActual->getCodigoM_FK1(),$horarioActual->getGrupo());
        $materia->consultar();
        echo "<td>" . $horarioActual->getCodigoM_FK1() . "</td>";
        echo "<td>" . $horarioActual->getGrupo() . "</td>";
        echo "<td>" . $materia->getNombre() . "</td>";
        $horario = new HorarioA ($horarioActual->getCodigo_FK(), $horarioActual->getCodigoM_FK1(),$horarioActual->getGrupo());
        $horarios1 = $horario->consultarMas();
        echo "<td>";
            echo "<table class='table table-borderless' style='font-size: 12px; text-align: center'>";
                echo "<tr>";
                    echo "<tbody style='border: none'>";
                        echo "<td>";
                            foreach ($horarios1 as $horarioActual1) {
                                echo $horarioActual1->getDia() . "<br>";
                            }
                        echo "</td>";
                    echo "</tbody>";
                echo "</tr>";
            echo "</table>";
        echo "</td>";
        echo "<td>";
            echo "<table class='table table-borderless' style='font-size: 12px; text-align: center'>";
                echo "<tr>";
                    echo "<tbody style='border: none'>";
                        echo "<td>";
                            foreach ($horarios1 as $horarioActual1) {
                                echo $horarioActual1->getHora_ini() . "<br>";
                            }
                        echo "</td>";
                    echo "</tbody>";
                echo "</tr>";
            echo "</table>";
        echo "</td>";
        echo "<td>";
            echo "<table class='table table-borderless' style='font-size: 12px; text-align: center'>";
                echo "<tr>";
                    echo "<tbody style='border: none'>";
                        echo "<td>";
                            foreach ($horarios1 as $horarioActual1) {
                                echo $horarioActual1->getHora_fin() . "<br>";
                            }
                        echo "</td>";
                    echo "</tbody>";
                echo "</tr>";
            echo "</table>";
        echo "</td>";
        echo "</tr>";
    }
    ?>											
    						</tbody>
					</table>
					<div class="row">
						<div class="col-11">
							<nav>
								<ul class="pagination" style="font-size: 12px">
    									<?php
    if ($pagina == 1) {
        echo "<li class='page-item disabled'><span class='page-link'>Anterior</span></li>";
        date_default_timezone_set('America/Bogota');
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
    }
    ?>
    								</ul>
							</nav>
						</div>
						<div class="col-1  row justify-content-center">
							<select name="cantidad" id="cantidad" class="custom-select"
								style="font-size: 12px">
								<option value="5" <?php echo ($cantidad==5)?"selected":"" ?>>5</option>
								<option value="10" <?php echo ($cantidad==10)?"selected":"" ?>>10</option>
								<option value="20" <?php echo ($cantidad==20)?"selected":"" ?>>20</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $("#cantidad").on("change", function() {
    	url = "index.php?pid=<?php echo base64_encode("presentacion/horario/consultarHorarioA.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";
    	//alert (url);
    	location.replace(url);
    });
    </script>
<script>
		function (){
			document.formulario.submit();
		}		
	</script>
<?php
} else if ($_SESSION["rol"] == "administrador") {
    $cantidad = 5;
    if (isset($_GET["cantidad"])) {
        $cantidad = $_GET["cantidad"];
    }
    $pagina = 1;
    if (isset($_GET["pagina"])) {
        $pagina = $_GET["pagina"];
    }
    $orden = "";
    if (isset($_GET["orden"])) {
        $orden = $_GET["orden"];
    }
    $dir = "";
    if (isset($_GET["dir"])) {
        $dir = $_GET["dir"];
    }

    $horario = new HorarioA();
    $horarios = $horario->consultarPorPagina1($cantidad, $pagina, $orden, $dir);
    $totalRegistros = $horario->consultarTotalRegistros();
    $totalPaginas = intval(($totalRegistros / $cantidad));
    if ($totalRegistros % $cantidad != 0) {
        $totalPaginas ++;
    }
    ?>
<div class="container-fluid row justify-content-center">
	<div class="row mt-3 ">
		<div class="col-12">
			<div class="card text-center">
				<div class="card-header">
					<h3>Consultar Horario</h3>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>C&oacutedigo</th>
								<th>Nombre</th>
								<th>CodigoM</th>
								<th>Grupo</th>
								<th>Materia</th>
								<th>D&iacutea</th>
								<th>Hora de inicio</th>
								<th>Hora de finalizaci&oacuten</th>
								<th>Servicios</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    foreach ($horarios as $horarioActual) {
        echo "<tr>";
        echo "<td>" . $horarioActual->getCodigo_FK() . "</td>";
        $alumno = new Alumno($horarioActual->getCodigo_FK());
        $alumno -> consultar();
        echo "<td>" . $alumno->getNombre() . "</td>";
        echo "<td>" . $horarioActual->getCodigoM_FK1() . "</td>";
        $materia = new curso($horarioActual->getCodigoM_FK1(),$horarioActual->getGrupo());
        $materia->consultar();
        echo "<td>" . $horarioActual->getGrupo() . "</td>";
        echo "<td>" . $materia-> getNombre() . "</td>";
        $horario = new HorarioA ($horarioActual->getCodigo_FK(), $horarioActual->getCodigoM_FK1(),$horarioActual->getGrupo());
        $horarios1 = $horario->consultarMas();
        echo "<td>";
            echo "<table class='table table-borderless' style='font-size: 12px; text-align: center'>";
                echo "<tr>";
                    echo "<tbody style='border: none'>";
                        echo "<td>";
                            foreach ($horarios1 as $horarioActual1) {
                                echo $horarioActual1->getDia() . "<br>";
                            }
                        echo "</td>";
                    echo "</tbody>";
                echo "</tr>";
            echo "</table>";
        echo "</td>";
        echo "<td>";
            echo "<table class='table table-borderless' style='font-size: 12px; text-align: center'>";
                echo "<tr>";
                    echo "<tbody style='border: none'>";
                        echo "<td>";
                            foreach ($horarios1 as $horarioActual1) {
                                echo $horarioActual1->getHora_ini() . "<br>";
                            }
                        echo "</td>";
                    echo "</tbody>";
                echo "</tr>";
            echo "</table>";
        echo "</td>";
        echo "<td>";
            echo "<table class='table table-borderless' style='font-size: 12px; text-align: center'>";
                echo "<tr>";
                    echo "<tbody style='border: none'>";
                        echo "<td>";
                            foreach ($horarios1 as $horarioActual1) {
                                echo $horarioActual1->getHora_fin() . "<br>";
                            }
                        echo "</td>";
                    echo "</tbody>";
                echo "</tr>";
            echo "</table>";
        echo "</td>";
        echo "<td>";
        echo "<a href='index.php?pid=" . base64_encode("presentacion/horario/eliminarHorarioA.php") . "&id=" . $horarioActual->getCodigo_FK() . "&materia=" . $horarioActual->getCodigoM_FK1() . "&grupo=" . $horarioActual->getGrupo() ."'><i class='fas fa-trash' data-toggle='tooltip' data-placement='bottom' title='Eliminar horario' onclick='return ConfirmDelete()'></i></a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>											
    						</tbody>
					</table>
					<div class="row">
						<div class="col-11">
							<nav>
								<ul class="pagination" style="font-size: 12px">
    									<?php
    if ($pagina == 1) {
        echo "<li class='page-item disabled'><span class='page-link'>Anterior</span></li>";
        date_default_timezone_set('America/Bogota');
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioA.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
    }
    ?>
    								</ul>
							</nav>
						</div>
						<div class="col-1  row justify-content-center">
							<select name="cantidad" id="cantidad" class="custom-select"
								style="font-size: 12px">
								<option value="5" <?php echo ($cantidad==5)?"selected":"" ?>>5</option>
								<option value="10" <?php echo ($cantidad==10)?"selected":"" ?>>10</option>
								<option value="20" <?php echo ($cantidad==20)?"selected":"" ?>>20</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $("#cantidad").on("change", function() {
    	url = "index.php?pid=<?php echo base64_encode("presentacion/horario/consultarHorarioA.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";
    	//alert (url);
    	location.replace(url);
    });
    </script>
<script>
		function (){
			document.formulario.submit();
		}		
	</script>
		<script>
        function ConfirmDelete(){
            var respuesta = confirm("\277Esta de acuerdo con eliminar el horario?");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }
    </script>
<?php
} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>  
  