<?php

class Usuario_Model extends RedBean_SimpleModel
{		
	public function comprobarEmail($email)
	{
		$usuario=R::findOne("usuario","email=?",array($email));
		return $usuario;
		
	}
	
	public function obtenerUsuarioPorId($id)
	{
		$usuario=R::load('usuario',$id);
		return $usuario;
	}
	
	public function crearUsuario($registro)
	{	
		$usuario=R::dispense('usuario');
		$usuario->email=$registro['email'];
		$usuario->password=sha1($registro['password']);		
		$usuario->nombre=$registro['nombre'];
		$usuario->apellidos=$registro['apellidos'];
		$usuario->sexo=$registro['sexo'];
		$usuario->fechaNac=$registro['fechaNac'];
		$usuario->cp=$registro['cp'];
		$usuario->cochePropio=$registro['cochePropio'];
		$usuario->activo=false;
		
		R::store($usuario);
	}
	
	public function loguearUsuario($login)
	{		
		$usuario=R::findOne("usuario","email=? AND password=?",array($login['email'],sha1($login['password'])));		
		//OTRA FORMA
		//$usuario=R::getAll( 'select * from usuario where email= :emailLogin AND password = :passwordLogin',array(':emailLogin'=>$login['email'],':passwordLogin' => sha1($login['password'])) );
		
		return $usuario;		
	}
	
	
}

?>