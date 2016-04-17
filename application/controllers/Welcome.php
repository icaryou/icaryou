<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$datos['errorLogin']=$this->session->flashdata('errorLogin');
		$datos['email']=$this->session->flashdata('email');
		enmarcar($this,'index.php',$datos);
		
		//enmarcar($this,'index.php');//DEBUG
	}
	
	public function plantilla()
	{
		enmarcar($this,'index.php');
	}
	
	public function service()
	{
		$this->load->view('bootstrap/service');
	}
	
	public function registrarUsuario()
	{
		enmarcar($this,'usuario/registrarUsuario.php');
	}
	
	public function buscarTrayectos()
	{
		enmarcar($this,'trayecto/buscarTrayectos.php');
	}
	
	public function cargarMunicipios()
	{
		$this->load->model("Municipios_Model");
		$datos="var municipios=";
		$datos.=$this->Municipios_Model->leerTodos();
		$datos.=";";

		if ( ! write_file('./assets/resources/municipios.js', $datos, 'r+'))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo 'File written!';
		}
		
	}

	public function autocompletar()
	{
		enmarcar($this,'trayecto/CopyOfcrearTrayecto.php');
		//$this->load->view('trayecto/autocompletar');
	}
	
	public function pruebajson()
	{
		$this->load->model("Welcome_Model");
		$datos=$this->Welcome_Model->leerTodos();
		$json_string = json_encode($datos);
		echo $json_string;
	}
}
