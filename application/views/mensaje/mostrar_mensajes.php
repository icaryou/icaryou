<div id="contenedor_mensajeria">

<!--  
<h3 id="titulo_mensajes">Mensajes</h3>
-->
<!--aQUI PINTAMOS LAS CONVERSACIONES ACTIVAS DEL USUARIO-->
<div id="contenedor_paneles">

	<div id="suplemento_conversaciones">
		
	</div>
	
	<div id="suplemento_mensajes">
		
	</div>

	<div id="panel_conversaciones">
		<h2 id="titulo_conversaciones">Conversaciones</h2>
		<ul>
			<?php foreach ($mensajes as $fila):?>
				<li><a id="<?php echo $fila['usuario_chat']?>" class="abrir_chat"><?php echo $fila['usuario_chat_nombre']?></a></li>
			<?php endforeach;?>
		</ul>
	</div>



	<!--PINTAMOS EL DIV DE LOS MENSAJES CON ID 0 Y EL CAMPO INPUT SOLO QUE ESTARA INVISIBLE DE MOMENTO-->
	<div id="panel_mensajes">
		<ul id="0">
			
			<!-- ORIGIN
			
			 
			 <li id="li_input_oculto"><input type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></li>
			 -->
		</ul>
	</div>
	
	<!-- NEW -->
	<div id="li_input"><input maxlength="140" type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></div>
	
	<div class="limpiarfloat">
	
	</div>

</div><!-- FIN CONTENEDOR PANELES -->

</div><!-- FIN CONTENEDOR MENSAJERIA -->



<!--CAMPO HIDDEN PARA IR GUARDANDO EL VALOR DE LA CONVERSACION ACTIVA-->
<input type="hidden" id="conv_activa" value="0"/>

<!--SI NECESITAMOS ABRIR UNA CONVERSACION AL CARGAR LA PAGINA LA GUARDAREMOS AQUI-->
<?php if (isset ($activarConversacion)):?>
	<input type="hidden" id="activar_conv" value="<?php echo $activarConversacion?>"/>
<?php endif;?>
<?php if (!isset ($activarConversacion)):?>
	<input type="hidden" id="activar_conv" value="0"/>
<?php endif;?>

<!-- PINTARIAMOS UN CAMPO HIDDEN SI FUERA UN INICIO DE CONVERSACION  PARA QUE ESCRIBA EL PRIMER MENSAJE-->
<?php if (isset($abrirEmergente)&&$abrirEmergente==1):?>
	<input type="hidden" id="abrirEmergente" value="1"/>
<?php endif;?>

<!--CAMPO HIDDEN PARA IR GUARDANDO EL VALOR DEL OTRO USUARIO DE CONVERSACION-->
<input type="hidden" id="otro_usuario" value="0"/>




<a id="botonToogelador" data-toggle="modal" href="#inicio_conversacion_div">Toogelador</a>

<?php if($abrirEmergente==1):?><!-- Esto lo dejo por si acaso pero funciona lo de abajo -->
<!--  
	<div id="dialog">
	<img title="Cerrar" id="imagen_cierre_popup" src="<?php echo base_url()?>assets/img/cross.png"/>
	<p id="titulo_dialog" class="centrado titulo-mediano">Iniciar conversacion con .......</p>
	<form action="<?php echo base_url()?>Mensaje/crear_mensaje" method="post">
	<div id="mensaje_inicio">
		<label class="titulo-mediano">Mensaje</label>
		<textarea id="texto_mensaje" name="texto"></textarea>
	</div>
	<input type="hidden" id="id_otro_usuario_mensaje" name="id_otro_usuario_mensaje" value="<?php echo $id_otro_usuario_mensaje?>"/>	
	<input type="hidden" id="nueva_conversacion" name="nueva_conversacion" value="1"/>	
	<input type="submit" id="boton_dialog" class="centrado btn btn-primary" value="Enviar"/>		
	</form>
	
</div>

<div id="sombra"></div>
-->
<?php endif;?>


<?php if($abrirEmergente==1):?>
<!--  Login form -->
<div class="modal hide fade in" id="inicio_conversacion_div" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4>Iniciar conversación con ...</h4>		
	</div>
	<!--Modal Body-->
	<div class="modal-body">

<!-- action="<?=base_url('usuario/loginUsuarioPost')?>" method="post" -->

		<form id="formularioLogin" class="form-inline loginForm" method="post" action="<?php echo base_url()?>Mensaje/crear_mensaje" >
		
			<label>Mensaje</label> 
			<textarea name="texto" id="texto_textarea"
				class="form-control" rows=5 cols=10> </textarea>												

			<input type="hidden" id="id_otro_usuario_mensaje" name="id_otro_usuario_mensaje" value="<?php echo $id_otro_usuario_mensaje?>"/>	
			<input type="hidden" id="nueva_conversacion" name="nueva_conversacion" value="1"/>				 
			<input type="submit" value="Enviar mensaje" class="btn btn-primary left-buffer" tabindex="7">
		</form>


	</div>
	<!--/Modal Body-->
</div>


<?php endif;?>