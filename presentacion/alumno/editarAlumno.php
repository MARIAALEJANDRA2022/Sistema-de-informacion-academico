<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "alumno" || $_SESSION["rol"] == "administrador") {
    $editado = false;
    if (isset($_POST["editar"])) {
        $salir = 0;
        $alumno = new Alumno($_GET["idAlumno"]);
        $telefono = new TelefonoAl($_GET["idAlumno"]);
        $nacionalidad = new Nacionalidad();
        $lugarnacimiento = new LugarNacimiento();
        $municipioresidencia = new MunicipioResidencia();
        $curso = new carrera_grado();
        $curso->buscar($_POST["proyecto"]);
        $alumno->consultar();
        $telefono->consultar();
        $nacionalidad1 = $nacionalidad->buscar($_POST["iD_Nacionalidad"]);
        $lugarnacimiento1 = $lugarnacimiento->buscar($_POST["iD_LugarNacimiento"]);
        $municipioresidencia1 = $municipioresidencia->buscar($_POST["iD_MunicipioResidencia"]);
        $curso1 = $curso->getCodigo();
        if ($_POST["clave"] == $alumno->getContrasena()) {
            $salir = 0;
            $i=0;
            if ($_POST["correoI"] == $alumno->getcorreoI()) {
                $salir = 0;
                    $alumno = new Alumno($_GET["idAlumno"], $_POST["nombre"], $_POST["correoP"], $curso1, $_POST["semestre_curso"], $_POST["correoI"], $_POST["clave"], $_POST["numero_ID"], $_POST["fecha_ID"], $_POST["tipoSangre"], $_POST["rH"], $_POST["direccion"], $_POST["fechaNacimiento"], $nacionalidad1, $lugarnacimiento1, $municipioresidencia1, $_POST["estado"]);
                    $telefono = new TelefonoAl($_GET["idAlumno"]);
                    $alumno->editar();
                    $telefono->editar($_POST["telefonoO"], $_POST["telefono1"], $_POST["telefono"], $_POST["telefono2"]);
                    $editado = true;
            }else{
                if ($_SESSION["rol"]=="administrador"){
                    $salir = 0;    
                }else{
                    $salir = 1;
                }
                    $alumno = new Alumno($_GET["idAlumno"], $_POST["nombre"], $_POST["correoP"], $curso1, $_POST["semestre_curso"], $_POST["correoI"], $_POST["clave"], $_POST["numero_ID"], $_POST["fecha_ID"], $_POST["tipoSangre"], $_POST["rH"], $_POST["direccion"], $_POST["fechaNacimiento"], $nacionalidad1, $lugarnacimiento1, $municipioresidencia1, $_POST["estado"]);
                    $telefono = new TelefonoAl($_GET["idAlumno"]);
                    $alumno->editar();
                    $telefono->editar($_POST["telefonoO"], $_POST["telefono1"], $_POST["telefono"], $_POST["telefono2"]);
                    $editado = true;
            }
        }else{
            $salir = 1;
                $alumno = new Alumno($_GET["idAlumno"], $_POST["nombre"], $_POST["correoP"], $curso1, $_POST["semestre_curso"], $_POST["correoI"], md5($_POST["clave"]), $_POST["numero_ID"], $_POST["fecha_ID"], $_POST["tipoSangre"], $_POST["rH"], $_POST["direccion"], $_POST["fechaNacimiento"], $nacionalidad1, $lugarnacimiento1, $municipioresidencia1, $_POST["estado"]);
                $telefono = new TelefonoAl($_GET["idAlumno"]);
                $alumno->editar();
                $telefono->editar($_POST["telefonoO"], $_POST["telefono1"], $_POST["telefono"], $_POST["telefono2"]);
                $editado = true;
        }
    }else{
        $alumno = new Alumno($_GET["idAlumno"]);
        $alumno->consultar();
        $telefono = new TelefonoAl($_GET["idAlumno"]);
        $telefono->consultar();
        $nacionalidad = new Nacionalidad();
        $lugarnacimiento = new LugarNacimiento();
        $municipioresidencia = new MunicipioResidencia();
        $curso = new carrera_grado();
        $i = 0;
    }
?>
<div class="container">
	<div class="row mt-3">
		<div class="col-3"></div>
    		<div class="col-6">
    			<div class="card border-dark mb-3">
    				<div class="card-header">
    					<h3>Editar Alumno</h3>
    				</div>
    				<div class="card-body">
        				<?php if ($editado && $salir==1) { ?>    											
                			<div class="alert alert-success alert-dismissible fade show" role="alert">
                    			<?php
                                    echo "Datos editados";
                                    session_destroy();
                                    echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
                                ?>
            				</div>
    					<?php }elseif($editado && $salir==0){ ?>
    							<div class="alert alert-success alert-dismissible fade show" role="alert">
                				    <?php
                                        echo "Datos editados";
                                        if ($_SESSION["rol"]=="administrador"){
                                            echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/alumno/consultarAlumno.php") . "';\",1500);</script>";
                                        }else{
                                            echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/sesionAlumno.php") . "';\",1500);</script>";
                                        }
                                    ?>
            					</div>
    					<?php }?>
    					<form
						        action="<?php echo "index.php?pid=" . base64_encode("presentacion/alumno/editarAlumno.php") . "&idAlumno=" . $_GET["idAlumno"] ?>" method="post">
    						    <?php if($_SESSION["rol"] == "alumno"){ ?>
        						    <div class="form-group" style="margin: 5px;">
							            <input type="text" name="nombre" class="form-control" placeholder="Nombre" pattern="[A-Za-z ]{6,100}" title="Escribir un nombre y apellido valido" value="<?php echo $alumno -> getNombre() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="email" name="correoP" class="form-control" placeholder="CorreoP" value="<?php echo $alumno -> getCorreoP() ?>" required="required">
						            </div>
						            <?php $curso = new carrera_grado($alumno->getID_proyecto());
						            $curso->consultar()?>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="proyecto" class="form-control" value="<?php echo $curso ->getNombre() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="semestre_curso" class="form-control" placeholder="semestre_curso" value="<?php echo $alumno -> getSemestre_curso() ?>" required="required">
        						    </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="correoI" class="form-control" value="<?php echo $alumno -> getCorreoI() ?>">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="password" name="clave" class="form-control" placeholder="Clave" value="<?php echo $alumno -> getContrasena() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="text" name="numero_ID" class="form-control" placeholder="Numero_ID" pattern="[0-9]{7,10}" title="Escribir un numero de identificacion valido" value="<?php echo $alumno -> getNumero_ID() ?>" required="required">
						            </div>
						            <?php $fechaid = strtotime ('+8 year' , strtotime($alumno -> getFechaNacimiento()));
            						$fechaid = date('Y-m-d',$fechaid);
            						?>
						            <div class="form-group" style="margin: 5px;">
							            <input type="text" name="fechaid" class="form-control" placeholder="Fecha de expedicion del documento" disabled>
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="date" name="fecha_ID" min="<?php echo $fechaid ?>" max="<?php echo date('Y-m-d') ?>" class="form-control" placeholder="Fecha_ID" value="<?php echo $alumno -> getFecha_ID() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="text" name="tipoSangre" class="form-control" placeholder="TipoSangre" pattern="[ABO]{1,2}" title="Escribir un tipo de sangre valido (A, B, O, AB)" value="<?php echo $alumno -> getTipoSangre() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="text" name="rH" class="form-control" placeholder="RH" pattern="[+-]{1}" title="Escribir un RH valido (+ , -)" value="<?php echo $alumno -> getRH() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="text" name="direccion" class="form-control" placeholder="Direccion" pattern="[A-Za-z0-9.- ]{6,100}" title="Escribir una direccion valida" value="<?php echo $alumno -> getDireccion() ?>" required="required">
						            </div>
						            <?php $fecha = strtotime ('-8 year' , strtotime(date('Y-m-d')));
            						$fecha = date('Y-m-d',$fecha);
            						?>
						            <div class="form-group" style="margin: 5px;">
							            <input type="text" name="fechanaci" class="form-control" placeholder="Fecha de nacimiento" disabled>
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="date" name="fechaNacimiento" max="<?php echo $fecha ?>" class="form-control" placeholder="FechaNacimiento" value="<?php echo $alumno -> getFechaNacimiento() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
            						    <div class="input-group">
                						    <input type="text" name="nacionalidad" class="form-control" placeholder="Nacionalidad: " disabled>
    							            <input type="text" name="iD_Nacionalidad" class="form-control" placeholder="Nacionalidad" value="<?php echo $nacionalidad -> mostrar($alumno->getID_Nacionalidad()) ?>" disabled>
            							</div>
        							</div>
						            <div class="form-group" style="margin: 5px;">
							            <select name="iD_Nacionalidad">
            							    <?php 
            							        $nacionalidades = $nacionalidad -> consultarTodos();
            							        foreach($nacionalidades as $nacionalidadActual){?>
            							        <option value="<?php echo $nacionalidadActual->getNacionalidad()?>"><?php echo $nacionalidadActual->getNacionalidad()?></option>
            							    <?php }?>
            							</select>
						            </div>
						            <div class="form-group" style="margin: 5px;">
            						    <div class="input-group">
                						    <input type="text" name="lugarnacimiento" class="form-control" placeholder="Lugar de nacimiento: " disabled>
							            <input type="text" name="iD_LugarNacimiento" class="form-control" placeholder="ID_LugarNacimiento" value="<?php echo $lugarnacimiento ->mostrar($alumno->getID_LugarNacimiento()) ?>" disabled>
            							</div>
                    				</div>
						            <div class="form-group" style="margin: 5px;">
							            <select name="iD_LugarNacimiento">
            							    <?php 
            							        $lugares = $lugarnacimiento -> consultarTodos();
            							        foreach($lugares as $lugarActual){?>
            							        <option value="<?php echo $lugarActual->getLugarNacimiento()?>"><?php echo $lugarActual->getLugarNacimiento()?></option>
            							    <?php }?>
            							</select>
						            </div>
						            <div class="form-group" style="margin: 5px;">
            						    <div class="input-group">
                						    <input type="text" name="municipioresidencia" class="form-control" placeholder="Municipio de residencia: " disabled>
                						    <input type="text" name="iD_MunicipioResidencia" class="form-control" placeholder="ID_MunicipioResidencia" value="<?php echo $municipioresidencia->mostrar($alumno -> getID_MunicipioResidencia()) ?>" disabled>
            							</div>
                    				</div>
						            <div class="form-group" style="margin: 5px;">
							            <select name="iD_MunicipioResidencia">
            							    <?php 
            							        $municipios = $municipioresidencia -> consultarTodos();
            							        foreach($municipios as $municipioActual){?>
            							        <option value="<?php echo $municipioActual->getMunicipioResidencia()?>"><?php echo $municipioActual->getMunicipioResidencia()?></option>
            							    <?php }?>
            							</select>
						            </div>        				
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="estado" class="form-control" placeholder="estado" value="<?php echo $alumno -> getEstado() ?>" required="required">
						            </div>
            					<?php
            					    $telefono = new TelefonoAl($alumno->getCodigo());
                                    $telefonos = $telefono->mostrar();
                                    foreach ($telefonos as $telefonoActual) {
                                        $i ++;
                                        if ($i == 1) {?>
    						    	        <div class="form-group" style="margin: 5px;">
							                    <input type="hidden" name="telefono1" class="form-control"
								                    placeholder="Telefono" value="<?php echo $telefonoActual -> getTelefono() ?>" required="required">
						                    </div>
						                    <div class="form-group" style="margin: 5px;">
							                    <input type="tel" name="telefono2" class="form-control" placeholder="Telefono" pattern="[0-9]{10}" title="Escribir un numero de telefono valido (10 digitos) (60 + indicativo de la ciudad + numero de telefono)" value="<?php echo $telefonoActual -> getTelefono() ?>" required="required">
						                    </div>
            					    <?php }else{ ?>            					
            					        <div class="form-group" style="margin: 5px;">
							                <input type="hidden" name="telefonoO" class="form-control"
								                placeholder="Telefono" value="<?php echo $telefonoActual -> getTelefono() ?>" required="required">
						                </div>
						                <div class="form-group" style="margin: 5px;">
							                <input type="tel" name="telefono" class="form-control"
								                placeholder="Telefono" pattern="[0-9]{10}" title="Escribir un numero de celular valido (10 digitos)" value="<?php echo $telefonoActual -> getTelefono() ?>" required="required">
						                </div>
    						        <?php }
                                    }
                                }elseif ($_SESSION["rol"] == "administrador") {?>
        						    <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="nombre" class="form-control"
								            placeholder="Nombre" value="<?php echo $alumno -> getNombre() ?>">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="text" name="nombre" class="form-control" value="<?php echo $alumno -> getNombre() ?>" disabled>
        						    </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="correoP" class="form-control" placeholder="CorreoP" value="<?php echo $alumno -> getCorreoP() ?>" required="required">
						            </div>
						            <?php $curso = new carrera_grado($alumno->getID_proyecto());
						            $curso->consultar()?>
						            <div class="form-group" style="margin: 5px;">
						                <div class="input-group">
    							            <input type="text" name="proyecto" class="form-control" placeholder="Proyecto" value="<?php echo $curso->getNombre() ?>" disabled>
    							            &nbsp;
            							    <select name="proyecto">
            						            <?php 
            						                $cursoop = new carrera_grado();
            						                $cursos = $cursoop->consultarTodos();
            						                foreach($cursos as $cursoActual){?>
            						                    <option value="<?php echo $cursoActual->getNombre()?>"><?php echo $cursoActual->getNombre()?></option>
            						            <?php } ?>
            						        </select>
            						    </div>
						            </div>
						            <div class="form-group" style="margin: 5px;">
						                <div class="input-group">
    							            <input type="text" name="semestre_curso" class="form-control" value="Semestre" disabled>
    							            <input type="text" name="semestre_curso" class="form-control" placeholder="semestre_curso" value="<?php echo $alumno -> getSemestre_curso() ?>" required="required">
							            </div>
        						    </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="email" name="correoI" class="form-control" placeholder="CorreoI" value="<?php echo $alumno -> getCorreoI() ?>" required="required">
						            </div> 
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="clave" class="form-control" placeholder="Clave" value="<?php echo $alumno -> getContrasena() ?>">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="numero_ID" class="form-control" placeholder="Numero_ID" value="<?php echo $alumno -> getNumero_ID() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="fecha_ID" class="form-control" placeholder="Fecha_ID" value="<?php echo $alumno -> getFecha_ID() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="tipoSangre" class="form-control" placeholder="TipoSangre" value="<?php echo $alumno -> getTipoSangre() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="rH" class="form-control" placeholder="RH" value="<?php echo $alumno -> getRH() ?>" required="required">
						            </div>
                                    <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="direccion" class="form-control" placeholder="Direccion" value="<?php echo $alumno -> getDireccion() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="fechaNacimiento" class="form-control" placeholder="FechaNacimiento" value="<?php echo $alumno -> getFechaNacimiento() ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="iD_Nacionalidad" class="form-control" placeholder="Nacionalidad" value="<?php echo $nacionalidad -> mostrar($alumno->getID_Nacionalidad()) ?>"required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="iD_LugarNacimiento" class="form-control" placeholder="ID_LugarNacimiento" value="<?php echo $lugarnacimiento ->mostrar($alumno->getID_LugarNacimiento()) ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="iD_MunicipioResidencia" class="form-control" placeholder="ID_MunicipioResidencia" value="<?php echo $municipioresidencia->mostrar($alumno -> getID_MunicipioResidencia()) ?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="estado" class="form-control" placeholder="estado" value="<?php echo $alumno -> getEstado() ?>" required="required">
						            </div>
    						    <?php } ?>	
    						    <div class="col text-center" style="margin: 5px;">
							        <button type="submit" name="editar" class="btn btn-dark">Editar</button>
						        </div>
					    </form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php
}else{
    echo "Lo siento. Usted no tiene permisos";
}?>    