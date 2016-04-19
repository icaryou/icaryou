	$( document ).ready(function() 
	{

	/************************************* DESPLEGABLE DE MUNICIPIOS *************************************************************/
	 $(function() {

			var objetos = $.parseJSON(municipios);
			
			arrayMuni=new Array();
			
			for (var i=0;i<objetos.length;i++){
				arrayMuni.push(objetos[i].poblacion);
			}

		    $( "#poblacionOrigenFil" ).autocomplete({
		      source: arrayMuni,
		      autoFocus: true
		    });
		    
		    $( "#poblacionDestinoFil" ).autocomplete({
			      source: arrayMuni,
			      autoFocus: true
			});
		  });
	 
	 /************************* VALIDAR MUNICIPIO **********************************************/
 
	 jQuery.validator.addMethod("isstate", function(value) {

		    return $.inArray(value, arrayMuni) != -1;
		}, "El dato introducido no es correcto");
	
	});