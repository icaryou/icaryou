
<?php if(sizeof($trayectosEncontrados)==0):?>
<!-- NO ENCUENTRA TRAYECTOS -->
<h4>Actualmente no dispones de trayectos activos.</h4>
<?php endif;?>

<?php if(sizeof($trayectosEncontrados)!=0):?>
<div class="container">
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h2 class="bottom-buffer_titulo"><strong>Trayectos <span class="origenBusqueda">PROPIOS</span> y <span class="destinoBusqueda">AJENOS</span> de <?php echo $usuario_buscado->nombre." ".$usuario_buscado->apellidos?></strong></h2>
			</div>
		</div>
	</div>
<div  id="rellenarAjax">
<?php $contadorTrayectos=0;?>
<?php foreach ($trayectosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	
	<?php $contadorTrayectos++;?>
		<?php if($trayectoAgrupado[0]['creador']==$usuario_buscado->id):?>
				<table class="elementoBusqueda span10 bottom-bufferElements">
		<?php endif;?>
		<?php if($trayectoAgrupado[0]['creador']!=$usuario_buscado->id):?>
				<table class="elementoBusquedaAjenos span10 bottom-bufferElements">
		<?php endif;?>
				<tr>
					<td class="paddignCeldaTrayec">
						<span class="diasBusqueda"><?php echo $trayectoAgrupado[0]['dias']?></span>
						<span class="horasBusqueda"><?php echo $trayectoAgrupado[0]['horallegadadestino']?> - 
						<?php echo $trayectoAgrupado[0]['horaretornodestino']?></span>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaVerde.png"/><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></div>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaRosa.png"/><?php echo $trayectoAgrupado[0]['poblacionDestino']?></div>
						<div class="comentariosBusqueda"><?php echo $trayectoAgrupado[0]['comentarios']?></div>
						
						<!-- PINTAMOS UNIRSE SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php $pintarAbandonar=false;
								$pintarYaHasSolicitado=false;
								$aceptados=0;?>	
								<?php foreach ($trayectoAgrupado as $usu){
									if($usu["aceptado"]==1){
										$aceptados++;
										if($usu["usuarioId"]==$this->session->userdata('id')){
											$pintarAbandonar=true;
										}
									}else if($usu["aceptado"]==0){
										if($usu["usuarioId"]==$this->session->userdata('id')){
											$pintarYaHasSolicitado=true;
										}	
									}
								}?>
								<!-- PINTAMOS YA LO HAS SOLICITADO SI ESTA A LA ESPERA DE SER ACEPTADO -->
							<?php if($this->session->userdata('id')!=null):?>
								<?php if(!$pintarAbandonar&&$pintarYaHasSolicitado):?>				
									<p class="top-buffer10"><strong>Estás a la espera de ser aceptado.</strong></p>				 
								<?php endif;?>
								
								<?php if(!$pintarAbandonar&&($trayectoAgrupado[0]['plazas']>$aceptados)&&!$pintarYaHasSolicitado):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick="llamarAjaxSubmit(this)" data-button="<?php echo $trayectoAgrupado[0]['trayecto_id']?>"
									class="btn btn-primary btn-lg btn-block" tabindex="7" data-toggle="modal" href="#teHasUnido">Unirse</button>				 
								<?php endif;?>
								
								<!-- PINTAMOS COMPLETO SI NO ESTA EN EL TRAYECTO Y NO HAY PLAZAS DISPONIBLES -->
								<?php if(!$pintarAbandonar&&($trayectoAgrupado[0]['plazas']==$aceptados)):?>				
								<p class="top-buffer10"><strong>Trayecto completo</strong></p>				 
								<?php endif;?>
								
								<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php if(isset($pintarAbandonar)&&$pintarAbandonar):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick="llamarAjaxAbandonar(this)" data-button="<?php echo $trayectoAgrupado[0]['trayecto_id']?>"
									class="btn btn-primary btn-lg btn-block" tabindex="7" data-toggle="modal" href="#hasAbandonado">Abandonar</button>				 
								<?php endif;?>
					
				
					</td>
					<td class="paddignCelda2">
						<div class="usuArriba">
							<p class="usuTitulo">Usuarios</p>
						</div>
						<div id="<?php echo "trayecto".$contadorTrayectos;?>" class="usuAbajo">
							<?php $contadorUsuarios=0;?>
							<?php foreach ($trayectoAgrupado as $usu):?>
								<?php if($usu["aceptado"]==1):?>
								<?php $contadorUsuarios++;?>
								<div class="UsuBusqueda">
									<img class="imgBusqueda" src="<?php echo base_url().$usu["foto"]?>"/>
									<p class="nombreViajero"><a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]?></a></p>
								</div>
								<?php endif;?>
				 			<?php endforeach;?>
				 			<?php for($i=0;$i<($usu["plazas"]-$contadorUsuarios);$i++):?>
				 				<div class="UsuBusqueda">
									<img src="<?php echo base_url()."assets/img/profile/avatar.png"?>"/>
									<p class="nombreViajero">Libre</p>
								</div>
				 			<?php endfor;?>
						</div>

					</td>
				</tr>
				</table>
	<?php endif;?>
