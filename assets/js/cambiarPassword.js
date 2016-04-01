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
                
                
                "passwd": {
                    required: true,
                    minlength: 8,
                    maxlength: 20                    
                },
                "passwordRepetido": {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    equalTo:"#passwd",
                },
                "passwordAntiguo": {
                    required: true,
                    minlength: 8,
                    maxlength: 20                    
                },                  
                
            },
            messages: {                
                "passwd": {
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