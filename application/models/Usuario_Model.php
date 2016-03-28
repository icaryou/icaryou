<?php

class Usuario_Model extends RedBean_SimpleModel
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
		$usuario->password=sha1($registro['password']);		
		$usuario->nombre=$registro['nombre'];
		$usuario->apellidos=$registro['apellidos'];
		$usuario->sexo=$registro['sexo'];
		$usuario->fechaNac=$registro['fechaNac'];
		$usuario->cp=$registro['cp'];
		$usuario->cochePropio=$registro['cochePropio'];
		$usuario->activo=false;
		
		$id=R::store($usuario);
		
		//$this->enviarEmail($registro['email']);
		
		//DEBUG var_dump($id);
	}
	
	public function cambiarPassword($cambioPassword)
	{
		echo $cambioPassword['email'];
		echo $cambioPassword['passwordAntiguo'];
		$usuario=R::findOne("usuario","email=? AND password=?",array($cambioPassword['email'],sha1($cambioPassword['passwordAntiguo'])));
		
		
		if($usuario!=null)
		{
			$usuario->password=sha1($cambioPassword['password']);
			R::store($usuario);
		}
		else
		{
			echo "null";
		}
		//sha1($cambioPassword['passwordAntiguo'])=?
	}
	
	function enviarEmail()//NO FUNCIONA
	{
			
		
		$this->email->from('icaryouspain@gmail.com', 'Your Name');
		$this->email->to('javicurso6@gmail.com');
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		$this->email->send();
		
		echo $this->email->print_debugger();
		
		/*
		
		$from_email = 'icaryouspain@gmail.com'; //change this to yours
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://localhost/CI_EXAMEN/Proyecto/usuario/verificarEmail/' . md5($emailDestino) . '<br /><br /><br />Thanks<br />Mydomain Team';
	
		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
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
		*/
	}
	
	//activate user account
	function verificarEmail($key)
	{
		$usuario=R::findOne("usuario","md5(email)=?",array($key));
		$usuario->activo=1;
		R::store($usuario);
		/*
		$data = array('activo' => 1);
		$this->db->where('md5(email)', $key);
		return $this->db->update('usuario', $data);
		*/
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