<?php
	
	date_default_timezone_set("America/Lima");
	//TODO: Template Controlador
	class ControladorSubCategoria{		
		
		public $time;
		//echo date("d/m/Y_H-i-s", $time);

		/*=============================================
		//tag: MOSTRAR SUBCATEGORIA
		=============================================*/

		static public function ctrMostrarSubCategoria($item, $valor){
			$tabla = "subcategoria";

			$respuesta = ModeloSubCategoria::mdlMostrarSubCategoria($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: MOSTRAR SUBCATEGORIAS POR CATEGORIA
		=============================================*/

		static public function ctrMostrarSubCategoriaXCategoria($item, $valor){
			$tabla = "subcategoria";

			$respuesta = ModeloSubCategoria::mdlMostrarSubCategoriaXCategoria($tabla, $item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR SUBCATEGORIA
		=============================================*/

		static public function ctrCrearSubCategoria(){
			///$time = time();
			//echo date("dmY_His", $time);
			if(isset($_POST["nuevaSubCategoria"])){
				//echo 'llegó subcategoria: '.$_POST["nuevaSubCategoria"];
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = "";

				if(isset($_FILES["nuevaImgSubCat"]["tmp_name"]) && !empty($_FILES["nuevaImgSubCat"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImgSubCat"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*===============================================================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					===============================================================================*/

					if($_FILES["nuevaImgSubCat"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/subcategorias/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImgSubCat"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImgSubCat"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/subcategorias/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImgSubCat"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "subcategoria";

				$datosSubCategoria = array(
					"idcategoria"=>$_POST["nuevaCategoria"],
					"descripcion"=>$_POST["nuevaSubCategoria"],
					"imagen"=>$ruta
				);	

				$respuesta = ModeloSubCategoria::mdlIngresarSubCategoria($tabla, $datosSubCategoria);
				
				if($respuesta == "ok"){
					echo'<script>
						Swal.fire({
							icon: "success",
							title: "La subcategoría ha sido creado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "subcategoria";
							}
						})
					</script>';
				}	
				
				//return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR SUBCATEGORIA
		=============================================*/

		static public function ctrEditarSubCategoria(){
			if(isset($_POST["idSubCategoria"])){		
				
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = $_POST["imgSubCatActual"];

				if(isset($_FILES["editarImgSubCat"]["tmp_name"]) && !empty($_FILES["editarImgSubCat"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImgSubCat"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*===========================================================
					//note: PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					===========================================================*/

					if(!empty($_POST["imgSubCatActual"])){
						unlink($_POST["imgSubCatActual"]);
					}/*else{
						mkdir($directorio, 0755);
					}*/

					/*===============================================================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					===============================================================================*/

					if($_FILES["editarImgSubCat"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/subcategorias/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgSubCat"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImgSubCat"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/subcategorias/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["editarImgSubCat"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "subcategoria";

				$datosSubCategoria = array(
					"idsubcategoria"=> $_POST["idSubCategoria"],
					"idcategoria"=> $_POST["editarCategoria"],
					"descripcion"=> $_POST["editarSubCategoria"],
					"imagen"=> $ruta
				);

				$respuesta = ModeloSubCategoria::mdlEditarSubCategoria($tabla, $datosSubCategoria);
				
				if($respuesta === "ok"){
					echo'<script>
						Swal.fire({
							icon: "success",
							title: "La subcategoría ha sido editada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "subcategoria";
							}
						})
					</script>';
				}
				
				//return $respuesta;
			}
		}

	}