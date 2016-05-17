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
		
		$id=R::store($usuario);			
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
	
	function enviarEmail()//NO FUNCIONA
	{	
		/*
		$this->email->initialize();
		$this->email->from('icaryouspain@gmail.com', 'Your Name');
		$this->email->to('javicurso6@gmail.com');
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		$this->email->send();
		
		echo $this->email->print_debugger();
		echo "----";
		
		*/
		$to_email="javicurso6@gmail.com";//cambiar por parametro funcion
		
		$from_email = 'icaryouspain@gmail.com'; //change this to yours
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br />
				<br /> http://localhost/CI_EXAMEN/Proyecto/usuario/verificarEmail/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
	
		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '587'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = 'micochecito'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);
	
		//send mail
		$this->email->from($from_email, 'Mydomain');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
		
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
		var_dump($usuariotrayecto);
		$usuariotrayecto->aceptado=-1;
		$id=R::store($usuariotrayecto);
	
		//CREO YA COGEMOS EL PRIMER USUARIO QUE ESTA EN ESE TRAYECTO
		$id_nuevo_admin=R::getRow("select usuario_id from usuariotrayecto ut
										WHERE ut.trayecto_id like :trayecto
										AND aceptado=1",array(
													':trayecto'=>$id_trayecto,
											));
	
		$trayecto_id_trayecto=R::load('trayecto',$id_trayecto);
		//LE PONEMOS COMO NUEVO ADMINISTRADOR
		$trayecto_id_trayecto->creador=$id_nuevo_admin['usuario_id'];
		$id_trayecto_cambiado=R::store($trayecto_id_trayecto);
	
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