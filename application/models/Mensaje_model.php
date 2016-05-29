<?php

class Mensaje_model extends RedBean_SimpleModel //CI_Model//
{		
	public function comprobar_conversacion($usuario,$id_otro_usuario)
	{
		$id_conversacion=R::getRow("SELECT id
				FROM conversacion c
				WHERE (c.usuario1_id=$usuario AND c.usuario2_id=$id_otro_usuario) OR (c.usuario1_id=$id_otro_usuario AND c.usuario2_id=$usuario)");
		
		return $id_conversacion;
	}
	
	
	//BUSCA LAS CONVERSACIONES ACTIVAS QUE TIENE EL USUARIO
	public function buscar_conversaciones($usuario_id)
	{
		//SELECCIONA LOS ID'S DE CONVERSACION EN LOS QUE ESTE EL USUARIO
		$id_buscar_conversacion=R::getAll("SELECT id, CASE
		WHEN c.USUARIO1_ID = $usuario_id then c.iniciochatusuario1
		ELSE c.iniciochatusuario2
		END inicio_chat
		FROM conversacion c
		WHERE c.usuario1_id=$usuario_id OR c.usuario2_id=$usuario_id");	
				
		
		
		$usuarios_buscar_conversacion=array();
		
		//SELECCIONA LAS CONVERSACIONES DE LOS  ID'S ANTERIORES EN LOS QUE TENGA CHAT ACTIVO(SIN BORRAR)
		foreach ($id_buscar_conversacion as $id)
		{
			/*
			array_push($usuarios_buscar_conversacion, R::getAll("SELECT m.conversacion_id, CASE
					WHEN c.USUARIO1_ID = $usuario_id then c.USUARIO2_ID
					ELSE c.USUARIO1_ID
					END usuario_chat,
					count(m.hora) conversacion_activa
					FROM conversacion c 
					join mensaje m on c.id=m.conversacion_id
					WHERE
					conversacion_id={$id['id']} AND
					M.hora>='{$id['inicio_chat']}'
			group by conversacion_id
			having conversacion_activa>0")[0]);
			
			*/
			
			$busqueda=R::getAll("SELECT m.conversacion_id, CASE
					WHEN c.USUARIO1_ID = $usuario_id then c.USUARIO2_ID
					ELSE c.USUARIO1_ID
					END usuario_chat,
					count(m.hora) conversacion_activa
					FROM conversacion c 
					join mensaje m on c.id=m.conversacion_id
					WHERE
					conversacion_id={$id['id']} AND
					m.hora>='{$id['inicio_chat']}'
			group by conversacion_id
			having conversacion_activa>0");
			
			if($busqueda!=null)
			{
				array_push($usuarios_buscar_conversacion,$busqueda[0]);
			};
			
		}
		
		//CAMBIAMOS ID USUARIO POR NOMBRE + APELLIDOS
		for ($i=0;$i<sizeof($usuarios_buscar_conversacion);$i++)
		{
			$usuarios_buscar_conversacion[$i]['usuario_chat_nombre']=R::getAll("SELECT
					CONCAT(Nombre, ' ', Apellidos) usuario_chat
					FROM usuario u
					WHERE
					u.id={$usuarios_buscar_conversacion[$i]['usuario_chat']}")[0]['usuario_chat'];
		}
		
		//AÑADIMOS LA CANTIDAD DE MENSAJES NO LEIDOS PARA PINTAR UN ICONO DE NO LEIDO
		for ($i=0;$i<sizeof($usuarios_buscar_conversacion);$i++)
		{
			$usuarios_buscar_conversacion[$i]['no_leidos']=R::getAll("SELECT
					count(m.sw_no_leido) no_leidos
					FROM conversacion c join mensaje m on c.id=m.conversacion_id
					WHERE
					conversacion_id={$usuarios_buscar_conversacion[$i]['conversacion_id']} AND
					m.sw_no_leido>=1 AND remitente !=$usuario_id")[0]['no_leidos'];
		}
		//Formato fila
		//[0]=> array(4) { ["conversacion_id"]=> string(1) "1" ["usuario_chat"]=> string(1) "2" ["conversacion_activa"]=> string(1) "3" ["no_leidos"]=> string(1) "5" 
				 
		return $usuarios_buscar_conversacion;	
	
	}
	
	//BUSCA MENSAJES DE UNA CONVERSACION QUE HA ABIERTO EL USUARIO Y PONE COMO LEIDOS TOODOS LOS DE ESA CONVERSACION QUE TIENEN DE DESTINATARIOEL USUARIO 
	public function buscar_mensajes_chat($usuario,$id_otro_usuario)
	{
		$id_conversacion=R::getRow("SELECT id
				FROM conversacion
				WHERE (usuario1_id=$usuario AND usuario2_id=$id_otro_usuario) OR
				(usuario1_id=$id_otro_usuario AND usuario2_id=$usuario)");
		
		
		
		
		
		$mensajes=R::getAll("SELECT *
				FROM mensaje
				WHERE conversacion_id={$id_conversacion['id']}");
		
		R::exec( "UPDATE mensaje SET sw_no_leido=0 WHERE remitente=$id_otro_usuario AND conversacion_id={$id_conversacion['id']}" );
		
		return $mensajes;
	}
	
	//BUSCA NUEVOS MENSAJES CONSTANTEMENTE Y PONE COMO LEIDOS TOODOS LOS DE ESA CONVERSACION QUE ES LA QUE TIENE ABIERTA EL USUARIO
	//(PONE COMO LEIDOS LOS QUE TENIA EL COMO DESTINATARIO)
	public function buscar_nuevos_mensajes_chat($id_conversacion,$id_ultimo_mensaje,$usuario_activo)
	{	
		
		
		$mensajes=R::getAll("SELECT *
				FROM mensaje
				WHERE conversacion_id=$id_conversacion AND id>$id_ultimo_mensaje");
	
		R::exec( "UPDATE mensaje SET sw_no_leido=0 WHERE remitente!=$usuario_activo AND conversacion_id={$id_conversacion}" );
		
		return $mensajes;
	}
	
	//CREA UN NUEVO MENSAJE EN LA BASE DE DATOS Y LO RELACIONA CON LA CONVERSACION QUE EXISTE ENTRE ESOS DOS USUARIOS
	public function crear_mensaje($texto,$hora,$remitente,$destinatario)
	{
		$id_buscar_conversacion=R::getRow("SELECT id 
							FROM conversacion 
							WHERE (usuario1_id=$remitente AND usuario2_id=$destinatario) OR 
							(usuario1_id=$destinatario AND usuario2_id=$remitente)");
		
		
		if($id_buscar_conversacion==NULL)//CREAMOS UNA CONVERSACION PORQUE NO EXISTIA
		{
			$conversacion=R::dispense('conversacion');
			$conversacion->iniciochatusuario1=$hora;
			$conversacion->iniciochatusuario2=$hora;
			
			$remitente_bean=R::load('usuario',$remitente);
			$destinatario_bean=R::load('usuario',$destinatario);
			
			$conversacion->usuario1=$remitente_bean;
			$conversacion->usuario2=$destinatario_bean;
			
			$id_buscar_conversacion['id']=R::store($conversacion);
			
			//======================
			
			$conversacion_encontrada=R::load('conversacion',$id_buscar_conversacion['id']);
			
			$mensaje=R::dispense('mensaje');
			$mensaje->texto=$texto;
			$mensaje->hora=$hora;
			$mensaje->remitente=$remitente;
			$mensaje->sw_no_leido=true;
			$mensaje->conversacion=$conversacion_encontrada;
			
			$id=R::store($mensaje);
				
		}
		else
		{
			$conversacion_encontrada=R::load('conversacion',$id_buscar_conversacion['id']);
			
			$mensaje=R::dispense('mensaje');
			$mensaje->texto=$texto;
			$mensaje->hora=$hora;
			$mensaje->remitente=$remitente;
			$mensaje->sw_no_leido=true;
			$mensaje->conversacion=$conversacion_encontrada;
			
			$id=R::store($mensaje);
		}
		
	}
	
	
	
	
	
}

?>