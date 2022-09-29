<?php

	//TODO: Template Controlador
	class ControladorProducto{

		/*=============================================
		//tag: MOSTRAR PRODUCTO
		=============================================*/

		static public function ctrMostrarProducto($item, $valor){
			$tabla = "producto";

			$respuesta = ModeloProducto::mdlMostrarProducto($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR PRODUCTO
		=============================================*/

		static public function ctrCrearProducto($datos){
			if(isset($datos["descripcion"])){
				$datosProducto = array(
					"descripcion"=>$datos["descripcion"]
				);	

				$respuesta = ModeloProducto::mdlIngresarProducto("producto", $datosProducto);
				return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR PRODUCTO
		=============================================*/

		static public function ctrEditarProducto($datos){
			if(isset($datos["idproductoEd"])){				
				$datosProducto = array(
					"idproducto"=> $datos["idproductoEd"],
					"descripcion"=> $datos["descripcionEd"]
				);

				$respuesta = ModeloProducto::mdlEditarProducto("producto", $datosProducto);
				return $respuesta;
			}
		}

	}