<?php

class Usuario_Model extends RedBean_SimpleModel
{		
	
	public function crearUsuario($datosRegistro)
	{	
		$usuario=R::dispense('usuario');
		$usuario->nombre=$datosRegistro['nombre'];
		$usuario->apellidos=$datosRegistro['apellidos'];
		$usuario->fechaNac=$datosRegistro['fechaNac'];
		$usuario->password=$datosRegistro['password'];
		$usuario->email=$datosRegistro['email'];
		R::store($usuario);
	}
	
	
}

?>