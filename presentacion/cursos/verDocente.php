<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "alumno" || $_SESSION["rol"] == "administrador") {
    $docente = new Docente($_GET["idDocente"]);
    $docente->consultar();
    ?>
<div class="container-fluid row justify-content-center">
	<div class="row mt-3 ">
		<div class="col-12">
			<div class="card text-center">
				<div class="card-header">
					<h3>Docente</h3>
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
    								<?php if ($_SESSION["rol"] == "alumno"){?>
    									<th>Servicios</th> 				
    								<?php } ?>
    							</tr>
						</thead>
						<tbody>
    						<?php
    echo "<tr>";
    
    echo "<td>" . $docente->getNombre() . "</td>";
    echo "<td>" . $docente->getCodigo() . "</td>";
    $curso = new carrera_grado($docente->getID_proyecto());
    $curso->consultar();
    echo "<td>" . $curso->getNombre() . "</td>";
    echo "<td>" . $docente->getCorreoI() . "</td>";
    echo "<td>";
    if ($_SESSION["rol"] == "alumno") {
        echo "<a href='index.php?pid=" . base64_encode("presentacion/comunicacion/chatDocente.php") . "&nombre=" . $docente->getNombre() . "'><i class='fas fa-comments' data-toggle='tooltip' data-placement='bottom' title='Enviar mensaje'></i></a></td>&nbsp";
    }
    echo "</tr>";
    ?>											
    						</tbody>
					</table>
    					<?php
    if ($_SESSION["rol"] == "alumno") {
        echo "<a href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursosA.php") . "'><i class='fas fa-hand-point-left' data-toggle='tooltip' data-placement='bottom' title='Volver'></i></a></td>";
    } else {
        echo "<a href='index.php?pid=" . base64_encode("presentacion/cursos/consultarInfoCursos.php") . "&i=" . $_GET["i"] . "&semestre=" . $_GET["semestre"] . "'><i class='fas fa-hand-point-left' data-toggle='tooltip' data-placement='bottom' title='Volver'></i></a></td>";
    }
    ?>    					
    				</div>
			</div>
		</div>
	</div>
</div>
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
  