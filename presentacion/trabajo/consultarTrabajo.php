<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "docente") {
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

    $trabajo = new Asignar_trabajo();
    $trabajos = $trabajo->consultarPorPagina($cantidad, $pagina, $orden, $dir);
    $totalRegistros = $trabajo->consultarTotalRegistros();
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
					<h3>Trabajos</h3>
				</div>
				<div class="card-body table-responsive">
					<br>
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>Codigo de la materia</th>
								<th>Grupo</th>
								<th>Materia</th>
								<th>ID del trabajo</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Fecha de asignacion</th>
								<th>Fecha de entrega</th>
								<th>Servicios</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    foreach ($trabajos as $trabajoActual) {
        echo "<tr>";
        echo "<td>" . $trabajoActual->getCodigoM_FK1() . "</td>";
        echo "<td>" . $trabajoActual->getGrupo() . "</td>";
        $materia = new curso($trabajoActual->getCodigoM_FK1(), $trabajoActual->getGrupo());
        $materia->consultar();
        echo "<td>" . $materia->getNombre() . "</td>";
        echo "<td>" . $trabajoActual->getID_Trabajo() . "</td>";
        echo "<td>" . $trabajoActual->getTrabajo() . "</td>";
        echo "<td>" . $trabajoActual->getDescripcion() . "</td>";
        echo "<td>" . $trabajoActual->getFecha_asignacion() . "</td>";
        echo "<td>" . $trabajoActual->getFecha_entrega() . "</td>";
        echo "<td>";
        echo "<a href='index.php?pid= " . base64_encode("presentacion/trabajo/verTrabajos.php") . "&codigoM=" . $trabajoActual->getCodigoM_FK1() . "&grupo=" .$trabajoActual->getGrupo() . "&id="  . $trabajoActual->getID_Trabajo()  . "'><i class='fas fa-info-circle' data-toggle='tooltip' data-placement='bottom' title='Ver trabajos'></i></a>";
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
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
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
    	url = "index.php?pid=<?php echo base64_encode("presentacion/trabajo/consultarTrabajo.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";    	
    	location.replace(url);
    });
    </script>
<script>
		function (){
			document.formulario.submit();
		}		
	</script>
<?php
} elseif ($_SESSION["rol"] == "alumno") {
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
    $horarios = $horario->consultarPorPagina($cantidad, $pagina, $orden, $dir, $_SESSION["id"]);
    $totalRegistros = $horario->consultarTotalRegistrosA($_SESSION["id"]);
    $totalPaginas = intval(($totalRegistros / $cantidad));
    if ($totalRegistros % $cantidad != 0) {
        $totalPaginas ++;
    }
    $j=0;
    ?>
<div class="container-fluid row justify-content-center">
	<div class="row mt-3 ">
		<div class="col-12">
			<div class="card text-center">
				<div class="card-header">
					<h3>Trabajos</h3>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>Codigo de la materia</th>	
								<th>Grupo</th>
								<th>Materia</th>
								<th>Id del trabajo</th>
								<th>Nombre</th>
								<th>Fecha de asignacion</th>
								<th>Fecha de entrega</th>
								<th>Estado</th>
								<th>Servicios</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    foreach ($horarios as $horarioActual) {
            echo "<tr>";
            $trabajo = new Asignar_trabajo();
            $trabajos = $trabajo->consultarAlumno($horarioActual->getCodigoM_FK1(), $horarioActual->getGrupo());
            foreach ($trabajos as $trabajoActual) {
                echo "<td>" . $horarioActual->getCodigoM_FK1() . "</td>";   
                echo "<td>" . $horarioActual->getGrupo() . "</td>";
                $materia= new curso($horarioActual->getCodigoM_FK1(),$horarioActual->getGrupo());
                $materia->consultar();
                echo "<td>" . $materia->getNombre() . "</td>";
                echo "<td>" . $trabajoActual->getID_Trabajo() . "</td>";     
                echo "<td>" . $trabajoActual->getTrabajo() . "</td>";            
                echo "<td>" . $trabajoActual->getFecha_asignacion() . "</td>";
                echo "<td>" . $trabajoActual->getFecha_entrega() . "</td>";
                $t = new Trabajo($horarioActual->getCodigoM_FK1(), $horarioActual->getGrupo(), $trabajoActual->getID_Trabajo(),$_SESSION["id"]);
                $t ->consultar();
                if ($t->getEstado()==""){
                    echo "<td>" . "Sin entregar" . "</td>";
                }else{
                    echo "<td>" . $t->getEstado() . "</td>";
                }
                echo "<td>";
                echo "<a href='index.php?pid= " . base64_encode("presentacion/trabajo/trabajoAlumno.php") . "&materia=" . $horarioActual->getCodigoM_FK1() . "&grupo=" . $horarioActual->getGrupo() . "&nombreM=" . $materia->getNombre() . "&id=" . $trabajoActual->getID_Trabajo() . "&nombre=" . $trabajoActual->getTrabajo() . "&fechaA=" . $trabajoActual->getFecha_asignacion() . "&fechaE=" . $trabajoActual->getFecha_entrega() . "&descripcion=" . $trabajoActual->getDescripcion() . "'><i class='fas fa-info-circle' title='Ver trabajo'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
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
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/consultarTrabajo.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
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
    	url = "index.php?pid=<?php echo base64_encode("presentacion/trabajo/consultarTrabajo.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";    	
    	location.replace(url);
    });
    </script>
<script>
		function (){
			document.formulario.submit();
		}		
	</script>
<?php
} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>  
  