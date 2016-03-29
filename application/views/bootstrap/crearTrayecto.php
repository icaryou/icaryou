<!-- ========================== SCRIPT VALIDACIONES ================================ -->

<style>
input.error {
	color: red;
	border: solid 1px red;
}

input.valid {
	border: solid 1px green;
}

#formularioTrayecto .error {
	color: red;
}
</style>
<script>
	
	
	$( document ).ready(function() 
	{

		//AÑADIR EXPRESIONES REGULARES
		$.validator.addMethod("regx", function(value, element, regexpr) {          
		    return regexpr.test(value);
		}, "Introduce un dato correcto.");
		
		//VALIDACION FORMULARIO
        $('#formularioTrayecto').submit(function(e) {
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
                if (element.attr("name") == "dias[]") {
                  error.insertAfter("#dias");
                } else {
                  error.insertAfter(element);
                }
              },
            rules: {
                
            	"cpOrigen": {
                    required:true,
                    number:true,
                    minlength: 5,
                    maxlength: 5,
                    max:52999
                },
                "poblacionOrigen": {
                    required: true,
                    //PARA AÑADIR ESPRESION REGULAR PERSONAL    regx:/^[AB]{3}$/
                },
                "cpDestino": {
                    required: true,
                    number:true,
                    minlength: 5,
                    maxlength: 5,
                    max:52999
                },
                "poblacionDestino": {
                    required: true
                    //PARA AÑADIR ESPRESION REGULAR PERSONAL    regx:/^[AB]{3}$/
                },
                "horaLlegada": {
                    required: true,
                    regx:/^([01]\d|2[0-3]):([0-5]\d)$/ //TODO    PROBAR
                },
                "horaRetorno": {
                    required: true,
                    regx:/^([01]\d|2[0-3]):?([0-5]\d)$/ //TODO    PROBAR
                },
                "comentarios": {
                	maxlength: 140                    
                },
                "dias[]": {
                    required: true                    
                },
                "plazas": {
                    required:true,
                    number:true,
                    min: 2                    
                },              
                
            },
            messages: {
            	"cpOrigen": {
            		required: "Introduce tu código postal de origen.",
                    number:"Introduce un número válido.",
                    minlength: "Introduce 5 digitos.",
                    maxlength: "Introduce 5 digitos.",
                    max:"Introduce un valor válido."
                },
                "poblacionOrigen": {
                    required: "Introduce tu población de origen.",
                    //PARA AÑADIR ESPRESION REGULAR PERSONAL    regx:/^[AB]{3}$/
                },
                "cpDestino": {
                	required: "Introduce tu código postal de destino.",
                    number:"Introduce un número válido.",
                    minlength: "Introduce 5 digitos.",
                    maxlength: "Introduce 5 digitos.",
                    max:"Introduce un valor válido."
                },
                "poblacionDestino": {
                	required: "Introduce tu población de destino.",
                    //PARA AÑADIR ESPRESION REGULAR PERSONAL    regx:/^[AB]{3}$/
                },
                "horaLlegada": {
                    required: "Introduce una hora de llegada al trabajo",
                    regx:"Introduce un formato de hora válido"
                },
                "horaRetorno": {
                	required: "Introduce una hora de retorno del trabajo",
                    regx:"Introduce un formato de hora válido"
                },
                "comentarios": {
                    maxlength: "Máximo 140 caracteres"                    
                },   
                "dias[]": {
                    required:"Elige por lo menos un día",//"Selecciona por lo menos un día",
                },
                "plazas": {
                	required: "Introduce un numero de plazas máximas(incluido tu)",
                    number:"Introduce un número correcto",
                    min: "Número mínimo 2"
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
					class="form-horizontal">

					<div class="span4">										

							<div class="form-group">
								<label>C&oacute;digo Postal origen</label> <input type="text"
									name="cpOrigen" class="form-control" id="cpOrigen" value="">
							</div>

							<div class="form-group top-buffer">
								<label>Poblaci&oacute;n origen</label> <input type="text"
									name="poblacionOrigen" class="form-control"
									id="poblacionOrigen" value="">
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
								<textarea maxlength="140" name="comentarios"
									class="form-control" id="cp"></textarea>
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