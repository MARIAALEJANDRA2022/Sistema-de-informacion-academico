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

    $trabajo = new Trabajo($_GET["codigoM"], $_GET["grupo"], $_GET["id"]);
    $trabajos = $trabajo ->consultarTrabajos($cantidad, $pagina, $orden, $dir);
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
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>Codigo de la materia</th>
								<th>Grupo</th>
								<th>ID del trabajo</th>
								<th>ID del alumno</th>		
								<th>Nombre del alumno</th>
								<th>Estado</th>				
								<th>Fecha de entrega</th>
								<th>Servicios</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    if (empty($trabajos)){
        $horario = new HorarioA("",$_GET["codigoM"], $_GET["grupo"]);
        $codigos = $horario->consultarPorPagina2($cantidad, $pagina, $orden, $dir);
        foreach ($codigos as $codigoActual) {
            echo "<tr>";
            echo "<td>" . $_GET["codigoM"] . "</td>";
            echo "<td>" . $_GET["grupo"] . "</td>";
            echo "<td>" . $_GET["id"] . "</td>";
            echo "<td>" . $codigoActual->getCodigo_FK() . "</td>";
            $alumno = new Alumno($codigoActual->getCodigo_FK());
            $alumno->consultar();
            echo "<td>" . $alumno->getNombre() . "</td>";
            echo "<td>" . "Sin entregar" . "</td>";
            echo "<td>" . "????-??-??" . "</td>";
            echo "<td>";
             echo "<a href='index.php?pid= " . base64_encode("presentacion/trabajo/calificarTrabajo.php") . "&codigoM=" . $_GET["codigoM"] . "&grupo=" . $_GET["grupo"] . "&id=" . $_GET["id"] . "&idAlumno=" . $codigoActual->getCodigo_FK() . "&estado=" . "Sin entregar" . "'><i class='fas fa-file' data-toggle='tooltip' data-placement='bottom' title='Calificar trabajo'></i></a>";
            echo "</td>";
            echo "</tr>";
        }
    }else{
        foreach ($trabajos as $trabajoActual) {
            $horario = new HorarioA("",$_GET["codigoM"], $_GET["grupo"]);
            $codigos = $horario->consultarPorPagina2($cantidad, $pagina, $orden, $dir);
            foreach($codigos as $c){
                if ($c->getCodigo_FK()==$trabajoActual->getID_Alumno()){
                    echo "<tr>";
                        echo "<td>" . $trabajoActual->getCodigoM_FK1() . "</td>";
                        echo "<td>" . $trabajoActual->getGrupo() . "</td>";
                        echo "<td>" . $trabajoActual->getID_Trabajo() . "</td>";
                        echo "<td>" . $trabajoActual->getID_Alumno() . "</td>";
                        $alumno = new Alumno($trabajoActual->getID_Alumno());
                        $alumno ->consultar();
                        echo "<td>" . $alumno ->getNombre() . "</td>";
                        echo "<td>" . $trabajoActual->getEstado() . "</td>";        
                        echo "<td>" . $trabajoActual->getFecha_entrega() . "</td>";
                        echo "<td>";
                        echo "<a href='index.php?pid= " . base64_encode("presentacion/trabajo/calificarTrabajo.php") . "&codigoM=" . $trabajoActual->getCodigoM_FK1() . "&grupo=" . $trabajoActual->getGrupo() . "&id=" . $trabajoActual->getID_Trabajo() . "&idAlumno=" . $trabajoActual->getID_Alumno() . "&estado=" . $trabajoActual->getEstado() . "'><i class='fas fa-file' data-toggle='tooltip' data-placement='bottom' title='Calificar trabajo'></i></a>";
                            echo "</td>";
                     echo "</tr>";
                }else{
                    echo "<tr>";
                    echo "<td>" . $_GET["codigoM"] . "</td>";
                    echo "<td>" . $_GET["grupo"] . "</td>";
                    echo "<td>" . $_GET["id"] . "</td>";
                    echo "<td>" . $c->getCodigo_FK() . "</td>";
                    $alumno = new Alumno($c->getCodigo_FK());
                    $alumno->consultar();
                    echo "<td>" . $alumno->getNombre() . "</td>";
                    echo "<td>" . "Sin entregar" . "</td>";
                    echo "<td>" . "????-??-??" . "</td>";
                    echo "</tr>";
                }
            }
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
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/verTrabajos.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/verTrabajos.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/verTrabajos.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/trabajo/verTrabajos.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
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
    	url = "index.php?pid=<?php echo base64_encode("presentacion/trabajo/verTrabajos.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";    	
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