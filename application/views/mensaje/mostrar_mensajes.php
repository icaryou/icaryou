<h3 onclick="actualizar_mensajes_chat()">Mensajería</h3>

<!--aQUI PINTAMOS LAS CONVERSACIONES ACTIVAS DEL USUARIO-->
<div id="panel_conversaciones">
	<ul>
		<?php foreach ($mensajes as $fila):?>
			<li><a id="<?php echo $fila['usuario_chat']?>" class="abrir_chat"><?php echo $fila['usuario_chat_nombre']?></a></li>
		<?php endforeach;?>
	</ul>
</div>

<!--PINTAMOS EL DIV DE LOS MENSAJES CON ID 0 Y EL CAMPO INPUT SOLO QUE ESTARA INVISIBLE DE MOMENTO-->
<div id="panel_mensajes">
	<ul id="0">
		
		<li id="li_input"><input type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></li>
		
	</ul>
</div>
<div class="limpiarfloat"></div>

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
<?php if (isset($abrirEmergente)):?>
	<input type="hidden" id="abrirEmergente" value="1"/>
<?php endif;?>

<!--CAMPO HIDDEN PARA IR GUARDANDO EL VALOR DEL OTRO USUARIO DE CONVERSACION-->
<input type="hidden" id="otro_usuario" value="0"/>



<input type="button" id="botonPM" value="botonPM"/>


<div id="dialog">
	<img title="Cerrar" id="imagen_cierre_popup" src="<?php echo base_url()?>assets/img/cross.png"/>
	<p id="titulo_dialog" class="centrado titulo-mediano">Iniciar conversacion con .......</p>
	<form action="<?php echo base_url()?>general/Gastos/generar_nueva_hoja_gastos" method="post">
	<div id="mensaje_inicio">
		<label class="titulo-peque">Mensaje</label>
		<input id="mes_seleccion" name="mes_seleccion" maxlength="2" type="text">
	</div>
			
	</form>
	<button id="boton_dialog" class="centrado buttonGenericoPeque">Enviar</button>
</div>

<div id="sombra"></div>

