<?php

class ControladorNivel{

	/*=============================================
	MOSTRAR NIVELES
	=============================================*/

	static public function ctrMostrarNiveles($item, $valor){

		$tabla = "nivel_usuario";

		$respuesta = ModeloNivel::mdlMostrarNiveles($tabla,$item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR NIVEL
	=============================================*/

	static public function ctrCrearNivel($datos){
		//echo ", seleccionarProveedor: ".$datos["seleccionarProveedor"];
		if(isset($datos["descripcion"])){

			//echo "seleccionarProveedor: ".$datos["seleccionarProveedor"];
			$datosNivel = array(
						"descripcion"=>$datos["descripcion"]
					);
			
			$respuesta = ModeloNivel::mdlIngresarNivel("nivel_usuario", $datosNivel);

			return $respuesta;
		
		}

	}

	/*=============================================
	EDITAR NIVEL
	=============================================*/

	static public function ctrEditarNivel($datos){

		if(isset($datos["idnivelEd"])){
				
			$datosNivel = array(
				"idnivelusuario"=> $datos["idnivelEd"],
				"descripcion"=> $datos["descripcionEd"]
			);

			$respuesta = ModeloNivel::mdlEditarNivel("nivel_usuario", $datosNivel);

			return $respuesta;

		}
		
	}

}