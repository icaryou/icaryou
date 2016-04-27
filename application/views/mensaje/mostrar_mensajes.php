<h3 onclick="actualizar_mensajes_chat()">Mensajería</h3>

<div id="panel_conversaciones">
	<ul>
	<?php foreach ($mensajes as $fila):?>
		<li><a id="<?php echo $fila['usuario_chat']?>" class="abrir_chat"><?php echo $fila['usuario_chat_nombre']?></a></li>
	<?php endforeach;?>
</ul>
</div>


<div id="panel_mensajes">
	<ul id="">
		<li><input type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></li>
	</ul>
</div>
<div class="limpiarfloat"></div>
<input type="hidden" id="conv_activa" value="0"/>
<input type="hidden" id="otro_usuario" value="0"/>