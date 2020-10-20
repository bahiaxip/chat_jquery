<?php
require_once("class/class_chat.php");
$chat=new Chat();
//$url=Connection::url();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<title>Chat con PHP y JAVASCRIPT</title>
		<link href="public/css/estilos.css" rel="stylesheet" type="text/css">
		<script src="public/js/jquery-3.5.1.min.js"></script>
		
	</head>
	<body>
		<header>
			<ul>				
				<a href="#"><li>Chat con JQuery</li></a>
			</ul>
		</header>


<!--  			inicio panel de chat                        -->
		<div class="panel-float">
			<input type="hidden" id="switch">
			<!-- boton mostrar panel -->
			<div id="btnPanel" class="btn-show-panel"  onclick="showPanel()">
				<img src="public/icons/guion_panel.png" width="32" height="32">
			</div>
			<!-- panel -->
			<div id="panel" class="panel">
				<!-- boton ocultar panel -->
				<div class="btn-hide-panel" onclick="hidePanel()">
					<img src="public/icons/guion_panel2.png" width="32" height="32">
				</div>
				<div id="chat">
					<div id="message" class="mssge">
						<?php
						if(isset($_SESSION["user"])){
							$chat->show_messages();						 
						}else{		
							$chat->show_form();
						}
						?>
					</div>
					<div id="avatar">
						<img src="public/icons/help.png" class="ima_profile" width="32" height="32">								
						<!--<p class="text_avatar">Sube tu Imagen</p>-->

						<div id="form">							
								<input type="hidden" name="fileframe" value="true">										
								<input type="file" id="file" name="image" class="file" title="Examinar">	
						</div>

						<div class="up">
							<input type="button" onclick="closeSession()" class="boton azul btn-close" value="Salir">
							<input type="button" onclick="uploadImage('#file')" class="boton azul btn-up" value="Subir">
							<input type="hidden" name="url_img" id="url_image">							
						</div>
					</div>					
					<div id="div_text">
						<textarea id="text" class="textarea" onkeydown="pressKey(event)"></textarea>
					</div>
				</div>
			</div>
		</div>

<!--  			fin panel de chat                        -->


		<section>
			<div class="content">
				<div class="text-left">			
					<aside>
						<p>
							Sabemos lo difícil que puede llegar a ser escoger el mejor cochecito para tu bebé. Por eso, y centrándonos en la marca Stokke para que no sea un post eterno, te ayudamos a decidirte entre los tres modelos de esta marca que puedes encontrar ahora mismo en tienda y que se adaptan a distintos estilos de vida.

							Todos los cochecitos Stokke tienen en común que son carritos de calidad en los que destaca que el asiento y el capazo se ubican en alto para favorecer el contacto visual entre padres e hijos. Por eso, para los papis que sois altos, ¡nada como un cochecito Stokke!
						</p>				
					</aside>
				</div>
				<div class="text-right">
					<aside>				
						<p>
							Pero no es sólo un cochecito ideal para las personas altas, gracias a que son regulables en altura, podréis ponerlos a la altura perfecta para vosotros para evitaros tener que estar continuamente agachándoos para atender a vuestro peque, como ocurre con muchas marcas del mercado en las que el bebé queda muy abajo, alejado de los padres.

							Otra ventaja con la que cuentan los carritos Stokke es que disponen de varias posiciones tanto hacia delante como hacia atrás, mirando hacia los papis o hacia el mundo, para no perderse nada de lo que les rodea, ¡incluso podrás sentar a la mesa a tu peque con el carrito!, lo que es imposible en otras marcas en las que los peques quedarían muy alejados de la mesa.
							
						</p>				
					</aside>
				</div>
			</div>
			<div class="text-hidden">
				<p>
					Sabemos lo difícil que puede llegar a ser escoger el mejor cochecito para tu bebé. Por eso, y centrándonos en la marca Stokke para que no sea un post eterno, te ayudamos a decidirte entre los tres modelos de esta marca que puedes encontrar ahora mismo en tienda y que se adaptan a distintos estilos de vida.

					Todos los cochecitos Stokke tienen en común que son carritos de calidad en los que destaca que el asiento y el capazo se ubican en alto para favorecer el contacto visual entre padres e hijos. Por eso, para los papis que sois altos, ¡nada como un cochecito Stokke!
				</p>
				<p>
					Pero no es sólo un cochecito ideal para las personas altas, gracias a que son regulables en altura, podréis ponerlos a la altura perfecta para vosotros para evitaros tener que estar continuamente agachándoos para atender a vuestro peque, como ocurre con muchas marcas del mercado en las que el bebé queda muy abajo, alejado de los padres.

					Otra ventaja con la que cuentan los carritos Stokke es que disponen de varias posiciones tanto hacia delante como hacia atrás, mirando hacia los papis o hacia el mundo, para no perderse nada de lo que les rodea, ¡incluso podrás sentar a la mesa a tu peque con el carrito!, lo que es imposible en otras marcas en las que los peques quedarían muy alejados de la mesa.
					
				</p>
			</div>
		</section>
		<script src="public/js/funciones.js"></script>
		<?php
		//si existe sesión mantener visible el botón de cerrar sesión (Salir)
		if(isset($_SESSION["user"])){
		?>
		<script>
			keepVisible();	
		</script>
		<?php } ?>
	</body>
</html>
