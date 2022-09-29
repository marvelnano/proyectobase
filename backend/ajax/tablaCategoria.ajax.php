<?php

	//TODO: Template Tabla Ajax
	require_once "../controladores/categoria.controlador.php";
	require_once "../modelos/categoria.modelo.php";

	class TablaCategoria{

	/*=============================================
	//tag: MOSTRAR LA TABLA DE CATEGORIA
	=============================================*/

		public function mostrarTablaCategoria(){	

			$item = null;
			$valor = null;

			$categoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);
			//echo "total de detalle: ".count($categoria);
			$datosJson = '{ 
				"data": [ ';

				for($i = 0; $i < count($categoria); $i++){ 

					/*=============================================
					//note: AGREGAR ETIQUETAS DE ESTADO
					=============================================*/

					if($categoria[$i]["estado"] == 0){
						$colorEstado = "btn-danger";
						$textoEstado = "Desactivado";
						$estadoCategoria = 1;
					}else{
						$colorEstado = "btn-success";
						$textoEstado = "Activado";
						$estadoCategoria = 0;
					}

					$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idCategoria='".$categoria[$i]["idcategoria"]."' estadoCategoria='".$estadoCategoria."'>".$textoEstado."</button>";

					/*=============================================
					//note: TRAER LAS ACCIONES
					=============================================*/
					$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria center' idCategoria='".$categoria[$i]["idcategoria"]."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-edit'></i></button></div>";

					/*=============================================
					//note: DEVOLVER DATOS JSON
					=============================================*/
					
					$datosJson	 .= '[
						"'.($i+1).'",
						"'.$categoria[$i]["descripcion"].'",
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
	//tag: ACTIVAR TABLA DE CATEGORIA
	=============================================*/ 
	$activar = new TablaCategoria();
	$activar -> mostrarTablaCategoria(); 