<?php

	//TODO: Template Controlador
	class ControladorMedida{

		/*=============================================
		//tag: MOSTRAR MEDIDA
		=============================================*/

		static public function ctrMostrarMedida($item, $valor){
			$tabla = "medida";

			$respuesta = ModeloMedida::mdlMostrarMedida($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR MEDIDA
		=============================================*/

		static public function ctrCrearMedida($datos){
			if(isset($datos["descripcion"])){
				$datosMedida = array(
					"descripcion"=>$datos["descripcion"]
				);	

				$respuesta = ModeloMedida::mdlIngresarMedida("medida", $datosMedida);
				return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR MEDIDA
		=============================================*/

		static public function ctrEditarMedida($datos){
			if(isset($datos["idmedidaEd"])){				
				$datosMedida = array(
					"idmedida"=> $datos["idmedidaEd"],
					"descripcion"=> $datos["descripcionEd"]
				);

				$respuesta = ModeloMedida::mdlEditarMedida("medida", $datosMedida);
				return $respuesta;
			}
		}

	}