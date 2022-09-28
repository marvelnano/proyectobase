<?php

class ControladorDesign{

	/*=============================================
	SELECCIONAR PLANTILLA
	=============================================*/

	static public function ctrSeleccionarPlantilla(){

		$tabla = "plantilla";

		$respuesta = ModeloDesign::mdlSeleccionarPlantilla($tabla);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR ARCHIVO
	=============================================*/

	static public function ctrSubirArchivo($valor, $item){

		/*=============================================
		CAMBIANDO ARCHIVO
		=============================================*/	

		//$valorNuevo = $valor;

		if(isset($valor["tmp_name"])){

			/*=============================================
			SUBIENDO ARCHIVO
			=============================================*/	
		
			//unlink("../../../ecommercedata/facturacion/".$valor["tmp_name"]);

			//$fileTmpPath = $valor['tmp_name']; //ruta origen del archivo
			$fileName = $valor['name']; //nombre del archivo
			//$fileSize = $valor['size']; //tamaño del archivo
			//$fileType = $valor['type']; // tipo de archio
			$fileNameCmps = explode(".", $fileName); 
			$fileExtension = strtolower(end($fileNameCmps)); //extensión del archivo

			$fileTmpPath = $valor['tmp_name'];

			$uploadFileDir = '../../../ecommercedata/facturacion/';
			
			$newFileName = $item.".".$fileExtension;//md5(time() . $fileName) . '.' . $fileExtension;
			
			$dest_path = $uploadFileDir . $newFileName;
 
			if(move_uploaded_file($fileTmpPath, $dest_path))
			{
			  $respuesta = "ok";
			}
			else
			{
			  $respuesta = "error";
			}			

		}		

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR LOGO O ICONO O PORTADA DE CATEGORIA
	=============================================*/

	static public function ctrActualizarLogoIcono($item, $valor){

		$tabla = "plantilla";
		$id = 1;

		$plantilla = ModeloDesign::mdlSeleccionarPlantilla($tabla);

		/*=============================================
		CAMBIANDO LOGOTIPO O ICONO
		=============================================*/	

		$valorNuevo = $valor;

		if(isset($valor["tmp_name"])){

			list($ancho, $alto) = getimagesize($valor["tmp_name"]);

			/*=============================================
			CAMBIANDO LOGOTIPO
			=============================================*/	

			if($item == "logo"){

				unlink("../".$plantilla["logo"]);

				$nuevoAncho = $ancho; //500
				$nuevoAlto = $alto; //100

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				if($valor["type"] == "image/jpeg"){

					$ruta = "vistas/img/plantilla/logo.jpg";

					$origen = imagecreatefromjpeg($valor["tmp_name"]);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, "../".$ruta);

				}

				if($valor["type"] == "image/png"){

					$ruta = "vistas/img/plantilla/logo.png";

					$origen = imagecreatefrompng($valor["tmp_name"]);

					imagealphablending($destino, FALSE);

					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, "../".$ruta);

				}

			}

			/*=============================================
			CAMBIANDO ICONO
			=============================================*/	

			if($item == "icono"){

				unlink("../".$plantilla["icono"]);

				$nuevoAncho = 100;
				$nuevoAlto = 100;

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				if($valor["type"] == "image/jpeg"){

					$ruta = "vistas/img/plantilla/icono.jpg";

					$origen = imagecreatefromjpeg($valor["tmp_name"]);					

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
			
				}

				if($valor["type"] == "image/png"){

					$ruta = "vistas/img/plantilla/icono.png";

					$origen = imagecreatefrompng($valor["tmp_name"]);

					imagealphablending($destino, FALSE);
        			
        			imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, "../".$ruta);
			
				}

			}

			/*=============================================
			CAMBIANDO PORTADA DE CATEGORIA
			=============================================*/	

			if($item == "categoria"){

				unlink("../".$plantilla["categoria"]);

				$nuevoAncho = 100;
				$nuevoAlto = 100;

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				if($valor["type"] == "image/jpeg"){

					$ruta = "vistas/img/cabeceras/default/default.jpg";

					$origen = imagecreatefromjpeg($valor["tmp_name"]);					

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, "../".$ruta);
			
				}

				if($valor["type"] == "image/png"){

					$ruta = "vistas/img/cabeceras/default/default.jpg";

					$origen = imagecreatefrompng($valor["tmp_name"]);

					imagealphablending($destino, FALSE);
        			
        			imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, "../".$ruta);
			
				}

			}

			$valorNuevo = substr($ruta, 0);

		}

		$respuesta = ModeloDesign::mdlActualizarLogoIcono($tabla, $id, $item, $valorNuevo);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR COLORES
	=============================================*/

	static public function ctrActualizarColores($datos){

		$tabla = "plantilla";
		$id = 1;

		$respuesta = ModeloDesign::mdlActualizarColores($tabla, $id, $datos);

		return $respuesta;


	}

	/*=============================================
	ACTUALIZAR SCRIPT
	=============================================*/

	static public function ctrActualizarScript($datos){

		$tabla = "plantilla";
		$id = 1;

		$respuesta = ModeloDesign::mdlActualizarScript($tabla, $id, $datos);

		return $respuesta;


	}

	/*=============================================
	SELECCIONAR DESIGN - NO USADO
	=============================================*/

	static public function ctrSeleccionarDesign(){

		$tabla = "plantilla";

		$respuesta = ModeloDesign::mdlSeleccionarDesign($tabla);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR INFORMACION
	=============================================*/

	static public function ctrActualizarInformacion($datos){

		$tabla = "plantilla";
		$id = 1;

		$respuesta = ModeloDesign::mdlActualizarInformacion($tabla, $id, $datos);

		return $respuesta;


	}

	/*=============================================
	SELECCIONAR COMPROBANTE
	=============================================*/

	static public function ctrMostrarComprobantes($item, $valor){

		$tabla = "comprobante_serie";

		$respuesta = ModeloDesign::mdlMostrarComprobantes($tabla, $item, $valor);

		return $respuesta;

	}


}


