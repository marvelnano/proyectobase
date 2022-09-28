<?php

class ControladorWebPortfolio{
	
	/*=============================================
	MOSTRAR WEBPORTFOLIOS
	=============================================*/

	static public function ctrMostrarWebPortfolios($item, $valor){

		$tabla = "plantilla_web_portfolio";

		$respuesta = ModeloWebPortfolio::mdlMostrarWebPortfolios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	REGISTRO DE PERFIL
	=============================================*/

	static public function ctrCrearWebPortfolio(){

		if(isset($_POST["nuevadescripcion"])){

			/*=============================================
			VALIDAR IMAGEN
			=============================================*/

			$ruta = "";

			if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;


				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					date_default_timezone_set('America/Lima');
					$aleatorio = $_POST["idplantillaweb"].'_'.$_POST["idwebareaportfolio"].'_'.date("Ymd_His");

					$ruta = "vistas/img/portfolios/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);

				}

				if($_FILES["nuevaFoto"]["type"] == "image/png"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					date_default_timezone_set('America/Lima');
					$aleatorio = $_POST["idplantillaweb"].'_'.$_POST["idwebareaportfolio"].'_'.date("Ymd_His");

					$ruta = "vistas/img/portfolios/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}

			}

			$tabla = "plantilla_web_portfolio";

			if($_POST["descripcion"] == ""){
				echo'<script>
					Swal.fire({
						type: "error",
						title: "¡La descripción no puede ir vacía!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
						if (result.value) {
							window.location = "webportfolio";
						}
					})
				</script>';
			}

			//$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array("idplantillaweb" => $_POST["idplantillaweb"],
							"idplantillawebareaportfolio" => $_POST["idwebareaportfolio"],
							"descripcion" => $_POST["descripcion"],		       
							"imagen"=>$ruta);
			
			$respuesta = ModeloWebPortfolio::mdlIngresarWebPortfolio($tabla, $datos);
		
			if($respuesta == "ok"){

				echo '<script>
					Swal.fire({
						type: "success",
						title: "¡El portfolio web ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){						
							window.location = "webportfolio";
						}
					});		
				</script>';
			}				
		}
	}

	/*=============================================
	EDITAR WEBPORTFOLIO
	=============================================*/

	static public function ctrEditarWebPortfolio(){
		
		if(isset($_POST["idplantillaweb"])){

			/*=============================================
			VALIDAR IMAGEN
			=============================================*/

			$ruta = $_POST["fotoActual"];

			if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				=============================================*/

				if(!empty($_POST["fotoActual"])){
					unlink($_POST["fotoActual"]);
				}else{
					mkdir('vistas/img/portfolios', 0755); //$directorio
				}	

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["editarFoto"]["type"] == "image/jpeg"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					date_default_timezone_set('America/Lima');
					$aleatorio = $_POST["idplantillaweb"].'_'.$_POST["idwebareaportfolio"].'_'.date("Ymd_His");

					$ruta = "vistas/img/portfolios/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);

				}

				if($_FILES["editarFoto"]["type"] == "image/png"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					date_default_timezone_set('America/Lima');
					$aleatorio = $_POST["idplantillaweb"].'_'.$_POST["idwebareaportfolio"].'_'.date("Ymd_His");

					$ruta = "vistas/img/portfolios/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}

			}

			$tabla = "plantilla_web_portfolio";

			if($_POST["descripcion"] == ""){
				echo'<script>
					Swal.fire({
						type: "error",
						title: "¡La descripción no puede ir vacía!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
						if (result.value) {
							window.location = "webportfolio";
						}
					})
				</script>';
			}

			//echo'<script> alert("id "+"'.$_POST["idWebPortfolio"].'");</script>';

			$datos = array("idplantillawebportfolio" => $_POST["idwebportfolio"],
							"idplantillaweb" => $_POST["idplantillaweb"],
							"idplantillawebareaportfolio" => $_POST["idwebareaportfolio"],
							"descripcion" => $_POST["descripcion"],
							"imagen" => $ruta);
			//echo'<script> alert("id1 "+"'.$datos["id"].'");</script>';
			$respuesta = ModeloWebPortfolio::mdlEditarWebPortfolio($tabla, $datos);
			echo "respuesta: ".$respuesta;
			if($respuesta === "ok"){

				echo'<script>
					Swal.fire({
						icon: "success",
						title: "El portfolio web ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
						if (result.value) {
							window.location = "webportfolio";
						}
					})
				</script>';
			}
		}
	}

	/*=============================================
	ELIMINAR WEBPORTFOLIO
	=============================================*/

	static public function ctrEliminarWebPortfolio(){

		if(isset($_GET["idwebportfolio"])){

			$tabla ="plantilla_web_portfolio";
			$datos = $_GET["idwebportfolio"];

			if($_GET["fotoPerfil"] != ""){
				unlink($_GET["fotoPerfil"]);			
			}

			$respuesta = ModeloWebPortfolio::mdlEliminarWebPortfolio($tabla, $datos);

			if($respuesta == "ok"){
				echo'<script>
					Swal.fire({
						type: "success",
						title: "El portfolio web ha sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result) {
						if (result.value) {
							window.location = "webportfolio";
						}
					})
				</script>';
			}		

		}

	}

}