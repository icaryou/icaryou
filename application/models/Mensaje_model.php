<?php

class Mensaje_model extends RedBean_SimpleModel //CI_Model//
{		
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
					m.sw_no_leido>=1")[0]['no_leidos'];
		}
		//Formato fila
		//[0]=> array(4) { ["conversacion_id"]=> string(1) "1" ["usuario_chat"]=> string(1) "2" ["conversacion_activa"]=> string(1) "3" ["no_leidos"]=> string(1) "5" 
		 
		 
		return $usuarios_buscar_conversacion;	
	
	}
	
	public function buscar_mensajes_chat($usuario,$id_otro_usuario)
	{
		$id_conversacion=R::getRow("SELECT id
				FROM conversacion
				WHERE (usuario1_id=$usuario AND usuario2_id=$id_otro_usuario) OR
				(usuario1_id=$id_otro_usuario AND usuario2_id=$usuario)");
		
		$mensajes=R::getAll("SELECT *
				FROM mensaje
				WHERE conversacion_id={$id_conversacion['id']}");
		
		return $mensajes;
	}
	
	public function buscar_nuevos_mensajes_chat($id_conversacion,$id_ultimo_mensaje)
	{	
		$mensajes=R::getAll("SELECT *
				FROM mensaje
				WHERE conversacion_id=$id_conversacion AND id>$id_ultimo_mensaje");
	
		return $mensajes;
	}
	
	
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
				
		}
		
		$conversacion_encontrada=R::load('conversacion',$id_buscar_conversacion['id']);
		
		$mensaje=R::dispense('mensaje');
		$mensaje->texto=$texto;
		$mensaje->hora=$hora;
		$mensaje->remitente=$remitente;
		$mensaje->sw_no_leido=true;
		$mensaje->conversacion=$conversacion_encontrada;//TODO cargar
	
		$id=R::store($mensaje);
	}
	
	
	
	
	
}

?>