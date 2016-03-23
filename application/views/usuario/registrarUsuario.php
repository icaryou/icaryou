<!--  
<html>

<head>
<meta charset="utf-8">

<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap-theme.min.css">

<script src="<?= base_url();?>assets/js/jquery-2.1.3.js"></script>
<script src="<?= base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>

<style>
	input.error 
	{
    	color: red;
    	border:solid 1px red;
	}
	
	input.valid 
	{
    	border:solid 1px green;
	}
	#formularioRegistro .error
	{
		color:red;
	}
	
</style>

-->


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

<!--  
</head>
<body>
-->

<form id="formularioRegistro" action="<?=base_url('usuario/registrarUsuarioPost')?>" method="post">

<div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Registro</h3>
				
				<div class="form-group col-lg-12">
					<label>Nombre</label>
					<input type="text" name="nombre" class="form-control" id="nombre" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Apellido</label>
					<input type="text" name="apellidos" class="form-control" id="apellidos" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Email</label>
					<input type="text" name="email" class="form-control" id="email" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Contraseña</label>
					<input type="password" name="password" class="form-control" id="password" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Repetir contraseña</label>
					<input type="password" name="passwordRepetido" class="form-control" id="passwordRepetido" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Fecha nacimiento</label>
					<input type="text" placeholder="dd/mm/aaaa" name="fechaNac" class="form-control" id="fechaNac" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Código Postal</label>
					<input type="text" name="cp" class="form-control" id="cp" value="">
					<span class="field-validation-valid help-block"></span>
				</div>			
				
				<!-- RADIOS -->
				<div class="form-group">
		            <label class="col-lg-4 control-label" id="sexo" for="sexo">Sexo</label>
		            <div class="col-lg-12">
		                <label class="radio-inline">
		                    <input type="radio" name="sexo" value="hombre">
		                    Hombre
		                </label>
		                <label class="radio-inline">
		                    <input type="radio" name="sexo" value="mujer">
		                    Mujer
		                </label>
		              	<span class="field-validation-valid help-block"></span>
		            </div>
       			</div>
       			
       			<div class="form-group">
		            <label class="col-lg-4 control-label" id="cochePropio" for="cochePropio">Coche propio</label>
		            <div class="col-lg-12">
		                <label class="radio-inline">
		                    <input type="radio" name="cochePropio" value="si">
		                    Si
		                </label>
		                <label class="radio-inline">
		                    <input type="radio" name="cochePropio" value="no">
		                    No
		                </label>
		              	<span class="field-validation-valid help-block"></span>
		            </div>
       			</div>							
				
				<div class="col-xs-12 col-lg-8"><input type="submit" value="Registrarse" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>			
			</div>	
				
		</div>
		
	</section>
	
</div>

</form>
<!-- 
</body>
</html>
 -->