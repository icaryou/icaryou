	
	
<?php if(sizeof($trayectosEncontrados)==0):?><!-- NO ENCUENTRA TRAYECTOS -->
	<h4>Lo lamentamos, no hemos encontrado trayectos con esas opciones.</h4>
<?php endif;?>

<?php if(sizeof($trayectosEncontrados)!=0):?><!--ENCUENTRA TRAYECTOS -->
	<h3>Mostrando trayectos desde <?php echo "{$camposBusqueda['poblacionOrigen']} a 
	{$camposBusqueda['poblacionDestino']}"?>
	</h3>

	<?php var_dump($camposBusqueda)?>
	<?php echo "<br/>"?>
	
	<?php echo "<br/>"?>
	<?php var_dump($trayectosEncontrados)?>
<?php endif;?>
<p><?=validation_errors();?></p>
<input TYPE="button" VALUE="Back" onClick="history.go(-1);">
