<?php

	//TODO: Template Controlador
	class ControladorConsumidor{

		/*=============================================
		//tag: MOSTRAR CONSUMIDOR
		=============================================*/

		static public function ctrMostrarConsumidor($item, $valor){
			$tabla = "consumidor";

			$respuesta = ModeloConsumidor::mdlMostrarConsumidor($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR CONSUMIDOR
		=============================================*/

		static public function ctrCrearConsumidor($datos){
			if(isset($datos["descripcion"])){
				$datosConsumidor = array(
					"descripcion"=>$datos["descripcion"]
				);	

				$respuesta = ModeloConsumidor::mdlIngresarConsumidor("consumidor", $datosConsumidor);
				return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR CONSUMIDOR
		=============================================*/

		static public function ctrEditarConsumidor($datos){
			if(isset($datos["idconsumidorEd"])){				
				$datosConsumidor = array(
					"idconsumidor"=> $datos["idconsumidorEd"],
					"descripcion"=> $datos["descripcionEd"]
				);

				$respuesta = ModeloConsumidor::mdlEditarConsumidor("consumidor", $datosConsumidor);
				return $respuesta;
			}
		}

	}