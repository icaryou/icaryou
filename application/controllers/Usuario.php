<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{
	
	public function __construct() {
		parent::__construct();
		
		
			
		//Cargamos la librería de validación (todos las librerias, helpers, etc pueden ser cargados en los controladores o auto cargarlos indicándolo en los ficheros de configuración)
		//$this->load->library('email');
	}
	
	public function sendMail($emailReceiver="", $message="", $subject="",$code="",$id_usuario=0) {	
		
        $icaryouEmail = 'icaryouspain@gmail.com';
        $icaryouPass = 'Micochecit0';
        
        
        $message=<<<MENSAJE
        
		<!html>
		    <head>
		        <title>Icaryou</title>
		        
		        <style>
		            
		            body
		            {
		                padding:5%;
		            }
		            .color_corp
		            {
		                color:#0DBD96;
		            }
		        </style>
		        
		    </head>
		    <body>
		        <h1>Bienvenido a <span class="color_corp">Icaryou</span>.</h1>
		        
		        <p>Para activar tu usuario pincha en el siguiente enlace por favor: </p>
		        
		        <p><a href="http://localhost/icaryou/usuario/activar_usuario/$id_usuario/$code">http://localhost/icaryou/usuario/activar_usuario/$id_usuario/$code</a></p>
		        
		        <p>Atentamente, el equipo de Icaryou.</p>
		    </body>
		</html>
        		
        
MENSAJE;
               
        $subject="Confirmación registro Icaryou";
        
        $this->load->library ( 'email' );
        
        $configGmail = null;
        
        if ($_SERVER ['SERVER_NAME'] == 'localhost' || $_SERVER ['SERVER_NAME'] == '127.0.0.1') {
            
            $configGmail = array (
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => 465,
                    'smtp_user' => $icaryouEmail, // correo desde el cual se envia
                    'smtp_pass' => $icaryouPass, // contraseña del correo
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n" 
            );
        } else {
            
            $configGmail = array (
                    // 'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com', // 'ssl://smtp.googlemail.com'//ssl://smtp.gmail.com
                    'smtp_port' => 587, // 465//25
                    'smtp_user' => $icaryouEmail, // change it to yours
                    'smtp_pass' => $icaryouPass, // change it to yours
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n",
                    'validation' => TRUE,
                    'smtp_crypto' => 'tls', // tls or ssl
                    'wordwrap' => TRUE 
            );
        }
        
        $this->email->initialize ( $configGmail );
        
        $this->email->from ( $icaryouEmail, 'Icaryou Spain' );
        $this->email->to ( $emailReceiver );
        
        $this->email->subject ( $subject );
        
        $this->email->message ( $message );
        
        if ($this->email->send ()) {
        	var_dump($this->email->print_debugger());
        	return true;
        } else {
        	var_dump($this->email->print_debugger());
            return false;
        }
        echo "----";
        var_dump($this->email->print_debugger());
    }
	
    public function activar_usuario($usuario,$code)
    {
    	$this->load->model("Usuario_Model");
		$respuesta=$this->Usuario_Model->activar_usuario($usuario,$code);//CREAMOS EN EL MODELO	
		
		if($respuesta==1)
		{
			$datos['tipo']='activado';
			$datos['h4']="¡Has activado tu cuenta!";
			$datos['textoModal']="Ya puedes loguearte desde el menú principal.";
			enmarcar($this,'index.php',$datos);
		}
		elseif($respuesta==-1)
		{
			$datos['tipo']='baneado';
			$datos['h4']="Ups... Has sido baneado";
			$datos['textoModal']="Lo sentimos, actualmente no puedes acceder con tu cuenta.";
			enmarcar($this,'index.php',$datos);
		}
		elseif($respuesta==2)
		{
			$datos['tipo']='reactivando';
			$datos['h4']="Este usuario ya está activo";
			$datos['textoModal']="Puedes loguearte desde el menú principal.";
			enmarcar($this,'index.php',$datos);
		}
		else
		{
			$datos['tipo']='noactivado';
			$datos['h4']="Ups... Algo ha ido mal";
			$datos['textoModal']="Lo sentimos, inténtalo de nuevo.";
			enmarcar($this,'index.php',$datos);
		}
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
			 
			if($this->form_validation->run()!=false)//Si la validación es correcta
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
				
			/* SUBIDA Y REDIMENSION IMAGEN*/	
				
			$config['upload_path'] = './assets/img/profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2000';
			$config['min_width']  = '400';
			$config['min_height']  = '400';
	
			$resp=$this->guardarYResizeImagenPerfil($config);
			$registro['foto']="";
			if(isset($resp['filename'])){
				$registro['foto']='assets/img/profile/'.$resp['filename'];
				//unlink("assets/img/temp/".$resp['filename']);
				$files = glob('assets/img/temp/*'); // get all file names
				foreach($files as $file){ // iterate files
				  if(is_file($file))
				    unlink($file); // delete file
				}
			}else{
				$registro['foto']='assets/img/profile/avatar.png';
			}
			
			
			$this->load->model("Usuario_Model");
			$id_creado=$this->Usuario_Model->crearUsuario($registro);//CREAMOS EN EL MODELO
			
						
			
			$code=substr($this->input->post('email'), -1).substr($this->input->post('email'),0,2).substr($this->input->post('cp'),0,3)."is6";
						
			$code=sha1($code);
			
			//mja288is693ec478b45407ba7540589f628e19857db1e8d4d
			
			$this->sendMail($this->input->post('email'), "", "",$code,$id_creado);
			
			header("Location:".base_url());
				
			//$datos["mensaje"]="Validación correcta";//TODO
				
			}else{
				//$datos["mensaje"]="Validación incorrectaa";//TODO
			}
		
			//enmarcar($this, "usuario/registrarUsuarioPost",$datos);//TODO
			
		}	
		
		
	}	//FIN REGISTRARUSUARIOPOST
	
	
	public function guardarYResizeImagenPerfil($config){
		$this->load->library('upload', $config);
		$respuesta;
		if ( $this->upload->do_upload('userFoto'))
		{
			if(($this->upload->image_width)>=400){
		
		
				$respuesta['valida']=true;
		
				if($this->upload->image_width*0.70>=$this->upload->image_height||$this->upload->image_height*0.70>=$this->upload->image_width)
				{
					$respuesta['valida']=false;
					$respuesta['error']='La imagen debe tener una proporción de 4:3 o inferior.';
					if($this->session->userdata('logueado')){
						$respuesta['ruta'] = $this->session->userdata('foto');
					}else{
						$respuesta['ruta'] = "assets/img/profile/avatar.png";
					}
				}
				else
				{
					$configResize['source_image'] = $config['upload_path'].$this->upload->file_name;
					$configResize['maintain_ratio'] = TRUE;
					$configResize['width'] = 400;
						
					$this->load->library('image_lib', $configResize);
					$this->image_lib->resize();
					$respuesta['ruta']= "assets/img/temp/".$this->upload->file_name;
					$respuesta['filename']=$this->upload->file_name;
				}
		
			}
		}else{
				
			$respuesta['errores']=$this->upload->display_errors();
			$error=$this->upload->display_errors();
			if(strrpos($error, "filetype") || strrpos($error, "You did not select a file")){
				$respuesta['error']='Introduzca una imagen gif, jpg o png.';
			}else if(strrpos($error, "maximum allowed size")){
				$respuesta['error']='La imagen no debe exceder los 2Mb.';
			}else{
				$respuesta['error']='La imagen debe superar 400px de ancho y alto.';
			}
		
			if($this->session->userdata('logueado')){
					$respuesta['ruta'] = $this->session->userdata('foto');
			}else{
					$respuesta['ruta'] = "assets/img/profile/avatar.png";
			}
			
			$respuesta['valida']=false;
		}
		return $respuesta;
	}
	
	public function mostrarFotoRegistro()
	{
		/* SUBIDA Y REDIMENSION IMAGEN*/
		
		
		$config['upload_path'] = './assets/img/temp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		$config['min_width']  = '400';
		$config['min_height']  = '400';
		
		$respuesta=$this->guardarYResizeImagenPerfil($config);
		
		echo json_encode($respuesta);
		
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
				
				/* SUBIDA Y REDIMENSION IMAGEN*/
				
				$config['upload_path'] = './assets/img/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '2000';
				$config['min_width']  = '400';
				$config['min_height']  = '400';
				
				$resp=$this->guardarYResizeImagenPerfil($config);
				$perfil['foto']="";
				if(isset($resp['filename'])){
					$perfil['foto']='assets/img/profile/'.$resp['filename'];
					//unlink("assets/img/temp/".$resp['filename']);
					$files = glob('assets/img/temp/*'); // get all file names
					foreach($files as $file){ // iterate files
						if(is_file($file))
							unlink($file); // delete file
					}
				}else{
					$perfil['foto']='assets/img/profile/avatar.png';
				}
					
	
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
							'foto' => $usuario->foto,
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
			$this->mostrarPerfilPropio();
			//header("Location:".base_url().'usuario/mostrarPerfil');	
		}
	
	
	}
	
	public function listarTrayectosPropios()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$this->load->Model('Trayecto_Model');
			$datos['trayectosPropiosEncontrados']=$this->Trayecto_Model->listarTrayectosPropios($this->session->userdata('id'));
			$datos['js']="listarTrayectosPropios";
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
	
	public function listarTrayectosPropiosRellenar()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$this->load->Model('Trayecto_Model');
			$datos['trayectosPropiosEncontrados']=$this->Trayecto_Model->listarTrayectosPropios($this->session->userdata('id'));
			$datos['js']="listarTrayectosPropios";
			$datos['css']="listadoTrayectos";
			$tipoTrayecto=$this->input->post('tipoTrayecto');

			if($tipoTrayecto==1){
				$resultadoParaDiv=$this->load->view("usuario/rellenarTrayecPropios", $datos, true);
			}else if($tipoTrayecto==2){
				$resultadoParaDiv=$this->load->view("usuario/rellenarTrayecAjenos", $datos, true);
			}
			
			echo $resultadoParaDiv;
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
	
	public function ver_trayectos_usuario_rellenar()//TODO???
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$id_usuario=$this->input->post('id_usuario');
			$this->load->Model('Usuario_Model');
			$datos['usuario_buscado']=$this->Usuario_Model->obtenerUsuarioPorId($id_usuario);
				
			$this->load->Model('Trayecto_Model');
			$datos['trayectosEncontrados']=$this->Trayecto_Model->listar_trayectos_usuario($id_usuario);
			
			$tipoTrayecto=$this->input->post('tipoTrayecto');
			
			if($tipoTrayecto==1){
				$resultadoParaDiv=$this->load->view("usuario/rellenarTrayecUsuarioP", $datos, true);
			}else if($tipoTrayecto==2){
				$resultadoParaDiv=$this->load->view("usuario/rellenarTrayecUsuarioA", $datos, true);
			}
				
			echo $resultadoParaDiv;
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
	
	public function unirse_trayecto()//TODO???
	{		
		if($this->session->userdata('logueado'))
		{
			$id_usuario=$this->session->userdata('id');
			$id_trayecto=$this->input->post('id_trayecto');
			$this->load->Model('Usuario_Model');
			$datos['usuario_buscado']=$this->Usuario_Model->unirse_trayecto($id_usuario,$id_trayecto);
			//enmarcar($this,'usuario/listarTrayectosUsuario.php',$datos); TODO Elegir donde le mandamos
			
			$info_trayecto=$datos['usuario_buscado'][0];			
			
			echo $info_trayecto['creador']."*"."Te han enviado una solicitud para tu trayecto con origen {$info_trayecto['poblacionOrigen']} y destino
			{$info_trayecto['poblacionDestino']}.";
			
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
		
	}
	
	public function abandonar_trayecto()//TODO???
	{
		if($this->session->userdata('logueado'))
		{
			$id_usuario=$this->session->userdata('id');
			$id_trayecto=$this->input->post('id_trayecto');
			$this->load->Model('Usuario_Model');
			$datos['usuario_buscado']=$this->Usuario_Model->abandonar_trayecto($id_usuario,$id_trayecto);
			
			$info_trayecto=$datos['usuario_buscado'][0];				
			
			$destinatario=$this->Usuario_Model->obtenerUsuarioPorId($id_usuario);
			
					
			echo $info_trayecto['creador']."*"."El usuario $destinatario->nombre $destinatario->apellidos ha abandonado tu trayecto con origen {$info_trayecto['poblacionOrigen']} y destino
			{$info_trayecto['poblacionDestino']}.";
			
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
						'foto' => $usuario->foto,
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