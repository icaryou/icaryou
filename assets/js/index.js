/********* VALIDACION VENTANA LOGIN *************/

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
        	   valid: function(label) {
            	     $(this).addClass("valid");          	     
               },
            debug: false,
            rules: {
                
                "email": {
                    required: true,
                    email: true
                },
                "passwd": {
                    required: true,
                    minlength: 8,
                    maxlength: 20 
                },            
             
            },
            messages: {
                "email": {
                    required: "Introduce tu email",
                    email: "Introduce un email válido.",
                },
                "passwd": {
                    required: "Introduce tu contraseña",
                    minlength:"Introduce al menos 8 caracteres.",
                    maxlength: "Introduce como máximo 20 caracteres." 
                },           
            } 
        });
});

/************************************* DESPLEGABLE DE MUNICIPIOS *************************************************************/
$(function() {

		var objetos = $.parseJSON(municipios);
		
		arrayMuni=new Array();
		
		for (var i=0;i<objetos.length;i++){
			arrayMuni.push(objetos[i].poblacion);
		}


	    $( "#poblacionOrigen" ).autocomplete({
	      source: arrayMuni,
	      autoFocus: true
	    });
	    
	    $( "#poblacionDestino" ).autocomplete({
		      source: arrayMuni,
		      autoFocus: true
		});
	  });

/************************* VALIDAR MUNICIPIO **********************************************/

jQuery.validator.addMethod("isstate", function(value) {
		console.log("dfsd");
	    return $.inArray(value, arrayMuni) != -1;
	}, "El dato introducido no es correcto");
