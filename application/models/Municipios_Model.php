<?php
class Municipios_Model extends RedBean_SimpleModel {
	
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

	private function crearString($municipios) {
		$sol ='\'[';
		foreach ( $municipios as $obj ) {
			$sol .= '{"idpoblacion":"';
			$sol .= $obj['idpoblacion'];
			$sol .= '","idprovincia":"';
			$sol .= $obj['idprovincia'];
			$sol .= '","poblacion":"';
			$sol .= $obj['poblacion'];
			$sol .= '","poblacionseo":"';
			$sol .= $obj['poblacionseo'];
			$sol .= '","postal":"';
			$sol .= $obj['postal'];
			$sol .= '"}, ';				
			
		}
		$sol = substr($sol, 0, -1); 
		$sol .=']\'';
		
		return $sol;
	}

	function leerTodos() {
		return $this->crearString( R::getAll( 'select * from poblacion' ));
	}
}

?>