
		<script>
		/* script que controla los sliders de la hora */
			  $(function() {
			    $( "#slider-range1" ).slider({
			      range: true,
			      min: 0,
			      max: 23,
			      values: [ 0, 23 ],
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
			    $( "#horaSalidaRango" ).val("00:00 - 23:00");
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
				      values: [ 0, 23 ],
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
				    $( "#horaRegresoRango" ).val("00:00 - 23:00");
				    /*
				    $( "#horaRegresoRango" ).val( $( "#slider-range2" ).slider( "values", 0 ) +
				      ":00 - " + $( "#slider-range2" ).slider( "values", 1 )+":00" );
				    */
				  });
					  

  		</script>	

<div class="container">
<div class="row">
		<div class="span2" id="containerFilter">
		<h2>Filtrar</h2>
		<div class="separadorHori"></div>
			<form id="formularioFiltro" action="<?php echo base_url()?>trayecto/filtrarTrayectoPost" method="post"
					class="form-horizontal formularioGenerico">
				
				<input type="hidden" id="busquedaOrigen" name="busquedaOrigen" value="<?php echo $camposBusqueda['poblacionOrigen'] ?>"/>
				<input type="hidden" id="busquedaDestino" name="busquedaDestino" value="<?php echo $camposBusqueda['poblacionDestino'] ?>"/>
				
			  	<label for="horaSalidaRango" class="labelFilter">Hora de llegada:</label>
	  
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
				
				<div class="form-group top-buffer">
					<label for="poblacionOrigenFil" class="labelFilter top-buffer">Poblaci&oacute;n origen:</label> 
					<input type="text" name="poblacionOrigenFil" class="form-control inputPeque isstate" id="poblacionOrigenFil" value="<?php echo "{$camposBusqueda['poblacionOrigen']}"?>">
				</div>
				
				<div class="form-group top-buffer">
					<label for="poblacionDestinoFil" class="labelFilter top-buffer">Poblaci&oacute;n destino:</label> 
					<input type="text" name="poblacionDestinoFil" class="form-control inputPeque isstate" id="poblacionDestinoFil" value="<?php echo "{$camposBusqueda['poblacionDestino']}"?>">
				</div>
				
				<div class="form-group">
					<label for="cpOrigen" class="labelFilter top-buffer">C&oacute;digo Postal origen:</label>
					<input type="text" name="cpOrigen" class="form-control inputPeque" id="cpOrigen" value="">
				</div>
					
				<div class="form-group top-buffer">
					<label for="cpDestino" class="labelFilter top-buffer">C&oacute;digo Postal destino:</label>
					<input type="text" name="cpDestino" class="form-control inputPeque" id="cpDestino" value="">
				</div>
				<!--  QUITO EL BOTON PORQUE SE ACTUALIZA SOLO CON AJAX
				<input type="button" id="filtrar" value="Filtrar búsqueda" class="btn btn-primary btn-block btn-lg top-buffer" />
			-->
			</form>
		</div>
		<div class="span10" id="rellenarAjax">
		<!-- variable que necesitaremos para pintar los botones de unirse o no -->
			<?php $pintarAbandonar=FALSE?>	
				
			<?php if(sizeof($trayectosEncontrados)==0):?><!-- NO ENCUENTRA TRAYECTOS -->
				<h4>Lo lamentamos, no hemos encontrado trayectos con esas opciones.</h4>
			<?php endif;?>
			
			<?php if(sizeof($trayectosEncontrados)!=0):?><!--ENCUENTRA TRAYECTOS -->
				<h2>Mostrando trayectos desde <span class="origenBusqueda"><?php echo "{$camposBusqueda['poblacionOrigen']}"?></span> a 
				<span class="destinoBusqueda"><?php echo "{$camposBusqueda['poblacionDestino']}"?></span>
				</h2>
				<div class="separadorHori"></div>
				<!--  MEJORANDO MAQUETACION -->
				<?php $contadorTrayectos=0;?>
				<?php foreach ($trayectosEncontrados as $trayectoAgrupado):?>
					<?php $contadorTrayectos++;?>
				<table class="elementoBusqueda span8 bottom-bufferElements">
				<tr>
					<td class="paddignCelda">
						<span class="diasBusqueda"><?php echo $trayectoAgrupado[0]['dias']?></span>
						<span class="horasBusqueda"><?php echo $trayectoAgrupado[0]['horallegadadestino']?> - 
						<?php echo $trayectoAgrupado[0]['horaretornodestino']?></span>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaVerde.png"/><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></div>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaRosa.png"/><?php echo $trayectoAgrupado[0]['poblacionDestino']?></div>
						<div class="comentariosBusqueda"><?php echo $trayectoAgrupado[0]['comentarios']?></div>
						
						<!-- PINTAMOS UNIRSE SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php foreach ($trayectoAgrupado as $usu):?>
									<?php if($usu["usuarioId"]==$this->session->userdata('id')):?>
										<?php $pintarAbandonar=TRUE?>
									<?php endif;?>
								<?php endforeach;?>
						
						
								<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']>sizeof($trayectoAgrupado)):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick='location.href="<?php echo base_url('usuario/unirse_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
									class="btn btn-primary btn-lg btn-block" tabindex="7">Unirse</button>				 
								<?php endif;?>
								
								<!-- PINTAMOS COMPLETO SI NO ESTA EN EL TRAYECTO Y NO HAY PLAZAS DISPONIBLES -->
								<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']==sizeof($trayectoAgrupado)):?>				
								<p>Trayecto completo</p>				 
								<?php endif;?>
								
								<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php if(isset($pintarAbandonar)&&$pintarAbandonar):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick='location.href="<?php echo base_url('usuario/abandonar_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
									class="btn btn-primary btn-lg btn-block" tabindex="7">Abandonar</button>				 
								<?php endif;?>
					</td>
					<td>
					<div class="usuArriba">
						<p class="usuTitulo">Usuarios</hp>
					</div>
					<div id="<?php echo "trayecto".$contadorTrayectos;?>" class="usuAbajo">
						<?php $contadorUsuarios=0;?>
						<?php foreach ($trayectoAgrupado as $usu):?>
							<?php $contadorUsuarios++;?>
							<div class="UsuBusqueda">
								<img class="imgBusqueda" src="<?php echo base_url().$usu["foto"]?>"/>
								<p class="nombreViajero"><a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]." ".$usu["apellidos"]?></a></p>
							</div>
			 			<?php endforeach;?>
			 			<?php for($i=0;$i<(5-$contadorUsuarios);$i++):?>
			 				<div class="UsuBusqueda">
								<img src="<?php echo base_url()."assets/img/profile/avatar.png"?>"/>
								<p class="nombreViajero">Libre</p>
							</div>
			 			<?php endfor;?>
					</div>

					</td>
				</tr>
				</table>
				<?php endforeach;?>
				<!--  AQUI ACABA LA MEJORA -->
				<br/>
				<div class="pagination-page span3 bottom-bufferElements left-buffer_paginator"></div>	
				
			<?php endif;?>
			<p><?=validation_errors();?></p>

		</div>
</div>

</div>
<script>

/* Llamada a ajax cada vez que se aplica algun filtro*/

$(document).ready(function(){
	
	$("#poblacionOrigenFil").on( "autocompletechange", function(event,ui) {
		llamarAjax();
		});
	$("#poblacionDestinoFil").on( "autocompletechange", function(event,ui) {
		llamarAjax();
		});
    $('#slider-range1').on('focusout mouseup', function(){
    	llamarAjax();
    });

    $('#slider-range2').on('focusout mouseup', function(){
    	llamarAjax();
    });
    
    $("#formularioFiltro").each(function(){
    	$(this).on("paste change",function(){
    		llamarAjax();
        });
    });
});

function llamarAjax(){
	$.ajax({
		  method: "POST",
		  url: "<?php echo base_url()?>trayecto/filtrarTrayectoPost",
		  data: $('#formularioFiltro').serialize()
		})
		  .done(function(res) {
	  		  //alert("cambio");
		    $('#rellenarAjax').html(res);
		    paginar();
		 });
}

//PAGINACION
//mind the slight change below, personal idea of best practices
jQuery(function($) {
 paginar();
});

function paginar(){
	   // consider adding an id to your table,
    // just incase a second table ever enters the picture..?
    var items = $("table");

    var numItems = items.length;
    var perPage = 2;

    // only show the first 2 (or "first per_page") items initially
    items.slice(perPage).hide();

    // now setup your pagination
    // you need that .pagination-page div before/after your table
    $(".pagination-page").pagination({
        items: numItems,
        itemsOnPage: perPage,
        cssStyle: "light-theme",
        onPageClick: function(pageNumber) { // this is where the magic happens
            // someone changed page, lets hide/show trs appropriately
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;

            items.hide() // first hide everything, then show for the new page
                 .slice(showFrom, showTo).show();
        }
    });


    var checkFragment = function() {
        // if there's no hash, make sure we go to page 1
        var hash = window.location.hash || "#page-1";

        // we'll use regex to check the hash string
        hash = hash.match(/^#page-(\d+)$/);

        if(hash)
            // the selectPage function is described in the documentation
            // we've captured the page number in a regex group: (\d+)
            $("#pagination").pagination("selectPage", parseInt(hash[1]));
    };

    // we'll call this function whenever the back/forward is pressed
    $(window).bind("popstate", checkFragment);

    // and we'll also call it to check right now!
    checkFragment();
}
</script>

