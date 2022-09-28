<?php

require_once "../controladores/rubronegocio.controlador.php";
require_once "../modelos/rubronegocio.modelo.php";

class TablaRubro{

  /*=============================================
  MOSTRAR LA TABLA DE RUBROS
  =============================================*/

	public function mostrarTablaRubro(){	

		$item = null;
		$valor = null;

		$rubros = ControladorRubro::ctrMostrarRubros($item, $valor);
		//echo "total de detalle: ".count($rubros);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count($rubros); $i++){ 

				/*=============================================
				AGREGAR ETIQUETAS DE ESTADO
				=============================================*/

				if($rubros[$i]["estado"] == 0){

					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estadoRubro = 1;

				}else{

					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estadoRubro = 0;

				}

				$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idRubro='".$rubros[$i]["idrubronegocio"]."' estadoRubro='".$estadoRubro."'>".$textoEstado."</button>";

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarRubro center' idRubro='".$rubros[$i]["idrubronegocio"]."' data-toggle='modal' data-target='#modalEditarRubro'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.$rubros[$i]["descripcion"].'",
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
ACTIVAR TABLA DE RUBROS
=============================================*/ 
$activar = new TablaRubro();
$activar -> mostrarTablaRubro(); 