<?php

require_once "../controladores/nivelusuario.controlador.php";
require_once "../modelos/nivelusuario.modelo.php";

class TablaNivel{

  /*=============================================
  MOSTRAR LA TABLA DE NIVELES
  =============================================*/

	public function mostrarTablaNivel(){	

		$item = null;
		$valor = null;

		$niveles = ControladorNivel::ctrMostrarNiveles($item, $valor);
		//echo "total de detalle: ".count($niveles);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count($niveles); $i++){ 

				/*=============================================
				AGREGAR ETIQUETAS DE ESTADO
				=============================================*/

				if($niveles[$i]["estado"] == 0){

					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estadoNivel = 1;

				}else{

					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estadoNivel = 0;

				}

				$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idNivel='".$niveles[$i]["idnivelusuario"]."' estadoNivel='".$estadoNivel."'>".$textoEstado."</button>";

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarNivel center' idNivel='".$niveles[$i]["idnivelusuario"]."' data-toggle='modal' data-target='#modalEditarNivel'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.$niveles[$i]["descripcion"].'",
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
ACTIVAR TABLA DE NIVELES
=============================================*/ 
$activar = new TablaNivel();
$activar -> mostrarTablaNivel(); 