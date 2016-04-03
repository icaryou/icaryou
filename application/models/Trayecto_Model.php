<?php

class Trayecto_Model extends RedBean_SimpleModel
{		
	
	
	public function obtenerTrayectoPorId($id)
	{
		$trayecto=R::load('trayecto',$id);
		return $trayecto;
	}
	
	public function comprobarCP($cp,$poblacionOrigen)
	{
		$poblacion=R::findOne("poblacion","email=?",array($email));
		return $usuario;
	}
	
	public function buscarTrayectos($trayecto)
	{		
		$trayectosEncontrados=R::getAll('select 
				t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,
				li.poblacion as poblacionOrigen,
				ld.poblacion poblacionDestino,
				u.nombre,u.apellidos,u.fechanac
					from trayecto t 
					join lugar li on t.inicio_id=li.id
					join lugar ld on t.destino_id=ld.id
					join usuario u on t.creador=u.id
						where t.horallegadadestino>= :horaLlegadaDesde
						AND t.horallegadadestino<= :horaLlegadaHasta
						AND t.horaretornodestino>= :horaRetornoDesde
						AND t.horaretornodestino<= :horaRetornoHasta
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
						':dias'=>$this->diasToStringParaBuscar($trayecto['dias[]']),
						));
		
						
		//var_dump($trayectosEncontrado);
		return $trayectosEncontrados;
	}
	
	public function buscarTrayectosMini($trayecto)
	{
		$trayectosEncontrados=R::getAll('select
				t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,
				li.poblacion as poblacionOrigen,
				ld.poblacion poblacionDestino,
				u.nombre,u.apellidos,u.fechanac
					from trayecto t
					join lugar li on t.inicio_id=li.id
					join lugar ld on t.destino_id=ld.id
					join usuario u on t.creador=u.id
						where li.poblacion like :poblacionOrigen
						AND ld.poblacion like :poblacionDestino',
				array(	':poblacionOrigen'=>$trayecto['poblacionOrigen'],
						':poblacionDestino'=>$trayecto['poblacionDestino'])
				);		
		//var_dump($trayectosEncontrados);  DEBUG
		return $trayectosEncontrados;
	}
	
	public function listarTrayectosPropios($id)
	{	
		/*funcionando solo seleccionado usuarios sin separar
		select u.id usuarioId, u.nombre,u.apellidos,u.fechanac,
		t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,
		li.poblacion as poblacionOrigen,
		ld.poblacion poblacionDestino,
		ut.trayecto_id
		from usuariotrayecto ut
		join usuario u on ut.usuario_id=u.id
		join trayecto t on ut.trayecto_id=t.id
		join lugar li on t.inicio_id=li.id
		join lugar ld on t.destino_id=ld.id
		where t.id in (select ut.trayecto_id from usuariotrayecto ut where ut.usuario_id=2) 
		order by ut.trayecto_id, ut.id
		*/
		
		$idTrayectosPropiosEncontrados=R::getAll("select ut.trayecto_id from usuariotrayecto ut where ut.usuario_id=2");
		
		
		$trayectosPropiosEncontrados=array();
		
		
		
		
		foreach ($idTrayectosPropiosEncontrados as $id)
		{
			array_push($trayectosPropiosEncontrados, R::getAll("select u.id usuarioId, u.nombre,u.apellidos,u.fechanac,
			t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,
			li.poblacion as poblacionOrigen,
			ld.poblacion poblacionDestino,
			ut.trayecto_id
			from usuariotrayecto ut
			join usuario u on ut.usuario_id=u.id
			join trayecto t on ut.trayecto_id=t.id
			join lugar li on t.inicio_id=li.id
			join lugar ld on t.destino_id=ld.id
			where t.id = {$id['trayecto_id']} 
			order by ut.trayecto_id, ut.id"));
		}
		
		
		
		/*   BUENO
		$trayectosPropiosEncontrados['propios']=R::getAll("select u.id usuarioId, u.nombre,u.apellidos,u.fechanac,
		t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,
		li.poblacion as poblacionOrigen,
		ld.poblacion poblacionDestino,
		ut.trayecto_id
		from usuariotrayecto ut
		join usuario u on ut.usuario_id=u.id
		join trayecto t on ut.trayecto_id=t.id
		join lugar li on t.inicio_id=li.id
		join lugar ld on t.destino_id=ld.id
		where t.id in (select ut.trayecto_id from usuariotrayecto ut where ut.usuario_id=2) 
		order by ut.trayecto_id, ut.id");
		*/
		
		
		return $trayectosPropiosEncontrados;
		
	}
	
	public function crearTrayecto($trayectoInput,$usuario)
	{	
		
		//var_dump($this->session->all_userdata);//TODO No funciona aqui
		
		$trayecto=R::dispense('trayecto');
		
		$trayecto->dias=$this->diasToStringParaGuardar($trayectoInput['dias[]']);
		$trayecto->horallegadadestino=$trayectoInput['horaLlegada'];		
		$trayecto->horaretornodestino=$trayectoInput['horaRetorno'];
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