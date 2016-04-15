<?php if(sizeof($trayectosPropiosEncontrados)==0):?><!-- NO ENCUENTRA TRAYECTOS -->
	<h4>Actualmente no dispones de trayectos activos.</h4>
<?php endif;?>
<?php if(sizeof($trayectosPropiosEncontrados)!=0):?><!-- ENCUENTRA TRAYECTOS -->


<div class="container">
		<div class="row bottom-buffer ">
			<div class="span12">
					<h2>Trayectos propios</h2>				
			</div>
		</div>
		<div class="row">
<div id="main">
    <ul id="holder">
<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->
	<li>
	<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>
		<table class="borderless">
			<tr><td class="bigCity origen"><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></td><td><img src="<?= base_url();?>assets/img/arrow.png"/></td><td class="bigCity destino"><?php echo $trayectoAgrupado[0]['poblacionDestino']?></td></tr>
			<tr><td class="bigCity"><?php echo $trayectoAgrupado[0]['horallegadadestino']?></td><td></td><td class="bigCity"><?php echo $trayectoAgrupado[0]['horaretornodestino']?></td></tr>
			<tr><td colspan="3"><?php echo $trayectoAgrupado[0]['dias']?></td></tr>
			<tr><td colspan="3"><p><strong>Comentarios:</strong></p><?php echo $trayectoAgrupado[0]['comentarios']?></td></tr>
			<tr><td colspan="3"><div class="numberCircle"><?php echo $trayectoAgrupado[0]['plazas']?></div></td></tr>
			<tr><td colspan="3"><?php foreach ($trayectoAgrupado as $usu):?>
					<p><a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]." ".$usu["apellidos"]?></a></p>
					<?php if($usu["usuarioId"]==$this->session->userdata('id')):?>
						<?php $pintarAbandonar=TRUE?>
					<?php endif;?>
					<?php endforeach;?></td></tr>
	<tr><td colspan="3"><?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']>sizeof($trayectoAgrupado)):?>				
					<button class="unirse_trayecto" onclick='location.href="<?php echo base_url('usuario/unirse_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Unirse</button>				 
					<?php endif;?>
					
					<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if($pintarAbandonar):?>				
					<button class="abandonar_trayecto" onclick='location.href="<?php echo base_url('usuario/abandonar_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Abandonar</button>				 
					<?php endif;?></td></tr>
			
		</table>		
	<?php endif;?>
<?php endforeach;?>
</li>
</div>
</div>
</div>







<?php endif;?>

<script src="<?= base_url();?>assets/js/paginator.js"></script>
<h3>Trayectos Ajenos</h3>

<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>
		<table border="1">
			<tr>
				<td>Poblacion origen</td>
				<td>Poblacion destino</td>
				<td>Hora llegada</td>
				<td>Hora regreso</td>				
				<td>Dias</td>
				<td>Comentarios</td>
				<td>Plazas máximas</td>
				<td>Usuarios</td>
			</tr>
			<tr>
			<!-- COGEMOS LOS DATOS GENRALES DE UNA FILA, LA PRIMERA PORQUE EN TODAS SON IGUALES -->
				<td><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></td>
				<td><?php echo $trayectoAgrupado[0]['poblacionDestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['horallegadadestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['horaretornodestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['dias']?></td>
				<td><?php echo $trayectoAgrupado[0]['comentarios']?></td>
				<td><?php echo $trayectoAgrupado[0]['plazas']?></td>
				<!-- Y SOLO ITERAMOS DE NUEVO PARA PINTAR LOS USUARIOS QUE NOS HA DEVUELTO -->
				<td><?php foreach ($trayectoAgrupado as $usu):?>
					<p><a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]." ".$usu["apellidos"]?></a></p>
					<?php if($usu["usuarioId"]==$this->session->userdata('id')):?>
						<?php $pintarAbandonar=TRUE?>
					<?php endif;?>
					<?php endforeach;?>
				</td>
				<td>
					<!-- PINTAMOS UNIRSE SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']>sizeof($trayectoAgrupado)):?>				
					<button class="unirse_trayecto" onclick='location.href="<?php echo base_url('usuario/unirse_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Unirse</button>				 
					<?php endif;?>
					
					<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if($pintarAbandonar):?>				
					<button class="abandonar_trayecto" onclick='location.href="<?php echo base_url('usuario/abandonar_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Abandonar</button>				 
					<?php endif;?>
				</td>
			</tr>
			
			
		</table>		
	<?php endif;?>
<?php endforeach;?>



<input TYPE="button" VALUE="Back" onClick="history.go(-1);">

