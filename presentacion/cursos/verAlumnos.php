<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "docente" || $_SESSION["rol"] == "administrador") {
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
    if ($_SESSION["rol"] == "docente") {
        $horario = new HorarioA("",$_GET["materia"], $_GET["grupo"]);
        $codigos = $horario->consultarPorPagina2($cantidad, $pagina, $orden, $dir);
        $totalRegistros = $horario->consultarTotalRegistros1();
        $totalPaginas = intval(($totalRegistros / $cantidad));
        if ($totalRegistros % $cantidad != 0) {
            $totalPaginas ++;
        }
    }else{
        $horario = new HorarioA("",$_GET["materia"], $_GET["grupo"]);
        $codigos = $horario->consultarPorPagina2($cantidad, $pagina, $orden, $dir);
        $totalRegistros = $horario->consultarTotalRegistros1();
        $totalPaginas = intval(($totalRegistros / $cantidad));
        if ($totalRegistros % $cantidad != 0) {
            $totalPaginas ++;
        }
    }
?>
<div class="container-fluid row justify-content-center">
	<div class="row mt-3 ">
		<div class="col-12">
			<div class="card text-center">
				<div class="card-header">
					<h3>Alumnos</h3>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Codigo</th>
								<th>Proyecto curricular</th>
								<th>Correo institucional</th> 
    							<?php if ($_SESSION["rol"] == "docente"){ ?> 
    								<th>Servicios</th>
    							<?php }?>
    						</tr>
						</thead>
						<tbody>
    						<?php
                                $i = (($pagina - 1) * $cantidad) + 1;
                                if ($_SESSION["rol"] == "docente") {
                                    foreach ($codigos as $codigoActual) {
                                        echo "<tr>";
                                        $alumno = new Alumno($codigoActual->getCodigo_FK());
                                        $alumno->consultar();
                                        $curso = new carrera_grado($alumno->getID_proyecto());
                                        $curso->consultar();
                                        echo "<td>" . $alumno->getNombre() . "</td>";
                                        echo "<td>" . $alumno->getCodigo() . "</td>";
                                        echo "<td>" . $curso->getNombre() . "</td>";
                                        echo "<td>" . $alumno->getCorreoI() . "</td>";
                                        echo "<td>";
                                        echo "<a href='index.php?pid=" . base64_encode("presentacion/nota/notaFinalM.php") . "&materia=" . $_GET["materia"] . "&grupo=" . $_GET["grupo"] . "&codigo=" . $alumno->getCodigo() . "'><i class='fas fa-file-download' data-toggle='tooltip' data-placement='bottom' title='Establecer nota final'></i></a>&nbsp";
                                        echo "<a href='index.php?pid=" . base64_encode("presentacion/comunicacion/chatAlumno.php") . "&nombre=" . $alumno->getNombre() . "'><i class='fas fa-comments' data-toggle='tooltip' data-placement='bottom' title='Enviar mensaje'></i></a></td>&nbsp";
                                            echo "</tr>";
                                    }
                                }else{
                                    foreach ($codigos as $codigoActual) {
                                        echo "<tr>";
                                        $alumno = new Alumno($codigoActual->getCodigo_FK());
                                        $alumno->consultar();
                                        $curso = new carrera_grado($alumno->getID_proyecto());
                                        $curso->consultar();
                                        echo "<td>" . $alumno->getNombre() . "</td>";
                                        echo "<td>" . $alumno->getCodigo() . "</td>";
                                        echo "<td>" . $curso->getNombre() . "</td>";
                                        echo "<td>" . $alumno->getCorreoI() . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>											
    					</tbody>
					</table>    					
    				<?php
                        if ($_SESSION["rol"] == "docente") {
                            echo "<a href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursosD.php") . "'><i class='fas fa-hand-point-left' data-toggle='tooltip' data-placement='bottom' title='Volver'></i></a></td>";
                        }else{
                            echo "<a href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&i=" . $_GET["i"] . "&semestre=" . $_GET["semestre"] . "'><i class='fas fa-hand-point-left' data-toggle='tooltip' data-placement='bottom' title='Volver'></i></a></td>";
                        }
                    ?>    					
    				<div class="row">
						<div class="col-11">
							<nav>
								<ul class="pagination" style="font-size: 12px">
    								<?php
                                        if ($pagina == 1) {
                                            echo "<li class='page-item disabled'><span class='page-link'>Anterior</span></li>";
                                            date_default_timezone_set('America/Bogota');
                                        }else{
                                            echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/verAlumnos.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
                                        }
                                        for ($i = 1; $i <= $totalPaginas; $i ++) {
                                            $radius = 2;
                                            if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
                                                if ($pagina == $i) {
                                                    echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
                                                }else{
                                                    if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                                                            if ($i == 1 || $i == $totalPaginas) {
                                                                echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/verAlumnos.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                                                            }else{
                                                                echo "...";
                                                            }
                                                    }else{
                                                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/verAlumnos.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                                                    }
                                                }
                                            }elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
                                                echo "...";
                                            }
                                        }
                                        if ($pagina == $totalPaginas || $totalRegistros == 0) {
                                            echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
                                        }else{
                                            echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cursos/verAlumnos.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
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
    	url = "index.php?pid=<?php echo base64_encode("presentacion/cursos/verAlumnos.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";
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
}else{
    echo "Lo siento. Usted no tiene permisos";
}?>  
  