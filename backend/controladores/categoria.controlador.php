<?php

	//TODO: Template Controlador
	class ControladorCategoria{

		/*=============================================
		//tag: MOSTRAR CATEGORIA
		=============================================*/

		static public function ctrMostrarCategoria($item, $valor){
			$tabla = "categoria";

			$respuesta = ModeloCategoria::mdlMostrarCategoria($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR CATEGORIA
		=============================================*/

		static public function ctrCrearCategoria($datos){
			if(isset($datos["descripcion"])){
				$datosCategoria = array(
					"descripcion"=>$datos["descripcion"]
				);	

				$respuesta = ModeloCategoria::mdlIngresarCategoria("categoria", $datosCategoria);
				return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR CATEGORIA
		=============================================*/

		static public function ctrEditarCategoria($datos){
			if(isset($datos["idcategoriaEd"])){				
				$datosCategoria = array(
					"idcategoria"=> $datos["idcategoriaEd"],
					"descripcion"=> $datos["descripcionEd"]
				);

				$respuesta = ModeloCategoria::mdlEditarCategoria("categoria", $datosCategoria);
				return $respuesta;
			}
		}

	}