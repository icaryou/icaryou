<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ShapeBootstrap Clean Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!--  EXTRA  -->
<!--  <link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->
<!--  FIN DE EXTRA  -->

<link href="<?= base_url();?>assets/css/bootstrap.min.css"
	rel="stylesheet">
<link href="<?= base_url();?>assets/css/bootstrap-responsive.min.css"
	rel="stylesheet">
<link href="<?= base_url();?>assets/css/style.css" rel="stylesheet">
<link href="<?= base_url();?>assets/css/formularios.css"
	rel="stylesheet">

<!--Font-->
<link
	href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600'
	rel='stylesheet' type='text/css'>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="img/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="img/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="img/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed"
	href="img/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="img/favicon.png">



<!-- SCRIPT 
    ============================================================-->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/js/jquery-2.1.3.js"></script>
<script src="<?= base_url();?>assets/js/jquery.validate.min.js"></script>

<!--  EXTRA  -->

<script
	src="<?= base_url();?>assets/resources/filterList//bootstrap-list-filter.src.js"></script>
<script
	src="<?= base_url();?>assets/resources/filterList/bootstrap-list-filter.min.js"></script>

<!--  FIN DE EXTRA  -->












</head>
<body>


	<!--HEADER ROW-->
	<div id="header-row">
		<div class="container">
			<div class="row">
				<!--LOGO-->
				<div class="span3">
					<a class="brand" href="<?= base_url();?>"><img
						src="<?= base_url();?>assets/img/logo.png" /></a>
				</div>
				<!-- /LOGO -->

				<!-- MAIN NAVIGATION -->
				<div class="span9">
					<div class="navbar  pull-right">
						<div class="navbar-inner">
							<a data-target=".navbar-responsive-collapse"
								data-toggle="collapse" class="btn btn-navbar"><span
								class="icon-bar"></span><span class="icon-bar"></span><span
								class="icon-bar"></span></a>
							<div class="nav-collapse collapse navbar-responsive-collapse">
								<ul class="nav">
									<li class="active"><a href="<?= base_url();?>">Home</a></li>
									<li class="active"><a
										href="<?= base_url();?>usuario/registrarUsuario">Registrarse</a></li>

									<!-- NO LOGUEADO -->
									<?php if(!$this->session->userdata('logueado')):?>
										<li class="login"><a data-toggle="modal" href="#loginForm">Iniciar
											sesi&oacute;n</a></li>
									<?php endif;?>
									<!--LOGUEADO -->
									<?php if($this->session->userdata('logueado')):?>
										<li class="dropdown"><a href="about.html"
										class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('nombre').$this->session->userdata('apellidos') ?> <b
											class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url()?>usuario/editarUsuario">Mi
													Perfil</a></li>
											<li><a href="<?php echo base_url()?>usuario/listarTrayectos">Mis
													trayectos</a></li>
											<li><a href="<?php echo base_url()?>usuario/listarMensajes">Mis
													mensajes</a></li>
											<li><a href="<?php echo base_url()?>usuario/logoutUsuario">Logout</a></li>
										</ul></li>
									<?php endif;?>
									
									

								</ul>
							</div>

						</div>
					</div>
				</div>
				<!-- MAIN NAVIGATION -->
			</div>
		</div>
	</div>
	<!-- /HEADER ROW -->





	<div class="container">
		<!--PAGE TITLE-->

		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Crear trayecto</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->

		<div class="container">
			<div class="row">
				<form id="formularioTrayecto"
					action="<?=base_url('trayecto/crearTrayectoPost')?>" method="post"
					class="form-horizontal formularioGenerico">

					<div class="span4">

						<div class="form-group">
							<label>C&oacute;digo Postal origen</label> <input type="text"
								name="cpOrigen" class="form-control" id="cpOrigen" value="">
						</div>




						<div class="form-group top-buffer">
							<label>Poblaci&oacute;n origen</label> <input
							type="text"
								name="poblacionOrigen" class="form-control" id="poblacionOrigen"
								value=""placeholder="Introduce una ciudad" />
						</div>
						<div id="searchlist" class="list-group">
							<!-- FILLED DYNAMICALLY -->
						</div>








						<div class="form-group top-buffer">
							<label>C&oacute;digo Postal destino</label> <input type="text"
								name="cpDestino" class="form-control" id="cpDestino" value="">
						</div>

						<div class="form-group top-buffer">
							<label>Poblaci&oacute;n destino</label> <input type="text"
								name="poblacionDestino" class="form-control"
								id="poblacionDestino" value="">
						</div>

						<div class="form-group top-buffer">
							<label>Hora de llegada al trabajo</label> <input type="text"
								placeholder="HH:MM" name="horaLlegada" class="form-control"
								id="horaLlegada" value="">
						</div>

						<div class="form-group top-buffer">
							<label>Hora de vuelta del trabajo</label> <input type="text"
								placeholder="HH:MM" name="horaRetorno" class="form-control"
								id="horaRetorno" value="">
						</div>
					</div>
					<div class="span3">
						<div class="form-group">
							<label>Comentarios</label>
							<textarea maxlength="140" name="comentarios" class="form-control"
								id="cp"></textarea>
						</div>

						<!-- CHECKBOX -->
						<div class="form-group top-buffer">
							<label class="" for="dias" id="dias">D&iacute;as</label>
							<div class="col-lg-11">
								<label class="checkbox-inline col-lg-2"> <input type="checkbox"
									name="dias[]" value="L"> Lunes
								</label> <label class="checkbox-inline col-lg-2"> <input
									type="checkbox" name="dias[]" value="M"> Martes
								</label> <label class="checkbox-inline col-lg-2"> <input
									type="checkbox" name="dias[]" value="X"> Mi&eacute;rcoles
								</label> <label class="checkbox-inline col-lg-2"> <input
									type="checkbox" name="dias[]" value="J"> Jueves
								</label> <label class="checkbox-inline col-lg-2"> <input
									type="checkbox" name="dias[]" value="V"> Viernes
								</label> <label class="checkbox-inline col-lg-2"> <input
									type="checkbox" name="dias[]" value="S"> S&aacute;bado
								</label> <label class="checkbox-inline col-lg-2"> <input
									type="checkbox" name="dias[]" value="D"> Domingo
								</label> <span class="field-validation-valid help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<input type="hidden" class="form-control" id="none" value="">
						</div>

						<div class="form-group top-buffer">
							<label>Plazas m&aacute;ximas(incluido t&uacute;).</label> <input
								type="text" name="plazas" class="form-control" id="plazas"
								value="">
						</div>

						<div class="form-group top-buffer">
							<input type="hidden" class="form-control" id="none" value="">
						</div>



						<div class="col-xs-12 col-lg-3 top-buffer">
							<input type="submit" name="submitOk" value="Registrarse"
								class="btn btn-primary btn-block btn-lg" tabindex="7">
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

	<script>
