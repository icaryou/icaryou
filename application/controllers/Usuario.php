<?php

class Usuario extends CI_Controller
{
	//PODRIAMOS HACER AUTOLOAD CON LIBRARIES Y THIRD PARTY??
	public function __construct() {
		parent::__construct();
			
		//Cargamos la librería de validación (todos las librerias, helpers, etc pueden ser cargados en los controladores o auto cargarlos indicándolo en los ficheros de configuración)
		$this->load->library('form_validation');
	}
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
		$registro['email']=isset($_REQUEST['email'])?$_REQUEST['email']:null;
		$registro['password']=isset($_REQUEST['password'])?$_REQUEST['password']:null;
		$registro['passwordRepetido']=isset($_REQUEST['passwordRepetido'])?$_REQUEST['passwordRepetido']:null;
		$registro['fechaNac']=isset($_REQUEST['fechaNac'])?$_REQUEST['fechaNac']:null;
		$registro['cp']=isset($_REQUEST['cp'])?$_REQUEST['cp']:null;
		$registro['sexo']=isset($_REQUEST['cp'])?$_REQUEST['cp']:null;
		
		
		//VALIDACION
		if($this->input->post())
		{
			$this->form_validation->set_rules('nombre', 'nombre', 'required|trim');
			$this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
			$this->form_validation->set_rules('password', 'contraseña', 'required|min_length[8]|max_length[20]|trim');
			$this->form_validation->set_rules('passwordRepetido', 'repetir contraseña', 'required|min_length[8]|max_length[20]|trim|matches[password]');
			$this->form_validation->set_rules('fechaNac', 'fecha de nacimiento', 'required|trim|callback__fechaRegex');
			$this->form_validation->set_rules('cp', 'código postal', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('sexo', 'sexo', 'required');
			//$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|valid_email|trim');
			//$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[3]');
			 
			//Mensajes
			// %s es el nombre del campo que ha fallado
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('alpha_numeric','El campo %s debe estar compuesto solo por letras y espacios');
			$this->form_validation->set_message('is_natural','El campo %s debe ser un número entero');
			$this->form_validation->set_message('min_length','El campo %s debe tener como mínimo %s carácteres');
			$this->form_validation->set_message('max_length','El campo %s debe tener como máximo %s carácteres');//PERSONALIZAR CON DOBLE %s
			$this->form_validation->set_message('exact_length','El campo %s debe tener %s carácteres');
			$this->form_validation->set_message('less_than','El campo %s debe ser menor que %s');
			$this->form_validation->set_message('greater_than','El campo %s debe ser mayor que %s');
			//$this->form_validation->set_message('_horaRegex','Formato de hora inválido');
			$this->form_validation->set_message('_fechaRegex','Formato de fecha inválido');
			$this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto');
			$this->form_validation->set_message('matches','El campo %s debe coincidir con el campo %s');
			 
			if($this->form_validation->run()!=false){ //Si la validación es correcta
				$datos["mensaje"]="Validación correcta";
			}else{
				$datos["mensaje"]="Validación incorrectaa";
			}
		
			$this->load->view("usuario/registrarUsuarioPost",$datos);
		}
		
		
		
		/*
		$this->load->model("Usuario_Model");
		$resultado=$this->Usuario_Model->crearUsuario($registro);
		*/
	}	
	
	//FUNCIONES PERSONALIZADAS ---  SE PUEDEN AGREGAR EN LIBRARIES/FORM_VALIDATION.PHP
	
	//dd/mm/yyyy
	public function _fechaRegexEuropeo($fecha) {
		if (preg_match('/(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)
				/', $fecha ) )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function _fechaRegex($fecha) {
		if (preg_match('/^((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))\-((0[13578])|(1[02]))\-((0[1-9])|([12][0-9])|(3[01])))|((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))\-((0[469])|11)\-((0[1-9])|([12][0-9])|(30)))|(((000[48])|([0-9][0-9](([13579][26])|([2468][048])))|([0-9][1-9][02468][048])|([1-9][0-9][02468][048]))\-02\-((0[1-9])|([12][0-9])))|((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))\-02\-((0[1-9])|([1][0-9])|([2][0-8])))$/',$fecha ) )
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