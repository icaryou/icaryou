$( document ).ready(function() 
	{
		$('.eliminar_usuario_trayecto').on('click',function()
		{
			var id_usuario=$(this).attr('id').split("*")[0];
			var id_trayecto=$(this).attr('id').split("*")[1];
						
			$.ajax({        
		       type: "POST",
		       url: BASE_URL+"trayecto/eliminar_usuario_trayecto",
		       data: { id_usuario : id_usuario, id_trayecto:id_trayecto },
		       success: function(respuesta) 
	           {
		    	   var destinatario=respuesta.split("*")[0];
	               var texto=respuesta.split("*")[1];
	                
	                $.ajax({        
					       type: "POST",
					       url: BASE_URL+"mensaje/crear_mensaje_admin",
					       data: { destinatario : destinatario,texto:texto},
					       success: function(respuesta) 
				           {
					    	   ///////
					       }
						});	 
	                llamarAjax(1);
		       }
			});
		});
		
		$('.aceptar_usuario_trayecto').on('click',function()
		{
			var id_usuario=$(this).attr('id').split("*")[0];
			var id_trayecto=$(this).attr('id').split("*")[1];
						
			$.ajax({        
		       type: "POST",
		       url: BASE_URL+"trayecto/aceptar_usuario_trayecto",
		       data: { id_usuario : id_usuario, id_trayecto:id_trayecto },
		       success: function(respuesta) 
	           {	          
	                
	                var destinatario=respuesta.split("*")[0];
	                var texto=respuesta.split("*")[1];
	                
	                $.ajax({        
					       type: "POST",
					       url: BASE_URL+"mensaje/crear_mensaje_admin",
					       data: { destinatario : destinatario,texto:texto},
					       success: function(respuesta) 
				           {
					    	   ///////
					       }
						});		
	                llamarAjax(1);
		       }
			});
		});
		
		$('.rechazar_usuario_trayecto').on('click',function()
		{
			var id_usuario=$(this).attr('id').split("*")[0];
			var id_trayecto=$(this).attr('id').split("*")[1];
						
			$.ajax({        
		       type: "POST",
		       url: BASE_URL+"trayecto/rechazar_usuario_trayecto",
		       data: { id_usuario : id_usuario, id_trayecto:id_trayecto },
		       success: function(respuesta) 
	           {	          
	                
	                var destinatario=respuesta.split("*")[0];
	                var texto=respuesta.split("*")[1];
	                
	                $.ajax({        
					       type: "POST",
					       url: BASE_URL+"mensaje/crear_mensaje_admin",
					       data: { destinatario : destinatario,texto:texto},
					       success: function(respuesta) 
				           {
					    	   ///////
					       }
						});	
	                llamarAjax(1);
		       }
			});
		});
		
});

