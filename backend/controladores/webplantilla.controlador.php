<?php

class ControladorWebPlantilla{

	/*=============================================
	MOSTRAR PLANTILLAS WEB
	=============================================*/

	static public function ctrMostrarPlantillasWeb($item, $valor){

		$tabla = "plantilla_web";

		$respuesta = ModeloWebPlantilla::mdlMostrarPlantillasWeb($tabla,$item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR WEB PLANTILLA
	=============================================*/

	static public function ctrCrearWebPlantilla($datos){
		//echo ", seleccionarRubroWebPlantilla: ".$datos["seleccionarRubroWebPlantilla"];
		if(isset($datos["contenido"])){

			//echo "seleccionarRubroWebPlantilla: ".$datos["seleccionarRubroWebPlantilla"];
			$datosWebPlantilla = array(
					"idnegocio"=>$datos["idnegocio"],
					"idplantillawebseccion"=>$datos["idseccionweb"],
					"contenido"=>$datos["contenido"]
				);
			
			$respuesta = ModeloWebPlantilla::mdlIngresarWebPlantilla("plantilla_web", $datosWebPlantilla);

			return $respuesta;
		
		}

	}

	/*=============================================
	EDITAR WEB PLANTILLA
	=============================================*/

	static public function ctrEditarWebPlantilla($datos){

		if(isset($datos["idnegocioEd"])){
				
			$datosWebPlantilla = array(
				"idplantillaweb"=> $datos["idwebplantillaEd"],
				"idnegocio"=> $datos["idnegocioEd"],
				"idplantillawebseccion"=> $datos["idseccionwebEd"],
				"contenido"=> $datos["contenidoEd"]
			);

			$respuesta = ModeloWebPlantilla::mdlEditarWebPlantilla("plantilla_web", $datosWebPlantilla);

			return $respuesta;

		}
		
	}

}