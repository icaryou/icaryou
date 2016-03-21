<?php

class Trayecto extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		 
		//Cargamos la librería de validación (todos las librerias, helpers, etc pueden ser cargados en los controladores o auto cargarlos indicándolo en los ficheros de configuración)
		$this->load->library('form_validation');
	}
	
	public function crearTrayecto() 
	{
		//enmarcar($this,'registro/registrarUsuario.php');
		$this->load->view('trayecto/crearTrayecto.php');
	}
	
	public function crearTrayectoPost()
	{
		
		if($this->input->post("submitOk"))
		{
			$this->form_validation->set_rules('cpOrigen', 'CP origen', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('poblacionOrigen', 'Población origen', 'required|trim');
			$this->form_validation->set_rules('cpDestino', 'CP destino', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('poblacionDestino', 'Población destino', 'required|trim');
			$this->form_validation->set_rules('horaLlegada', 'Hora llegada', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('horaRetorno', 'Hora llegada', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('comentarios', 'comentarios', 'max_length[140]|trim');
			$this->form_validation->set_rules('dias[]', 'dias', 'required');
			$this->form_validation->set_rules('plazas', 'plazas', 'required|is_natural|greater_than[1]|trim');
            //$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|valid_email|trim');
            //$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[3]');
             
            //Mensajes
            // %s es el nombre del campo que ha fallado
            $this->form_validation->set_message('required','El campo %s es obligatorio'); 
            $this->form_validation->set_message('alpha_numeric','El campo %s debe estar compuesto solo por letras y espacios');
            $this->form_validation->set_message('is_natural','El campo %s debe ser un número entero');
            $this->form_validation->set_message('max_length','El campo %s debe tener como máximo %s números');//PERSONALIZAR CON DOBLE %s
            $this->form_validation->set_message('exact_length','El campo %s debe tener %s números');
            $this->form_validation->set_message('less_than','El campo %s debe ser menor que %s');
            $this->form_validation->set_message('greater_than','El campo %s debe ser mayor que %s');
            $this->form_validation->set_message('_horaRegex','Formato de hora inválido');
            //$this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto');
             
             if($this->form_validation->run()!=false){ //Si la validación es correcta
                $datos["mensaje"]="Validación correcta";
             }else{
                $datos["mensaje"]="Validación incorrectaa";
             }
              
             $this->load->view("trayecto/crearTrayectoPost",$datos);
		}	
	}
	
	//FUNCIONES PERSONALIZADAS ---  SE PUEDEN AGREGAR EN LIBRARIES/FORM_VALIDATION.PHP
	public function _horaRegex($hora) {
		if (preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $hora ) )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
}

?>