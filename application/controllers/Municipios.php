<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Municipios extends CI_Controller {
	
	public function cargarMunicipios()
	{
		$this->load->model("Municipios_Model");
		$datos="var municipios=";
		$datos.=$this->Municipios_Model->leerTodos();
		$datos.=";";
	
		if ( ! write_file('./assets/resources/municipios.js', $datos, 'w+'))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo $datos;
		}
	
	}
	
}

?>