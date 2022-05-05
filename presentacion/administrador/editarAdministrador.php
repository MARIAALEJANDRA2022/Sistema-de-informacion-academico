<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "administrador") {
    $editado = false;
    if (isset($_POST["editar"])) {
        $salir = 0;
        $administrador = new Administrador($_GET["idAdministrador"]);
        $telefono = new TelefonoAd($_GET["idAdministrador"]);
        $nacionalidad = new Nacionalidad();
        $lugarnacimiento = new LugarNacimiento();
        $municipioresidencia = new MunicipioResidencia();
        $administrador->consultar();
        $telefono->consultar();
        $nacionalidad1 = $nacionalidad->buscar($_POST["iD_Nacionalidad"]);
        $lugarnacimiento1 = $lugarnacimiento->buscar($_POST["iD_LugarNacimiento"]);
        $municipioresidencia1 = $municipioresidencia->buscar($_POST["iD_MunicipioResidencia"]);
        if ($_POST["clave"] == $administrador->getContrasena()) {
            $salir = 0;
            $i = 0;
            if ($_POST["correoI"] == $administrador->getcorreoI()) {
                $salir = 0;
                $administrador = new Administrador($_GET["idAdministrador"], $_POST["nombre"], $_POST["correoP"], $_POST["correoI"], $_POST["clave"], $_POST["numero_ID"], $_POST["fecha_ID"], $_POST["tipoSangre"], $_POST["rH"], $_POST["direccion"], $_POST["fechaNacimiento"], $nacionalidad1, $lugarnacimiento1, $municipioresidencia1);
                $telefono = new TelefonoAd($_GET["idAdministrador"]);
                $administrador->editar();
                $telefono->editar($_POST["telefonoO"], $_POST["telefono1"], $_POST["telefono"], $_POST["telefono2"]);
                $editado = true;
            } else {
                $salir = 1;
                $administrador = new Administrador($_GET["idAdministrador"], $_POST["nombre"], $_POST["CorreoP"], $_POST["correoI"], $_POST["clave"], $_POST["numero_ID"], $_POST["fecha_ID"], $_POST["tipoSangre"], $_POST["rH"], $_POST["direccion"], $_POST["fechaNacimiento"], $nacionalidad1, $lugarnacimiento1, $municipioresidencia1);
                $telefono = new TelefonoAd($_GET["idAdministrador"]);
                $administrador->editar();
                $telefono->editar($_POST["telefonoO"], $_POST["telefono1"], $_POST["telefono"], $_POST["telefono2"]);
                $editado = true;
            }
        } else {
            $salir = 1;
            $administrador = new Administrador($_GET["idAdministrador"], $_POST["nombre"], $_POST["correoP"], $_POST["correoI"], md5($_POST["clave"]), $_POST["numero_ID"], $_POST["fecha_ID"], $_POST["tipoSangre"], $_POST["rH"], $_POST["direccion"], $_POST["fechaNacimiento"], $nacionalidad1, $lugarnacimiento1, $municipioresidencia1);
            $telefono = new TelefonoAd($_GET["idAdministrador"]);
            $administrador->editar();
            $telefono->editar($_POST["telefonoO"], $_POST["telefono1"], $_POST["telefono"], $_POST["telefono2"]);
            $editado = true;
        }
    } else {
        $administrador = new Administrador($_GET["idAdministrador"]);
        $administrador->consultar();
        $telefono = new TelefonoAd($_GET["idAdministrador"]);
        $telefono->consultar();
        $nacionalidad = new Nacionalidad();
        $lugarnacimiento = new LugarNacimiento();
        $municipioresidencia = new MunicipioResidencia();
        $i = 0;
    }
    ?>
<div class="container">
	<div class="row mt-3">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="card border-dark mb-3">
				<div class="card-header">
					<h3>Editar Administrador</h3>
				</div>
				<div class="card-body">
    					<?php if ($editado && $salir==1) { ?>    											
                				<div
						class="alert alert-success alert-dismissible fade show"
						role="alert">
                					<?php
        echo "Datos editados";
        session_destroy();
        echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
        ?>
            					</div>
    					<?php }elseif($editado && $salir==0){ ?>
    							<div class="alert alert-success alert-dismissible fade show"
						role="alert">
                					<?php
        echo "Datos editados";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/sesionAdministrador.php") . "';\",1500);</script>";
        ?>
            					</div>
    					<?php }?>
    					<form
						action="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/editarAdministrador.php") . "&idAdministrador=" . $_GET["idAdministrador"] ?>"
						method="post">
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="nombre" class="form-control"
								placeholder="Nombre" value="<?php echo $administrador -> getNombre() ?>" pattern="[A-Za-z ]{6,100}" title="Escribir un nombre y apellido valido" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="email" name="correoP" class="form-control" placeholder="CorreoP" value="<?php echo $administrador -> getCorreoP() ?>" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="email" name="correoI" class="form-control" placeholder="CorreoI" value="<?php echo $administrador -> getcorreoI() ?>" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="password" name="clave" class="form-control" placeholder="Clave" value="<?php echo $administrador -> getContrasena() ?>" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="numero_ID" class="form-control" placeholder="Numero_ID" value="<?php echo $administrador -> getNumero_ID() ?>" pattern="[0-9]{7,10}" title="Escribir un numero de identificacion valido" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
						    <input type="text" name="fechaid" class="form-control" placeholder="Fecha de expedicion del documento" disabled>
						</div>
						<?php $fechaid = strtotime ('-10 year' , strtotime(date('Y-m-d')));
						$fechaid = date('Y-m-d',$fechaid);
						$fechamax= strtotime ('-1 day' , strtotime(date('Y-m-d')));
						$fechamax= date('Y-m-d',$fechamax);
						?>
						<div class="form-group" style="margin: 5px;">
							<input type="date" name="fecha_ID" min="<?php echo $fechaid?>" 
							max="<?php echo $fechamax?>" class="form-control" placeholder="Fecha_ID" value="<?php echo $administrador -> getFecha_ID() ?>" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="tipoSangre" class="form-control" placeholder="TipoSangre" value="<?php echo $administrador -> getTipoSangre() ?>" pattern="[ABO]{1,2}" title="Escribir un tipo de sangre valido (A, B, O, AB)" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="rH" class="form-control" placeholder="RH" value="<?php echo $administrador -> getRH() ?>" pattern="[+-]{1}" title="Escribir un RH valido (+ , -)" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="text" name="direccion" class="form-control" placeholder="Direccion" value="<?php echo $administrador -> getDireccion() ?>" pattern="[A-Za-z0-9.- ]{6,100}" title="Escribir una direccion valida" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
						    <input type="text" name="fechanaci" class="form-control" placeholder="Fecha de nacimiento" disabled>
						</div>
						<?php $fecha = strtotime ('-17 year' , strtotime(date('Y-m-d')));
						$fecha = date('Y-m-d',$fecha);
						?>
						<div class="form-group" style="margin: 5px;">
							<input type="date" name="fechaNacimiento" max="<?php echo $fecha ?>" class="form-control" placeholder="FechaNacimiento" 
							    value="<?php echo $administrador -> getFechaNacimiento() ?>" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
							<input type="hidden" name="iD_Nacionalidadn" class="form-control" placeholder="ID_Nacionalidadn" value="<?php echo $administrador->getID_Nacionalidad() ?>" required="required">
						</div>
						<div class="form-group" style="margin: 5px;">
						    <div class="input-group">
    						    <input type="text" name="nacionalidad" class="form-control" placeholder="Nacionalidad: " disabled>
    						    <input type="text" name="nacionalidad" class="form-control" placeholder="Nacionalidad" value="<?php echo $nacionalidad -> mostrar($administrador->getID_Nacionalidad()) ?>" disabled>
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
    						    <input type="text" name="lugarnacimiento" class="form-control" placeholder="ID_LugarNacimiento" value="<?php echo $lugarnacimiento ->mostrar($administrador->getID_LugarNacimiento()) ?>" disabled>
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
    						    <input type="text" name="municipioresidencia" class="form-control" placeholder="ID_MunicipioResidencia" value="<?php echo $municipioresidencia->mostrar($administrador -> getID_MunicipioResidencia()) ?>" disabled>
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
    					<?php
                            $telefono = new TelefonoAd($administrador->getCodigo());
                            $telefonos = $telefono->mostrar();
                            foreach ($telefonos as $telefonoActual) {
                                $i ++;
                                if ($i == 1) {
                        ?>    		        	        						    						    
    						    	<div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="telefono1" class="form-control" placeholder="Telefono" value="<?php echo $telefonoActual -> getTelefono()?>" required="required">
						            </div>
						            <div class="form-group" style="margin: 5px;">
							            <input type="tel" name="telefono2" class="form-control" placeholder="Telefono" value="<?php echo $telefonoActual -> getTelefono()?>" pattern="[0-9]{10}" title="Escribir un numero de telefono valido (10 digitos) (60 + indicativo de la ciudad + numero de telefono)" required="required">
						            </div>	                                        			                
						        <?php
                                } else {?>            					
            					    <div class="form-group" style="margin: 5px;">
							            <input type="hidden" name="telefonoO" class="form-control" placeholder="Telefono" value="<?php echo $telefonoActual -> getTelefono()?>" required="required">
						            </div>
            						<div class="form-group" style="margin: 5px;">
            							<input type="tel" name="telefono" class="form-control" placeholder="Telefono" value="<?php echo $telefonoActual -> getTelefono()?>" pattern="[0-9]{10}" title="Escribir un numero de celular valido (10 digitos)" required="required">
            						</div>
    						    <?php
                                }
                            }
                            ?>
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
} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>    