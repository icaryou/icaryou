<?php

class Trayecto extends CI_Controller
{
	
	public function __construct() {
		
		parent::__construct();
		 
		//Cargamos la librería de validación (todos las librerias, helpers, etc pueden ser cargados en los controladores o autocargarlos indicándolo en los ficheros de configuración)
		$this->load->library('form_validation');
	}
	
	public function buscarTrayectos()
	{
		$datos['errorLogin']=$this->session->flashdata('errorLogin');
		$datos['email']=$this->session->flashdata('email');
		$datos['css']="buscarTrayectoPost";
		enmarcar($this,'trayecto/buscarTrayectos.php',$datos);//CAMBIADO POR LOGIN
		//$this->load->view('trayecto/crearTrayecto.php');	
	}
	
	public function buscarTrayectosPost()
	{
	
		if($this->input->post())
		{			
			
			//reglas de validacion //TODO
			
			$this->form_validation->set_rules('poblacionDestino', 'Población destino', 'required');
			$this->form_validation->set_rules('poblacionOrigen', 'Población origen', 'required');
			$this->form_validation->set_rules('cpOrigen', 'CP origen', 'exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('cpDestino', 'CP destino', 'exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('horaLlegadaDesde', 'Hora llegada desde');
			$this->form_validation->set_rules('horaLlegadaHasta', 'Hora llegada hasta');
			$this->form_validation->set_rules('horaRetornoDesde', 'Hora retorno desde');
			$this->form_validation->set_rules('horaRetornoHasta', 'Hora retorno hasta');
			$this->form_validation->set_rules('dias[]', 'dias');
			 
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
			
			
			 //Lo he puesto igual a false para que no falle por las validaciones
			if($this->form_validation->run()!=false)//Si la validación es correcta
			{
				//RECOGIDA DE DATOS
				$horaSalidaRango=explode(" - ",$this->input->post('horaSalidaRango'));
				$trayecto['horaLlegadaDesde']=$horaSalidaRango[0];
				$trayecto['horaLlegadaHasta']=$horaSalidaRango[1];
				$horaRegresoRango=explode(" - ",$this->input->post('horaRegresoRango'));
				$trayecto['horaRetornoDesde']=$horaRegresoRango[0];
				$trayecto['horaRetornoHasta']=$horaRegresoRango[1];
		
				if(null !=$this->input->post('poblacionOrigen')){
					$trayecto['poblacionOrigen']=$this->input->post('poblacionOrigen');
				}else{
					$trayecto['poblacionOrigen']=$this->input->post('busquedaOrigen');
				}
				if(null !=$this->input->post('poblacionDestino')){
					$trayecto['poblacionDestino']=$this->input->post('poblacionDestino');			
				}else{
					$trayecto['poblacionDestino']=$this->input->post('busquedaDestino');
				}
				
				if(null !=$this->input->post('cpOrigen')){
					$trayecto['cpOrigen']=$this->input->post('cpOrigen');
				}
				if(null !=$this->input->post('cpDestino')){
					$trayecto['cpDestino']=$this->input->post('cpDestino');
				}
				
				$trayecto['dias[]']=$this->input->post('dias[]');
				
				$this->load->Model('Trayecto_Model');
				$trayectosEncontrados['trayectosEncontrados']=$this->Trayecto_Model->filtrarTrayecto($trayecto);
				$trayectosEncontrados['camposBusqueda']=$trayecto;
				$trayectosEncontrados['css']="buscarTrayectoMiniPost";
				enmarcar($this, "trayecto/buscarTrayectoMiniPost",$trayectosEncontrados);//TODO
				
			}
			else
			{	
				$this->session->set_flashdata('error', 'Se produjo un error, intentelo de nuevo más tarde.');
				enmarcar($this, "trayecto/buscarTrayectoPost",$datos);//TODO
			}			
			
		}
	}
	
	public function buscarTrayectosMiniPost()
	{
		$trayecto['poblacionOrigen']=($this->input->post('poblacionOrigen')!=null)?$this->input->post('poblacionOrigen'):$this->input->get('poblacionOrigen');
		$trayecto['poblacionDestino']=($this->input->post('poblacionDestino')!=null)?$this->input->post('poblacionDestino'):$this->input->get('poblacionDestino');
		if(($trayecto['poblacionOrigen']==null) ||($trayecto['poblacionDestino']==null)){
			enmarcar($this, "index.php");
		}else{
			$this->load->Model('Trayecto_Model');
			$trayectosEncontrados=$this->Trayecto_Model->filtrarTrayecto($trayecto);
			
			$datos['camposBusqueda']=$trayecto;
			$datos['trayectosEncontrados']=$trayectosEncontrados;
			$datos['css']="buscarTrayectoMiniPost";
			enmarcar($this, "trayecto/buscarTrayectoMiniPost",$datos);//TODO
		}	
	}
	
	public function filtrarTrayectoPost()
	{	
		$horaSalidaRango=explode(" - ",$this->input->post('horaSalidaRango'));
		$trayecto['horaLlegadaDesde']=$horaSalidaRango[0];
		$trayecto['horaLlegadaHasta']=$horaSalidaRango[1];
		$horaRegresoRango=explode(" - ",$this->input->post('horaRegresoRango'));
		$trayecto['horaRetornoDesde']=$horaRegresoRango[0];
		$trayecto['horaRetornoHasta']=$horaRegresoRango[1];

		if(null !=$this->input->post('poblacionOrigenFil')){
			$trayecto['poblacionOrigen']=$this->input->post('poblacionOrigenFil');
		}else{
			$trayecto['poblacionOrigen']=$this->input->post('busquedaOrigen');
		}
		if(null !=$this->input->post('poblacionDestinoFil')){
			$trayecto['poblacionDestino']=$this->input->post('poblacionDestinoFil');			
		}else{
			$trayecto['poblacionDestino']=$this->input->post('busquedaDestino');
		}
		
		if(null !=$this->input->post('cpOrigen')){
			$trayecto['cpOrigen']=$this->input->post('cpOrigen');
		}
		if(null !=$this->input->post('cpDestino')){
			$trayecto['cpDestino']=$this->input->post('cpDestino');
		}
		
		$trayecto['dias[]']=$this->input->post('dias[]');
		
		$this->load->Model('Trayecto_Model');
		$trayectosEncontrados['trayectosEncontrados']=$this->Trayecto_Model->filtrarTrayecto($trayecto);
		$trayectosEncontrados['camposBusqueda']=$trayecto;
		$resultadoParaDiv=$this->load->view("trayecto/resultadoParaDiv", $trayectosEncontrados, true);
		echo $resultadoParaDiv;

	}
	
	public function crearTrayecto() 
	{		
		
		
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$datos['css']="crearTrayecto";
			enmarcar($this,'trayecto/crearTrayecto.php',$datos);
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['redireccion']='trayecto/crearTrayecto';
			enmarcar($this,'trayecto/crearTrayecto.php',$datos);
				
		}
	}
	
