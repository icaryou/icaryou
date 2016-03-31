<?php
class Welcome_Model extends RedBean_SimpleModel {
	
	private function crearArray($municipios) {
		$sol = [ ];
		foreach ( $municipios as $obj ) {
			$elem ['idpoblacion'] = $obj['idpoblacion'];
			$elem ['idprovincia'] = $obj['idprovincia'];
			$elem ['poblacion'] = $obj['poblacion'];
			$elem ['poblacionseo'] = $obj['poblacionseo'];
			$elem ['postal'] = $obj['postal'];
			
			array_push ( $sol, $elem );
		}
		return $sol;
	}

	function leerTodos() {
		return $this->crearArray( R::getAll( 'select * from poblacion' ));
	}
}
?>