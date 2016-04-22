
//EJEMPLO JSON
/*
var emple={"employees":[
             {"firstName":"John", "lastName":"Doe"},
             {"firstName":"Anna", "lastName":"Smith"},
             {"firstName":"Peter", "lastName":"Jones"}
         ]};
*/
//HASTA QUE NO SE CARGA EL DOCUMENTO NO CARGA ESTAS FUNCIONES
$(document).ready(function() {	
	
	//AÑADIMOS EVENTO CLICK AL BOTON abrir chat
    $(".abrir_chat").click(function(event) 
    { 	
    	var id_otro_usuario=$(this).attr('id');
    	//EN DATA EL PRIMER DATO ES EL NOMBRE EN LADO SERVIDOR DE LA VARIABLE, EL SEGUNDO EN LADO CLIENTE
    	
    	//SUCCESS INDICA LA ACCION A SEGUIR DESPUES DE LA RESPUESTA
    	
    	
    	$.ajax({        
    	       type: "POST",
    	       url: BASE_URL+"mensaje/abrir_chat",
    	       data: { id_otro_usuario : id_otro_usuario},
    	       dataType: "json",
    	       success: function(respuesta) {
    	    	   var mensajes_cliente=respuesta;
    	    	   pintar_chat(mensajes_cliente);
    	       }
    	    }); 
    	
      });
    
 });

function pintar_chat(mensajes_cliente)
{
		
	for(i=0;i<mensajes_cliente.length;i++)
	{	
		$('#lista_chat').append("<p>"+mensajes_cliente[i].texto+"</p>");
	}
	
	/*
	$('#lista_chat').append()
	 */   
}