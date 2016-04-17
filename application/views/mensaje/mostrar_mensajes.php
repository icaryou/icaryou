<h3>Mensajería</h3>

<div id="panel_conversaciones"></div>

<ul>
<?php foreach ($mensajes as $fila):?>
	<li><a id="<?php echo $fila['usuario_chat']?>" class="abrir_chat"><?php echo $fila['usuario_chat_nombre']?></a></li>
<?php endforeach;?>
</ul>
<div id="panel_mensajes">
	<ul id="lista_chat"></ul>
</div>
