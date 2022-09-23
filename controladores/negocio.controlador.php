<?php

class ControladorNegocio{

	/*=============================================
	VER NEGOCIO
	=============================================*/
	static public function ctrVerNegocio($valor){
		$respuesta = ModeloNegocio::mdlVerNegocio($valor);
		return $respuesta;
	}

	/*=============================================
	MOSTRAR NEGOCIOS WEB
	=============================================*/
	static public function ctrMostrarNegociosWeb($item, $valor){
		$tabla = "negocio";
		$respuesta = ModeloNegocio::mdlMostrarNegociosWeb($tabla,$item, $valor);
		return $respuesta;
	}

	/*=============================================
	MOSTRAR NEGOCIOS
	=============================================*/
	static public function ctrMostrarNegocios($item, $valor){
		$tabla = "negocio";
		$respuesta = ModeloNegocio::mdlMostrarNegocios($tabla,$item, $valor);
		return $respuesta;
	}

	/*=============================================
	CREAR NEGOCIO
	=============================================*/
	static public function ctrCrearNegocio($datos){
		//echo ", seleccionarRubroNegocio: ".$datos["seleccionarRubroNegocio"];
		if(isset($datos["razon_social"])){

			//echo "seleccionarRubroNegocio: ".$datos["seleccionarRubroNegocio"];
			$datosNegocio = array(
					"idrubronegocio"=>$datos["idrubronegocio"],
					"ruc"=>$datos["ruc"],
					"razon_social"=>$datos["razon_social"],
					"direccion"=>$datos["direccion"],
					"celular"=>$datos["celular"],
					"email"=>$datos["email"],
					"pagina_web"=>$datos["pagina_web"]
				);
			
			$respuesta = ModeloNegocio::mdlIngresarNegocio("negocio", $datosNegocio);
			return $respuesta;		
		}
	}

	/*=============================================
	EDITAR NEGOCIO
	=============================================*/
	static public function ctrEditarNegocio($datos){

		if(isset($datos["idrubronegocioEd"])){				
			$datosNegocio = array(
				"idnegocio"=> $datos["idnegocioEd"],
				"idrubronegocio"=> $datos["idrubronegocioEd"],
				"ruc"=> $datos["rucEd"],
				"razon_social"=> $datos["razon_socialEd"],
				"direccion"=> $datos["direccionEd"],
				"celular"=> $datos["celularEd"],
				"email"=> $datos["emailEd"],
				"pagina_web"=> $datos["pagina_webEd"]
			);

			$respuesta = ModeloNegocio::mdlEditarNegocio("negocio", $datosNegocio);
			return $respuesta;
		}		
	}
}