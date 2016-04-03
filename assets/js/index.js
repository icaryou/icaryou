
        
   
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
        
        $('#formularioBuscar').validate({
            rules: {
            	"poblacionOrigen": {
                    required: true,
                    validarBuscar: true
                }
            }
        });
        



