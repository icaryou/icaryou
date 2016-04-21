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
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>Busca un trayecto</h1>
			</div>
		</div>
	</div>

	<!-- /. PAGE TITLE-->





	<!--  =========================================  FORMULARIO  ======================================================== -->

	<div class="container">
		<div class="row">
			<form id="formularioTrayecto"
				action="<?=base_url('trayecto/buscarTrayectosPost')?>" method="post"
				class="form-horizontal formularioGenerico">

				<div class="span4">

					<div class="form-group">
						<label for="cpOrigen" class="labelFilter">Código Postal origen</label> <input type="text"
							name="cpOrigen" class="form-control" id="cpOrigen" value="">
					</div>

					<div class="form-group top-buffer">
						<label for="poblacionOrigen" class="labelFilter">Poblaci&oacute;n origen</label> <input type="text"
							name="poblacionOrigen" class="form-control isstate" id="poblacionOrigen"
							value="">
					</div>

					<div class="form-group top-buffer">
						<label for="cpDestino" class="labelFilter">Código Postal destino</label> <input type="text"
							name="cpDestino" class="form-control" id="cpDestino" value="">
					</div>

					<div class="form-group top-buffer">
						<label for="poblacionDestino" class="labelFilter">Poblaci&oacute;n destino</label> <input type="text"
							name="poblacionDestino" class="form-control isstate"
							id="poblacionDestino" value="">
					</div>
			<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" name="submitOk" value="Buscar"
							class="btn btn-primary btn-lg span2" tabindex="7">
					</div>
				</div>
				<div class="span3">
					<label for="horaSalidaRango" class="labelFilter">Hora de llegada:</label>
		  
				  	<input type="text" id="horaSalidaRango" name="horaSalidaRango" class="top-buffer10" readonly style="border:0; color:#777; font-weight:bold; width:90px;">
					<div id="slider-range1" class="top-buffer"></div>
					
										
					<label for="horaRegresoRango" class="labelFilter top-buffer">Hora de regreso:</label>
				  
				  	<input type="text" id="horaRegresoRango" name="horaRegresoRango" class="top-buffer10" readonly style="border:0; color:#777; font-weight:bold; width:90px;">
					<div id="slider-range2" class="top-buffer"></div>


					<!-- CHECKBOX -->
					<div class="form-group top-buffer">
						
				<p class="labelFilter top-buffer">Días:</p>
				<div class="diasFilter" >
					<input type="checkbox" name="dias[]" id="L" value="L" /> 
					<label for="L">L</label>
				</div>
				<div class="diasFilter">
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
					</div>

					<div class="form-group col-lg-12">
						<input type="hidden" class="form-control" id="none" value="">
					</div>

				</div>

			</form>
		</div>
	</div>
</div>
