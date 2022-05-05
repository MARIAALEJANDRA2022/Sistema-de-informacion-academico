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

    $docente = new Docente();
    $telefono = new TelefonoD();
    $nacionalidad = new Nacionalidad();
    $lugarnacimiento = new LugarNacimiento();
    $municipioresidencia = new MunicipioResidencia();
    $docentes = $docente->consultarPorPagina($cantidad, $pagina, $orden, $dir);
    $totalRegistros = $docente->consultarTotalRegistros();
    $totalPaginas = intval(($totalRegistros / $cantidad));
    if ($totalRegistros % $cantidad != 0) {
        $totalPaginas ++;
    }
    ?>
<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3>Consultar Docente
    					<?php
    if ($orden != "nombre") {
        echo "<a href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&cantidad=" . $cantidad . "&orden=nombre&dir=asc'><i class='fas fa-sort-amount-up'></i></a> 
                                      <a href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&cantidad=" . $cantidad . "&orden=nombre&dir=desc'><i class='fas fa-sort-amount-down'></i></a>";
    } else if ($orden == "nombre" && $dir == "asc") {
        echo "<i class='fas fa-sort-up'></i>
                                      <a href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&cantidad=" . $cantidad . "&orden=nombre&dir=desc'><i class='fas fa-sort-amount-down'></i></a>";
    } else if ($orden == "nombre" && $dir == "desc") {
        echo "<a href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&cantidad=" . $cantidad . "&orden=nombre&dir=asc'><i class='fas fa-sort-amount-up'></i></a>
                                      <i class='fas fa-sort-down'></i>";
    }
    ?>
    					</h3>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover"
						style="font-size: 12px; text-align: center">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Nombre</th>
								<th>Email</th>
								<th>Proyecto</th>
								<th>Semestre</th>
								<th>Correo</th>
								<th>Telefono</th>
								<th>ID<br>Expedicion
								</th>
								<th>Grupo sanguineo</th>
								<th>Direccion</th>
								<th>Fecha<br>nacimiento
								</th>
								<th>Nacionalidad</th>
								<th>Lugar natal</th>
								<th>Residencia</th>
								<th>Estado</th>
								<th>Servicios</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    $i = (($pagina - 1) * $cantidad) + 1;
    foreach ($docentes as $docenteActual) {
        if ($docenteActual->getCodigo()!="1"){
            $curso = new carrera_grado($docenteActual->getID_proyecto());
            $curso->consultar();
            echo "<tr>";
            echo "<td>" . $docenteActual->getCodigo() . "</td><td>" . $docenteActual->getNombre() . "</td>";
            echo "<td>" . $docenteActual->getCorreoP() . "</td><td>" . $curso->getNombre() . "</td>";
            echo "<td>" . $docenteActual->getSemestre_curso() . "</td>";
            echo "<td>" . $docenteActual->getCorreoI() . "</td>";
            $telefono = new TelefonoD($docenteActual->getCodigo());
            $telefonos = $telefono->mostrar();
            echo "<td>";
            echo "<table class='table table-borderless'>";
            echo "<tr>";
            echo "<tbody style='border: none'>";
            echo "<td>";
            foreach ($telefonos as $telefonoActual) {
                echo $telefonoActual->getTelefono() . " ";
            }
            echo "</td>";
            echo "</tbody>";
            echo "</tr>";
            echo "</table>";
            echo "</td>";
            echo "<td>" . $docenteActual->getNumero_ID() . "<br>" . $docenteActual->getFecha_ID() . "</td><td>" . $docenteActual->getTipoSangre() . $docenteActual->getRH() . "</td>";
            echo "<td>" . $docenteActual->getDireccion() . "</td>";
            echo "<td>" . $docenteActual->getFechaNacimiento() . "</td><td>" . $nacionalidad->mostrar($docenteActual->getID_Nacionalidad()) . "</td>";
            echo "<td>" . $lugarnacimiento->mostrar($docenteActual->getID_LugarNacimiento()) . "</td><td>" . $municipioresidencia->mostrar($docenteActual->getID_MunicipioResidencia()) . "</td>";
            echo "<td><div id='estado" . $docenteActual->getCodigo() . "'>" . (($docenteActual -> getEstado()=="Activo")?"<i class='fas fa-user-check' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>":"<i class='fas fa-user-times' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>") . "<div></td>";
            echo "<td>";
            if ($docenteActual->getEstado()=="Activo"){
                echo "<a href='index.php?pid= " . base64_encode("presentacion/materia/consultarMateria.php") . "&i=" . "1" . "&idDocente=" . $docenteActual->getCodigo() . "&semestre_curso=" .$docenteActual->getSemestre_curso()  . "'><i class='fas fa-folder-plus' title='Asignar materia'></i></a>&nbsp";
                echo "<a href='index.php?pid= " . base64_encode("presentacion/docente/editarDocente.php") . "&idDocente=" . $docenteActual->getCodigo() . "'><i class='fas fa-edit'></i></a>&nbsp";
                    echo "<a href='#'><i id='cambiarEstado" . $docenteActual -> getCodigo() . "' class='fas fa-user-alt-slash' data-toggle='tooltip' data-placement='bottom' title='Cambiar Estado'></i></a> ";
            }else{
                echo "<a href='#'><i id='cambiarEstado" . $docenteActual -> getCodigo() . "' class='fas fa-user-alt' data-toggle='tooltip' data-placement='bottom' title='Cambiar Estado'></i></a> ";
            }
            echo "</td>";
        }
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
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Anterior</a></li>";
    }
    for ($i = 1; $i <= $totalPaginas; $i ++) {
        $radius = 2;
        if (($i >= 1 && $i <= $radius) || ($i > $pagina - $radius && $i < $pagina + $radius) || ($i <= $totalPaginas && $i > $totalPaginas - $radius)) {
            if ($pagina == $i) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                if ($pagina != 1 && $i == $pagina - 2 || $pagina != 1 && $i == $pagina + 2) {
                    if ($i == 1 || $i == $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                    } else {
                        echo "...";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>" . $i . "</a></li>";
                }
            }
        } elseif ($i == $pagina - $radius || $i == $pagina + $radius) {
            echo "...";
        }
    }
    if ($pagina == $totalPaginas || $totalRegistros == 0) {
        echo "<li class='page-item disabled'><span class='page-link'>Siguiente</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . (($orden != "") ? "&orden=" . $orden : "") . (($dir != "") ? "&dir=" . $dir : "") . "'>Siguiente</a></li>";
    }
    ?>
    								</ul>
							</nav>
						</div>
						<div class="col-1 text-right">
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
    	url = "index.php?pid=<?php echo base64_encode("presentacion/docente/consultarDocente.php") ?>&cantidad=" + $(this).val() + "<?php echo (($orden!="")?"&orden=" . $orden:"") . (($dir!="")?"&dir=" . $dir:"") ?>";
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
            var respuesta = confirm("\277Esta de acuerdo con eliminar al docente?");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }
    </script>
<script>
    $(document).ready(function(){
    <?php 
    $i = 1;
    foreach ($docentes as $docenteActual){
        echo "\t$(\"#cambiarEstado" . $docenteActual -> getCodigo() . "\").click(function(){\n";
        echo "\t\t const url = \"indexAjax.php?pid=" . base64_encode("presentacion/docente/cambiarEstadoDocenteAjax.php") . "&id=" . $docenteActual -> getCodigo() . "\"\n";
        echo "\t\t$(\"#estado" . $docenteActual -> getCodigo() . "\").load(url);\n";
        echo "\t});\n\n";
    }	
    ?>
    });
</script>
<?php
} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>  
  