	public function crearTrayectoPost()
	{
		
			//reglas de validacion
			$this->form_validation->set_rules('cpOrigen', 'CP origen', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('poblacionOrigen', 'Población origen', 'required|trim');
			$this->form_validation->set_rules('cpDestino', 'CP destino', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('poblacionDestino', 'Población destino', 'required|trim');
			$this->form_validation->set_rules('horaLlegada', 'Hora llegada', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('horaRetorno', 'Hora llegada', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('comentarios', 'comentarios', 'max_length[140]|trim');
			$this->form_validation->set_rules('dias[]', 'dias', 'required');
			$this->form_validation->set_rules('plazas', 'plazas', 'required|is_natural|greater_than[1]|trim');
             
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
             
             if($this->form_validation->run()!=false)//Si la validación es correcta
             { 
             	
             	//RECOGIDA DE DATOS
             	$trayecto['cpOrigen']=$this->input->post('cpOrigen');
             	$trayecto['poblacionOrigen']=$this->input->post('poblacionOrigen');
             	$trayecto['cpDestino']=$this->input->post('cpDestino');
             	$trayecto['poblacionDestino']=$this->input->post('poblacionDestino');
             	$trayecto['horaLlegada']=$this->input->post('horaLlegada');
             	$trayecto['horaRetorno']=$this->input->post('horaRetorno');
             	$trayecto['comentarios']=$this->input->post('comentarios');
             	$trayecto['dias[]']=$this->input->post('dias[]');
             	$trayecto['plazas']=$this->input->post('plazas');
             	$trayecto['creador_id']=$this->session->userdata('id');
             	
             	
                $this->load->Model('Usuario_Model');
                $usuario=$this->Usuario_Model->obtenerUsuarioPorId($this->session->userdata('id'));
                
             	/*
             	$this->load->Model('Lugar_Model');
             	$usuario=$this->Usuario_Model->obtenerUsuarioPorEmail($this->session->userdata('id'));
             	*/
             	
                $this->load->Model('Trayecto_Model');
                $trayectoCreado=$this->Trayecto_Model->crearTrayecto($trayecto,$usuario);
                header("Location:".base_url());
                
             }
             else
             {
                $datos["mensaje"]="Validación incorrectaa";//TODO
                
             }
              
			
	}
	
	public function comprobarCP()//TODO
	{
		echo "true";
		
	}
	
	public function aceptar_usuario_trayecto()
	{
		$id_usuario=$_REQUEST['id_usuario'];
		$id_trayecto=$_REQUEST['id_trayecto'];
	
		if($this->session->userdata('logueado'))
		{
			$this->load->Model('Trayecto_Model');
			$info_trayecto=$this->Trayecto_Model->aceptar_usuario_trayecto($id_usuario,$id_trayecto)[0];
			
			//var_dump($info_trayecto);
			
			echo $id_usuario."*"."Ha sido aceptada su solicitud para el trayecto con origen {$info_trayecto['poblacionOrigen']} y destino 
			{$info_trayecto['poblacionDestino']} administrado por {$info_trayecto['nombre']} {$info_trayecto['apellidos']}.";
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
	
	}
	
	public function eliminar_usuario_trayecto()
	{	
		$id_usuario=$_REQUEST['id_usuario'];
		$id_trayecto=$_REQUEST['id_trayecto'];	
		
		if($this->session->userdata('logueado'))
		{
			$this->load->Model('Trayecto_Model');
			$info_trayecto=$this->Trayecto_Model->eliminar_usuario_trayecto($id_usuario,$id_trayecto)[0];
			
			echo $id_usuario."*"."Has sido eliminado del trayecto con origen {$info_trayecto['poblacionOrigen']} y destino
			{$info_trayecto['poblacionDestino']} administrado por {$info_trayecto['nombre']} {$info_trayecto['apellidos']}.";
	
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
		
	}
	
	public function rechazar_usuario_trayecto()
	{
		$id_usuario=$_REQUEST['id_usuario'];
		$id_trayecto=$_REQUEST['id_trayecto'];
	
		if($this->session->userdata('logueado'))
		{
			$this->load->Model('Trayecto_Model');
			$info_trayecto=$this->Trayecto_Model->rechazar_usuario_trayecto($id_usuario,$id_trayecto)[0];
				
			echo $id_usuario."*"."Ha sido rechazada su solicitud para el trayecto con origen {$info_trayecto['poblacionOrigen']} y destino
			{$info_trayecto['poblacionDestino']} administrado por {$info_trayecto['nombre']} {$info_trayecto['apellidos']}.";
	
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
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