
		<script>
		/* script que controla los sliders de la hora */
			  $(function() {
			    $( "#slider-range1" ).slider({
			      range: true,
			      min: 0,
			      max: 23,
			      values: [ 9, 18 ],
			      slide: function( event, ui ) {
				    //El formato que devuelve es 9h y debo pasarlo a 09h asiq miro la longitud del numero
				    $hora1="";
				    if(((ui.values[ 0 ]).toString()).length == 1){
				    	$hora1="0" + ui.values[ 0 ] + ":00";
					}else{
						$hora1=ui.values[ 0 ] + ":00";
					}
				    $hora2="";
				    if(((ui.values[ 1 ]).toString()).length == 1){
				    	$hora2="0" + ui.values[ 1 ] + ":00";
					}else{
						$hora2=ui.values[ 1 ] + ":00";
					}

			        $( "#horaSalidaRango" ).val( $hora1 + " - " + $hora2 );
			      }
			    });
			    //Pongo la hora a mano porque con la funcion de abajo no me pone el 0 delante del 9
			    $( "#horaSalidaRango" ).val("09:00 - 18:00");
			    /*
			    $( "#horaSalidaRango" ).val( $( "#slider-range1" ).slider( "values", 0 ) +
			      ":00 - " + $( "#slider-range1" ).slider( "values", 1 )+":00");
			      */
			  });

			  $(function() {
				    $( "#slider-range2" ).slider({
				      range: true,
				      min: 0,
				      max: 23,
				      values: [ 9, 18 ],
				      slide: function( event, ui ) {
				    	  $hora1="";
						    if(((ui.values[ 0 ]).toString()).length == 1){
						    	$hora1="0" + ui.values[ 0 ] + ":00";
							}else{
								$hora1=ui.values[ 0 ] + ":00";
							}
						    $hora2="";
						    if(((ui.values[ 1 ]).toString()).length == 1){
						    	$hora2="0" + ui.values[ 1 ] + ":00";
							}else{
								$hora2=ui.values[ 1 ] + ":00";
							}

						$( "#horaRegresoRango" ).val( $hora1 + " - " + $hora2 );  
				      }
				    });
				    $( "#horaRegresoRango" ).val("09:00 - 18:00");
				    /*
				    $( "#horaRegresoRango" ).val( $( "#slider-range2" ).slider( "values", 0 ) +
				      ":00 - " + $( "#slider-range2" ).slider( "values", 1 )+":00" );
				    */
				  });
					  

  		</script>	

<div class="container">
<div class="row">
		<div class="span2">
		<h2>Filtrar</h2>
		<div class="separadorHori"></div>
			<form id="formularioFiltro" action="<?php echo base_url()?>trayecto/filtrarTrayectoPost" method="post"
					class="form-horizontal formularioGenerico">
				
				<input type="hidden" id="busquedaOrigen" name="busquedaOrigen" value="<?php echo $camposBusqueda['poblacionOrigen'] ?>"/>
				<input type="hidden" id="busquedaDestino" name="busquedaDestino" value="<?php echo $camposBusqueda['poblacionDestino'] ?>"/>
				
			  	<label for="horaSalidaRango" class="labelFilter">Hora de salida:</label>
	  
			  	<input type="text" id="horaSalidaRango" name="horaSalidaRango" class="top-buffer10" readonly style="border:0; color:#777; font-weight:bold; width:90px;">
				<div id="slider-range1" class="top-buffer"></div>
				
				
				<label for="horaRegresoRango" class="labelFilter top-buffer">Hora de regreso:</label>
			  
			  	<input type="text" id="horaRegresoRango" name="horaRegresoRango" class="top-buffer10" readonly style="border:0; color:#777; font-weight:bold; width:90px;">
				<div id="slider-range2" class="top-buffer"></div>
			
				
				<p class="labelFilter top-buffer">Días:</p>
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
				
				<div class="form-group top-buffer">
					<label for="poblacionOrigenFil" class="labelFilter top-buffer">Poblaci&oacute;n origen:</label> 
					<input type="text" name="poblacionOrigenFil" class="form-control inputPeque isstate" id="poblacionOrigenFil" value="<?php echo "{$camposBusqueda['poblacionOrigen']}"?>">
				</div>
				
				<div class="form-group top-buffer">
					<label for="poblacionDestinoFil" class="labelFilter top-buffer">Poblaci&oacute;n destino:</label> 
					<input type="text" name="poblacionDestinoFil" class="form-control inputPeque isstate" id="poblacionDestinoFil" value="<?php echo "{$camposBusqueda['poblacionDestino']}"?>">
				</div>
				
				<input type="button" id="filtrar" value="Filtrar búsqueda" class="btn btn-primary btn-block btn-lg top-buffer" />
			
			</form>
		</div>
		<div class="span10" id="rellenarAjax">
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

$(document).ready(function(){
    $("#filtrar").click(function(){
    	$.ajax({
  		  method: "POST",
  		  url: "<?php echo base_url()?>trayecto/filtrarTrayectoPost",
  		  data: $('#formularioFiltro').serialize()
  		})
  		  .done(function(res) {
  		    $('#rellenarAjax').html(res);
  		 });
        
    	/*
    	$.ajax({
    		  method: "POST",
    		  url: "<?php echo base_url()?>trayecto/filtrarTrayectoPost",
    		  data: $('#formularioFiltro').serialize(),
    		  dataType: 'json'
    		})
    		  .done(function(res) {
    		    alert( );
    		 });
		 */
    });
});
</script>

