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
		
		$idTrayectosEncontrados=R::getAll("select distinct ut.trayecto_id from usuariotrayecto ut
										join trayecto t on ut.trayecto_id=t.id
										join lugar li on t.inicio_id=li.id
										join lugar ld on t.destino_id=ld.id
										join usuario u on ut.usuario_id=u.id
										where t.horallegadadestino>= :horaLlegadaDesde
										AND t.horallegadadestino<= :horaLlegadaHasta
										AND t.horaretornodestino>= :horaRetornoDesde
										AND t.horaretornodestino<= :horaRetornoHasta
										AND (li.cp= :cpOrigen OR li.poblacion like :poblacionOrigen)
										AND (ld.cp= :cpDestino OR ld.poblacion like :poblacionDestino)
										AND (t.dias like :dias)",array(':horaLlegadaDesde'=>$trayecto['horaLlegadaDesde'],
										':horaLlegadaHasta'=>$trayecto['horaLlegadaHasta'],
										':horaRetornoDesde'=>$trayecto['horaRetornoDesde'],
										':horaRetornoHasta'=>$trayecto['horaRetornoHasta'],
										':cpOrigen'=>$trayecto['cpOrigen'],
										':poblacionOrigen'=>$trayecto['poblacionOrigen'],
										':cpDestino'=>$trayecto['cpDestino'],
										':poblacionDestino'=>$trayecto['poblacionDestino'],
										':dias'=>$this->diasToStringParaBuscar($trayecto['dias[]']),
										));//TODO cmabiar por $id
		
		$trayectosEncontrados=array();
		
		foreach ($idTrayectosEncontrados as $id)
		{
			//CADA ITERACION BUSCA POR UN ID DE USUARIO DEVOLVIENDO TANTAS FILAS COMO USUARIOS TENGA ESE ID DE TRAYECTO
			array_push($trayectosEncontrados, R::getAll("select u.id usuarioId, u.nombre,u.apellidos,u.fechanac, u.foto,
					t.id trayecto_id,t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,t.plazas,
					li.poblacion as poblacionOrigen,
					ld.poblacion poblacionDestino,
					ut.trayecto_id
					from usuariotrayecto ut
					join usuario u on ut.usuario_id=u.id
					join trayecto t on ut.trayecto_id=t.id
					join lugar li on t.inicio_id=li.id
					join lugar ld on t.destino_id=ld.id
					where t.id = {$id['trayecto_id']} AND aceptado=1
			order by ut.trayecto_id, ut.id"));
		}
		//CAMBIO   AGREGADO ACEPTADO=1
		
		//var_dump($trayectosEncontrado);
		return $trayectosEncontrados;
	}
	/* YA NO SE USA
	public function buscarTrayectosMini($trayecto)
	{
		$idTrayectosEncontrados=R::getAll("select distinct ut.trayecto_id from usuariotrayecto ut
										join trayecto t on ut.trayecto_id=t.id
										join lugar li on t.inicio_id=li.id
										join lugar ld on t.destino_id=ld.id
										join usuario u on ut.usuario_id=u.id										
										WHERE li.poblacion like :poblacionOrigen
										AND ld.poblacion like :poblacionDestino",array(
										':poblacionOrigen'=>$trayecto['poblacionOrigen'],
										':poblacionDestino'=>$trayecto['poblacionDestino'],
										));//TODO cmabiar por $id
		
		$trayectosEncontrados=array();
		
		foreach ($idTrayectosEncontrados as $id)
		{
			//CADA ITERACION BUSCA POR UN ID DE USUARIO DEVOLVIENDO TANTAS FILAS COMO USUARIOS TENGA ESE ID DE TRAYECTO
			array_push($trayectosEncontrados, R::getAll("select u.id usuarioId, u.nombre,u.apellidos,u.fechanac,
					t.id trayecto_id,t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,t.plazas,
					li.poblacion as poblacionOrigen,
					ld.poblacion poblacionDestino,
					ut.trayecto_id
					from usuariotrayecto ut
					join usuario u on ut.usuario_id=u.id
					join trayecto t on ut.trayecto_id=t.id
					join lugar li on t.inicio_id=li.id
					join lugar ld on t.destino_id=ld.id
					where t.id = {$id['trayecto_id']}  AND aceptado=1
			order by ut.trayecto_id, ut.id"));
		}
		
		return $trayectosEncontrados;
	}
	
*/
	
	public function filtrarTrayecto($trayecto)
	{
		$consulta="select distinct ut.trayecto_id from usuariotrayecto ut
										join trayecto t on ut.trayecto_id=t.id
										join lugar li on t.inicio_id=li.id
										join lugar ld on t.destino_id=ld.id
										join usuario u on ut.usuario_id=u.id
										where ";
		
		$consulta.=isset($trayecto['cpOrigen'])?"li.cp=\"".$trayecto['cpOrigen']."\" AND ":"";
		$consulta.=isset($trayecto['cpDestino'])?"ld.cp=\"".$trayecto['cpDestino']."\" AND ":"";
		
		$consulta.=isset($trayecto['dias[]'])?"t.dias like \"".$this->diasToStringParaBuscar($trayecto['dias[]'])."\" AND ":"";
		
		$consulta.=isset($trayecto['horaLlegadaDesde'])?"t.horallegadadestino>=\"".$trayecto['horaLlegadaDesde']."\" AND ":"";
		$consulta.=isset($trayecto['horaLlegadaHasta'])?"t.horallegadadestino<=\"".$trayecto['horaLlegadaHasta']."\" AND ":"";
		$consulta.=isset($trayecto['horaRetornoDesde'])?"t.horaretornodestino>=\"".$trayecto['horaRetornoDesde']."\" AND ":"";
		$consulta.=isset($trayecto['horaRetornoHasta'])?"t.horaretornodestino<=\"".$trayecto['horaRetornoHasta']."\" AND ":"";
		
		$consulta.=isset($trayecto['poblacionOrigen'])?"li.poblacion like \"".$trayecto['poblacionOrigen']."\" AND ":"";
		$consulta.=isset($trayecto['poblacionDestino'])?"ld.poblacion like \"".$trayecto['poblacionDestino']."\"":"";
		
		$idTrayectosEncontrados=R::getAll($consulta);

		
		$trayectosEncontrados=array();
	
		foreach ($idTrayectosEncontrados as $id)
		{
				//CADA ITERACION BUSCA POR UN ID DE USUARIO DEVOLVIENDO TANTAS FILAS COMO USUARIOS TENGA ESE ID DE TRAYECTO
				/*
				array_push($trayectosEncontrados, R::getAll("select u.id usuarioId, u.nombre,u.apellidos,u.fechanac,u.foto,
														t.id trayecto_id,t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,t.plazas,
														li.poblacion as poblacionOrigen,
														ld.poblacion poblacionDestino,
														ut.trayecto_id
														from usuariotrayecto ut
														join usuario u on ut.usuario_id=u.id
														join trayecto t on ut.trayecto_id=t.id
														join lugar li on t.inicio_id=li.id
														join lugar ld on t.destino_id=ld.id
														where t.id = {$id['trayecto_id']} AND aceptado=1
														order by ut.trayecto_id, ut.id"));
														*/
			array_push($trayectosEncontrados, R::getAll("select u.id usuarioId, u.nombre,u.apellidos,u.fechanac,u.foto,
					t.id trayecto_id,t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,t.plazas,ut.aceptado,
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
		//CAMBIO   AGREGADO ACEPTADO=1
	
		//var_dump($trayectosEncontrado);
		return $trayectosEncontrados;
		//return $consulta;
	}
	
	public function listarTrayectosPropios($id)
	{	
		
		
		//SELECCIONAMOS LOS IDS DE SUS TRAYECTOS
		$idTrayectosPropiosEncontrados=R::getAll("select ut.trayecto_id from usuariotrayecto ut where ut.usuario_id=$id AND aceptado!=-1 ");//TODO cmabiar por $id
				
		$trayectosPropiosEncontrados=array();	
		
		foreach ($idTrayectosPropiosEncontrados as $id)
		{
			$sql="select u.id usuarioId, u.nombre,u.apellidos,u.fechanac,u.foto,
			t.id trayecto_id,t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,t.plazas,
			li.poblacion as poblacionOrigen,
			ld.poblacion poblacionDestino,
			ut.trayecto_id,
		    ut.aceptado
			from usuariotrayecto ut
			join usuario u on ut.usuario_id=u.id
			join trayecto t on ut.trayecto_id=t.id
			join lugar li on t.inicio_id=li.id
			join lugar ld on t.destino_id=ld.id
			where t.id = {$id['trayecto_id']}
			AND ut.aceptado!=-1
			order by ut.trayecto_id, ut.id";
			
			//CADA ITERACION BUSCA POR UN ID DE USUARIO DEVOLVIENDO TANTAS FILAS COMO USUARIOS TENGA ESE ID DE TRAYECTO
			array_push($trayectosPropiosEncontrados, R::getAll($sql));
		}	
		
		return $trayectosPropiosEncontrados;
		
	}
	
	public function listar_trayectos_usuario($id)
	{
	
	
		//SELECCIONAMOS LOS IDS DE SUS TRAYECTOS
		$id_trayectos_encontrados=R::getAll("select ut.trayecto_id from usuariotrayecto ut where ut.usuario_id=$id");//TODO cmabiar por $id
	
		$trayectos_encontrados=array();
	
		foreach ($id_trayectos_encontrados as $id)
		{
			//CADA ITERACION BUSCA POR UN ID DE USUARIO DEVOLVIENDO TANTAS FILAS COMO USUARIOS TENGA ESE ID DE TRAYECTO
			array_push($trayectos_encontrados, R::getAll("select u.id usuarioId, u.nombre,u.apellidos,u.fechanac, u.foto,
					t.id trayecto_id,t.dias,t.horallegadadestino,t.horaretornodestino,t.comentarios,t.creador,t.plazas,
					li.poblacion as poblacionOrigen,
					ld.poblacion poblacionDestino,
					ut.trayecto_id,
		    		ut.aceptado
					from usuariotrayecto ut
					join usuario u on ut.usuario_id=u.id
					join trayecto t on ut.trayecto_id=t.id
					join lugar li on t.inicio_id=li.id
					join lugar ld on t.destino_id=ld.id
					where t.id = {$id['trayecto_id']}
			order by ut.trayecto_id, ut.id"));
		}
	
	
		return $trayectos_encontrados;
	
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
		$trayecto->plazas=$trayectoInput['plazas'];
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
	
	public function aceptar_usuario_trayecto($id_usuario,$id_trayecto)
	{
		//R::exec( "UPDATE usuariotrayecto SET aceptado=1 WHERE trayecto_id=$id_trayecto AND usuario_id=$id_usuario");
		
		$id_ut=R::getAll("SELECT id FROM usuariotrayecto where trayecto_id=$id_trayecto 
				AND usuario_id=$id_usuario ORDER BY id DESC LIMIT 1");
		
		$id_ut=$id_ut[0]['id'];
	
		
		R::exec( "UPDATE usuariotrayecto SET aceptado=1 WHERE id=$id_ut");
		
		
		
		$info_trayecto=R::getAll("select u.nombre,u.apellidos,li.poblacion as poblacionOrigen,ld.poblacion poblacionDestino
			from trayecto t
			join usuario u on t.creador=u.id
			join lugar li on t.inicio_id=li.id
			join lugar ld on t.destino_id=ld.id
			where t.id = $id_trayecto");
		
		return $info_trayecto;
	
	}
	
	public function eliminar_usuario_trayecto($id_usuario,$id_trayecto)
	{
		R::exec( "UPDATE usuariotrayecto SET aceptado=-1 WHERE trayecto_id=$id_trayecto AND usuario_id=$id_usuario");
		
		$info_trayecto=R::getAll("select u.nombre,u.apellidos,li.poblacion as poblacionOrigen,ld.poblacion poblacionDestino
				from trayecto t
				join usuario u on t.creador=u.id
				join lugar li on t.inicio_id=li.id
				join lugar ld on t.destino_id=ld.id
				where t.id = $id_trayecto");
		
		return $info_trayecto;
	
	}
	
	public function rechazar_usuario_trayecto($id_usuario,$id_trayecto)
	{
			
		
		R::exec( "UPDATE usuariotrayecto SET aceptado=-1 WHERE trayecto_id=$id_trayecto AND usuario_id=$id_usuario");
	
		$info_trayecto=R::getAll("select u.nombre,u.apellidos,li.poblacion as poblacionOrigen,ld.poblacion poblacionDestino
				from trayecto t
				join usuario u on t.creador=u.id
				join lugar li on t.inicio_id=li.id
				join lugar ld on t.destino_id=ld.id
				where t.id = $id_trayecto");
	
		return $info_trayecto;
	
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
	/*
	public function diasToStringParaBuscar($dias)
	{
		$diasString;
		foreach ($dias as $dia)
		{
			$diasString.=$dia.'+';
		}
		return $diasString;
	}
	*/
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