<?php

require_once "../controladores/rubronegocio.controlador.php";
require_once "../modelos/rubronegocio.modelo.php";

require_once "../controladores/negocio.controlador.php";
require_once "../modelos/negocio.modelo.php";

class TablaNegocio{

  /*=============================================
  MOSTRAR LA TABLA DE NEGOCIOS
  =============================================*/

	public function mostrarTablaNegocio(){	

		$item = null;
		$valor = null;

		$negocios = ControladorNegocio::ctrMostrarNegocios($item, $valor);
		//echo "total de detalle: ".count($negocios);
		$datosJson = '{ 
			"data": [ ';

			for($i = 0; $i < count($negocios); $i++){ 

				/*=============================================
				AGREGAR ETIQUETAS DE ESTADO
				=============================================*/

				if($negocios[$i]["estado"] == 0){

					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estadoNegocio = 1;

				}else{

					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estadoNegocio = 0;

				}

				$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idNegocio='".$negocios[$i]["idnegocio"]."' estadoNegocio='".$estadoNegocio."'>".$textoEstado."</button>";

				/*=============================================
				TRAER RUBRONEGOCIO
				mdlMostrarRubros(campo1,contenidoaguardar1)
				=============================================*/
				$item = "idrubronegocio";
				$valor = $negocios[$i]["idrubronegocio"]; 
				//echo "proveedor: ".$valor;
				$traerRubro = ControladorRubro::ctrMostrarRubros($item, $valor);
				$rubro = $traerRubro[0]["descripcion"];

				/*=============================================
				TRAER LAS ACCIONES
				=============================================*/
				$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarNegocio center' idNegocio='".$negocios[$i]["idnegocio"]."' data-toggle='modal' data-target='#modalEditarNegocio'><i class='fa fa-edit'></i></button></div>";

				/*=============================================
				DEVOLVER DATOS JSON
				=============================================*/

				//$contenido = '<script> $(".textarea").summernote("code"); </script>';
				
				$datosJson	 .= '[
					"'.($i+1).'",
					"'.$rubro.'",
					"'.$negocios[$i]["ruc"].'",
					"'.$negocios[$i]["razon_social"].'",					
					"'.$negocios[$i]["direccion"].'",
					"'.$negocios[$i]["celular"].'",
					"'.$negocios[$i]["email"].'",
					"'.$negocios[$i]["pagina_web"].'",
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
$activar = new TablaNegocio();
$activar -> mostrarTablaNegocio(); 