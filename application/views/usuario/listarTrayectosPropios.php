	
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
				<h2 class="bottom-buffer_titulo">Trayectos propios</h2>
			</div>
		</div>
	</div>
<?php $contadorTrayectos=0;?>
<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>
	<?php $contadorTrayectos++;?>
				<table id="tablaPropios" class="elementoBusqueda span9 bottom-bufferElements">
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
	<?php endif;?>
<?php endforeach;?>

	<br/>
	<div class="pagination-page1 span4 bottom-bufferElements left-buffer_paginator"></div>


	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h2 class="bottom-buffer_titulo">Trayectos ajenos</h2>
			</div>
		</div>
	</div>

<?php $contadorTrayectos=0;?>
<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>
<?php $contadorTrayectos++;?>
				<table id="tablaAjenos" class="elementoBusquedaAjenos span9 bottom-bufferElements">
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
<?php endif;?>
<?php endforeach;?>
	<br/>
	<div class="pagination-page2 span4 bottom-bufferElements left-buffer_paginator"></div>


</div>
<?php endif;?>

</div>
	<div class="container">
	<div class="span3 pull-right"></div>
	<input TYPE="button" class="btn btn-primary botonBusqueda span2 top-buffer pull-right" VALUE="Volver" onClick="history.go(-1);">
	</div>
<script>
//mind the slight change below, personal idea of best practices
jQuery(function($) {
    // consider adding an id to your table,
    // just incase a second table ever enters the picture..
    var table1 = $("table#tablaPropios");
    var paginador1 = $(".pagination-page1");
	paginar(table1,paginador1);
	
});

function paginar(items, paginador){
    //var items = $("table#tablaPropios");
        var numItems = items.length;
        var perPage = 2;

        // only show the first 2 (or "first per_page") items initially
        items.slice(perPage).hide();

        // now setup your pagination
        // you need that .pagination-page div before/after your table
        paginador.pagination({
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
var table2 = $("table#tablaAjenos");
var paginador2 = $(".pagination-page2");
paginar(table2,paginador2);

</script>


