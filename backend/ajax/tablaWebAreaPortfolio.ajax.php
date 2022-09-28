<?php

require_once "../controladores/webareaportfolio.controlador.php";
require_once "../modelos/webareaportfolio.modelo.php";

class TablaWebAreaPortfolio{

  /*=============================================
  MOSTRAR LA TABLA DE WEB ÁREA PORTFOLIOS
  =============================================*/

	public function mostrarTablaWebAreaPortfolio(){	

		$item = null;
		$valor = null;

		$webareaportfolios = ControladorWebAreaPortfolio::ctrMostrarWebAreaPortfolios($item, $valor);
		//echo "total de detalle: ".count($webareaportfolios);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count($webareaportfolios); $i++){ 

				/*=============================================
				AGREGAR ETIQUETAS DE ESTADO
				=============================================*/

				if($webareaportfolios[$i]["estado"] == 0){

					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estadoWebAreaPortfolio = 1;

				}else{

					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estadoWebAreaPortfolio = 0;

				}

				$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idWebAreaPortfolio='".$webareaportfolios[$i]["idplantillawebareaportfolio"]."' estadoWebAreaPortfolio='".$estadoWebAreaPortfolio."'>".$textoEstado."</button>";

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarWebAreaPortfolio center' idWebAreaPortfolio='".$webareaportfolios[$i]["idplantillawebareaportfolio"]."' data-toggle='modal' data-target='#modalEditarWebAreaPortfolio'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.$webareaportfolios[$i]["descripcion"].'",
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
ACTIVAR TABLA DE WEB ÁREA PORTFOLIOS
=============================================*/ 
$activar = new TablaWebAreaPortfolio();
$activar -> mostrarTablaWebAreaPortfolio(); 