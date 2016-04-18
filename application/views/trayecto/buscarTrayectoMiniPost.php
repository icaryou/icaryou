<div class="container">
<div class="row">
		<div class="span2">
		<h2>Filtrar</h2>
		
		<form id="formularioFiltro"
				action="<?=base_url('trayecto/filtrarTrayectoPost')?>" method="post"
				class="form-horizontal formularioGenerico">
				
		<input type="hidden" name="poblacionOrigen" id="poblacionOrigen" value="<?php echo "{$camposBusqueda['poblacionOrigen']}"?>"/>
		<input type="hidden" name="poblacionDestino" id="poblacionDestino" value="<?php echo "{$camposBusqueda['poblacionDestino']}"?>"/>
		
		
		
		<script>
			  $(function() {
			    $( "#slider-range1" ).slider({
			      range: true,
			      min: 0,
			      max: 23,
			      values: [ 9, 18 ],
			      slide: function( event, ui ) {
			        $( "#horaSalidaRango" ).val( ui.values[ 0 ] + "h - " + ui.values[ 1 ] +"h" );
			      }
			    });
			    $( "#horaSalidaRango" ).val( $( "#slider-range1" ).slider( "values", 0 ) +
			      "h - " + $( "#slider-range1" ).slider( "values", 1 )+"h" );
			  });

			  $(function() {
				    $( "#slider-range2" ).slider({
				      range: true,
				      min: 0,
				      max: 23,
				      values: [ 9, 18 ],
				      slide: function( event, ui ) {
				        $( "#horaRegresoRango" ).val( ui.values[ 0 ] + "h - " + ui.values[ 1 ] +"h" );
				      }
				    });
				    $( "#horaRegresoRango" ).val( $( "#slider-range2" ).slider( "values", 0 ) +
				      "h - " + $( "#slider-range2" ).slider( "values", 1 )+"h" );
				  });

  		</script>	


  	<label for="horaSalidaRango" class="labelFilter">Hora de salida:</label>
  
  	<input type="text" id="horaSalidaRango" class="top-buffer10" readonly style="border:0; color:#777; font-weight:bold; width:60px;">
	<div id="slider-range1" class="top-buffer"></div>
	
	
	<label for="horaRegresoRango" class="labelFilter">Hora de regreso:</label>
  
  	<input type="text" id="horaRegresoRango" class="top-buffer10" readonly style="border:0; color:#777; font-weight:bold; width:60px;">
	<div id="slider-range2" class="top-buffer"></div>
		
		
		<p class="labelFilter">Días:</p>
		<div class="diasFilter" >
			<input type="checkbox" name="dias[]" id="L" value="L" /> 
			<label for="L">L</label>
		</div>
		<div class="diasFilter" >
			<input type="checkbox" name="dias[]" id="M" value="M"> 
			<label for="M">M</label>
		</div>
		<div class="diasFilter" >
			<input type="checkbox" name="dias[]" id="X" value="X">  
			<label for="X">X</label>
		</div>
		<div class="diasFilter" >
			<input type="checkbox" name="dias[]" id="J" value="J">   
			<label for="J">J</label>
		</div>
		<div class="diasFilter" >
			<input type="checkbox" name="dias[]" id="V" value="V">   
			<label for="V">V</label>
		</div>
		<div class="diasFilter" >
			<input type="checkbox" name="dias[]" id="S" value="S"> 
			<label for="S">S</label>
		</div>
		<div class="diasFilter" >
			<input type="checkbox" name="dias[]" id="D" value="D">   
			<label for="D">D</label>
		</div>
		
		<input type="submit" value="Filtrar búsqueda" class="btn btn-primary btn-block btn-lg top-buffer" />
		
		</form>
		</div>
		<div class="span10">
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
		</div>
</div>

</div>
<script>
$(document).ready(function () {
	$('#horaSalida').on('input', function(){
		$('#horaSalidaOut').val($('#horaSalida').val());
	});
	$('#horaRegreso').on('input', function(){
		$('#horaRegresoOut').val($('#horaRegreso').val());
	});
	$('#horaSalidaOut').on('input', function(){
		$('#horaSalida').val($('#horaSalidaOut').val());
	});
	$('#horaRegresoOut').on('change', function(){
		$('#horaRegreso').val($('#horaRegresoOut').val());
	});
});
</script>
