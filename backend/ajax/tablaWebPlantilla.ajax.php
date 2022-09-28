<?php

require_once "../controladores/negocio.controlador.php";
require_once "../modelos/negocio.modelo.php";

require_once "../controladores/webseccion.controlador.php";
require_once "../modelos/webseccion.modelo.php";

require_once "../controladores/webplantilla.controlador.php";
require_once "../modelos/webplantilla.modelo.php";

class tablaWebPlantilla{

  /*=============================================
  MOSTRAR LA TABLA DE NEGOCIOS
  =============================================*/

	public function mostrarTablaWebPlantilla(){	

		$item = null;
		$valor = null;

		$webplantillas = ControladorWebPlantilla::ctrMostrarPlantillasWeb($item, $valor);
		//echo "total de detalle: ".count($webplantillas);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count($webplantillas); $i++){ 

				/*=============================================
				AGREGAR ETIQUETAS DE ESTADO
				=============================================*/

				if($webplantillas[$i]["estado"] == 0){

					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estadoWebPlantilla = 1;

				}else{

					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estadoWebPlantilla = 0;

				}

				$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idWebPlantilla='".$webplantillas[$i]["idplantillaweb"]."' estadoWebPlantilla='".$estadoWebPlantilla."'>".$textoEstado."</button>";

				/*=============================================
				TRAER NEGOCIO
				mdlMostrarNegocios(campo1,contenidoaguardar1)
				=============================================*/
				$item = "idnegocio";
				$valor = $webplantillas[$i]["idnegocio"]; 
				//echo "razon_social: ".$valor;
				$traerNegocio = ControladorNegocio::ctrMostrarNegocios($item, $valor);
				$negocio = $traerNegocio[0]["razon_social"];

				/*=============================================
				TRAER SECCION WEB
				mdlMostrarSeccionesWeb(campo1,contenidoaguardar1)
				=============================================*/
				$item = "idplantillawebseccion";
				$valor = $webplantillas[$i]["idplantillawebseccion"]; 
				//echo "razon_social: ".$valor;
				$traerSeccionWeb = ControladorWebSeccion::ctrMostrarWebSecciones($item, $valor);
				$seccionweb = $traerSeccionWeb[0]["descripcion"];

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarWebPlantilla center' idWebPlantilla='".$webplantillas[$i]["idplantillaweb"]."' data-toggle='modal' data-target='#modalEditarWebPlantilla'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/

				//$contenido = '<script> $(".textarea").summernote("code"); </script>';
				//"'.$webplantillas[$i]["contenido"].'",
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.$negocio.'",
					"'.$seccionweb.'",					
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
ACTIVAR TABLA DE NEGOCIOS
=============================================*/ 
$activar = new tablaWebPlantilla();
$activar -> mostrarTablaWebPlantilla(); 