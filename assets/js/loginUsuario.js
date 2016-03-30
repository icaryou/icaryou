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