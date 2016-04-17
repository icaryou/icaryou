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
	
	
	
	public function mostrar_mensajes()
	{
		//VALIDAMOS SI HAY USUARIO ACTIVO
		if($this->session->userdata('logueado'))
		{
			$usuario=$this->session->userdata('id');
			$datos['mensajes']=$this->Mensaje_model->buscar_conversaciones(1);//TODO cambiar por $usuario		
			enmarcar($this,'mensaje/mostrar_mensajes.php',$datos);
		}
		else//SI NO ESTA LOGUEADO LE MANDAMOS AL LOGIN CON UN CAMPO REDIRECCION PARA QUE LUEGO LE LLEVE A LA PAGINA QUE QUERIA
		{
			$datos['errorLogin']='Por favor inicia sesion';
			enmarcar($this,'index.php',$datos);
		}		
	}
	
	
	
	public function crear_mensaje()
	{
		//TODO
		$texto="hola 1";
		$hora=Date("Y-m-d H:i:s");
		$remitente=3;
		$destinatario=1;
		
		$this->Mensaje_model->crear_mensaje($texto,$hora,$remitente,$destinatario);	
	}
	
	public function abrir_chat()
	{
		$usuario=$this->session->userdata('id');
		$id_otro_usuario=$_REQUEST['id_otro_usuario'];
		$mensajes=$this->Mensaje_model->buscar_mensajes_chat($usuario,$id_otro_usuario);//TODO cambiar por $usuario
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