<!-- variable que necesitaremos para pintar los botones de unirse o no -->
<?php $pintarAbandonar=FALSE?>	
	
<?php if(sizeof($trayectosEncontrados)==0):?><!-- NO ENCUENTRA TRAYECTOS -->
	<h4>Lo lamentamos, no hemos encontrado trayectos con esas opciones.</h4>
<?php endif;?>

<?php if(sizeof($trayectosEncontrados)!=0):?><!--ENCUENTRA TRAYECTOS -->
	<h3>Mostrando trayectos desde <?php echo "{$camposBusqueda['poblacionOrigen']} a 
	{$camposBusqueda['poblacionDestino']}"?>
	</h3>
	
	
	
	
	<?php foreach ($trayectosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	
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
					
					<!-- PINTAMOS COMPLETO SI NO ESTA EN EL TRAYECTO Y NO HAY PLAZAS DISPONIBLES -->
					<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']==sizeof($trayectoAgrupado)):?>				
					<p>Trayecto completo</p>				 
					<?php endif;?>
					
					<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if(isset($pintarAbandonar)&&$pintarAbandonar):?>				
					<button class="abandonar_trayecto" onclick='location.href="<?php echo base_url('usuario/abandonar_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Abandonar</button>				 
					<?php endif;?>
				</td>
			</tr>
			
			
		</table>		
	
<?php endforeach;?>
	
	
	
	<!--  
	<?php var_dump($camposBusqueda)?>
	<?php echo "<br/>"?>
	<?php echo $camposBusqueda['cpOrigen']?>
	<?php echo "<br/>"?>
	<?php var_dump($trayectosEncontrados)?>
	-->
<?php endif;?>
<p><?=validation_errors();?></p>
<input TYPE="button" VALUE="Back" onClick="history.go(-1);">
