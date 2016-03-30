<?php
class Welcome_Model extends RedBean_SimpleModel {
	public $id_municipio;
	public $nombre;
	
	
	private function crearArray($municipios) {
		$sol = [ ];
		foreach ( $municipios as $obj ) {
			$elem ['nombre'] = $obj['nombre'];
			$elem ['id_municipio'] = $obj['id_municipio'];			
			
			array_push ( $sol, $elem );
		}
		return $sol;
	}

	function leerTodos() {
		return $this->crearArray( R::getAll( 'select nombre, id_municipio from municipios' ));
	}
}
?>