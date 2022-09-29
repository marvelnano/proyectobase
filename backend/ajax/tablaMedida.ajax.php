<?php

	//TODO: Template Tabla Ajax
	require_once "../controladores/medida.controlador.php";
	require_once "../modelos/medida.modelo.php";

	class TablaMedida{

	/*=============================================
	//tag: MOSTRAR LA TABLA DE MEDIDA
	=============================================*/

		public function mostrarTablaMedida(){	

			$item = null;
			$valor = null;

			$medida = ControladorMedida::ctrMostrarMedida($item, $valor);
			//echo "total de detalle: ".count($medida);
			$datosJson = '{ 
				"data": [ ';

				for($i = 0; $i < count($medida); $i++){ 

					/*=============================================
					//note: AGREGAR ETIQUETAS DE ESTADO
					=============================================*/

					if($medida[$i]["estado"] == 0){
						$colorEstado = "btn-danger";
						$textoEstado = "Desactivado";
						$estadoMedida = 1;
					}else{
						$colorEstado = "btn-success";
						$textoEstado = "Activado";
						$estadoMedida = 0;
					}

					$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idMedida='".$medida[$i]["idmedida"]."' estadoMedida='".$estadoMedida."'>".$textoEstado."</button>";

					/*=============================================
					//note: TRAER LAS ACCIONES
					=============================================*/
					$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarMedida center' idMedida='".$medida[$i]["idmedida"]."' data-toggle='modal' data-target='#modalEditarMedida'><i class='fa fa-edit'></i></button></div>";

					/*=============================================
					//note: DEVOLVER DATOS JSON
					=============================================*/
					
					$datosJson	 .= '[
						"'.($i+1).'",
						"'.$medida[$i]["descripcion"].'",
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
	//tag: ACTIVAR TABLA DE MEDIDA
	=============================================*/ 
	$activar = new TablaMedida();
	$activar -> mostrarTablaMedida(); 