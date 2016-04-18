	
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
				<h2>Trayectos propios</h2>
			</div>
		</div>
	</div>

<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>
	<table><tr><td>
	<div id="contenedor">
<!-- COGEMOS LOS DATOS GENRALES DE UNA FILA, LA PRIMERA PORQUE EN TODAS SON IGUALES -->
		<div id="izquierda" class="flotando">
			<div class="dias">
				<p><?php echo $trayectoAgrupado[0]['dias']?></p>
			</div>
			<div class="flotandoPeq ciudades">
				<span class="bloque"><img src="<?php echo base_url()?>assets/img/flag1.png" width="19px"/><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></span> 
				<span class="bloque"><img src="<?php echo base_url()?>assets/img/flag2.png" width="19px"/><?php echo $trayectoAgrupado[0]['poblacionDestino']?></span>
			</div>
			<div class="flotandoPeq horas">
				<span class="bloque"><?php echo $trayectoAgrupado[0]['horallegadadestino']?></span>
				<span class="bloque"><?php echo $trayectoAgrupado[0]['horaretornodestino']?></span>
			</div>
		</div>
		<div class="divider flotando"></div>
		<div id="centro" class="flotando">
			<p class="comentarios"><strong>Comentarios:</strong><br/><?php echo $trayectoAgrupado[0]['comentarios']?></p>
		</div>
		<div class="divider flotando"></div>
		<div id="derecha" class="flotando">
			<div class="plazas numberCircle"><?php echo $trayectoAgrupado[0]['plazas']?></div>
		</div>

	</div>
	<div id="usuarios">
		
		<!-- Y SOLO ITERAMOS DE NUEVO PARA PINTAR LOS USUARIOS QUE NOS HA DEVUELTO -->
		<?php foreach ($trayectoAgrupado as $usu):?>
					<p>
				<a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]." ".$usu["apellidos"]?></a>
			</p>
					<?php if($usu["usuarioId"]==$this->session->userdata('id')):?>
						<?php $pintarAbandonar=TRUE?>
					<?php endif;?>
					<?php endforeach;?>

			<!-- PINTAMOS UNIRSE SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']>sizeof($trayectoAgrupado)):?>				
					<button class="unirse_trayecto"
				onclick='location.href="<?php echo base_url('usuario/unirse_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
				class="btn btn-primary btn-lg btn-block" tabindex="7">Unirse</button>				 
					<?php endif;?>
					
					<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if($pintarAbandonar):?>				
					<button class="abandonar_trayecto"
				onclick='location.href="<?php echo base_url('usuario/abandonar_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
				class="btn btn-primary btn-lg btn-block" tabindex="7">Abandonar</button>				 
					<?php endif;?>
				
	</div>
	</td></tr></table>
	<?php endif;?>
<?php endforeach;?>

	

	<div class="pagination-page"></div>
</div>
<?php endif;?>

<h3>Trayectos Ajenos</h3>

<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>
<table border="1">
	<thead>
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
	</thead>
	<tbody>
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
					<p>
					<a
						href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]." ".$usu["apellidos"]?></a>
				</p>
					<?php if($usu["usuarioId"]==$this->session->userdata('id')):?>
						<?php $pintarAbandonar=TRUE?>
					<?php endif;?>
					<?php endforeach;?>
				</td>
			<td>
				<!-- PINTAMOS UNIRSE SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']>sizeof($trayectoAgrupado)):?>				
					<button class="unirse_trayecto"
					onclick='location.href="<?php echo base_url('usuario/unirse_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
					class="btn btn-primary btn-lg btn-block" tabindex="7">Unirse</button>				 
					<?php endif;?>
					
					<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
					<?php if($pintarAbandonar):?>				
					<button class="abandonar_trayecto"
					onclick='location.href="<?php echo base_url('usuario/abandonar_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
					class="btn btn-primary btn-lg btn-block" tabindex="7">Abandonar</button>				 
					<?php endif;?>
				</td>
		</tr>
	</tbody>

</table>
<?php endif;?>
<?php endforeach;?>


<script>
//mind the slight change below, personal idea of best practices
jQuery(function($) {
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
});
</script>

<input TYPE="button" VALUE="Back" onClick="history.go(-1);">