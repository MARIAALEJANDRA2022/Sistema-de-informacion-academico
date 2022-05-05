<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "administrador") {
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

    $materia = new Materia();
    $materias = $materia->consultarPorPagina($cantidad, $pagina, $orden, $dir, $_GET["i"], $_GET["semestre_curso"]);
    $totalRegistros = $materia->consultarTotalRegistros();
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
					<h3>Consultar Materia</h3>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>C&oacutedigo</th>
								<th>Nombre</th>
								<th>Semestre</th>
								<th>Clasificacion</th>
								<th>Servicios</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    foreach ($materias as $materiaActual) {
            echo "<tr>";
            echo "<td>" . $materiaActual->getCodigoM() . "</td>";
            echo "<td>" . $materiaActual->getNombre() . "</td>";
            echo "<td>" . $materiaActual->getSemestre_curso() . "</td>";
            echo "<td>" . $materiaActual->getClasificacion() . "</td>";
            echo "<td>";
            if ($_GET["i"] == "0") {
                echo "<a href='index.php?pid= " . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&idMateria=" . $materiaActual->getCodigoM() . "&i=" . $_GET["i"] . "&idAlumno=" . $_GET["idAlumno"] . "&semestre=" . $_GET["semestre_curso"] . "'><i class='fas fa-eye' title='Ver cursos'></i></a>&nbsp";
            } elseif ($_GET["i"] == "1") {
                echo "<a href='index.php?pid= " . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&idMateria=" . $materiaActual->getCodigoM() . "&i=" . $_GET["i"]  . "&idDocente=" . $_GET["idDocente"] . "&semestre=" . $_GET["semestre_curso"] . "'><i class='fas fa-eye' title='Ver cursos'></i></a>&nbsp";
            } elseif ($_GET["i"] != "0" || $_GET["i"] != "1") {
                echo "<a href='index.php?pid=" . base64_encode("presentacion/cursos/crearCurso.php") . "&codigoM=" . $materiaActual->getCodigoM() . "&nombre=" . $materiaActual->getNombre() . "&semestre=" . $materiaActual->getSemestre_curso() . "'><i class='fas fa-plus-square' data-toggle='tooltip' data-placement='bottom' title='Agregar curso'></i></a></td>";
            }
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
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/materia/consultarMateria.php"). "&i=" . $_GET["i"] . "&semestre_curso=" . $_GET["semestre_curso"] . "&idAlumno=" . $_GET["idAlumno"]  . "&idDocente=" . $_GET["idDocente"] . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/materia/consultarMateria.php"). "&i=" . $_GET["i"] . "&semestre_curso=" . $_GET["semestre_curso"] . "&idAlumno=" . $_GET["idAlumno"]  . "&idDocente=" . $_GET["idDocente"] . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/materia/consultarMateria.php"). "&i=" . $_GET["i"] . "&semestre_curso=" . $_GET["semestre_curso"] . "&idAlumno=" . $_GET["idAlumno"]  . "&idDocente=" . $_GET["idDocente"] . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/materia/consultarMateria.php"). "&i=" . $_GET["i"] . "&idAlumno=" . "&semestre_curso=" . $_GET["semestre_curso"] . $_GET["idAlumno"]  . "&idDocente=" . $_GET["idDocente"] . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
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
    	url = "index.php?pid=<?php echo base64_encode("presentacion/materia/consultarMateria.php") . "&i=" . $_GET["i"] . "&idAlumno=" . $_GET["idAlumno"] . "&semestre_curso=" . $_GET["semestre_curso"]  . "&idDocente=" . $_GET["idDocente"] ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";
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
            var respuesta = confirm("\277Esta de acuerdo con eliminar la materia?");
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
  