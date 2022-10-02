<?php
	
	date_default_timezone_set("America/Lima");
	//TODO: Template Controlador
	class ControladorCategoria{		
		
		public $time;
		//echo date("d/m/Y_H-i-s", $time);

		/*=============================================
		//tag: MOSTRAR CATEGORIA
		=============================================*/

		static public function ctrMostrarCategoria($item, $valor){
			$tabla = "categoria";

			$respuesta = ModeloCategoria::mdlMostrarCategoria($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR CATEGORIA
		=============================================*/

		static public function ctrCrearCategoria(){
			//echo 'llego a categoria: ';
			//$time = time();
			//echo date("dmY_His", $time);
			if(isset($_POST["nuevaCategoria"])){
				echo 'capo categoria: '.$_POST["nuevaCategoria"];
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = "";

				if(isset($_FILES["nuevaImagen"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/categorias/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/categorias/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "categoria";

				$datosCategoria = array(
					"descripcion"=>$_POST["nuevaCategoria"],
					"imagen"=>$ruta
				);	

				$respuesta = ModeloCategoria::mdlIngresarCategoria($tabla, $datosCategoria);
				
				if($respuesta == "ok"){
					echo '<script>
						Swal.fire({
							type: "success",
							title: "¡La categoría ha sido guardada correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "categoria";
							}
						});	
					</script>';
				}	
				
				//return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR CATEGORIA
		=============================================*/

		static public function ctrEditarCategoria(){
			if(isset($_POST["idCategoria"])){		
				
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = $_POST["imagenActual"];

				if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					//note: PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"])){
						unlink($_POST["imagenActual"]);
					}/*else{
						mkdir($directorio, 0755);
					}*/

					/*=============================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/categorias/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/categorias/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "categoria";

				$datosCategoria = array(
					"idcategoria"=> $_POST["idCategoria"],
					"descripcion"=> $_POST["editarCategoria"],
					"imagen"=> $ruta
				);

				$respuesta = ModeloCategoria::mdlEditarCategoria($tabla, $datosCategoria);
				
				if($respuesta === "ok"){
					echo'<script>
					Swal.fire({
						icon: "success",
						title: "La categoría ha sido editada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "categoria";
							}
						})
					</script>';
				}
				
				//return $respuesta;
			}
		}

	}