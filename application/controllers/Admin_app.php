<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_app extends CI_Controller
{
	
	public function __construct() {
		parent::__construct();		
			
		//Cargamos la librería de validación (todos las librerias, helpers, etc pueden ser cargados en los controladores o auto cargarlos indicándolo en los ficheros de configuración)
		$this->load->library('grocery_CRUD');
	}
	
	public function index($tabla='usuario')
	{		
		
		$crud = new grocery_CRUD();
		
		
		
		//$crud->set_theme('datatables');
		$crud->set_table($tabla);
		//$crud->set_language("english").
		$output = $crud->render();
		
		
		
		$this->load->view('admin/admin_view.php',$output);
	}
	
	
	
	
	
}

?>