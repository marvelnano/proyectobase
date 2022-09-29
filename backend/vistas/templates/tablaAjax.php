<?php

	//TODO: Template Tabla Ajax
	require_once "../controladores/{CONTROLADORMIN}.controlador.php";
	require_once "../modelos/{CONTROLADORMIN}.modelo.php";

	class Tabla{CONTROLADOR}{

	/*=============================================
	//tag: MOSTRAR LA TABLA DE {CONTROLADORMAY}
	=============================================*/

		public function mostrarTabla{CONTROLADOR}(){	

			$item = null;
			$valor = null;

			${CONTROLADORMIN} = Controlador{CONTROLADOR}::ctrMostrar{CONTROLADOR}($item, $valor);
			//echo "total de detalle: ".count(${CONTROLADORMIN});
			$datosJson = '{ 
				"data": [ ';

				for($i = 0; $i < count(${CONTROLADORMIN}); $i++){ 

					/*=============================================
					//note: AGREGAR ETIQUETAS DE ESTADO
					=============================================*/

					if(${CONTROLADORMIN}[$i]["estado"] == 0){
						$colorEstado = "btn-danger";
						$textoEstado = "Desactivado";
						$estado{CONTROLADOR} = 1;
					}else{
						$colorEstado = "btn-success";
						$textoEstado = "Activado";
						$estado{CONTROLADOR} = 0;
					}

					$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' id{CONTROLADOR}='".${CONTROLADORMIN}[$i]["id{CONTROLADORMIN}"]."' estado{CONTROLADOR}='".$estado{CONTROLADOR}."'>".$textoEstado."</button>";

					/*=============================================
					//note: TRAER LAS ACCIONES
					=============================================*/
					$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditar{CONTROLADOR} center' id{CONTROLADOR}='".${CONTROLADORMIN}[$i]["id{CONTROLADORMIN}"]."' data-toggle='modal' data-target='#modalEditar{CONTROLADOR}'><i class='fa fa-edit'></i></button></div>";

					/*=============================================
					//note: DEVOLVER DATOS JSON
					=============================================*/
					
					$datosJson	 .= '[
						"'.($i+1).'",
						"'.${CONTROLADORMIN}[$i]["descripcion"].'",
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
	//tag: ACTIVAR TABLA DE {CONTROLADORMAY}
	=============================================*/ 
	$activar = new Tabla{CONTROLADOR}();
	$activar -> mostrarTabla{CONTROLADOR}(); 