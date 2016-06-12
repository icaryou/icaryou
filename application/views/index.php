<!--  /Login form -->


<div class="container">

	<!--Carousel
  ==================================================-->

	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<?php if(!$this->session->userdata('logueado')):?>
			<div class="active item">

				<div class="container">
					<div class="row">

						<div class="span6">

							<div class="carousel-caption">
								<h1>Comparte viajes diarios</h1>
								<p class="lead">Crea o encuentra el trayecto que mejor se adapte
									a tus necesidades diarias. Reg&iacute;strate y encuentra a tu
									compa&ntilde;ero de viaje.</p>
								<a class="btn btn-large btn-primary"
									href="<?= base_url();?>usuario/registrarUsuario">Reg&iacute;strate
									gratis</a>
							</div>

						</div>

						<div class="span6">
							<img src="<?= base_url();?>assets/img/slide/slide1.png">
						</div>

					</div>
				</div>
			</div>
			<?php endif;?>
			
			 <?php if($this->session->userdata('logueado')):?>
				<div class="item">
				<div class="container">
					<div class="row">
						<div class="span6">

							<div class="carousel-caption">
								<h1>Crea una nueva ruta</h1>
								<p class="lead">¿No encuentras un trayecto que se adapte a tus
									necesidades? Seas conductor o no, crea una nueva ruta para
									empezar a buscar compañero de viaje.</p>
								<a class="btn btn-large btn-primary" href="<?= base_url();?>trayecto/crearTrayecto">Crear trayecto</a>
							</div>

						</div>

						<div class="span6">
							<img src="<?= base_url();?>assets/img/slide/slide2.png">
						</div>

					</div>
				</div>

			</div>
			<?php endif;?> 
			 
			<?php echo ($this->session->userdata('logueado'))?"<div class=\"active item\">":"<div class=\"item\">"?>

				<div class="container">
				<div class="row">

					<div class="span12">

						<div class="carousel-caption">
							<div class="center-block">
								<div class="topaligned">
									<!-- <h1>Encuentra tu trayecto</h1>  -->
									<img src="<?= base_url();?>assets/img/slide/busca.png">
								</div>
								<form id="formularioBuscar"
									action="<?=base_url('trayecto/buscarTrayectosMiniPost')?>"
									method="post" class="form-inline loginForm">

									<label for="poblacionOrigen"><h3>Desde</h3></label> <input
										type="text" name="poblacionOrigen"
										class="form-control validarBuscar left-buffer inputGrande"
										id="poblacionOrigen" value=""> <input type="text"
										name="poblacionDestino"
										class="form-control validarBuscar left-buffer inputGrande"
										id="poblacionDestino" value=""><label class="left-buffer"><h3>Hasta</h3></label>

									<div>
										<input type="submit" value="Buscar"
											class="btn btn-large btn-primary bottomaligned span2"
											tabindex="7">
									</div>
								<div id="errorSubmit" class="tooltip center-block " title="El usuario o la contraseña son incorrectos."></div>

								</form>
							</div>


						</div>

					</div>

				</div>
			</div>





		</div>

	</div>
	<!-- Carousel nav -->
	<a class="carousel-control left " href="#myCarousel" data-slide="prev"><i
		class="icon-chevron-left"></i></a> <a class="carousel-control right"
		href="#myCarousel" data-slide="next"><i class="icon-chevron-right"></i></a>
	<!-- /.Carousel nav -->

</div>
<!-- /Carousel -->



<!-- Feature 
  ==============================================-->


<div class="row feature-box">
	<div class="span12 cnt-title">
		<h1>Trayectos destacados</h1>
	</div>

	<div class="span4">
		<a href="<?= base_url();?>trayecto/buscarTrayectosMiniPost?poblacionOrigen=Madrid&poblacionDestino=Fuenlabrada"><img src="<?= base_url();?>assets/img/masbuscados1.png"></a>

	</div>

	<div class="span4">
		<a href="<?= base_url();?>trayecto/buscarTrayectosMiniPost?poblacionOrigen=Barcelona&poblacionDestino=Tarragona"><img src="<?= base_url();?>assets/img/masbuscados2.png"></a>
	</div>

	<div class="span4">
		<a href="<?= base_url();?>trayecto/buscarTrayectosMiniPost?poblacionOrigen=Amurrio&poblacionDestino=Arraia-Maeztu"><img src="<?= base_url();?>assets/img/masbuscados3.png"></a>

	</div>
</div>


<!-- /.Feature -->


<!--  VENTANA MODAL MAIL CONFIRMACION -->

<div class="modal hide fade in" id="mailConfirmacion" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4 class="modalTitle"><img class="tick" src="<?php echo base_url()."assets/img/tick.png";?>"/><?php echo isset($h4)?$h4:"";?></h4>
		
		
	</div>
	<!--Modal Body-->
	<div class="modal-body">
		<p class="modalTexto"><?php echo isset($textoModal)?$textoModal:"";?></p>
	</div>
	<!--/Modal Body-->
</div>
</div>
<?php if(isset($tipo)):?>
	<script>
		$(document).ready(function(){
		$('#mailConfirmacion').modal('show');
		});
	</script>
<?php endif;?>

<?php if(isset($error)):?>

<script type='text/javascript'>
					$(document).ready(function(){
						alert("---index");
					//$('#loginForm').show();
					//$('#loginForm').modal('show');
					});
					</script>

<?php endif;?>


<!-- /.Row View -->