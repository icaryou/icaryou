<?php

class Usuario_Model extends RedBean_SimpleModel //CI_Model//
{		
	
	public function comprobarEmail($email)
	{
		$usuario=R::findOne("usuario","email=?",array($email));
		return $usuario;
		
	}
	
	public function obtenerUsuarioPorId($id)
	{
		$usuario=R::load('usuario',$id);
		return $usuario;
	}
	
	public function crearUsuario($registro)
	{			
		$usuario=R::dispense('usuario');
		$usuario->email=$registro['email'];
		$usuario->password=sha1($registro['passwd']);		
		$usuario->nombre=$registro['nombre'];
		$usuario->apellidos=$registro['apellidos'];
		$usuario->sexo=$registro['sexo'];
		$usuario->fechanac=$registro['fechaNac'];
		$usuario->cp=$registro['cp'];
		$usuario->cochepropio=$registro['cochePropio'];
		$usuario->foto=isset($registro['foto'])?$registro['foto']:null;
		$usuario->sw_activo=false;
		$usuario->sw_mensajes_nuevos=false;
		$usuario->admin=0;
		
		$id=R::store($usuario);		
		
		return $id;
	}
	
	
	public function activar_usuario($usuario,$code)
	{
		$usuario=R::findOne("usuario","id=?",array($usuario));
		$respuesta=0;
		
		$code_nuevo=sha1(substr($usuario->email,-1).substr($usuario->email,0,2).substr($usuario->cp,0,3)."is6");
		
				
		if($usuario->sw_activo==0&&$code_nuevo==$code)//ACTIVACION
		{
			$usuario->sw_activo=1;
			$id=R::store($usuario);
			$respuesta=1;
		}
		elseif($usuario->sw_activo==-1)//BANEADO
		{
			$respuesta=-1;
		}
		elseif($usuario->sw_activo==1)//YA ACTIVADO
		{
			$respuesta=2;
		}
		else
		{
			$respuesta=0;
		}
		
		return $respuesta;
	}
	
	public function editarPerfil($perfil,$email)
	{
		$usuario=R::findOne("usuario","email=?",array($email));
		
		if($usuario!=null)
		{
			$usuario->nombre=$perfil['nombre'];
			$usuario->apellidos=$perfil['apellidos'];
			$usuario->sexo=$perfil['sexo'];
			$usuario->fechanac=$perfil['fechaNac'];
			$usuario->cp=$perfil['cp'];
			$usuario->cochepropio=$perfil['cochePropio'];
			$usuario->foto=$perfil['foto'];
			$id=R::store($usuario);
		}
		return $usuario;
		
	}
	
	public function cargarDatosUsuario($id)
	{
		$usuario=R::findOne("usuario","id=?",array($id));
		
		return $usuario;
	}
	
	public function cambiarPassword($cambioPassword)
	{
		$usuario=R::findOne("usuario","email=? AND password=?",array($cambioPassword['email'],sha1($cambioPassword['passwordAntiguo'])));
		
		
		if($usuario!=null)
		{
			$usuario->password=sha1($cambioPassword['passwd']);
			R::store($usuario);
		}	
		return $usuario;
	}
	
	
	
	//activate user account
	function verificarEmail($key)
	{
		$usuario=R::findOne("usuario","md5(email)=?",array($key));
		$usuario->sw_activo=1;
		R::store($usuario);
		/*
		$data = array('activo' => 1);
		$this->db->where('md5(email)', $key);
		return $this->db->update('usuario', $data);
		*/
	}
	
	public function unirse_trayecto($id_usuario,$id_trayecto)
	{
		
		$linea_usuario_trayecto=R::dispense('usuariotrayecto');
		$linea_usuario_trayecto->aceptado=0;
		$linea_usuario_trayecto->usuario_id=$id_usuario;
		$linea_usuario_trayecto->trayecto_id=$id_trayecto;
		
		$id=R::store($linea_usuario_trayecto);			
		
		$info_trayecto=R::getAll("select t.creador, u.nombre,u.apellidos,li.poblacion as poblacionOrigen,ld.poblacion poblacionDestino
				from trayecto t
				join usuario u on t.creador=u.id
				join lugar li on t.inicio_id=li.id
				join lugar ld on t.destino_id=ld.id
				where t.id = $id_trayecto");
		
		return $info_trayecto;
		
		
		
				
	}
	
public function abandonar_trayecto($id_usuario,$id_trayecto)
	{	
		
		//COGEMOS LA FILA CON ESOS ID'S		
		$id=R::getRow("select id from usuariotrayecto ut
										WHERE ut.usuario_id like :usuario
										AND ut.trayecto_id like :trayecto
										AND aceptado=1",array(
													':usuario'=>$id_usuario,
													':trayecto'=>$id_trayecto,
											));		
		//CARGAMOS ESE BEAN CON EL ID ANTERIOR
		$usuariotrayecto=R::load('usuariotrayecto',$id['id']);
		
		//LE CAMBIAMOS A -1 EL ACEPTADO Y ACTUALIZAMOS
		$usuariotrayecto->aceptado=-1;
		$id=R::store($usuariotrayecto);		
		
		//CREO YA COGEMOS EL PRIMER USUARIO QUE ESTA EN ESE TRAYECTO
		$id_nuevo_admin=R::getRow("select usuario_id from usuariotrayecto ut
										WHERE ut.trayecto_id like :trayecto
										AND aceptado=1",array(
													':trayecto'=>$id_trayecto,
											));	
		if($id_nuevo_admin!=NULL)//HAY MAS USUARIOS
		{
			$trayecto_id_trayecto=R::load('trayecto',$id_trayecto);
			//LE PONEMOS COMO NUEVO ADMINISTRADOR
			$trayecto_id_trayecto->creador=$id_nuevo_admin['usuario_id'];
			$id_trayecto_cambiado=R::store($trayecto_id_trayecto);
		}
		else//NO QUEDAN USUARIOS EN EL TRAYE
		{
			R::exec( "DELETE FROM usuariotrayecto WHERE trayecto_id=$id_trayecto");			
			R::exec( "DELETE FROM lugar WHERE id=(SELECT inicio_id FROM TRAYECTO WHERE id=$id_trayecto)");
			R::exec( "DELETE FROM lugar WHERE id=(SELECT destino_id FROM TRAYECTO WHERE id=$id_trayecto)");
			R::exec( "DELETE FROM trayecto WHERE id=$id_trayecto");
		}	
		
		
		$info_trayecto=R::getAll("select t.creador,u.nombre,u.apellidos,li.poblacion as poblacionOrigen,ld.poblacion poblacionDestino
				from trayecto t
				join usuario u on t.creador=u.id
				join lugar li on t.inicio_id=li.id
				join lugar ld on t.destino_id=ld.id
				where t.id = $id_trayecto");
		
				
		return $info_trayecto;
		
	}
	
	public function loguearUsuario($login)
	{		
		$usuario=R::findOne("usuario","email=? AND password=?",array($login['email'],sha1($login['password'])));	
		
				
		//OTRA FORMA
		//$usuario=R::getAll( 'select * from usuario where email= :emailLogin AND password = :passwordLogin',array(':emailLogin'=>$login['email'],':passwordLogin' => sha1($login['password'])) );
		
		return $usuario;		
	}
	
	
}

?>