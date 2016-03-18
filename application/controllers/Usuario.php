<?php

class Usuario extends CI_Controller
{
	
	public function registrarUsuario() 
	{
		//enmarcar($this,'usuario/registrarUsuario.php');
		$this->load->view('usuario/registrarUsuario.php');
	}
	
	public function registrarUsuarioPost()
	{
		//RECOGIDA DATOS
		$registro['nombre']=isset($_REQUEST['nombre'])?$_REQUEST['nombre']:null;
		$registro['apellidos']=isset($_REQUEST['apellidos'])?$_REQUEST['apellidos']:null;
		$registro['fechaNac']=isset($_REQUEST['fechaNac'])?$_REQUEST['fechaNac']:null;
		$registro['password']=isset($_REQUEST['password'])?$_REQUEST['password']:null;
		$registro['passwordRepetido']=isset($_REQUEST['passwordRepetido'])?$_REQUEST['passwordRepetido']:null;
		$registro['email']=isset($_REQUEST['email'])?$_REQUEST['email']:null;
		$registro['emailRepetido']=isset($_REQUEST['emailRepetido'])?$_REQUEST['emailRepetido']:null;
		
		
		$this->load->model("Usuario_Model");
		$resultado=$this->Usuario_Model->crearUsuario($registro);
	}	
	
}

?>