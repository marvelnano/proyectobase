<?php

	//TODO: Template Tabla Ajax
	require_once "../controladores/producto.controlador.php";
	require_once "../modelos/producto.modelo.php";

	class TablaProducto{

	/*=============================================
	//tag: MOSTRAR LA TABLA DE PRODUCTO
	=============================================*/

		public function mostrarTablaProducto(){	

			$item = null;
			$valor = null;

			$producto = ControladorProducto::ctrMostrarProducto($item, $valor);
			//echo "total de detalle: ".count($producto);
			$datosJson = '{ 
				"data": [ ';

				for($i = 0; $i < count($producto); $i++){ 

					/*=============================================
					//note: AGREGAR ETIQUETAS DE ESTADO
					=============================================*/

					if($producto[$i]["estado"] == 0){
						$colorEstado = "btn-danger";
						$textoEstado = "Desactivado";
						$estadoProducto = 1;
					}else{
						$colorEstado = "btn-success";
						$textoEstado = "Activado";
						$estadoProducto = 0;
					}

					$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$producto[$i]["idproducto"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";

					/*=============================================
					//note: TRAER LAS ACCIONES
					=============================================*/
					$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto center' idProducto='".$producto[$i]["idproducto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-edit'></i></button></div>";

					/*=============================================
					//note: DEVOLVER DATOS JSON
					=============================================*/
					
					$datosJson	 .= '[
						"'.($i+1).'",
						"'.$producto[$i]["descripcion"].'",
						"'.$estado.'",
						"'.$acciones.'"		
						],';

				} 

			$datosJson = substr($datosJson, 0, -1);

			$datosJson.=  ']
				
			}'; 
			
			echo $datosJson; 
		}
	}

	/*=============================================
	//tag: ACTIVAR TABLA DE PRODUCTO
	=============================================*/ 
	$activar = new TablaProducto();
	$activar -> mostrarTablaProducto(); 