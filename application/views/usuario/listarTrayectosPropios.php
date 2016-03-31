<?php var_dump($trayectosPropiosEncontrados)?>	
	
<?php if(sizeof($trayectosPropiosEncontrados)==0):?><!-- NO ENCUENTRA TRAYECTOS -->
	<h4>Actualmente no dispones de trayectos activos.</h4>
<?php endif;?>


<h3>Trayectos Propios</h3>
<?php if(sizeof($trayectosPropiosEncontrados['propios'])!=0):?><!--ENCUENTRA TRAYECTOS PROPIOS -->	
	<?php var_dump($trayectosPropiosEncontrados['propios'])?>
	<?php echo "<br/>"?>
<?php endif;?>

<?php if(sizeof($trayectosPropiosEncontrados['propios'])==0):?><!--ENCUENTRA TRAYECTOS PROPIOS -->
	<p>No dispones de trayectos propios</p>
	<?php echo "<br/>"?>
<?php endif;?>


<h3>Trayectos Ajenos</h3>
<?php if(sizeof($trayectosPropiosEncontrados['ajenos'])!=0):?><!--ENCUENTRA TRAYECTOS PROPIOS -->	
	<?php var_dump($trayectosPropiosEncontrados['ajenos'])?>
	<?php echo "<br/>"?>
<?php endif;?>

<?php if(sizeof($trayectosPropiosEncontrados['ajenos'])==0):?><!--ENCUENTRA TRAYECTOS PROPIOS -->
	<p>No dispones de trayectos ajenos</p>
	<?php echo "<br/>"?>
<?php endif;?>

<input TYPE="button" VALUE="Back" onClick="history.go(-1);">
