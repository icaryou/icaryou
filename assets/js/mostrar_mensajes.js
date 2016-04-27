
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
	
	setInterval(function()
	{ 
		
		actualizar_mensajes_chat(); 
	}, 200);
	
	
	//AÑADIMOS EVENTO CLICK AL BOTON abrir chat
    $(".abrir_chat").click(function(event) 
    { 	
    	var id_otro_usuario=$(this).attr('id');
    	
    	$('#panel_mensajes ul').attr('id',id_otro_usuario);    	
    	//EN DATA EL PRIMER DATO ES EL NOMBRE EN LADO SERVIDOR DE LA VARIABLE, EL SEGUNDO EN LADO CLIENTE
    	
    	//SUCCESS INDICA LA ACCION A SEGUIR DESPUES DE LA RESPUESTA    	
    	
    	$.ajax({        
    	       type: "POST",
    	       url: BASE_URL+"mensaje/abrir_chat",
    	       data: { id_otro_usuario : id_otro_usuario},
    	       dataType: "json",
    	       success: function(respuesta) {
    	    	   var mensajes_cliente=respuesta;
    	    	   $('#conv_activa').attr('value',mensajes_cliente[0].conversacion_id);
    	    	   $('#otro_usuario').attr('value',id_otro_usuario);
    	    	   pintar_chat(mensajes_cliente,true);
    	       }
    	    }); 
    	
      });
    
 });

function pintar_chat(mensajes_cliente,borrar_mensajes)
{
	if(borrar_mensajes)
	{
		$('#panel_mensajes ul').html('');
		
		for(i=0;i<mensajes_cliente.length;i++)
		{	
			if(mensajes_cliente[i].remitente==($('#otrosuario')))
			{
				$('#panel_mensajes ul').append("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_contrario'>"+mensajes_cliente[i].texto+"</li>");
			}
			else
			{
				$('#panel_mensajes ul').append("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_propio'>"+mensajes_cliente[i].texto+"</li>");
			}			
		}
		
		$('#panel_mensajes ul').append('<li id="li_input"><input type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></li>');
	}
	else
	{
		for(i=0;i<mensajes_cliente.length;i++)
		{	
			var nueva_linea;
			alert($('#otro_usuario').val());
			if(mensajes_cliente[i].remitente==($('#otro_usuario').val()))
			{
				nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_contrario'>"+mensajes_cliente[i].texto+"</li>");
			}
			else
			{
				nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_propio'>"+mensajes_cliente[i].texto+"</li>");
			}	
			nueva_linea.insertBefore($('#li_input')); 
		}
	}
	
}

function actualizar_mensajes_chat()
{
	var id_conversacion=$('#conv_activa').val();
	
	if(id_conversacion!=0)
	{
		var id_ultimo_mensaje=$('#panel_mensajes ul .mensaje').last().attr('id');
		
		$.ajax({        
		       type: "POST",
		       url: BASE_URL+"mensaje/actualizar_chat",
		       data: { id_conversacion : id_conversacion,id_ultimo_mensaje:id_ultimo_mensaje},
		       dataType: "json",
		       success: function(respuesta) {
		    	   var mensajes_cliente=respuesta;
		    	   pintar_chat(mensajes_cliente,false);
		       }
		    }); 
		
	}	
}

function pressEnter(e) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("input_mensajes");
        enviarMensaje();
        return false;
    }
}

function enviarMensaje()
{
	var id_otro_usuario_mensaje=$('#panel_mensajes ul').attr('id');
	var texto=$('#input_mensajes').val();
	$.ajax({        
	       type: "POST",
	       url: BASE_URL+"mensaje/crear_mensaje",
	       data: { id_otro_usuario_mensaje : id_otro_usuario_mensaje,texto:texto},
	       success: function(respuesta) {
	    	   //alert("mensaje enviado");
	       }
	    }); 
	var texto=$('#input_mensajes').val('');
	//actualizar_mensajes_chat();
	
}