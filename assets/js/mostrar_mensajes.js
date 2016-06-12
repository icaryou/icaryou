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
	
	
	$( window ).resize(function() {
var altura=$(document).height();		
		
		$('body').css('height',$(document).height()+"px");
		$('#header-row').css('height',$(document).height()*0.10+"px");
		
		var altura_contenedor=altura*0.90;
		
		$('#contenedor_mensajeria').css('height',altura_contenedor+'px');
		$('footer').css('height',$(document).height()*0.10+"px");	
		
		$('footer').css('display','none');
	});
	
	
	//PONER ALTURA DINAMICAMENTE
		var altura=$(document).height();		
		
		$('body').css('height',$(document).height()+"px");
		$('#header-row').css('height',$(document).height()*0.10+"px");
		
		var altura_contenedor=altura*0.90;
		
		$('#contenedor_mensajeria').css('height',altura_contenedor+'px');
		$('footer').css('height',$(document).height()*0.10+"px");	
		
		$('footer').css('display','none');
	
	
	
	
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
	
	
	actualizar_conversaciones();
	setInterval(function()
    		{ 		
    			actualizar_conversaciones(); 
    		}, 10000);
	
	//AÑADIMOS EVENTO CLICK AL BOTON abrir chat
	
	$('#panel_conversaciones').delegate('.abrir_chat','click',function(event)
	{	
		//MANDAMOS EL ID DEL USUARIO CON EL QUE VAMOS A ABRIR EL CHAT
		var id_otro_usuario=$(this).attr('id');
		abrir_chat(id_otro_usuario);
	
	});
	
	$('#panel_conversaciones').delegate('ul li','click',function(event)
	{	
		//MANDAMOS EL ID DEL USUARIO CON EL QUE VAMOS A ABRIR EL CHAT
		var id_otro_usuario=$(this).find('.abrir_chat').attr('id');
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
	flag_mensajes_nuevos=false;	
	
	if((id_otro_usuario!=$('#panel_mensajes ul').attr('id'))||$('#panel_mensajes ul').attr('id')==0)
	{
		//SI HACE CLICK EN UNA CONVERSACION DIFERENTE A LA QUE TIENE ABIERTA BORRAMOS EL CHAT, CREAMOS EL INPUT Y BUSCAMOS LOS MENSAJES
		$('#panel_mensajes ul').html('');
		
		//NEW ESTABA SIN COMENTAR
		//$('#panel_mensajes ul').append('<li id="li_input"><input type="text" id="input_mensajes" onkeypress="return pressEnter(event)"/></li>');
		
		//GUARDAMOS EL ID DEL USUARIO CON EL QUE VAMOS A ABRIR EL CHAT EN LA LISTA DEL PANEL DE MENSAJES
    	$('#panel_mensajes ul').attr('id',id_otro_usuario); 
    	
    	
    	
    	$('#panel_conversaciones').find('li').css('background','transparent');
    	
    	$('#'+id_otro_usuario).parent().css('background','#FFF');
    	$('#'+id_otro_usuario).parent().addClass('conv_activa');
    	
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
    	    		}, 10000);
    	    		
    	    	   
    	    	   $('#input_mensajes').css('display','block');
    	       }
    	    }); 
	}
}

var flag_mensajes_nuevos=false;

