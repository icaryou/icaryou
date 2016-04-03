
	
<?php if(sizeof($trayectosPropiosEncontrados)==0):?><!-- NO ENCUENTRA TRAYECTOS -->
	<h4>Actualmente no dispones de trayectos activos.</h4>
<?php endif;?>


<h3>Trayectos Propios</h3>

<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
	<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>
		<table border="1">
			<tr>
				<td>Poblacion origen</td>
				<td>Poblacion destino</td>
				<td>Hora llegada</td>
				<td>Hora regreso</td>				
				<td>Dias</td>
				<td>Comentarios</td>
				<td>Usuarios</td>
			</tr>
			<tr>
				<td><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></td>
				<td><?php echo $trayectoAgrupado[0]['poblacionDestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['horallegadadestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['horaretornodestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['dias']?></td>
				<td><?php echo $trayectoAgrupado[0]['comentarios']?></td>
				<td><?php foreach ($trayectoAgrupado as $usu):?>
					<p><?php echo $usu["nombre"].$usu["apellidos"]?></p>
					<?php endforeach;?>
				</td>
			</tr>
		</table>		
	<?php endif;?>
<?php endforeach;?>




<h3>Trayectos Ajenos</h3>

<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
	<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>
		<table border="1">
			<tr>
				<td>Poblacion origen</td>
				<td>Poblacion destino</td>
				<td>Hora llegada</td>
				<td>Hora regreso</td>				
				<td>Dias</td>
				<td>Comentarios</td>
				<td>Usuarios</td>
			</tr>
			<tr>
				<td><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></td>
				<td><?php echo $trayectoAgrupado[0]['poblacionDestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['horallegadadestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['horaretornodestino']?></td>
				<td><?php echo $trayectoAgrupado[0]['dias']?></td>
				<td><?php echo $trayectoAgrupado[0]['comentarios']?></td>
				<td><?php foreach ($trayectoAgrupado as $usu):?>
					<p><?php echo $usu["nombre"].$usu["apellidos"]?></p>
					<?php endforeach;?>
				</td>
			</tr>
		</table>
	<?php endif;?>
<?php endforeach;?>



<input TYPE="button" VALUE="Back" onClick="history.go(-1);">
