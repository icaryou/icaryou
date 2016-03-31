	$( document ).ready(function() 
	{
		//DEBUG
		//var getUrl = window.location;
		//var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/"+getUrl.pathname.split('/')[2]+"/"+getUrl.pathname.split('/')[3];
			
		
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
                    max:52999,
                    remote : {
                        url: "comprobarCP",
                        type: "post",
                        dataType: 'json'
                     }
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
                    max:"Introduce un valor válido.",
                    remote:"El código postal no corresponde."
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

