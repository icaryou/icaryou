var acceso_desbloqueado=true;
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

	
	
	//PARA ABRIR LA VENTANA EMERGENTE
	
	if($('#abrirEmergente').val()==1)
	{
		abrir_emergente();
		$('#botonToogelador').click();
	}
	
	//PONEMOS LA VENTANA EMERGENTE Y EL FONDO OSCURO OCULTOS POR DEFECTO
	
	$("#dialog").css('display','none');
	
	$("#sombra").css('display','none');	
	
	
	if($('#abrirEmergente').val()==1)
	{
		//alert("abrirEmergente");
		abrir_emergente();
	}
	
	//LOS CERRAMOS Y HACEMOS INVISIBLES
	$('#imagen_cierre_popup').on('click',function()
	{
		$("#dialog").css('display','none');
		$("#sombra").css('display','none');
	});
	
	
	
	
	
	//FUNCION PARA ABRIR UNA CONVERSACION AUTOMATICAMENTE AL CARGAR LA PAGINA
	if($('#activar_conv').val()!=0)
	{
		
		$( ".abrir_chat").each(function()
		{
			if($(this).attr('id')==$('#activar_conv').val())
			{
				abrir_chat($(this).attr('id'));
			}
		});
	}
	
	
	
	setInterval(function()
    		{ 		
    			actualizar_conversaciones(); 
    		}, 3000);
	
	//AÑADIMOS EVENTO CLICK AL BOTON abrir chat
	
	$('#panel_conversaciones').delegate('.abrir_chat','click',function(event)
	{	
		//MANDAMOS EL ID DEL USUARIO CON EL QUE VAMOS A ABRIR EL CHAT
		var id_otro_usuario=$(this).attr('id');
		abrir_chat(id_otro_usuario);
	
	});
	
 });

function abrir_emergente()
{
	//LE DAMOS EL TAMAÑO DE LA PANTALLA A LA SOMBRA
	$("#sombra").css('width',$(window).width()+"px");
	$("#sombra").css('height',$(window).height()+"px");
	
	//LOS HACEMOS VISIBLES
	$("#dialog").css('display','block');
	$("#sombra").css('display','block');
}

function abrir_chat(id_otro_usuario)
{
	  	
	
	if((id_otro_usuario!=$('#panel_mensajes ul').attr('id'))||$('#panel_mensajes ul').attr('id')==0)
	{
		//SI HACE CLICK EN UNA CONVERSACION DIFERENTE A LA QUE TIENE ABIERTA BORRAMOS EL CHAT, CREAMOS EL INPUT Y BUSCAMOS LOS MENSAJES
		$('#panel_mensajes ul').html('');
		
		$('#panel_mensajes ul').append('<li id="li_input"><input type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></li>');
		
		//GUARDAMOS EL ID DEL USUARIO CON EL QUE VAMOS A ABRIR EL CHAT EN LA LISTA DEL PANEL DE MENSAJES
    	$('#panel_mensajes ul').attr('id',id_otro_usuario); 
    	
		//alert("abrimos"+id_otro_usuario+"--"+$('#conv_activa').val());
		//EN DATA EL PRIMER DATO ES EL NOMBRE EN LADO SERVIDOR DE LA VARIABLE, EL SEGUNDO EN LADO CLIENTE    	
    	//SUCCESS INDICA LA ACCION A SEGUIR DESPUES DE LA RESPUESTA    	    	
    	$.ajax({        
    	       type: "POST",
    	       url: BASE_URL+"mensaje/abrir_chat",
    	       data: { id_otro_usuario : id_otro_usuario},
    	       dataType: "json",
    	       success: function(respuesta) {
    	    	   var mensajes_cliente=respuesta;
    	    	   
    	    	   //GUARDAMOS LA CONVERSACION ACTIVA EN UNA VARIABLE
    	    	   $('#conv_activa').attr('value',mensajes_cliente[0].conversacion_id);
    	    	   $('#otro_usuario').attr('value',id_otro_usuario);
    	    	   pintar_chat(mensajes_cliente,true);
    	    	 //AL PINTAR EL CHAT FIJAMOS UN DEMONIO QUE ACTUALICE LOS MENSAJES DEL USUARIO
    	    	   
    	    		setInterval(function()
    	    		{ 		
    	    			actualizar_mensajes_chat(); 
    	    		}, 1000);
    	    		
    	    	   
    	    	   $('#input_mensajes').css('display','block');
    	       }
    	    }); 
	}
}