function seleccionado(obj){
	obj.style.display='none';
	document.getElementById('poblacionOrigen').value=obj.innerHTML;
	
}
</script>
	<script>

$('#searchlist').btsListFilter('#poblacionOrigen', {
	sourceTmpl: '<p class="list-group-item" onclick="seleccionado(this)">{title}</p>',
	sourceData: function(text, callback) {
		return $.getJSON('http://localhost/icaryou/assets/resources/filterList/search.php?q='+text, function(json) {
			callback(json);
		});
	}
});

</script>
	<script
		src="<?= base_url();?>assets/resources/filterList/labs-common.js"></script>



	<!--Footer
==========================-->

	<footer>
		<div class="container">
			<div class="row">
				<div class="span6">
					Copyright 2013 Shapebootstrap | All Rights Reserved <br> <small>Aliquam
						tincidunt mauris eu risus.</small>
				</div>
				<div class="span6">
					<div class="social pull-right">
						<a href="#"><img
							src="<?= base_url();?>assets/img/social/googleplus.png" alt=""></a>
						<a href="#"><img
							src="<?= base_url();?>assets/img/social/dribbble.png" alt=""></a>
						<a href="#"><img
							src="<?= base_url();?>assets/img/social/twitter.png" alt=""></a>
						<a href="#"><img
							src="<?= base_url();?>assets/img/social/dribbble.png" alt=""></a>
						<a href="#"><img src="<?= base_url();?>assets/img/social/rss.png"
							alt=""></a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!--/.Footer-->

</body>
</html>

