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
												class="form-control validarBuscar left-buffer inputGrande" id="poblacionOrigen" value="">
	
											 <input type="text"
												name="poblacionDestino" class="form-control validarBuscar left-buffer inputGrande"
												id="poblacionDestino" value=""><label class="left-buffer"><h3>Hasta</h3></label>
				
											<div>
												<input type="submit" value="Buscar"
													class="btn btn-large btn-primary bottomaligned span2" tabindex="7">
											</div>
	
									</form>
								</div>


							</div>

						</div>

					</div>
				</div>
				
				<div class="item">
					<div class="container">
						<div class="row">
							<div class="span6">
	
								<div class="carousel-caption">
									<h1>Example headline</h1>
									<p class="lead">Cras justo odio, dapibus ac facilisis in,
										egestas eget quam. Donec id elit non mi porta gravida at eget
										metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
									<a class="btn btn-large btn-primary" href="#">Sign up today</a>
								</div>
	
							</div>
	
							<div class="span6">
								<img src="<?= base_url();?>assets/img/slide/slide2.jpg">
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
			<h1>At vero eos et accusamus et iusto odio dignissimos</h1>
			<span>Contrary to popular belief, Lorem Ipsum is not simply random
				text.</span>
		</div>

		<div class="span4">
			<img src="<?= base_url();?>assets/img/icon3.png">
			<h2>Feature A</h2>
			<p>Pellentesque habitant morbi tristique senectus et netus et
				malesuada fames ac turpis egestas.</p>

			<a href="#">Read More &rarr;</a>

		</div>

		<div class="span4">
			<img src="<?= base_url();?>assets/img/icon2.png">
			<h2>Feature B</h2>
			<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
				labore et dolore magna aliqua.</p>
			<a href="#">Read More &rarr;</a>
		</div>

		<div class="span4">
			<img src="<?= base_url();?>assets/img/icon1.png">
			<h2>Feature C</h2>
			<p>Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit
				amet, ante.</p>
			<a href="#">Read More &rarr;</a>
		</div>
	</div>


	<!-- /.Feature -->

	<div class="hr-divider"></div>

	<!-- Row View -->


	<div class="row">
		<div class="span6">
			<img src="<?= base_url();?>assets/img/responsive.png">
		</div>

		<div class="span6">
			<img class="hidden-phone" src="<?= base_url();?>assets/img/icon4.png"
				alt="">
			<h1>Fully Responsive</h1>
			<p>Pellentesque habitant morbi tristique senectus et netus et
				malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat
				vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit
				amet quam egestas semper. Aenean ultricies mi vitae est. Mauris
				placerat eleifend leo.</p>
			<a href="#">Read More &rarr;</a>
		</div>
	</div>


</div>

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