<?php endforeach;?>
</div>
	<br/>
	<div class="pagination-page span4 bottom-bufferElements left-buffer_paginator"></div>
</div>

<?php endif;?>
</div>
	<div class="container">
	<div class="span3 pull-right"></div>
	<input TYPE="button" class="btn btn-primary botonBusqueda span2 top-buffer pull-right" VALUE="Volver" onClick="history.go(-1);">
	</div>

	<!--  VENTANA MODAL ABANDONAR -->

<div class="modal hide fade in" id="hasAbandonado" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4 class="modalTitle"><img class="tick" src="<?php echo base_url()."assets/img/tick.png";?>"/>Has abandonado</h4>
		
		
	</div>
	<!--Modal Body-->
	<div class="modal-body">
		<p class="modalTexto">Puedes volver a unirte al trayecto realizando una búsqueda.</p>
	</div>
	
	<!--/Modal Body-->
</div>

<!--  VENTANA MODAL UNIRSE -->

<div class="modal hide fade in" id="teHasUnido" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4 class="modalTitle"><img class="tick" src="<?php echo base_url()."assets/img/tick.png";?>"/>¡Te has unido!</h4>
		
		
	</div>
	<!--Modal Body-->
	<div class="modal-body">
		<p class="modalTexto">Ya solo falta que el creador del trayecto acepte tu solicitud.</p>
	</div>
	<!--/Modal Body-->
</div>	
<script>

function llamarAjax(){
	$.ajax({
		  method: "POST",
		  url: "<?php echo base_url()?>usuario/ver_trayectos_usuario_rellenar",
		})
		  .done(function(res) {
		    $('#rellenarAjax').html(res);
		    paginar();
		 });
}

function llamarAjaxAbandonar(b){

	var boton=b;
	var id_tray=b.getAttribute("data-button");
	$.ajax({
		  method: "POST",
		  url: "<?php echo base_url()?>usuario/abandonar_trayecto",
		  data: { id_trayecto: id_tray}
		})
		  .done(function(res) {
	
			  var destinatario=res.split("*")[0];
              var texto=res.split("*")[1];
			  
			  $.ajax({        
			       type: "POST",
			       url: BASE_URL+"mensaje/crear_mensaje_admin",
			       data: { destinatario : destinatario,texto:texto},
			       success: function(respuesta) 
		           {
			    	   ///////
			       }
				});	

			  
			  llamarAjax();
			  paginar();
		 });
}

function llamarAjaxSubmit(b){
	var boton=b;
	var id_tray=b.getAttribute("data-button");
	$.ajax({
		  method: "POST",
		  url: "<?php echo base_url()?>usuario/unirse_trayecto",
		  data: { id_trayecto: id_tray}
		})
		  .done(function(res) {

			  var destinatario=res.split("*")[0];
              var texto=res.split("*")[1];
              
              $.ajax({        
				       type: "POST",
				       url: BASE_URL+"mensaje/crear_mensaje_admin",
				       data: { destinatario : destinatario,texto:texto},
				       success: function(respuesta) 
			           {
				    	   ///////
				       }
					});	




			  
			  llamarAjax();
		 });
}

//PAGINACION
//mind the slight change below, personal idea of best practices
jQuery(function($) {
	paginar();
	$('button[href="#hasAceptado"]').on('click',function(){
		llamarAjax();
		paginar();
	});
	$('button[href="#hasRechazado"]').on('click',function(){
		llamarAjax();
		paginar();
	});
	$('button[href="#hasEliminado"]').on('click',function(){
		llamarAjax();
		paginar();
	});
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
	