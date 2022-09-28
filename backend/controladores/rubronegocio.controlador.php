<?php

class ControladorRubro{

	/*=============================================
	MOSTRAR RUBROS
	=============================================*/

	static public function ctrMostrarRubros($item, $valor){

		$tabla = "rubro_negocio";

		$respuesta = ModeloRubro::mdlMostrarRubros($tabla,$item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR RUBRO
	=============================================*/

	static public function ctrCrearRubro($datos){
		//echo ", seleccionarProveedor: ".$datos["seleccionarProveedor"];
		if(isset($datos["descripcion"])){
			//echo "seleccionarProveedor: ".$datos["seleccionarProveedor"];
			$datosRubro = array(
						"descripcion"=>$datos["descripcion"]
					);		
			$respuesta = ModeloRubro::mdlIngresarRubro("rubro_negocio", $datosRubro);
			return $respuesta;		
		}
	}

	/*=============================================
	EDITAR RUBRO
	=============================================*/

	static public function ctrEditarRubro($datos){

		if(isset($datos["idrubroEd"])){
				
			$datosRubro = array(
				"idrubronegocio"=> $datos["idrubroEd"],
				"descripcion"=> $datos["descripcionEd"]
			);

			$respuesta = ModeloRubro::mdlEditarRubro("rubro_negocio", $datosRubro);

			return $respuesta;

		}
		
	}

}