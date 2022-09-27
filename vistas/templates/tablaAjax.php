<?php

require_once "../controladores/{CONTROLADORMIN}.controlador.php";
require_once "../modelos/{CONTROLADORMIN}.modelo.php";

class Tabla{CONTROLADOR}{

  /*=============================================
  MOSTRAR LA TABLA DE {CONTROLADORMAY}
  =============================================*/

	public function mostrarTabla{CONTROLADOR}(){	

		$item = null;
		$valor = null;

		${CONTROLADORMIN}s = Controlador{CONTROLADOR}::ctrMostrar{CONTROLADOR}($item, $valor);
		//echo "total de detalle: ".count(${CONTROLADORMIN}s);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count(${CONTROLADORMIN}s); $i++){ 

				/*=============================================
				AGREGAR ETIQUETAS DE ESTADO
				=============================================*/

				if(${CONTROLADORMIN}s[$i]["estado"] == 0){

					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estado{CONTROLADOR} = 1;

				}else{

					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estado{CONTROLADOR} = 0;

				}

				$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' id{CONTROLADOR}='".${CONTROLADORMIN}s[$i]["id{CONTROLADORMIN}"]."' estado{CONTROLADOR}='".$estado{CONTROLADOR}."'>".$textoEstado."</button>";

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditar{CONTROLADOR} center' id{CONTROLADOR}='".${CONTROLADORMIN}s[$i]["id{CONTROLADORMIN}"]."' data-toggle='modal' data-target='#modalEditar{CONTROLADOR}'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.${CONTROLADORMIN}s[$i]["descripcion"].'",
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
ACTIVAR TABLA DE {CONTROLADORMAY}
=============================================*/ 
$activar = new Tabla{CONTROLADOR}();
$activar -> mostrarTabla{CONTROLADOR}(); 