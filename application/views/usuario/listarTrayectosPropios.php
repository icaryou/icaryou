
<?php if(sizeof($trayectosPropiosEncontrados)==0):?>
<!-- NO ENCUENTRA TRAYECTOS -->
<h4>Actualmente no dispones de trayectos activos.</h4>
<?php endif;?>

<?php if(sizeof($trayectosPropiosEncontrados)!=0):?>
<div class="container">
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h2 class="bottom-buffer_titulo">Mis trayectos <span class="origenBusqueda">PROPIOS</span> y <span class="destinoBusqueda">AJENOS</span></h2>
			</div>
		</div>
	</div>
<div  id="rellenarAjax">
<?php $contadorTrayectos=0;?>
<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	
	<?php $contadorTrayectos++;?>
		<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>
				<table class="elementoBusqueda span10 bottom-bufferElements">
		<?php endif;?>
		<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>
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
						<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>	
							<?php foreach ($trayectoAgrupado as $usu):?>	
						
							<?php $contadorUsuarios++;?>
							<div class="UsuTrayecto">
								<img class="imgUsuTrayecto" src="<?php echo base_url().$usu["foto"]?>"/>
								<a class="nombreUsuTrayecto" href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><strong><?php echo $usu["nombre"]?></strong></a>
								
								<?php if($usu['aceptado']==0):?>								
    								<button data-toggle="modal" href="#hasAceptado" id="<?php echo $usu['usuarioId']."*".$usu['trayecto_id']?>" class="aceptar_usuario_trayecto btn btn-primary ">Aceptar</button>
    								<button data-toggle="modal" href="#hasRechazado" id="<?php echo $usu['usuarioId']."*".$usu['trayecto_id']?>" class="rechazar_usuario_trayecto btn btn-primary ">Rechazar</button>
								<?php endif;?>
								
								<?php if($usu['usuarioId']!=$this->session->userdata('id') && $usu['aceptado']==1):?>								
    								<button data-toggle="modal" href="#hasEliminado" id="<?php echo $usu['usuarioId']."*".$usu['trayecto_id']?>" class="eliminar_usuario_trayecto btn btn-primary ">Eliminar</button>
								<?php endif;?>
								
							</div>
			 				<?php endforeach;?>
						<?php endif;?>	
						<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>			
							<?php foreach ($trayectoAgrupado as $usu):?>	
						
							<?php $contadorUsuarios++;?>
							<div class="UsuTrayecto">
								<img class="imgUsuTrayecto" src="<?php echo base_url().$usu["foto"]?>"/>
								<a class="nombreUsuTrayecto" href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><strong><?php echo $usu["nombre"]?></strong></a>
								
							</div>
			 				<?php endforeach;?>
						<?php endif;?>	
			 			<?php for($i=0;$i<($usu["plazas"]-$contadorUsuarios);$i++):?>
			 				<div class="UsuTrayecto">
								<img class="imgUsuTrayecto" src="<?php echo base_url()."assets/img/profile/avatar.png"?>"/>
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
	<!--  VENTANA MODAL ACEPTAR -->

<div class="modal hide fade in" id="hasAceptado" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4 class="modalTitle"><img class="tick" src="<?php echo base_url()."assets/img/tick.png";?>"/>Le has aceptado</h4>
		
		
	</div>
	<!--Modal Body-->
	<div class="modal-body">
		<p class="modalTexto">Puedes rechazar a este usuario en cualquier momento.</p>
	</div>
	
	<!--/Modal Body-->
</div>
	<!--  VENTANA MODAL ELIMINADO -->

<div class="modal hide fade in" id="hasEliminado" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4 class="modalTitle"><img class="tick" src="<?php echo base_url()."assets/img/tick.png";?>"/>¡Eliminado!</h4>
		
		
	</div>
	<!--Modal Body-->
	<div class="modal-body">
		<p class="modalTexto">Puedes seguir administrando tus trayectos.</p>
	</div>
	
	<!--/Modal Body-->
</div>

	<!--  VENTANA MODAL RECHAZADO -->

<div class="modal hide fade in" id="hasRechazado" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4 class="modalTitle"><img class="tick" src="<?php echo base_url()."assets/img/tick.png";?>"/>Le has rechazado</h4>
		
		
	</div>
	<!--Modal Body-->
	<div class="modal-body">
		<p class="modalTexto">Puedes seguir administrando tus trayectos.</p>
	</div>
	
	<!--/Modal Body-->
</div>
<script>

function llamarAjax(){
	$.ajax({
		  method: "POST",
		  url: "<?php echo base_url()?>usuario/listarTrayectosPropiosRellenar",
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
	