var ultima_fecha_pintada;

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
			//PRIMER MENSAJE NO LEIDO(PONEMOS LEYENDA DE MENSAJES NO LEIDOS)
			if(mensajes_cliente[i].sw_no_leido==1 && mensajes_cliente[i].remitente==($('#otro_usuario').val()) && !flag_mensajes_nuevos)
			{
				var flag_nuevos=$("<li class='mensaje mensaje_fecha mensajes_nuevos'>Mensajes nuevos</li>");
				flag_nuevos.appendTo($('#panel_mensajes ul'));
				flag_mensajes_nuevos=true;
			}
			
			var numero_mensajes_pintados=$('#panel_mensajes ul li').length;
			
			var nueva_fecha;
			
			//primer mensaje fecha
			if(numero_mensajes_pintados==0)//primer mensaje fecha
			{
				ultima_fecha_pintada=mensajes_cliente[i].hora.split(' ')[0];
				
				var fecha_troceada=mensajes_cliente[i].hora.split(' ')[0].split('-');
				var fecha_formato_europeo=fecha_troceada[2]+"-"+fecha_troceada[1]+"-"+fecha_troceada[0];
				
				nueva_fecha=$("<li class='mensaje mensaje_fecha'>"+fecha_formato_europeo+"</li>");
				nueva_fecha.appendTo($('#panel_mensajes ul'));
			}
			else
			{
				//HEMOS CAMBIADO DE DIA(PINTAMOS LA FECHA)
				if(ultima_fecha_pintada!=mensajes_cliente[i].hora.split(' ')[0])//nueva fecha pintar
				{
					ultima_fecha_pintada=mensajes_cliente[i].hora.split(' ')[0];
					
					var fecha_troceada=mensajes_cliente[i].hora.split(' ')[0].split('-');
					var fecha_formato_europeo=fecha_troceada[2]+"-"+fecha_troceada[1]+"-"+fecha_troceada[0];
					
					nueva_fecha=$("<li class='mensaje mensaje_fecha'>"+fecha_formato_europeo+"</li>");
					nueva_fecha.appendTo($('#panel_mensajes ul'));
				}
			}
			
			var nueva_linea;
			
			//HACEMOS ESTO PARA ASEGURAR QUE NO DUPLIQUE UN MENSAJE
			if(mensajes_cliente[i].id!=$('#panel_mensajes ul .mensaje').last().attr('id'))
			{
				//EL REMITENTE ES EL OTRO USUARIO
				if(mensajes_cliente[i].remitente==($('#otro_usuario').val()))
				{
					
					
					if(mensajes_cliente[i].sw_no_leido==1)
					{
						var hora_troceada=mensajes_cliente[i].hora.split(' ')[1].split(':');
						var hora=hora_troceada[0]+":"+hora_troceada[1];
						
						nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_contrario negrita'>"+"<span class=\"hora_peque\">("+hora+")</span>"+mensajes_cliente[i].texto+"</li>");
					}
					else
					{
						var hora_troceada=mensajes_cliente[i].hora.split(' ')[1].split(':');
						var hora=hora_troceada[0]+":"+hora_troceada[1];
					
						nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_contrario'>"+"<span class=\"hora_peque\">("+hora+")</span>"+mensajes_cliente[i].texto+"</li>");
					}
					//CONTINUAR PONIENDO MENSAJES NEGRITA NUEVOS
				}
				else//EL REMITENTE ES EL MISMO
				{
					var hora_troceada=mensajes_cliente[i].hora.split(' ')[1].split(':');
					var hora=hora_troceada[0]+":"+hora_troceada[1];
					
					nueva_linea=$("<li id="+mensajes_cliente[i].id+" class='mensaje mensaje_propio'>"+"<span class=\"hora_peque\">("+hora+")</span>"+mensajes_cliente[i].texto+"</li>");
				}	
			}	
				//nueva_linea.insertBefore($('#li_input'));//NEW era li_input		
				nueva_linea.appendTo($('#panel_mensajes ul'));
		}
		//MOVEMOS HACIA ABAJO EL SCROLL
		if(mensajes_cliente.length>0)
		{
			$("#panel_mensajes").animate({ scrollTop: '99999px' }, 1);
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
		
		var nueva_linea;
		
		//CONVERSACION ACTIVA
		if(conversaciones_activas[i].conversacion_id==$('#conv_activa').val())
		{
			//TIENE MENSAJES NO LEIDOS
			if(conversaciones_activas[i].no_leidos>0)
			{
				nueva_linea=$('<li class="conv_activa"><a id='+conversaciones_activas[i].usuario_chat+' class="abrir_chat">'+conversaciones_activas[i].usuario_chat_nombre+'</a><img class="sobre_conversaciones" src="'+BASE_URL+'/assets/img/sobre.png"/></li>');
			}
			//NO TIENE MENSAJES NO LEIDOS
			else
			{
				nueva_linea=$('<li class="conv_activa"><a id='+conversaciones_activas[i].usuario_chat+' class="abrir_chat">'+conversaciones_activas[i].usuario_chat_nombre+'</a></li>');
			}
		}
		else
		{
			//TIENE MENSAJES NO LEIDOS
			if(conversaciones_activas[i].no_leidos>0)
			{
				nueva_linea=$('<li><a id='+conversaciones_activas[i].usuario_chat+' class="abrir_chat">'+conversaciones_activas[i].usuario_chat_nombre+'</a><img class="sobre_conversaciones" src="'+BASE_URL+'/assets/img/sobre.png"/></li>');
			}
			//NO TIENE MENSAJES NO LEIDOS
			else
			{
				nueva_linea=$('<li><a id='+conversaciones_activas[i].usuario_chat+' class="abrir_chat">'+conversaciones_activas[i].usuario_chat_nombre+'</a></li>');
			}
		}
		
		
		
		
		
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
	
	var cancelar_envio=false;
	
	if(texto.length>140)
	{
		alert("La longitud máxima de mensaje es 140 caracteres.");
		cancelar_envio=true;
	}
	
	
	if(id_otro_usuario_mensaje==1)
	{
		cancelar_envio=true;
		alert("No puedes mandar mensajes instantaneos al admin, usa el email!!!");
		var texto=$('#input_mensajes').val('');
	}
	
	if(texto=='')
	{
		cancelar_envio=true;
	}
	
	if($('#conv_activa').val()==0)
	{
		alert("No tienes ninguna conversación seleccionada.");
		cancelar_envio=true;
	}
	
	
	if(!cancelar_envio)
	{
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
	
	
	
}