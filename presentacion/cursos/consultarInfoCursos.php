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

    $curso = new curso();
    $cursos = $curso->consultarPorPagina($cantidad, $pagina, $orden, $dir, $_GET["i"], $_GET["semestre"], $_GET["idMateria"]);
    $totalRegistros = $curso->consultarTotalRegistros();
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
					<h3>Cursos</h3>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>C&oacutedigo</th>
								<th>Grupo</th>
								<th>Docente</th>
								<th>Materia</th>
								<th>Semestre/curso</th>
								<th>Cupos totales</th>
								<th>Cantidad de alumnos</th>
								<th>Cupos disponibles</th>
								<th>Servicios</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    foreach ($cursos as $cursoActual) {
        echo "<tr>";
        echo "<td>" . $cursoActual->getCodigoM() . "</td>";
        echo "<td>" . $cursoActual->getGrupo() . "</td>";
        $docente = new Docente($cursoActual->getID_Docente());
        $docente->consultar();
        if ($docente->getNombre() == "Administrador"){
            echo "<td>" . "SIN ASIGNAR" . "</td>";
        }else{
            echo "<td>" . $docente->getNombre() . "</td>";
        }
        echo "<td>" . $cursoActual->getNombre() . "</td>";
        echo "<td>" . $cursoActual->getSemestre_curso() . "</td>";
        echo "<td>" . $cursoActual->getCupos_totales() . "</td>";
        echo "<td>" . $cursoActual->getCantidad_estudiantes() . "</td>";
        echo "<td>" . $cursoActual->getCupos_disponibles() . "</td>";
        if ($_GET["i"]==0 || $_GET["i"]==1){
            echo "<td>";
            echo "<a href='index.php?pid=" . base64_encode("presentacion/horario/consultarHorarioME.php") . "&i=" . $_GET["i"] . "&idMateria=" . $_GET["idMateria"] . "&codigo=" . $cursoActual->getGrupo() . "&idDocente=" . $docente->getCodigo() . "&semestre=" . $_GET["semestre"]. "&idAlumno=" . $_GET["idAlumno"] . "'><i class='fas fa-eye' data-toggle='tooltip' data-placement='bottom' title='Ver horario'></i></a>&nbsp";
            if ($_GET["i"]==0){
                echo "<a href='index.php?pid=" . base64_encode("presentacion/horario/crearHorarioA.php") . "&idDocente=" . $docente->getCodigo() . "&idMateria=" . $_GET["idMateria"] . "&codigo=" . $cursoActual->getGrupo() . "&idAlumno=" . $_GET["idAlumno"] . "&semestre=" . $_GET["semestre"] . "'><i class='fas fa-plus-square' data-toggle='tooltip' data-placement='bottom' title='Asignar curso'></i></a>&nbsp";
            }else{
                echo "<a href='index.php?pid=" . base64_encode("presentacion/horario/crearHorarioD.php") . "&idDocente=" . $_GET["idDocente"] . "&idMateria=" . $_GET["idMateria"] . "&codigo=" . $cursoActual->getGrupo() . "&idAlumno=" . $_GET["idAlumno"] . "&semestre=" . $_GET["semestre"] . "'><i class='fas fa-plus-square' data-toggle='tooltip' data-placement='bottom' title='Asignar curso'></i></a>&nbsp";
            }
        }else{
            echo "<td>";
            echo "<a href='index.php?pid=" . base64_encode("presentacion/horario/crearHorarioM.php"). "&codigoM=" .  $cursoActual->getCodigoM() . "&grupo=" . $cursoActual->getGrupo() . "'><i class='fas fa-plus-square' data-toggle='tooltip' data-placement='bottom' title='Asignar horario'></i></a>&nbsp";
            if ($docente->getNombre() != "Administrador"){
                echo "<a href='index.php?pid=" . base64_encode("presentacion/cursos/verDocente.php") . "&idDocente=" . $docente->getCodigo() . "&i=" . $_GET["i"] . "&semestre=" . $_GET["semestre"] . "'><i class='fas fa-chalkboard-teacher' data-toggle='tooltip' data-placement='bottom' title='Ver docente'></i></a>&nbsp";
            }
            echo "<a href='index.php?pid=" . base64_encode("presentacion/cursos/verAlumnos.php") . "&materia=" . $cursoActual->getCodigoM() . "&grupo=" . $cursoActual->getGrupo(). "&i=" . $_GET["i"] . "&semestre=" . $_GET["semestre"] . "'><i class='fas fa-users' data-toggle='tooltip' data-placement='bottom' title='Ver alumnos'></i></a></td>";
        }
        echo "</tr>";
    }
    ?>											
    						</tbody>
					</table>
					<div class="row">
						<div class="col-11">
						    <?php 
						    if ($_GET["i"]==0 || $_GET["i"]==1){
						        echo "<a href='index.php?pid= " . base64_encode("presentacion/materia/consultarMateria.php") . "&i=" . $_GET["i"] . "&idAlumno=" . $_GET["idAlumno"]  . "&idDocente=" . $_GET["idDocente"] . "&semestre_curso=" . $_GET["semestre"] . "'><i class='fas fa-hand-point-left' title='Volver'></i></a>&nbsp"; } ?>
							<nav>
								<ul class="pagination" style="font-size: 12px">
    									<?php
    if ($pagina == 1) {
        echo "<li class='page-item disabled'><span class='page-link'>Anterior</span></li>";
        date_default_timezone_set('America/Bogota');
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
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
    	url = "index.php?pid=<?php echo base64_encode("presentacion/cursos/consultarInfoCursos.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";
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
} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>  
  