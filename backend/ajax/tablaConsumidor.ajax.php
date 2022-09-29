<?php

	//TODO: Template Tabla Ajax
	require_once "../controladores/consumidor.controlador.php";
	require_once "../modelos/consumidor.modelo.php";

	class TablaConsumidor{

	/*=============================================
	//tag: MOSTRAR LA TABLA DE CONSUMIDOR
	=============================================*/

		public function mostrarTablaConsumidor(){	

			$item = null;
			$valor = null;

			$consumidor = ControladorConsumidor::ctrMostrarConsumidor($item, $valor);
			//echo "total de detalle: ".count($consumidor);
			$datosJson = '{ 
				"data": [ ';

				for($i = 0; $i < count($consumidor); $i++){ 

					/*=============================================
					//note: AGREGAR ETIQUETAS DE ESTADO
					=============================================*/

					if($consumidor[$i]["estado"] == 0){
						$colorEstado = "btn-danger";
						$textoEstado = "Desactivado";
						$estadoConsumidor = 1;
					}else{
						$colorEstado = "btn-success";
						$textoEstado = "Activado";
						$estadoConsumidor = 0;
					}

					$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idConsumidor='".$consumidor[$i]["idconsumidor"]."' estadoConsumidor='".$estadoConsumidor."'>".$textoEstado."</button>";

					/*=============================================
					//note: TRAER LAS ACCIONES
					=============================================*/
					$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarConsumidor center' idConsumidor='".$consumidor[$i]["idconsumidor"]."' data-toggle='modal' data-target='#modalEditarConsumidor'><i class='fa fa-edit'></i></button></div>";

					/*=============================================
					//note: DEVOLVER DATOS JSON
					=============================================*/
					
					$datosJson	 .= '[
						"'.($i+1).'",
						"'.$consumidor[$i]["descripcion"].'",
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
	//tag: ACTIVAR TABLA DE CONSUMIDOR
	=============================================*/ 
	$activar = new TablaConsumidor();
	$activar -> mostrarTablaConsumidor(); 