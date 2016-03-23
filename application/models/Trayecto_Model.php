<?php

class Trayecto_Model extends RedBean_SimpleModel
{		
	
	
	public function obtenerTrayectoPorId($id)
	{
		$trayecto=R::load('trayecto',$id);
		return $trayecto;
	}
	
	public function crearTrayecto($trayectoInput,$usuario)
	{	
		
		//var_dump($this->session->all_userdata);//TODO No funciona aqui
		
		$trayecto=R::dispense('trayecto');
		
		$trayecto->dias=$this->diasToString($trayectoInput['dias[]']);
		$trayecto->horaLlegadaDestino=$trayectoInput['horaLlegada'];		
		$trayecto->horaRetornoDestino=$trayectoInput['horaRetorno'];
		$trayecto->comentarios=$trayectoInput['comentarios'];
		$trayecto->creador=$trayectoInput['creador_id'];
		//lugares
		$inicio=R::dispense('lugar');
		$inicio->cp=$trayectoInput['cpOrigen'];
		$inicio->poblacion=$trayectoInput['poblacionOrigen'];
		$destino=R::dispense('lugar');
		$destino->cp=$trayectoInput['cpDestino'];
		$destino->poblacion=$trayectoInput['poblacionDestino'];
		
		//asignacionBeans
		$trayecto->inicio=$inicio;
		$trayecto->destino=$destino;		
		//R::store($trayecto);	
		
		$usuario_trayecto=R::dispense('usuariotrayecto');
		$usuario_trayecto->usuario=$usuario;
		$usuario_trayecto->trayecto=$trayecto;
		$usuario_trayecto->aceptado=true;
		R::Store($usuario_trayecto);
	}
	
	public function diasToString($dias)
	{
		$diasString="";
		foreach ($dias as $dia)
		{
			$diasString.=$dia;
		}
		return $diasString;
	}
	
}

?>