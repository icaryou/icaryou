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
                "passwd": {
                    required: true,
                    minlength: 8,
                    maxlength: 20                    
                },
                "passwordRepetido": {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    equalTo:"#passwd"
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
