/********* VALIDACION VENTANA LOGIN *************/

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/"+getUrl.pathname.split('/')[2]+"/"+getUrl.pathname.split('/')[3];
var pathname = window.location.pathname;

$( document ).ready(function() 
	{		
	/* CERRAR MENSAJES DE ERROR AL CERRAR VENTANA MODAL */

	$('#botonLogin').click(function (){
		
		$(document).mouseup(function (e)
				{
				    var container = $('#loginForm');

				    if (!container.is(e.target) // if the target of the click isn't the container...
				        && container.has(e.target).length === 0) // ... nor a descendant of the container
				    {
				    	$('#loginForm input[type="text"]').tooltipster('hide');
				    	$('#loginForm input[type="password"]').tooltipster('hide');
				    	$('#errorSubmit').tooltipster('hide');
				    }
				});
			    	
	});
	
	/* TOOLTIPSTER  OPCIONES */
	
	$('#errorSubmit').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'top',  // display the tips to the right of the element
    });
	
	$('#formularioLogin input[type="text"]').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'bottom'  // display the tips to the right of the element
    });
	
	$('#formularioLogin input[type="password"]').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'bottom'  // display the tips to the right of the element
    });
	
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
            errorPlacement: function(error, element) {
           	 	$(element).tooltipster('update', $(error).text());
           	 	$(element).tooltipster('show');
             },
             success: function (label, element) {
                 $(element).tooltipster('hide');
             },
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
            //perform an AJAX post to ajax.php
            submitHandler: function () {

                    $.ajax({
                        type: 'post',
                        url: '/icaryou/usuario/loginUsuarioPost',
                        data: $('#formularioLogin').serialize(),
                        success: function(response){
                        	console.log(response);
                        	if(response == true){
                        		window.location.reload();
                        	}else if(response == false){
                        		$('#errorSubmit').tooltipster('show');
                        	}else{
                        		window.location.href=response;
                        	}
                                                    	
                         }
    
                    });
                return false; // required to block normal submit since you used ajax
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
         //llamamos a la funcion una vez y creamos un intervalo
        comprobar_mensajes_no_leidos();
        setInterval(function()
        		{ 		
        			comprobar_mensajes_no_leidos(); 
        		}, 500);
        
	});
  
//funcion que comprueba si hay mensajes nuevos y pone el icono en el login
function comprobar_mensajes_no_leidos()
{
	$.ajax({        
	       type: "POST",
	       url: BASE_URL+"mensaje/comprobar_mensaje_nuevos_login",
	       //data: { id_conversacion : id_conversacion,id_ultimo_mensaje:id_ultimo_mensaje},
	       success: function(respuesta) 
	       {
	    	   if((Number)(respuesta)>0)
	    	   {
	    		   $('#sobre_login').css('visibility','visible');
	    	   }
	    	   else
	    	   {
	    		   $('#sobre_login').css('visibility','hidden');
	    	   }
	       }
	    }); 
}  


