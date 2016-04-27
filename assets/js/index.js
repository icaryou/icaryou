/********* VALIDACION VENTANA LOGIN *************/

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/"+getUrl.pathname.split('/')[2]+"/"+getUrl.pathname.split('/')[3];
var pathname = window.location.pathname;

$( document ).ready(function() 
	{		
	
	
	/* TOOLTIPSTER  OPCIONES */
	$('a').on('click', function(){
		$('#poblacionOrigen').tooltipster('hide');
		$('#poblacionDestino').tooltipster('hide');
	});
	
	$('#poblacionOrigen').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'bottom',  // display the tips to the right of the element
        timer:800
    });
	
	$('#poblacionDestino').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'bottom',  // display the tips to the right of the element
        timer:800
    });
	
		//VALIDACION FORMULARIO
        $('#formularioBuscar').submit(function(e) {
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
                
                "poblacionOrigen": {
                    required: true,
                },
                "poblacionDestino": {
                    required: true,
                },            
             
            },
            messages: {
                "poblacionOrigen": {
                    required: "Selecciona un municipio",
                    lettersonly: "Selecciona un municipio"
                },
                "poblacionDestino": {
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

        jQuery.validator.addMethod("validarBuscar", function(value) {
    	    return $.inArray(value, arrayMuni) != -1;
    	}, "El dato introducido no es correcto");
        
        



