<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{
	
	public function __construct() {
		parent::__construct();
		
		
			
		//Cargamos la librería de validación (todos las librerias, helpers, etc pueden ser cargados en los controladores o auto cargarlos indicándolo en los ficheros de configuración)
		//$this->load->library('email');
	}
	
	public function enviarEmail()//DEBUG
	{		
		$this->load->model("Usuario_Model");
		$usuario=$this->Usuario_Model->enviarEmail();//COMPROBAMOS EN EL MODELO
	}
	
	public function comprobarEmail()//PETICION AJAX DESDE FORMULARIO
	{
		
		if (isset($_REQUEST['email'])&&$_REQUEST['email']!='')
		{
			$this->load->model("Usuario_Model");
			$resultado=$this->Usuario_Model->comprobarEmail($_REQUEST['email']);	
			if($resultado!=null)
			{
				echo 'false';//SI ENCUENTRA EMAIL DEVOLVEMOS FALSE(ERROR)
			}
			else
			{
				echo 'true';
			}
		}
		else
		{
			echo 'false';//No deberia entra aqui, pero lo ponemos por si acaso
		}
		
	}
	
	public function registrarUsuario() 
	{
		enmarcar($this,'usuario/registrarUsuario.php');
		//$this->load->view('usuario/registrarUsuario.php');
	}
	
	public function registrarUsuarioPost()
	{
		
		//VALIDACION
		if($this->input->post())
		{
			/*
			//reglas de validacion
			$this->form_validation->set_rules('nombre', 'nombre', 'required|trim');
			$this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
			$this->form_validation->set_rules('passwdNormal', 'contraseña', 'required|min_length[8]|max_length[20]|trim');
			$this->form_validation->set_rules('passwordRepetido', 'repetir contraseña', 'required|min_length[8]|max_length[20]|trim|matches[passwdNormal]');
			$this->form_validation->set_rules('fechaNac', 'fecha de nacimiento', 'required|trim|callback__fechaRegex');
			$this->form_validation->set_rules('cp', 'código postal', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('sexo', 'sexo', 'required');
			$this->form_validation->set_rules('cochePropio', 'coche propio', 'required');
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
			 */
			if($this->form_validation->run()==false)//Si la validación es correcta
			{ 
				//RECOGIDA DATOS			
				$registro['email']=$this->input->post('email');
				$registro['passwd']=$this->input->post('passwdNormal');
				$registro['nombre']=$this->input->post('nombre');
				$registro['apellidos']=$this->input->post('apellidos');
				$registro['sexo']=$this->input->post('sexo');				
				$registro['fechaNac']=$this->input->post('fechaNac');
				$registro['cp']=$this->input->post('cp');
				$registro['cochePropio']=$this->input->post('cochePropio')=='si'?true:false;
				$registros['foto']=$this->input->post('userFoto');
				
			/* SUBIDA Y REDIMENSION IMAGEN*/	
				
			$config['upload_path'] = './assets/img/profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2000';
	
			$this->load->library('upload', $config);
			$fotoWidth="";
			
			if ( ! $this->upload->do_upload('userFoto'))
			{
				$error = array('error' => $this->upload->display_errors());
				
				if(strrpos($error['error'], "filetype")){
					$error = array('error' => "Introduzca una imagen gif, jpg o png.");
				}else if(strrpos($error['error'], "maximum allowed size")){
					$error = array('error' => "La imagen no debe exceder los 2mb");
				}
				$this->load->view('upload_form', $error);
			}
			else
			{
				$configResize['source_image'] = $config['upload_path'].$this->upload->file_name;
				$configResize['maintain_ratio'] = TRUE;
				$configResize['width'] = 300;
				
				$this->load->library('image_lib', $configResize);
				$this->image_lib->resize();
				
				$data  = array('upload_data' => $this->upload->data());
	
				$this->load->view('upload_form', $data);
			}
	
				
				
				$this->load->model("Usuario_Model");
				//$resultado=$this->Usuario_Model->crearUsuario($registro);//CREAMOS EN EL MODELO
				
				$datos["mensaje"]="Validación correcta";//TODO
				
			}else{
				$datos["mensaje"]="Validación incorrectaa";//TODO
			}
		
			enmarcar($this, "usuario/registrarUsuarioPost",$datos);//TODO
			
		}	
		
		
	}	//FIN REGISTRARUSUARIOPOST
	
	public function mostrarFotoRegistro()
	{
		/* SUBIDA Y REDIMENSION IMAGEN*/
		
		$config['upload_path'] = './assets/img/temp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		
		$this->load->library('upload', $config);
		$this->upload->do_upload('userFoto');
		
		$configResize['source_image'] = $config['upload_path'].$this->upload->file_name;
		$configResize['maintain_ratio'] = TRUE;
		$configResize['width'] = 200;
		
		$this->load->library('image_lib', $configResize);
		$this->image_lib->resize();
		
	}
	
	public function mostrarPerfilPropio()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			enmarcar($this, 'usuario/mostrarPerfilPropio.php');
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['redireccion']='usuario/mostrarPerfil';
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);				
		}
		
		
		
		//enmarcar($this, 'usuario/mostrarPerfil.php');    DEBUG
	}
	
	public function mostrarPerfilUsuario($id_usuario)
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$this->load->model("Usuario_Model");
			$datos['usuario']=$this->Usuario_Model->cargarDatosUsuario($id_usuario);
			enmarcar($this, 'usuario/mostrarPerfilUsuario.php',$datos);
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['redireccion']='usuario/mostrarPerfil';
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
	
	
	
		//enmarcar($this, 'usuario/mostrarPerfil.php');    DEBUG
	}
	
	public function editarPerfil()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			enmarcar($this, 'usuario/editarPerfil.php');
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['redireccion']='usuario/editarPerfil';
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
		
		//enmarcar($this, 'usuario/editarPerfil.php');    DEBUG
	}
	
	public function editarPerfilPost()
	{
	
		//VALIDACION
		if($this->input->post())
		{
			//reglas de validacion
			$this->form_validation->set_rules('nombre', 'nombre', 'required|trim');
			$this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim');
			$this->form_validation->set_rules('fechaNac', 'fecha de nacimiento', 'required|trim|callback__fechaRegex');
			$this->form_validation->set_rules('cp', 'código postal', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('sexo', 'sexo', 'required');
			$this->form_validation->set_rules('cochePropio', 'coche propio', 'required');
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
	
			if($this->form_validation->run()!=false)//Si la validación es correcta
			{
				//RECOGIDA DATOS
				$perfil['nombre']=$this->input->post('nombre');
				$perfil['apellidos']=$this->input->post('apellidos');
				$perfil['sexo']=$this->input->post('sexo');
				$perfil['fechaNac']=$this->input->post('fechaNac');
				$perfil['cp']=$this->input->post('cp');
				$perfil['cochePropio']=$this->input->post('cochePropio')=='si'?true:false;
	
				$this->load->model("Usuario_Model");
				$usuario=$this->Usuario_Model->editarPerfil($perfil,$this->session->userdata('email'));//CREAMOS EN EL MODELO
				//TODO
				if ($usuario!=null)//ENCUENTRA USUARIO
				{
					$usuario_data = array(
							'id' => $usuario->id,
							'nombre' => $usuario->nombre,
							'apellidos' => $usuario->apellidos,
							'email' => $usuario->email,
							'sexo' => $usuario->sexo,
							'fechanac' => $usuario->fechanac,
							'cp' => $usuario->cp,
							'cochepropio' => $usuario->cochepropio,
							'logueado' => TRUE
					);
					$this->session->set_userdata($usuario_data);
				}
				
				$datos["mensaje"]="Validación correcta";//TODO
	
			}else{
				$datos["mensaje"]="Validación incorrectaa";//TODO
			}
	
			//$this->load->view("usuario/registrarUsuarioPost",$datos);
			//enmarcar($this, "usuario/mostrarPerfil.php",$datos);//TODO
			header("Location:".base_url().'usuario/mostrarPerfil');	
		}
	
	
	}
	
	public function listarTrayectosPropios()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$this->load->Model('Trayecto_Model');
			$datos['trayectosPropiosEncontrados']=$this->Trayecto_Model->listarTrayectosPropios($this->session->userdata('id'));
			$datos['css']="listadoTrayectos";
			enmarcar($this,'usuario/listarTrayectosPropios.php',$datos);
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['redireccion']='usuario/listarTrayectosPropios';
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
		/*
		$this->load->Model('Trayecto_Model');
		$datos['trayectosPropiosEncontrados']=$this->Trayecto_Model->listarTrayectosPropios($this->session->userdata('id'));
		
		enmarcar($this,'usuario/listarTrayectosPropios.php',$datos);
		*/
	}
	
	public function ver_trayectos_usuario($id_usuario)//TODO???
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$this->load->Model('Usuario_Model');
			$datos['usuario_buscado']=$this->Usuario_Model->obtenerUsuarioPorId($id_usuario);
			
			$this->load->Model('Trayecto_Model');
			$datos['trayectosEncontrados']=$this->Trayecto_Model->listar_trayectos_usuario($id_usuario);				
			enmarcar($this,'usuario/listarTrayectosUsuario.php',$datos);
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{			
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
		/*
			$this->load->Model('Trayecto_Model');
			$datos['trayectosPropiosEncontrados']=$this->Trayecto_Model->listarTrayectosPropios($this->session->userdata('id'));
	
			enmarcar($this,'usuario/listarTrayectosPropios.php',$datos);
			*/
	}
	
	public function unirse_trayecto($id_trayecto)//TODO???
	{
		
		
		if($this->session->userdata('logueado'))
		{
			$id_usuario=$this->session->userdata('id');
			$this->load->Model('Usuario_Model');
			$datos['usuario_buscado']=$this->Usuario_Model->unirse_trayecto($id_usuario,$id_trayecto);
				
			//enmarcar($this,'usuario/listarTrayectosUsuario.php',$datos); TODO Elegir donde le mandamos
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
		
	}
	
	public function abandonar_trayecto($id_trayecto)//TODO???
	{
		if($this->session->userdata('logueado'))
		{
			$id_usuario=$this->session->userdata('id');
			$this->load->Model('Usuario_Model');
			$datos['usuario_buscado']=$this->Usuario_Model->abandonar_trayecto($id_usuario,$id_trayecto);
			
			//enmarcar($this,'usuario/listarTrayectosUsuario.php',$datos); TODO Elegir donde le mandamos
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}		
	}
	
	//=========LOGIN=================
	
	public function loginUsuario()
	{
		
		//RECOGEMOS DOS VARIABLES POR SI RETORNAMOS DE UN INTENTO DE LOGIN FALLIDO(LOGINUSUARIOPOST)
		$datos['errorLogin']=$this->session->flashdata('errorLogin');
		$datos['email']=$this->session->flashdata('email');
		enmarcar($this,'usuario/loginUsuario.php',$datos);
		//$this->load->view('usuario/loginUsuario.php');
		
		 
	}	
	public function loginUsuarioPost()
	{
		$response;
		
		if($this->input->post())
		{
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('passwd', 'contraseña', 'required');
			
			$this->form_validation->set_message('required','El campo %s es obligatorio');
		}
		if($this->form_validation->run()!=false)//VALIDACION CORRECTA
		{
			//RECOGIDA DATOS
			$login['email']=$this->input->post('email');
			$login['password']=$this->input->post('passwd');
			
			$this->load->model("Usuario_Model");
			$usuario=$this->Usuario_Model->loguearUsuario($login);//COMPROBAMOS EN EL MODELO
			
			if ($usuario!=null)//ENCUENTRA USUARIO
			{
				$usuario_data = array(
						'id' => $usuario->id,
						'nombre' => $usuario->nombre,
						'apellidos' => $usuario->apellidos,
						'email' => $usuario->email,
						'sexo' => $usuario->sexo,
						'fechanac' => $usuario->fechanac,
						'cp' => $usuario->cp,
						'cochepropio' => $usuario->cochepropio,
						'logueado' => TRUE
				);
				$this->session->set_userdata($usuario_data);
				//SI SE HUBIERA FORZADO EL LOGIN POR INTENTAR ACCEDER A UN SITIO SIN PERMISO LE MANSDAMOS AL MISMO				
				//$this->session->userdata('redireccion')!=null?header("Location:".base_url().$this->session->userdata('redireccion')):header("Location:".base_url().'trayecto/buscarTrayectos');
				//isset($_REQUEST['redireccion'])?header("Location:".base_url().$this->input->post('redireccion')):header("Location:".base_url().'trayecto/buscarTrayectos');
				//$response = isset($_REQUEST['redireccion'])?$this->input->post('redireccion'):true;
				$response = true;
				//$this->session->set_userdata('nombre', 'blasa'); PARA CAMBIAR SOLO UN VALOR
			}
			else//NO ENCUENTRA
			{
				$response = false;
				/*
				//GUARDAMOS DOS DATOS EN SESIONES TEMPORALES Y RETORNAMOS A LOGIN
				$this->session->set_flashdata('errorLogin', 'El usuario o la contraseña son incorrectos.');
				$this->session->set_flashdata('email', $login['email']);
				//header("Location:".base_url().'usuario/loginUsuario');
				header("Location:".base_url().'trayecto/buscarTrayectos');
				

				$urlPartida=explode("/",$_REQUEST['urlOrigen']);
				
				
				if(sizeof($urlPartida)<=3)
				{
					header("Location:".base_url());
					//header("Location:".base_url().'usuario/loginUsuario');
				}
				else
				{
					header("Location:".base_url().$urlPartida[sizeof($urlPartida)-2]."/".$urlPartida[sizeof($urlPartida)-1]);
				}
				
				
				//header("Location:".base_url().$_SERVER['PHP_SELF']);
				 * 
				 */
			}
		}
		echo $response;
		
		//enmarcar($this,'usuario/registrarUsuario.php');
		//$this->load->view('usuario/registrarUsuario.php');
		 
	}
	
	
	public function logoutUsuario()
	{		
		//PARAMETRO LOGUEADO A FALSE Y DESTRUIMOS SESION
		$usuario_data = array(
				'logueado' => FALSE
		);
		$this->session->set_userdata($usuario_data);
		$this->session->sess_destroy();
		header("Location:".base_url());	//TODO este y el login meten un index.php en el login
	}
	
	public function cambiarPassword()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$datos['errorPassword']=$this->session->flashdata('error');
			enmarcar($this,'usuario/cambiarPassword.php',$datos);
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['redireccion']='usuario/cambiarPassword';
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
		
		//RECOGEMOS DOS VARIABLES POR SI RETORNAMOS DE UN INTENTO DE LOGIN FALLIDO(LOGINUSUARIOPOST)
		/*
		$datos['error']=$this->session->flashdata('error');
		enmarcar($this,'usuario/cambiarPassword.php',$datos);
		*/
	}
	
	public function cambiarPasswordPost()
	{
		//VALIDACION
		if($this->input->post())
		{
			//reglas de validacion	
			
			$this->form_validation->set_rules('pass', 'contraseña', 'required|min_length[8]|max_length[20]|trim');
			$this->form_validation->set_rules('passwordRepetido', 'repetir contraseña', 'required|min_length[8]|max_length[20]|trim|matches[pass]');
			$this->form_validation->set_rules('passwordAntiguo', 'contraseña antigua', 'required|min_length[8]|max_length[20]|trim');
			
		
			//Mensajes
			// %s es el nombre del campo que ha fallado
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('min_length','El campo %s debe tener como mínimo %s carácteres');
			$this->form_validation->set_message('max_length','El campo %s debe tener como máximo %s carácteres');//PERSONALIZAR CON DOBLE %s			
			$this->form_validation->set_message('matches','El campo %s debe coincidir con el campo %s');
		
			if($this->form_validation->run()!=false)//Si la validación es correcta
			{
				//RECOGIDA DATOS
				$cambioPassword['passwd']=$this->input->post('pass');
				$cambioPassword['passwordAntiguo']=$this->input->post('passwordAntiguo');
				$cambioPassword['email']=$this->session->userdata('logueado')?$this->session->userdata('email'):null;
		
				$this->load->model("Usuario_Model");
				$resultado=$this->Usuario_Model->cambiarPassword($cambioPassword);
				
				$datos["mensaje"]="Validación correcta";//TODO
				
				
				
				if ($resultado!=null)//cambio contraseña
				{
					enmarcar($this, "usuario/cambiarPasswordPost",$datos);
				}
				else//no cambia porque no encuentra
				{
					$this->session->set_flashdata('error', 'Contraseña antigua erronea.');
					//header("Location:".base_url().'usuario/loginUsuario');
					header("Location:".base_url().'usuario/cambiarPassword');
				}
				
				
			}	
			else{
				$datos["mensaje"]="Validación incorrectaa";//TODO
			}
		
			$this->load->view("usuario/registrarUsuarioPost",$datos);
			//enmarcar($this, "usuario/registrarUsuarioPost",$datos);//TODO
				
				
	}
	}
	
	//FUNCIONES PERSONALIZADAS VALIDACION ---  SE PUEDEN AGREGAR EN LIBRARIES/FORM_VALIDATION.PHP
	
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
		if (preg_match('/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/',$fecha ) )
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