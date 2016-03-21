<?php

class Usuario_Model extends RedBean_SimpleModel
{		
	
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
		$usuario->email=$login['email'];
		$usuario->password=sha1($login['password']);
		
		//$usuario = R::findOne( 'usuario', ' email LIKE :emailLogin ', [ ':emailLogin' => $login['email']]);
		//$usuario = R::findOne( 'usuario', ' email LIKE :emailLogin ', [ ':emailLogin' => $login['email']]);
		
		//$usuario=R::getAll( 'select * from usuario where email= :emailLogin AND password = :passwordLogin',
			//	array(':emailLogin'=>$login['email'],':passwordLogin' => $login['password']) );
		
		//$usuario=R::getAll( 'select * from usuario' );
		
		if ($usuario!=null) 
		{
			echo "encontrado";
			var_dump($usuario[0]['nombre']);
		}
		else
		{
			echo "no encontrado";
		}
		
	}
	
	
}

?>