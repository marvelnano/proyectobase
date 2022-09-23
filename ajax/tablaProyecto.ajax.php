<?php

require_once "../controladores/proyecto.controlador.php";
require_once "../modelos/proyecto.modelo.php";

class TablaProyecto{

  /*=============================================
  MOSTRAR LA TABLA DE PROYECTOS
  =============================================*/

	public function mostrarTablaProyecto(){	

		$item = null;
		$valor = null;

		$proyectos = ControladorProyecto::ctrMostrarProyectos($item, $valor);
		//echo "total de detalle: ".count($proyectos);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count($proyectos); $i++){ 

				/*=============================================
				TRAER UBIGEO
				ctrMostrarUbigeo(campo1,contenidoaguardar1)
				=============================================*/
				$item = "idubigeo";
				$valor = $proyectos[$i]["idubigeo"]; 
				//echo "proveedor: ".$valor;
				$traerUbigeo = ControladorProyecto::ctrMostrarUbigeos($item, $valor);
				$ubigeo = $traerUbigeo[0]["descripcion"];

				/*=============================================
				ESTADO
				=============================================*/
				if($proyectos[$i]["estado"] == 1){
					$estado = 'Activado';
				}else{
					$estado = 'Desactivado';
				}

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProyecto center' idProyecto='".$proyectos[$i]["idproyecto"]."' data-toggle='modal' data-target='#modalEditarProyecto'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.$proyectos[$i]["ruc"].'",
					"'.$proyectos[$i]["razonsocial"].'",
					"'.$proyectos[$i]["nombrecomercial"].'",
					"'.$proyectos[$i]["abreviatura"].'",
					"'.$proyectos[$i]["email"].'",
					"'.$proyectos[$i]["telefono"].'",
					"'.$proyectos[$i]["web"].'",
					"'.$ubigeo.'",
					"'.$proyectos[$i]["direccion"].'",
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
ACTIVAR TABLA DE VENTAS
=============================================*/ 
$activar = new TablaProyecto();
$activar -> mostrarTablaProyecto(); 