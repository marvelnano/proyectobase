<?php

	//TODO: Template Controlador
	class ControladorProducto{

		public $time;
		//echo date("d/m/Y_H-i-s", $time);

		/*=============================================
		//tag: MOSTRAR PRODUCTO
		=============================================*/

		static public function ctrMostrarProducto($item, $valor){
			$tabla = "producto";

			$respuesta = ModeloProducto::mdlMostrarProducto($tabla,$item, $valor);
			return $respuesta;
		}

		/*=============================================
		//tag: CREAR PRODUCTO
		=============================================*/

		static public function ctrCrearProducto(){
			///$time = time();
			//echo date("dmY_His", $time);
			if(isset($_POST["nuevoTitulo"])){
				//echo 'llegó producto: '.$_POST["nuevoTitulo"];
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = "";

				if(isset($_FILES["nuevaImgProducto"]["tmp_name"]) && !empty($_FILES["nuevaImgProducto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImgProducto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*===============================================================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					===============================================================================*/

					if($_FILES["nuevaImgProducto"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/productos/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImgProducto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImgProducto"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/productos/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImgProducto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "producto";

				$datosProducto = array(
					"idnegocio"		=> $_POST["nuevoNegocio"],
					"idsubcategoria"=> $_POST["nuevaSubCategoria"],
					"idconsumidor"	=> $_POST["nuevoConsumidor"],
					"idmedida"		=> $_POST["nuevaMedida"],
					"titulo"		=> $_POST["nuevoTitulo"],
					"descripcion"	=> $_POST["nuevaDescripcion"],
					"codigo_sku"	=> $_POST["nuevoCodigoSku"],
					"precio_costo"	=> $_POST["nuevoPrecioCosto"],
					"precio_venta"	=> $_POST["nuevoPrecioVenta"],
					"precio_oferta"	=> $_POST["nuevoPrecioOferta"],
					"stock"			=> $_POST["nuevoStock"],
					"imagen"		=> $ruta
				);	

				$respuesta = ModeloProducto::mdlIngresarProducto($tabla, $datosProducto);
				
				if($respuesta == "ok"){
					echo'<script>
						Swal.fire({
							icon: "success",
							title: "El producto ha sido creado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "producto";
							}
						})
					</script>';
				}	
				
				//return $respuesta;		
			}
		}

		/*=============================================
		//tag: EDITAR PRODUCTO
		=============================================*/

		static public function ctrEditarProducto(){
			if(isset($_POST["idProducto"])){		
				
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/				
				$time = time();
				$ruta = $_POST["imgProductoActual"];

				if(isset($_FILES["editarImgProducto"]["tmp_name"]) && !empty($_FILES["editarImgProducto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImgProducto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*===========================================================
					//note: PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					===========================================================*/

					if(!empty($_POST["imgProductoActual"])){
						unlink($_POST["imgProductoActual"]);
					}/*else{
						mkdir($directorio, 0755);
					}*/

					/*===============================================================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					===============================================================================*/

					if($_FILES["editarImgProducto"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/productos/".$nuevoNombre.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgProducto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImgProducto"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$nuevoNombre = date("dmY_His", $time); //mt_rand(100,999);

						$ruta = "vistas/img/productos/".$nuevoNombre.".png";

						$origen = imagecreatefrompng($_FILES["editarImgProducto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "producto";

				$datosSubCategoria = array(
					"idproducto"	=> $_POST["idProducto"],
					"idnegocio"		=> $_POST["editarNegocio"],
					"idsubcategoria"=> $_POST["editarSubCategoria"],
					"idconsumidor"	=> $_POST["editarConsumidor"],
					"idmedida"		=> $_POST["editarMedida"],
					"titulo"		=> $_POST["editarTitulo"],
					"descripcion"	=> $_POST["editarDescripcion"],
					"codigo_sku"	=> $_POST["editarCodigoSku"],
					"precio_costo"	=> $_POST["editarPrecioCosto"],
					"precio_venta"	=> $_POST["editarPrecioVenta"],
					"precio_oferta"	=> $_POST["editarPrecioOferta"],
					"stock"			=> $_POST["editarStock"],
					"imagen"		=> $ruta
				);

				$respuesta = ModeloProducto::mdlEditarProducto($tabla, $datosSubCategoria);
				
				if($respuesta === "ok"){
					echo'<script>
						Swal.fire({
							icon: "success",
							title: "El producto ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "producto";
							}
						})
					</script>';
				}
				
				//return $respuesta;
			}
		}

	}