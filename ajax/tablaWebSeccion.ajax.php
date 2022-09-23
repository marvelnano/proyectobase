<?php

require_once "../controladores/webseccion.controlador.php";
require_once "../modelos/webseccion.modelo.php";

class TablaWebSeccion{

  /*=============================================
  MOSTRAR LA TABLA DE WEB SECCIONES
  =============================================*/

	public function mostrarTablaWebSeccion(){	

		$item = null;
		$valor = null;

		$websecciones = ControladorWebSeccion::ctrMostrarWebSecciones($item, $valor);
		//echo "total de detalle: ".count($websecciones);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count($websecciones); $i++){ 

				/*=============================================
				AGREGAR ETIQUETAS DE ESTADO
				=============================================*/

				if($websecciones[$i]["estado"] == 0){

					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estadoWebSeccion = 1;

				}else{

					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estadoWebSeccion = 0;

				}

				$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idWebSeccion='".$websecciones[$i]["idplantillawebseccion"]."' estadoWebSeccion='".$estadoWebSeccion."'>".$textoEstado."</button>";

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarWebSeccion center' idWebSeccion='".$websecciones[$i]["idplantillawebseccion"]."' data-toggle='modal' data-target='#modalEditarWebSeccion'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.$websecciones[$i]["descripcion"].'",
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
ACTIVAR TABLA DE WEB SECCIONES
=============================================*/ 
$activar = new TablaWebSeccion();
$activar -> mostrarTablaWebSeccion(); 