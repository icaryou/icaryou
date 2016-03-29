<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ShapeBootstrap Clean Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">


<link href="<?= base_url();?>assets/css/bootstrap.min.css"
	rel="stylesheet">
<link href="<?= base_url();?>assets/css/bootstrap-responsive.min.css"
	rel="stylesheet">
<link href="<?= base_url();?>assets/css/style.css" rel="stylesheet">

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

<!-- ========================== SCRIPT VALIDACIONES ================================ -->
<style>
.error {
	color: red;
}

input.error {
	color: red;
	border: solid 1px red;
}

input.valid {
	border: solid 1px green;
}

#formularioRegistro .error {
	color: red;
}
</style>
<script>
	
	
	$( document ).ready(function() 
	{

		
		//VALIDACION FORMULARIO
        $('#formularioLogin').submit(function(e) {
            e.preventDefault();
        }).validate({
        	submitHandler: function(form) {
        	    // do other things for a valid form
        	    form.submit();},
        	error: function(label) {
        	     $(this).addClass("error");
        	   },
            debug: false,
            rules: {
                
                "email": {
                    required: true
                },
                "password": {
                    required: true                  
                },            
             
            },
            messages: {
                "email": {
                    required: "Introduce tu email.",
                },
                "password": {
                    required: "Introduce tu contraseña"                    
                },           
            }, 
        });
});
	
</script>


</head>

<body>


	<!--HEADER ROW-->
	<div id="header-row">
		<div class="container">
			<div class="row">
				<!--LOGO-->
				<div class="span3">
					<a class="brand" href="#"><img
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
									<li class="active"><a href="index.html">Home</a></li>

									<li class="dropdown"><a href="about.html"
										class="dropdown-toggle" data-toggle="dropdown">About <b
											class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="about.html">Company</a></li>
											<li><a href="about.html">History</a></li>
											<li><a href="about.html">Team</a></li>
										</ul></li>

									<li><a href="service.html">Services</a></li>
									<li><a href="blog.html">Blog</a></li>
									<li><a href="contact.html">Contact</a></li>

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
					<h1>Login Usuario</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->

		<div class="container">
			<div class="row">

				<form id="formularioLogin"
					action="<?=base_url('usuario/loginUsuarioPost')?>" method="post"
					class="form-horizontal">


					<div class="span4">

						<div class="form-group">
							<label>Email</label> <input type="text" name="email"
								class="form-control" id="email"
								value="<?php echo isset($email)?$email:''?>">
						</div>
						<div class="form-group top-buffer">
							<label>Contrase&ntilde;a</label> <input type="password" name="password"
								class="form-control" id="password" value="">
						</div>										
				
				<?php if(isset($error)):?>
					<p class="error col-lg-8"><?=$error?></p>
				<?php endif;?>
				
				<?php if(isset($redireccion)):?>
					<input type="hidden" name="redireccion"
							value="<?php echo $redireccion?>" />
				<?php endif;?>					
				
				<div class="col-xs-12 col-lg-3 top-buffer">
							<input type="submit" value="Login"
								class="btn btn-primary btn-lg span2" tabindex="7">
						</div>
						<p class="col-lg-3 top-buffer">
							<a href="<?=base_url('usuario/registrarUsuario')?>">Crear una
								cuenta</a>
						</p>


					</div>

				</form>
			</div>
		</div>
</div>

		<!--Footer
==========================-->

		<footer>
			<div class="container">
				<div class="row">
					<div class="span6">
						Copyright &copy 2013 Shapebootstrap | All Rights Reserved <br> <small>Aliquam
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

