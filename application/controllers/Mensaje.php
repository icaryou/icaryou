<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensaje extends CI_Controller
{
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model("Mensaje_model");
			
		//Cargamos la librería de validación (todos las librerias, helpers, etc pueden ser cargados en los controladores o auto cargarlos indicándolo en los ficheros de configuración)
		//$this->load->library('email');
	}
	
	public function comprobar_mensaje_nuevos_login()
	{
		$usuario=$this->session->userdata('id');
		echo $this->Mensaje_model->comprobar_existen_mensajes_nuevos($usuario);
	}
	
	//FUNCION ENVIAR MENSAJE DESDE PERFIL OTRO USUARIO, SI TIENE CONVERSACION ACTIVA REENVIAMOS A LAS CONVERSACIONES, SI NO ABRIMOS UNA VENTANA PARA INICIAR UN CHAT
	public function comprobar_conversacion_mensaje_inicial($id_otro_usuario)
	{
		$usuario=$this->session->userdata('id');
		$id_conversacion=$this->Mensaje_model->comprobar_conversacion($usuario,$id_otro_usuario);
		
		if($id_conversacion!=null)
		{
			$this->mostrar_mensajes($id_otro_usuario);	
		}
		else
		{
			$this->mostrar_mensajes($id_otro_usuario,1);
		}
	}
	
	//CREAMOS UNA CONVERSACION NUEVA Y EL PRIMER MENSAJE Y LE REDIRIGIMOS A LAS CONVERSACIONES ABRIENDO ESA CONVERSACION
	//DE MOMENTO NO LO USO
	public function enviar_mensaje_inicial($id_otro_usuario)
	{
		//$this->comprobar_conversacion_mensaje_inicial($id_otro_usuario);
	}
	
	//BUSCA LAS CONVERSACIONES ACTIVAS QUE TIENE EL USUARIO
	//primer parametro id del usuario con el que queremos abrir la conversacion
	//segundo parametro abrir ventana emergente que creara conversacion nueva y primer mensaje
	public function mostrar_mensajes($id_usuario_abrir_conversacion=0,$abrir_emergente=0)
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$usuario=$this->session->userdata('id');
			$datos['mensajes']=$this->Mensaje_model->buscar_conversaciones($usuario);//TODO cambiar por $usuario
			//var_dump($datos['mensajes']);
			//die;
			$datos['css']='mostrar_mensajes';
			
			
			//mandamos abrir la ventana emergente para iniciar conversacion
			if(isset($abrir_emergente)&&$abrir_emergente!=0)
			{
				$datos['abrirEmergente']=1;
				$datos['id_otro_usuario_mensaje']=$id_usuario_abrir_conversacion;
				enmarcar($this,'mensaje/mostrar_mensajes.php',$datos);
			}
			
			//abrimos el panel con una conversacion abierta
			else if(isset($id_usuario_abrir_conversacion)&&$id_usuario_abrir_conversacion!=0)
			{
				$datos['abrirEmergente']=0;
				$datos['activarConversacion']=$id_usuario_abrir_conversacion;
				enmarcar($this,'mensaje/mostrar_mensajes.php',$datos);
			}
			//abrimos el panel de mensajes
			 else if(isset($id_usuario_abrir_conversacion)&&$id_usuario_abrir_conversacion==0)
			{
				$datos['abrirEmergente']=0;
				enmarcar($this,'mensaje/mostrar_mensajes.php',$datos);
			}
			/*
			echo $id_usuario_abrir_conversacion;
			echo $abrir_emergente;
			die;
			*/
			//enmarcar($this,'mensaje/mostrar_mensajes.php',$datos);
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}		
	}
	
	public function crear_mensaje_admin()
	{
		$id_destinario=$_REQUEST['destinatario'];
		$texto=$_REQUEST['texto'];
		$hora=Date("Y-m-d H:i:s");
	
	
		$this->Mensaje_model->crear_mensaje($texto,Date("Y-m-d H:i:s"),31,$id_destinario);	
	
	}
	
	public function crear_mensaje()
	{
		//TODO
		$texto=$_REQUEST['texto'];
		$hora=Date("Y-m-d H:i:s");
		$remitente=$this->session->userdata('id');
		$destinatario=$_REQUEST['id_otro_usuario_mensaje'];
		
		//var_dump($_REQUEST);
		
		$this->Mensaje_model->crear_mensaje($texto,$hora,$remitente,$destinatario);	
		
		if(isset($_REQUEST['nueva_conversacion']))
		{
			
			$this->mostrar_mensajes($id_usuario_abrir_conversacion=$destinatario);
		}
		
	}
	//ABRE UN CHAT DETERMINADO CON UN USUARIO
	public function abrir_chat()
	{
		$usuario=$this->session->userdata('id');
		$id_otro_usuario=$_REQUEST['id_otro_usuario'];
		
		//var_dump($_REQUEST);
		
		$mensajes=$this->Mensaje_model->buscar_mensajes_chat($usuario,$id_otro_usuario);//TODO cambiar por $usuario
		echo(json_encode($mensajes));
	}
	
	public function actualizar_conversaciones()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$usuario=$this->session->userdata('id');
			$datos['conversaciones']=$this->Mensaje_model->buscar_conversaciones($usuario);
			
			echo (json_encode($datos['conversaciones']));
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}
	}
	
	public function actualizar_chat()
	{
		
		$id_conversacion=$_REQUEST['id_conversacion'];
		$usuario_activo=$this->session->userdata('id');
		$id_ultimo_mensaje=$_REQUEST['id_ultimo_mensaje'];
		$mensajes=$this->Mensaje_model->buscar_nuevos_mensajes_chat($id_conversacion,$id_ultimo_mensaje,$usuario_activo);//TODO cambiar por $usuario
		echo(json_encode($mensajes));
		
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