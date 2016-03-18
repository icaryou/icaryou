<!DOCTYPE html>
<html>
<head>
<title>ICarYou</title>
<meta charset="UTF-8">

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
	#formularioTrayecto .error
	{
		color:red;
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
                    required: true,
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
                    regx:/^([01]\d|2[0-3]):([0-5]\d)$///TODO    PROBAR
                },
                "horaRetorno": {
                    required: true,
                    regx:/^([01]\d|2[0-3]):?([0-5]\d)$///TODO    PROBAR
                },
                "comentarios": {
                	maxlength: 140                    
                },
                "dias[]": {
                    required: true                    
                },
                "plazas": {
                    required:true,
                    numbre:true,
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
                    numbre:"Introduce un número correcto",
                    min: "Número mínimo 2"
                },                 
            } 
        });
});
	
</script>
</head>
<body>
<form id="formularioTrayecto" action="<?=base_url('registro/crearTrayectoPost')?>" method="post">

<div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Crear trayecto</h3>
				
				<div class="form-group col-lg-12">
					<label>Código Postal origen</label>
					<input type="text" name="cpOrigen" class="form-control" id="cpOrigen" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Población origen</label>
					<input type="text" name="poblacionOrigen" class="form-control" id="poblacionOrigen" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Código Postal destino</label>
					<input type="text" name="cpDestino" class="form-control" id="cpDestino" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Población destino</label>
					<input type="text" name="poblacionDestino" class="form-control" id="poblacionDestino" value="">
				</div>				
				
				<div class="form-group col-lg-12">
					<label>Hora de llegada al trabajo</label>
					<input type="text" placeholder="HH:MM" name="horaLlegada" class="form-control" id="horaLlegada" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Hora de vuelta del trabajo</label>
					<input type="text" placeholder="HH:MM" name="horaRetorno" class="form-control" id="horaRetorno" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Comentarios</label>
					<textarea maxlength="140" name="comentarios" class="form-control" id="cp" ></textarea>
				</div>	
				
				<!-- CHECKBOX -->
				<div class="form-group">
		            <label class="col-lg-3 control-label" for="dias" id="dias">Días</label>
		            <div class="col-lg-11">
		                <label class="checkbox-inline col-lg-2">
		                    <input type="checkbox" name="dias[]" value="L">
		                    Lunes
		                </label>
		                <label class="checkbox-inline col-lg-2">
		                    <input type="checkbox" name="dias[]" value="M">
		                    Martes
		                </label>
		                <label class="checkbox-inline col-lg-2">
		                    <input type="checkbox" name="dias[]" value="X">
		                    Miércoles
		                </label>
		                <label class="checkbox-inline col-lg-2">
		                    <input type="checkbox" name="dias[]" value="J">
		                    Jueves
		                </label>
		                <label class="checkbox-inline col-lg-2">
		                    <input type="checkbox" name="dias[]" value="V">
		                    Viernes
		                </label>
		                <label class="checkbox-inline col-lg-2">
		                    <input type="checkbox" name="dias[]" value="S">
		                    Sábado
		                </label>
		                <label class="checkbox-inline col-lg-2">
		                    <input type="checkbox" name="dias[]" value="D">
		                    Domingo
		                </label>
		              	<span class="field-validation-valid help-block"></span>
		            </div>
       			</div>
				
				<div class="form-group col-lg-12">
					<input type="hidden" name="none" class="form-control" id="none" value="">
				</div>
				
				<div class="form-group col-lg-6">
					<label>Plazas máximas(incluido tú).</label>
					<input type="text" name="plazas" class="form-control" id="plazas" value="">
				</div>
				
				<div class="form-group col-lg-12">
					<input type="hidden" name="none" class="form-control" id="none" value="">
				</div>			
				
											
				
				<div class="col-xs-12 col-lg-8"><input type="submit" value="Registrarse" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>			
			</div>	
				
		</div>
		
	</section>
	
</div>

</form>

</body>
</html>
