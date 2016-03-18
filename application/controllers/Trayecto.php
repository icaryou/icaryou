<?php

class Trayecto extends CI_Controller
{
	
	public function crearTrayecto() 
	{
		//enmarcar($this,'registro/registrarUsuario.php');
		$this->load->view('trayecto/crearTrayecto.php');
	}
	
	public function crearTrayectoPost()
	{
		
	}
	
}

?>