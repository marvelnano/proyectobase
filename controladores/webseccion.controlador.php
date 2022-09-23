<?php

class ControladorWebSeccion{

	/*=============================================
	MOSTRAR WEB SECCIONES
	=============================================*/

	static public function ctrMostrarWebSecciones($item, $valor){

		$tabla = "plantilla_web_seccion";

		$respuesta = ModeloWebSeccion::mdlMostrarWebSecciones($tabla,$item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR WEB SECCIÓN
	=============================================*/

	static public function ctrCrearWebSeccion($datos){
		//echo ", seleccionarProveedor: ".$datos["seleccionarProveedor"];
		if(isset($datos["descripcion"])){

			//echo "seleccionarProveedor: ".$datos["seleccionarProveedor"];
			$datosWebSeccion = array(
						"descripcion"=>$datos["descripcion"]
					);
			
			$respuesta = ModeloWebSeccion::mdlIngresarWebSeccion("plantilla_web_seccion", $datosWebSeccion);

			return $respuesta;
		
		}

	}

	/*=============================================
	EDITAR WEB SECCIÓN
	=============================================*/

	static public function ctrEditarWebSeccion($datos){

		if(isset($datos["idwebseccionEd"])){
				
			$datosWebSeccion = array(
				"idplantillawebseccion"=> $datos["idwebseccionEd"],
				"descripcion"=> $datos["descripcionEd"]
			);

			$respuesta = ModeloWebSeccion::mdlEditarWebSeccion("plantilla_web_seccion", $datosWebSeccion);

			return $respuesta;

		}
		
	}

}