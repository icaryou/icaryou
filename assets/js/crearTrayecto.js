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
                    remote:"El código postal no es correcto."
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
	
	/*************** DESPLEGABLE DE MUNICIPIOS ************/
	 $(function() {

			objetos = $.parseJSON(municipios);
			
			var arrayMuni=new Array();
			
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
	 
	    function search(nameKey, myString){
        	if (myString.indexOf(nameKey)) {
            	alert(nameKey);
                return -1;
            }
	    	
	    	/*
	    	var sinCorchetes = myString.substring(1,myString.length-1);
	    	var arrayFinal= sinCorchetes.split(", ");
	    	console.log(arrayFinal.length);
	        for (var i=0; i < arrayFinal.length; i++) {
	        	if (arrayFinal[i].poblacion === nameKey) {
	            	alert(nameKey);
	                return -1;
	            }
	        }*/
	    }
	 
	 jQuery.validator.addMethod("isstate", function(value) {
		    var states = [
		        "AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA",
		        "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD",
		        "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ",
		        "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC",
		        "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY",
		        "AS", "DC", "FM", "GU", "MH", "MP", "PR", "PW", "VI"
		    ];
		    
		    //var resultObject = search("string 1", municipios);
		    
		    //return $.inArray(value, municipios) != -1;
		    //console.log(municipios);
		    var existe = search(value, municipios);
		    //alert("existe: "+existe);
		    return existe != -1;
		}, "El dato introducido no es correcto");
	 
	 $( "#poblacionOrigen" ).on('blur', function(){
		 $("#poblacionOrigen").validate();
		 
	 });


