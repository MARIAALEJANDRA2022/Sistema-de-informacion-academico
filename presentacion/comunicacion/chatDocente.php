<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if ($_SESSION["rol"] == "alumno") {
    $enviado = false;
    if (isset($_POST["enviar"])) {
        date_default_timezone_set('America/Bogota');
        $chat = new chat($_POST["id"], $_POST["nombre"], $_POST["destinatario"], $_POST["mensaje"], date('Y-m-d'), date('H:i:s'));
        $chat->crear();
        $enviado = true;
    }
    ?>
<html>
<meta http-equiv="refresh" content="20">
<div class="container-fluid row justify-content-center">
	<div class="row mt-3">
		<div class="col-12">
			<div class="card text-center" style="width: 20rem;">
				<div class="card-header">
					<h2>
                    	<?php echo $_GET["nombre"] ?> 
                      		<span style="color: #dd7ff3;"></span>
					</h2>
				</div>
				<div class="card-body"
					style="background-image: url(img/fondo.jpg); background-size: 100% 100%;">	 
					<?php if ($enviado) { ?>						
						<div class="alert alert-success alert-dismissible fade show"
						role="alert">
    						<?php
    						echo "Datos ingresados";
        echo "<script>setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/comunicacion/chatDocente.php") . "&nombre=" . $_GET["nombre"] . "';\",1500);</script>";
        ?>
    						</div>
    					<?php } ?>
                    <div class="display-chat" id="display-chat">	
                        <?php
    $chat = new chat();
    $alumno = new Alumno($_SESSION["id"]);
    $alumno->consultar();
    $totalR = $chat->registros($_GET["nombre"], $alumno->getNombre());
    $mensajes = $chat->consultar($_GET["nombre"], $alumno->getNombre());
    $total = $chat->Totalregistros();
    if ($totalR == 0 && $total != 0 || $totalR != 0 && $total != 0 || $totalR == 0 && $total != 0) {
        $id = $total + 1;
    } elseif ($totalR == 0 && $total == 0) {
        $id = $totalR + 1;
    }
    $i = 0;
    if ($totalR != 0) {
        ?>                                
								<div class="message">                                    	
                                	<?php

foreach ($mensajes as $mensajeActual) {
            $fecha = $chat->fecha($mensajeActual->getFecha());
            if ($fecha == 1) {
                ?>
                                   		<div
								style="font-size: 18px; background-color: #ABB2B9">
								<b> <?php echo $mensajeActual->getFecha();?> </b>
							</div>   
                                   	  	<?php }elseif ($i==0){?>     
										       		<div
								style="font-size: 18px; background-color: #ABB2B9";>
								<b> <?php echo $mensajeActual->getFecha();?> </b>
							</div>
							<br>
                                   		<?php } if ($mensajeActual->getNombre()==$alumno->getNombre()){?>                                     			                                   		    
                                           			<div
								style="text-align: right; font-size: 18px; background-color: #DEE9F0">
								<b><span> 
                                               				<?php echo $mensajeActual->getNombre(); ?> :
                                               			</span></b>                                        		                                            	
              											<?php echo $mensajeActual->getMensaje();?>
               										</div>
							<div
								style="text-align: right; font-size: 12px;; background-color: #DEE9F0">        											        											
               							  				<?php echo $mensajeActual->getHora();?>        										
               										</div>
							<br>           									               									               									
										<?php }else{?>
										    		<div
								style="text-align: left; font-size: 18px; background-color: #EBDEF0">
								<b><span>
										    				<?php echo $mensajeActual->getNombre(); ?> :
                                               			</span></b>                                        		                                            	
              										<?php echo $mensajeActual->getMensaje();?>
               										</div>
							<div
								style="text-align: left; font-size: 12px;; background-color: #EBDEF0">        											        											
               							  				<?php echo $mensajeActual->getHora();?>        										
               										</div>
							<br>          
								    	      <?php }?>												
									<?php $i++; }?>
   								</div>
                            <?php
    } else {
        ?>
                            	<div class="message">
							<font color="Indigo">
								<p>
									<b>No hay ninguna conversaci&oacuten previa.</b>
								</p>
							</font>
						</div>
                            <?php

}
    ?>
                    	<form class="form-horizontal"
							action="<?php echo "index.php?pid=" . base64_encode("presentacion/comunicacion/chatDocente.php") . "&nombre=" . $_GET["nombre"]?> "
							method="post">
							<div class="form-group" style="margin: 5px;">
								<input type="hidden" name="id" class="form-control" placeholder="Nombre" required="required" value="<?php echo $id?>">
							</div>
							<div class="form-group" style="margin: 5px;">
								<input type="hidden" name="nombre" class="form-control" placeholder="Nombre" required="required" value="<?php echo $alumno->getNombre()?>">
							</div>
							<div class="form-group" style="margin: 5px;">
								<input type="hidden" name="destinatario" class="form-control" placeholder="Nombre" required="required" value="<?php echo $_GET["nombre"]?>">
							</div>
							<div class="form-group">
								<div>
									<textarea name="mensaje" class="form-control" placeholder="Ingresa tu mensaje ac&aacute..."></textarea>
									<br>
								</div>
								<div>
									<button type="submit" name="enviar" class="btn btn-info">
										<i class='fas fa-paper-plane'></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</html>
<script>
      $(document).ready(function(){
        var trigger = $('.container .display-chat '),
            container = $('#content');
        trigger.on('click', function(){
          var $this = $(this),
            target = $this.data('target');       
          container.load(target + '.php');
          return false;
        });
      });
</script>
<?php

} else {
    echo "Lo siento. Usted no tiene permisos";
}
?>