<?php

	date_default_timezone_set("America/Lima");
	//TODO: Template Controlador
	class ControladorConsumidor{

		public $time;
		//echo date("d/m/Y_H-i-s", $time);

		/*=============================================
		//tag: MOSTRAR CONSUMIDOR
		=============================================*/

		static public function ctrMostrarConsumidor($item, $valor){
			$tabla = "consumidor";

			$respuesta = ModeloConsumidor::mdlMostrarConsumidor($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR CONSUMIDOR
		=============================================*/

		static public function ctrCrearConsumidor(){
			//$time = time();
			//echo date("dmY_His", $time);
			if(isset($_POST["nuevoConsumidor"])){

				//echo 'capo consumidor: '.$_POST["nuevoConsumidor"];
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = "";

				if(isset($_FILES["nuevaImgConsumidor"]["tmp_name"]) && !empty($_FILES["nuevaImgConsumidor"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImgConsumidor"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImgConsumidor"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/consumidores/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImgConsumidor"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImgConsumidor"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/consumidores/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImgConsumidor"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "consumidor";

				$datosConsumidor = array(
					"descripcion"=>$_POST["nuevoConsumidor"],
					"imagen"=>$ruta
				);	

				$respuesta = ModeloConsumidor::mdlIngresarConsumidor($tabla, $datosConsumidor);
				
				if($respuesta == "ok"){
					echo '<script>
						Swal.fire({
							type: "success",
							title: "¡El consumidor ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "consumidor";
							}
						});	
					</script>';
				}

				//return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR CONSUMIDOR
		=============================================*/

		static public function ctrEditarConsumidor(){
			if(isset($_POST["idConsumidor"])){	
				
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = $_POST["imgActual"];

				if(isset($_FILES["editarImg"]["tmp_name"]) && !empty($_FILES["editarImg"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImg"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					//note: PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imgActual"])){
						unlink($_POST["imgActual"]);
					}/*else{
						mkdir($directorio, 0755);
					}*/

					/*=============================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImg"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/consumidores/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImg"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImg"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/consumidores/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["editarImg"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "consumidor";

				$datosConsumidor = array(
					"idconsumidor"=> $_POST["idConsumidor"],
					"descripcion"=> $_POST["editarConsumidor"],
					"imagen"=> $ruta
				);

				$respuesta = ModeloConsumidor::mdlEditarConsumidor($tabla, $datosConsumidor);
				
				if($respuesta === "ok"){
					echo'<script>
					Swal.fire({
						icon: "success",
						title: "El consumidor ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "consumidor";
							}
						})
					</script>';
				}

				//return $respuesta;
			}
		}

	}