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
		enmarcar($this,'trayecto/buscarTrayectos.php',$datos);//CAMBIADO POR LOGIN
		//$this->load->view('trayecto/crearTrayecto.php');	
	}
	
	public function buscarTrayectosPost()
	{
	
		if($this->input->post())
		{			
			
			//reglas de validacion //TODO
			
			$this->form_validation->set_rules('cpOrigen', 'CP origen', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('poblacionOrigen', 'Población origen', 'required|trim');
			$this->form_validation->set_rules('cpDestino', 'CP destino', 'required|exact_length[5]|is_natural|less_than[53000]|trim');
			$this->form_validation->set_rules('poblacionDestino', 'Población destino', 'required|trim');
			$this->form_validation->set_rules('horaLlegadaDesde', 'Hora llegada desde', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('horaLlegadaHasta', 'Hora llegada hasta', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('horaRetornoDesde', 'Hora retorno desde ', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('horaRetornoHasta', 'Hora retorno hasta', 'required|trim|callback__horaRegex|trim');
			$this->form_validation->set_rules('dias[]', 'dias', 'required');
			 
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
				$trayecto['horaLlegadaDesde']=$this->input->post('horaLlegadaDesde');
				$trayecto['horaLlegadaHasta']=$this->input->post('horaLlegadaHasta');
				$trayecto['horaRetornoDesde']=$this->input->post('horaRetornoDesde');
				$trayecto['horaRetornoHasta']=$this->input->post('horaRetornoHasta');
				$trayecto['dias[]']=$this->input->post('dias[]');	
	
				$this->load->Model('Trayecto_Model');
				$trayectosEncontrados=$usuario=$this->Trayecto_Model->buscarTrayectos($trayecto);
							
				
				$datos['camposBusqueda']=$trayecto;
				$datos['trayectosEncontrados']=$trayectosEncontrados;
				$datos['mensaje']="hola";
				enmarcar($this, "trayecto/buscarTrayectoPost",$datos);//TODO
				
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
		$trayecto['poblacionOrigen']=$this->input->post('poblacionOrigen');
		$trayecto['poblacionDestino']=$this->input->post('poblacionDestino');
		
		$this->load->Model('Trayecto_Model');
		$trayectosEncontrados=$usuario=$this->Trayecto_Model->buscarTrayectosMini($trayecto);
		
		$datos['camposBusqueda']=$trayecto;
		$datos['trayectosEncontrados']=$trayectosEncontrados;
		$datos['mensaje']="hola";
		enmarcar($this, "trayecto/buscarTrayectoMiniPost",$datos);//TODO
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
		
		$trayecto['dias[]']=$this->input->post('dias[]');
		/*
		$trayecto['cpOrigen'];
		$trayecto['cpDestino'];
		*/
		$this->load->Model('Trayecto_Model');
		$trayectosEncontrados['trayectosEncontrados']=$this->Trayecto_Model->filtrarTrayecto($trayecto);
		$trayectosEncontrados['camposBusqueda']=$trayecto;
		$resultadoParaDiv=$this->load->view("trayecto/resultadoParaDiv", $trayectosEncontrados, true);
		//echo $trayecto['horaRetornoDesde'];
		echo $resultadoParaDiv;
		//echo $trayectosEncontrados;
	}
	
	public function crearTrayecto() 
	{		
		/*	
		//VALIDAMOS SI HAY USUARIO ACTIVO		 
		if($this->session->userdata('logueado'))
		{
			enmarcar($this,'trayecto/crearTrayecto.php');
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{			
			$datos['redireccion']='trayecto/crearTrayecto';  
			enmarcar($this,'usuario/loginUsuario.php',$datos);
			
		}*/
		
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			enmarcar($this,'trayecto/crearTrayecto.php');
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['redireccion']='trayecto/crearTrayecto';
			enmarcar($this,'trayecto/crearTrayecto.php',$datos);
				
		}
		

		
		
	}
	
	public function crearTrayectoPost()
	{
		
		if($this->input->post("submitOk"))//se puede quitar el "submitok"
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
             }
             else
             {
                $datos["mensaje"]="Validación incorrectaa";//TODO
             }
              
             //$this->load->view("trayecto/crearTrayectoPost",$datos);
             //enmarcar($this, "trayecto/crearTrayectoPost",$datos);//TODO
		}	
	}
	
	public function comprobarCP()//TODO
	{
		echo "true";
		/*
		if (isset($_REQUEST['cpOrigen'])&&$_REQUEST['cpOrigen']!='')
		{
			$this->load->model("Trayecto_Model");
			$resultado=$this->Trayecto_Model->comprobarCP($_REQUEST['cpOrigen']);
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
		*/
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