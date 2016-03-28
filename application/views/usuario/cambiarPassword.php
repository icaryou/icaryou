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
                "passwordAntiguo": {
                    required: true,
                    minlength: 8,
                    maxlength: 20                    
                },                  
                
            },
            messages: {                
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
                "passwordAntiguo": {
                    required: "Introduce tu contraseña",
                    minlength:"Introduce al menos 8 caracteres.",
                    maxlength: "Introduce como máximo 20 caracteres."                    
                },                               
            } 
        });
});
	
</script>

<!--  
</head>
<body>
-->

<form id="formularioRegistro" action="<?=base_url('usuario/cambiarPasswordPost')?>" method="post">

<div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Cambiar contraseña</h3>					
				
				<div class="form-group col-lg-12">
					<label>Nueva contraseña</label>
					<input type="password" name="password" class="form-control" id="password" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Repetir nueva contraseña</label>
					<input type="password" name="passwordRepetido" class="form-control" id="passwordRepetido" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Contraseña antigua</label>
					<input type="password" name="passwordAntiguo" class="form-control" id="passwordAntiguo" value="">
				</div>								
       										
				
				<div class="col-xs-12 col-lg-8"><input type="submit" value="Guardar cambio" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>			
			</div>	
				
		</div>
		
	</section>
	
</div>

</form>
<!-- 
</body>
</html>
 -->