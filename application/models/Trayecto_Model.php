<?php

class Trayecto_Model extends RedBean_SimpleModel
{		
	
	
	public function obtenerTrayectoPorId($id)
	{
		$trayecto=R::load('trayecto',$id);
		return $trayecto;
	}
	
	public function buscarTrayectos($trayecto)
	{
		//TODO creo que ya esta funcional, solo añadir  dias
		$trayectosEncontrado=R::getAll('select * from trayecto t 
				join lugar li on t.inicio_id=li.id
				join lugar ld on t.destino_id=ld.id
				where t.hora_llegada_destino>= :horaLlegadaDesde
				AND t.hora_llegada_destino<= :horaLlegadaHasta
				AND t.hora_retorno_destino>= :horaRetornoDesde
				AND t.hora_retorno_destino<= :horaRetornoHasta
				AND (li.cp= :cpOrigen OR li.poblacion like :poblacionOrigen)
				AND (ld.cp= :cpDestino OR ld.poblacion like :poblacionDestino)
				AND (t.dias like :dias)',
				array(':horaLlegadaDesde'=>$trayecto['horaLlegadaDesde'],
						':horaLlegadaHasta'=>$trayecto['horaLlegadaHasta'],
						':horaRetornoDesde'=>$trayecto['horaRetornoDesde'],
						':horaRetornoHasta'=>$trayecto['horaRetornoHasta'],
						':cpOrigen'=>$trayecto['cpOrigen'],
						':poblacionOrigen'=>$trayecto['poblacionOrigen'],
						':cpDestino'=>$trayecto['cpDestino'],
						':poblacionDestino'=>$trayecto['poblacionDestino'],
						':dias'=>$this->diasToStringParaBuscar($trayecto['dias[]']),));
		var_dump($trayectosEncontrado);
		//return $trayecto;
	}
	
	public function crearTrayecto($trayectoInput,$usuario)
	{	
		
		//var_dump($this->session->all_userdata);//TODO No funciona aqui
		
		$trayecto=R::dispense('trayecto');
		
		$trayecto->dias=$this->diasToStringParaGuardar($trayectoInput['dias[]']);
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
	
	
	//funcion para convertir array dias en string tipo(LMXJV)
	public function diasToStringParaBuscar($dias)
	{
		$diasString="%";
		foreach ($dias as $dia)
		{
			$diasString.=$dia.'%';
		}
		return $diasString;
	}
	
	public function diasToStringParaGuardar($dias)
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