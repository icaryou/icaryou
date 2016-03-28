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

<script>
	
	
	$( document ).ready(function() 
	{

		var getUrl = window.location;
		var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/"+getUrl.pathname.split('/')[2]+"/"+getUrl.pathname.split('/')[3];
		
		//AÑADIR EXPRESIONES REGULARES
		$.validator.addMethod("regx", function(value, element, regexpr) {          
		    return regexpr.test(value);
		}, "Introduce un dato correcto.");
		
		//VALIDACION FORMULARIO
        $('#formularioRegistro').submit(function(e) {
            e.preventDefault();
        }).validate({
        	submitHandler: function(form) {
        	    // do other things for a valid form
        	    form.submit();},
        	error: function(label) {
        	     $(this).addClass("error");
        	   },
        	   valid: function(label) {
          	     $(this).addClass("valid");          	     
          	   },
            debug: false,
            errorPlacement: function(error, element) {
                if (element.attr("name") == "sexo") 
                {
                   error.insertAfter("#sexo");
                } 
                else if(element.attr("name") == "cochePropio")
                {
                   error.insertAfter("#cochePropio");
                }
                else 
                {
                   error.insertAfter(element);
                }
              },
            rules: {
                
                "nombre": {
                    required: true,
                    //PARA AÑADIR ESPRESION REGULAR PERSONAL    regx:/^[AB]{3}$/
                },
                "apellidos": {
                    required: true
                },
                "email": {
                    required: true,
                    email: true,
                    remote : {
                        url: "comprobarEmail",
                        type: "post",
                        dataType: 'json'
                     }
                },
                "password": {
                    required: true,
                    minlength: 8,
                    maxlength: 20                    
                },
                "passwordRepetido": {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    equalTo:"#password",
                },
                "fechaNac": {
                    required: true,
                    regx:/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/
                },
                "cp": {
                    required: true,
                    number:true,
                    minlength: 5,
                    maxlength: 5,
                    max:52999
                },
                "sexo": {
                    required: true
                },
                "cochePropio": {
                    required: true
                },
                               
                
            },
            messages: {
                "nombre": {
                    required: "Introduce tu nombre."
                },
                "apellidos": {
                    required: "Introduce tus apellidos."
                },
                "email": {
                    required: "Introduce tu email.",
                    email: "Introduce un email válido.",
                    remote: "Email existente."
                },
                "password": {
                    required: "Introduce tu contraseña",
                    minlength:"Introduce al menos 8 caracteres.",
                    maxlength: "Introduce como máximo 20 caracteres."                    
                },
                "passwordRepetido": {
                    required: "Introduce tu contraseña de nuevo",
                    minlength: "Introduce al menos 8 caracteres.",
                    maxlength: "Introduce como máximo 20 caracteres.",
                    equalTo:"La contraseña no se corresponde con la anterior"
                },
                "fechaNac": {
                    required: "Fecha nacimiento obligatoria.",
                    regx:"Formato fecha inválido(Formato requerido:dd/mm/yyyy)"
                },                
                "cp": {
                    required: "Introduce tu código postal.",
                    number: "Introduce un código postal válido.",
                    maxlength: "Debe contener 5 dígitos.",
                    minlength: "Debe contener 5 dígitos.",
                    max:"Introduce un valor válido."
                },

                "sexo": {
                    required: "Introduce tu sexo."
                }, 
                "cochePropio": {
                    required: "Introduce si dispones o no de coche propio."
                },                
            } 
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
					<h1>Registrar Usuario</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->
		<div class="container"></div>
		<div class="row">
			<form id="formularioRegistro"
				action="<?=base_url('usuario/registrarUsuarioPost')?>" method="post"
				class="form-horizontal">

				<div class="span4">

					<div class="form-group ">
						<label>Nombre</label> <input type="text" name="nombre"
							class="form-control" id="nombre" value="">
					</div>
					<div class="form-group top-buffer">
						<label>Apellido</label> <input type="text" name="apellidos"
							class="form-control" id="apellidos" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Email</label> <input type="text" name="email"
							class="form-control" id="email" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Contrase&ntilde;a</label> <input type="password"
							name="password" class="form-control" id="password" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Repetir contrase&ntilde;a</label> <input type="password"
							name="passwordRepetido" class="form-control"
							id="passwordRepetido" value="">
					</div>
				</div>
				
				
				<div class="span3">
					<div class="form-group">
						<label>Fecha nacimiento</label> <input type="text"
							placeholder="dd/mm/aaaa" name="fechaNac" class="form-control"
							id="fechaNac" value="">
					</div>

					<div class="form-group top-buffer">
						<label>C&oacute;digo Postal</label> <input type="text" name="cp"
							class="form-control" id="cp" value=""> <span
							class="field-validation-valid help-block"></span>
					</div>

					<!-- RADIOS -->
					<div class="form-group top-buffer">
						<label class="" id="sexo" for="sexo">Sexo</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio" name="sexo"
								value="hombre"> Hombre
							</label> <label class="radio-inline"> <input type="radio"
								name="sexo" value="mujer"> Mujer
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="form-group top-buffer">
						<label class="" id="cochePropio"
							for="cochePropio">Coche propio</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio"
								name="cochePropio" value="si"> Si
							</label> <label class="radio-inline"> <input type="radio"
								name="cochePropio" value="no"> No
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" value="Registrarse"
							class="btn btn-primary btn-lg btn-block" tabindex="7">
					</div>

				</div>

			</form>
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