//PINTA LOS MENSAJES, COMO SEGUNDO PARAMETRO RECIBE TRUE O FALSE PARA BORRAR LOS QUE YA HAY, 
//ES DECIR AL ABRIR LA CONVERSACION SI HUBIERA ALGO SE BORRA, Y ASI SOLO PINTAMOS EL INPUT UNA VEZ(ES MEJORABLE)
function pintar_chat(mensajes_cliente,borrar_mensajes)
{
	/*
	if(borrar_mensajes)
	{
		$('#panel_mensajes ul').html('');
		
		for(i=0;i<mensajes_cliente.length;i++)
		{	
			if(mensajes_cliente[i].id!=$('#panel_mensajes ul .mensaje').last().attr('id'))
			{
				if(mensajes_cliente[i].remitente==($('#otro_usuario').val()))
				{
					$('#panel_mensajes ul').append("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_contrario'>"+mensajes_cliente[i].texto+"</li>");
				}
				else
				{
					$('#panel_mensajes ul').append("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_propio'>"+mensajes_cliente[i].texto+"</li>");
				}	
			}	
		}
		$('#panel_mensajes ul').append('<li id="li_input"><input type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></li>');
		
	}
	else		
	{
	*/
		for(i=0;i<mensajes_cliente.length;i++)
		{	
			var nueva_linea;
			
			if(mensajes_cliente[i].id!=$('#panel_mensajes ul .mensaje').last().attr('id'))
			{
				if(mensajes_cliente[i].remitente==($('#otro_usuario').val()))
				{
					nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_contrario'>"+mensajes_cliente[i].texto+"</li>");
				}
				else
				{
					nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_propio'>"+mensajes_cliente[i].texto+"</li>");
				}	
			}	
				nueva_linea.insertBefore($('#li_input'));			
		}
	//}
	
}

//funcionque cada intervalo de tiempo va a la base de datos a buscar mensajes nuevos
function actualizar_mensajes_chat()
{
	//variable que pondremos a false cuando vayamos a la bbdd para que no se puedan juntar peticiones y duplicar mensajes
	if(acceso_desbloqueado)
	{
		acceso_desbloqueado=false;
		
		//mandamos el id de la conversacion activa
		var id_conversacion=$('#conv_activa').val();
		
		//solo vamos si el id es diferente a 0 que seria si tiene una conversacion abierta
		if(id_conversacion!=0)
		{
			
			
			
			//mandamos tambien el id del ultimo mensaje para buscar a partir de ahi
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
		//antes de salir desbloqueamos el acceso
		acceso_desbloqueado=true;
	}
	
}


function actualizar_conversaciones()
{
	//variable que pondremos a false cuando vayamos a la bbdd para que no se puedan juntar peticiones y duplicar mensajes
		//mandamos el id de la conversacion activa
		//var id_conversacion=$('#conv_activa').val();
		
		
	$.ajax({        
	       type: "POST",
	       url: BASE_URL+"mensaje/actualizar_conversaciones",
	       //data: { id_conversacion : id_conversacion,id_ultimo_mensaje:id_ultimo_mensaje},
	       dataType: "json",
	       success: function(respuesta) {
	    	   var conversaciones_activas=respuesta;
	    	   pintar_conversaciones(conversaciones_activas);
	       }
	    }); 
	
	
}

function pintar_conversaciones(conversaciones_activas)
{
	$('#panel_conversaciones ul').html('');
	
	//alert("vacio");
	
	for(i=0;i<conversaciones_activas.length;i++)
	{	
		//alert(conversaciones_activas[i].usuario_chat);
		
		nueva_linea=$('<li><a id='+conversaciones_activas[i].usuario_chat+' class="abrir_chat">'+conversaciones_activas[i].usuario_chat_nombre+'</a></li>');
		
		$('#panel_conversaciones ul').append(nueva_linea);
		/*
		var nueva_linea;
		
		if(mensajes_cliente[i].id!=$('#panel_mensajes ul .mensaje').last().attr('id'))
		{
			if(mensajes_cliente[i].remitente==($('#otro_usuario').val()))
			{
				nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_contrario'>"+mensajes_cliente[i].texto+"</li>");
			}
			else
			{
				nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_propio'>"+mensajes_cliente[i].texto+"</li>");
			}	
		}	
			nueva_linea.insertBefore($('#li_input'));		
		*/
	}
}

//funcion que detecta cuando se pulsa el boton enter en el input
function pressEnter(e) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("input_mensajes");
        enviarMensaje();
        return false;
    }
}

//va a la base de datos y crea un registro con el nuevo mensaje
function enviarMensaje()
{
	//MANDAMOS EN ID DEL DESTINATARIO Y EL TEXTO
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
	//PONEMOS EL INPUT A 0
	var texto=$('#input_mensajes').val('');
	
}