<?php

class Controlador{CONTROLADOR}{

	/*=============================================
	MOSTRAR {CONTROLADORMAY}
	=============================================*/

	static public function ctrMostrar{CONTROLADOR}($item, $valor){
		$tabla = "{CONTROLADORMIN}";

		$respuesta = Modelo{CONTROLADOR}::mdlMostrar{CONTROLADOR}($tabla,$item, $valor);
		return $respuesta;
	}

	/*=============================================
	CREAR {CONTROLADORMAY}
	=============================================*/

	static public function ctrCrear{CONTROLADOR}($datos){
		if(isset($datos["descripcion"])){
			$datos{CONTROLADOR} = array(
                "descripcion"=>$datos["descripcion"]
            );	

			$respuesta = Modelo{CONTROLADOR}::mdlIngresar{CONTROLADOR}("{CONTROLADORMIN}", $datos{CONTROLADOR});
			return $respuesta;		
		}
	}

	/*=============================================
	EDITAR {CONTROLADORMAY}
	=============================================*/

	static public function ctrEditar{CONTROLADOR}($datos){
		if(isset($datos["id{CONTROLADORMIN}Ed"])){				
			$datos{CONTROLADOR} = array(
				"id{CONTROLADORMIN}"=> $datos["id{CONTROLADORMIN}Ed"],
				"descripcion"=> $datos["descripcionEd"]
			);

			$respuesta = Modelo{CONTROLADOR}::mdlEditar{CONTROLADOR}("{CONTROLADORMIN}", $datos{CONTROLADOR});
			return $respuesta;
		}
    }

}