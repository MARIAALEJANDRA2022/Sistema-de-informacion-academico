<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"]=="administrador"){
    $creado = false;
if (isset($_POST["registrar"])) {
    $docente_existe = new Docente($_POST["codigo"]);
    $docente_existe->consultarE();
    $nacionalidad = new Nacionalidad();
    $lugarnacimiento = new LugarNacimiento();
    $municipioresidencia = new MunicipioResidencia();
    $curso = new carrera_grado();
    $nacionalidad1 = $nacionalidad->buscar($_POST["iD_Nacionalidad"]);
    $lugarnacimiento1 = $lugarnacimiento->buscar($_POST["iD_LugarNacimiento"]);
    $municipioresidencia1 = $municipioresidencia->buscar($_POST["iD_MunicipioResidencia"]);
    $curso->buscar($_POST["proyecto"]);
    $curso1 = $curso->getCodigo();
    if ($_POST["codigo"] == $docente_existe->getCodigo()) {
        echo "<script>alert('El docente ya se encuentra registrado');</script>";
        $creado = false;
    } else {
            $docente = new Docente($_POST["codigo"], $_POST["nombre"], $_POST["correoP"], $curso1, $_POST["semestre_curso"], $_POST["correoI"].$_POST["correoDocente"], $_POST["clave"], $_POST["numero_ID"], $_POST["fecha_ID"], $_POST["tipoSangre"], $_POST["rH"], $_POST["direccion"], $_POST["fechaNacimiento"], $nacionalidad1, $lugarnacimiento1, $municipioresidencia1, "Activo");
            $telefono = new TelefonoD($_POST["codigo"], $_POST["telefono"]);
            $docente->crear();
            $telefono->crear();
            $telefono = new TelefonoD($_POST["codigo"], $_POST["celular"]);
            $telefono->crear();
            $creado = true;
    }
}
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h3>Registrar docente</h3>
				</div>
				<div class="card-body">
    					<?php if ($creado) { ?>						
    						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    							<?php
            echo "Datos ingresados";
            echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "';\",1500);</script>";
            ?>
    						</div>
    					<?php } ?>
    					<form
						action="<?php echo "index.php?pid=" . base64_encode("presentacion/docente/crearDocente.php")?>"
						method="post">
						<div class="form-group" style="margin: 5px;">
							    <input type="text" name="codigo" class="form-control" placeholder="Codigo del docente" pattern="[0-9]{4,11}" title="Escribir un codigo valido de minimo 4 digitos y maximo 11 digitos" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="nombre" class="form-control" placeholder="Nombre y apellido" pattern="[A-Za-z ]{6,100}" title="Escribir un nombre y apellido valido" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="email" name="correoP" class="form-control" placeholder="Correo personal" required="required">
						    </div>
						    <?php 
						        $curso = new carrera_grado();
						        $cursos = $curso->consultarTodos();
						    ?>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="cp" class="form-control" placeholder="Curso/carrera" disabled>
							    <select name="proyecto">
						            <?php 
						                foreach($cursos as $cursoActual){?>
						                    <option value="<?php echo $cursoActual->getNombre()?>"><?php echo $cursoActual->getNombre()?></option>
						            <?php } ?>
						        </select>
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="semestre_curso" class="form-control" placeholder="Semestre" pattern="[A-Za-z]{5,7}" title="Escribir un semestre valido" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
						        <div class="input-group">
							        <input type="text" name="correoI" class="form-control" placeholder="Correo institucional" required="required">
							        <input type="email" name="correoDocente" class="form-control" placeholder="@docente.edu.co" required="required" disabled>
							    </div>
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="hidden" name="correoDocente" class="form-control" value="@docente.edu.co" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="password" name="clave" class="form-control" placeholder="Clave" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="numero_ID" class="form-control" placeholder="Numero de identificacion" pattern="[0-9]{7,10}" title="Escribir un numero de identificacion valido" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="fechaid" class="form-control" placeholder="Fecha de expedicion del documento" disabled>
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="date" name="fecha_ID" class="form-control" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="tipoSangre" class="form-control" placeholder="Tipo de sangre" pattern="[ABO]{1,2}" title="Escribir un tipo de sangre valido (A, B, O, AB)" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="rH" class="form-control" placeholder="RH" pattern="[+-]{1}" title="Escribir un RH valido (+ , -)" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="direccion" class="form-control" placeholder="Direccion" pattern="[A-Za-z0-9.- ]{6,100}" title="Escribir una direccion valida" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="text" name="fechanaci" class="form-control" placeholder="Fecha de nacimiento" disabled>
						    </div>
						    <?php $fecha = strtotime ('-8 year' , strtotime(date('Y-m-d')));
    						$fecha = date('Y-m-d',$fecha);
    						?>
						    <div class="form-group" style="margin: 5px;">
							    <input type="date" name="fechaNacimiento" max="<?php echo $fecha ?>" class="form-control" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
						        <input type="text" name="cp" class="form-control" placeholder="Nacionalidad" disabled>
    						    <select name="iD_Nacionalidad">
    							    <?php 
    							        $nacionalidad = new Nacionalidad();
    							        $nacionalidades = $nacionalidad -> consultarTodos();
    							        foreach($nacionalidades as $nacionalidadActual){?>
    							            <option value="<?php echo $nacionalidadActual->getNacionalidad()?>"><?php echo $nacionalidadActual->getNacionalidad()?></option>
    							    <?php }?>
    							</select>
							</div>
							<div class="form-group" style="margin: 5px;">
							    <input type="text" name="cp" class="form-control" placeholder="Lugar de nacimiento" disabled>
                                <select name="iD_LugarNacimiento">
    							    <?php 
    							        $lugarnacimiento = new LugarNacimiento();
    							        $lugares = $lugarnacimiento -> consultarTodos();
    							        foreach($lugares as $lugarActual){?>
    							            <option value="<?php echo $lugarActual->getLugarNacimiento()?>"><?php echo $lugarActual->getLugarNacimiento()?></option>
    							    <?php }?>
    							</select>
							</div>
							<div class="form-group" style="margin: 5px;">
							    <input type="text" name="cp" class="form-control" placeholder="Municipio de residencia" disabled>
                                <select name="iD_MunicipioResidencia">
                                    <?php 
                                        $municipioresidencia = new MunicipioResidencia();
                                        $municipios = $municipioresidencia -> consultarTodos();
                                        foreach($municipios as $municipioActual){?>
                                            <option value="<?php echo $municipioActual->getMunicipioResidencia()?>"><?php echo $municipioActual->getMunicipioResidencia()?></option>
                                    <?php }?>
                                </select>
                            </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="tel" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}" title="Escribir un numero de telefono valido (10 digitos) (60 + indicativo de la ciudad + numero de telefono)" required="required">
						    </div>
						    <div class="form-group" style="margin: 5px;">
							    <input type="tel" name="celular" class="form-control" placeholder="Celular" pattern="[0-9]{10}" title="Escribir un numero de celular valido (10 digitos)" required="required">
						    </div>
						<div class="text-center">
							<button type="submit" name="registrar" class="btn btn-primary">
								Registrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }else{
    echo "Lo siento. Ud no tiene permisos";
}?>