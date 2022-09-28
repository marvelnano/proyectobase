<?php

class ControladorProyecto{

	/*=============================================
	MOSTRAR UBIGEOS
	=============================================*/

	static public function ctrMostrarUbigeos($item, $valor){

		$tabla = "ubigeo";

		$respuesta = ModeloProyecto::mdlMostrarUbigeos($tabla,$item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PROYECTOS
	=============================================*/

	static public function ctrMostrarProyectos($item, $valor){

		$tabla = "proyecto";

		$respuesta = ModeloProyecto::mdlMostrarProyectos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR PROYECTO
	=============================================*/

	static public function ctrCrearProyecto($datos){
		//echo ", seleccionarProveedor: ".$datos["seleccionarProveedor"];
		if(isset($datos["ruc"])){

			//echo "seleccionarProveedor: ".$datos["seleccionarProveedor"];
			$datosProyecto = array(
						"ruc"=>$datos["ruc"],
						"razonsocial"=>$datos["razonsocial"],
						"nombrecomercial"=>$datos["nombrecomercial"],
						"abreviatura"=>$datos["abreviatura"],
						"email"=>$datos["email"],
						"telefono"=>$datos["telefono"],
						"web"=>$datos["web"],
						"seleccionarUbigeo"=>$datos["seleccionarUbigeo"],
						"direccion"=>$datos["direccion"]/* ,
						"firma"=>$datos["firma"],
						"usuariosol"=>$datos["usuariosol"],
						"clavesol"=>$datos["clavesol"] */
					);
			
			$respuesta = ModeloProyecto::mdlIngresarProyecto("proyecto", $datosProyecto);

			return $respuesta;
		
		}

	}

	/*=============================================
	EDITAR PROYECTO
	=============================================*/

	static public function ctrEditarProyecto($datos){

		if(isset($datos["idproyectoEd"])){
				
			$datosProveedor = array(
				"idproyecto"=> $datos["idproyectoEd"],
				"ruc"=> $datos["rucEd"],
				"razonsocial"=>$datos["razonsocialEd"],
				"nombrecomercial"=> $datos["nombrecomercialEd"],
				"abreviatura"=>$datos["abreviaturaEd"],
				"email"=> $datos["emailEd"],
				"telefono"=> $datos["telefonoEd"],
				"web"=>$datos["webEd"],
				"seleccionarUbigeo"=> $datos["seleccionarUbigeoEd"],
				"direccion"=>$datos["direccionEd"]/* ,
				"firma"=>$datos["firmaEd"],
				"usuariosol"=> $datos["usuariosolEd"],
				"clavesol"=>$datos["clavesolEd"] */
			);

			$respuesta = ModeloProyecto::mdlEditarProyecto("proyecto", $datosProveedor);

			return $respuesta;

		}
		
	}

}