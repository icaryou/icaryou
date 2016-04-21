$( document ).ready(function() 
	{
	
	/* TOOLTIPSTER  OPCIONES */
/*	
	$('#errorSubmit').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'top',  // display the tips to the right of the element
    });
*/	
	$('#poblacionOrigen').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'bottom'  // display the tips to the right of the element
    });
	$('#poblacionDestino').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'bottom'  // display the tips to the right of the element
    });
	$('#poblacionOrigen')
    .focus(function(){
        $(this).tooltipster('hide');
    });
	$('#poblacionDestino')
    .focus(function(){
        $(this).tooltipster('hide');
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
            focusCleanup: true,
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
                    lettersonly: true
                },
                "poblacionDestino": {
                    required: true,
                    lettersonly: true
                },            
             
            },
            messages: {
                "poblacionOrigen": {
                    required: "Selecciona un municipio",
                    lettersonly: "Selecciona un municipio"
                },
                "poblacionDestino": {
                	required: "Selecciona un municipio",
                    lettersonly: "Selecciona un municipio"
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
        
        



