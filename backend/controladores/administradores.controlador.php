<?php

class ControladorAdministradores{

	/*=============================================
	//tag: INGRESO ADMINISTRADORES
	=============================================*/
    public function ctrIngresoAdministrador(){

		//echo "email: ".$_POST["ingEmail"];

        if(isset($_POST["ingEmail"])){

			//preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
			   
			   $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
						
				$tabla = "usuario";
				$item = "email";
				$valor = $_POST["ingEmail"];

				$respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);

				if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){
					if($respuesta["estado"] == 1){
						$_SESSION["validarSesionBackend"] = "ok";
						$_SESSION["id"] = $respuesta["idusuario"];
						$_SESSION["nombre"] = $respuesta["nombre_completo"];
						$_SESSION["foto"] = ($respuesta["foto"] == ''?"vistas/img/usuarios/default/anonymous.png":$respuesta["foto"]);
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["password"] = $respuesta["password"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						echo '<script>
							window.location = "inicio";
						</script>';
					}else{
						echo '<br>
						<div class="alert alert-warning">Este usuario aún no está activado</div>';
					}
				}else{
					echo '<br>
					<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
				}
			}
		}
	}
	
	/*=============================================
	//tag: MOSTRAR ADMINISTRADORES
	=============================================*/

	static public function ctrMostrarAdministradores($item, $valor){

		$tabla = "usuario";

		$respuesta = ModeloAdministradores::MdlMostrarAdministradores($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	//tag: REGISTRO DE PERFIL
	=============================================*/

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoPerfil"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

			   	/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/perfiles/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/perfiles/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuario";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre_completo" => $_POST["nuevoNombre"],
					           "email" => $_POST["nuevoEmail"],
							   "password" => $encriptar,
							   "clave_inicial" => $_POST["nuevoPassword"],
					           "perfil" => $_POST["nuevoPerfil"],			       
					           "foto"=>$ruta,
					           "estado" => 1);

				$respuesta = ModeloAdministradores::mdlIngresarUsuario($tabla, $datos);
			
				if($respuesta == "ok"){
					echo '<script>
						Swal.fire({
							icon: "success",
							title: "¡El usuario ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "administrador";
							}
						});	
					</script>';
				}	
			}else{

				echo '<script>
					Swal.fire({
						icon: "error",
						title: "¡El perfil no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){							
							window.location = "administrador";
						}
					});		
				</script>';
			}
		}
	}

	/*=============================================
	//tag: EDITAR PERFIL
	=============================================*/

	static public function ctrEditarPerfil(){
		
		if(isset($_POST["idPerfil"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					//note: PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){
						unlink($_POST["fotoActual"]);
					}/*else{
						mkdir($directorio, 0755);
					}*/

					/*=============================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/perfiles/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/perfiles/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuario";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{
						echo'<script>
							Swal.fire({
								icon: "error",
								title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then(function(result) {
								if (result.value) {
									window.location = "administrador";
								}
							})
						</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				//echo'<script> alert("id "+"'.$_POST["idPerfil"].'");</script>';

				$datos = array("idusuario" => $_POST["idPerfil"],
							   "nombre_completo" => $_POST["editarNombre"],
							   "email" => $_POST["editarEmail"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);
				//echo'<script> alert("id1 "+"'.$datos["id"].'");</script>';
				$respuesta = ModeloAdministradores::mdlEditarPerfil($tabla, $datos);
				//echo "respuesta: ".$respuesta;
				if($respuesta === "ok"){

					echo'<script>
					Swal.fire({
						  icon: "success",
						  title: "El perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "administrador";
							}
						})
					</script>';

				}


			}else{

				echo'<script>
					Swal.fire({
						icon: "error",
						title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result) {
						if (result.value) {
							window.location = "administrador";
						}
					})
			  	</script>';

			}

		}

	}

	/*=============================================
	//tag: ELIMINAR PERFIL
	=============================================*/

	static public function ctrEliminarPerfil(){
		if(isset($_GET["idPerfil"])){
			$tabla ="usuario";
			$datos = $_GET["idPerfil"];

			if($_GET["fotoPerfil"] != ""){
				unlink($_GET["fotoPerfil"]);			
			}

			$respuesta = ModeloAdministradores::mdlEliminarPerfil($tabla, $datos);

			if($respuesta == "ok"){
				echo'<script>
					Swal.fire({
						icon: "success",
					  	title: "El perfil ha sido borrado correctamente",
					  	showConfirmButton: true,
					  	confirmButtonText: "Cerrar",
					  	closeOnConfirm: false
					}).then(function(result) {
						if (result.value) {
							window.location = "administrador";
						}
					})
				</script>';
			}		

		}

	}
	
	/*=============================================
	//tag: MOSTRAR USUARIOS
	=============================================*/
	static public function ctrMostrarUsuarios($item, $valor){
		$tabla = "usuario";
		$respuesta = ModeloAdministradores::mdlMostrarUsuarios($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	//tag: REGISTRO DE NUEVO USUARIO
	=============================================*/
	static public function ctrRegistroUsuario(){
		if(isset($_POST["regNombres"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regNombres"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

			   	/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/
				$ruta = "";
				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/perfiles/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);				
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){
						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/perfiles/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuario";
				$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datos = array("nombre_completo" => $_POST["regNombres"],
					           "email" => $_POST["regEmail"],
							   "password" => $encriptar,
							   "clave_inicial" => $_POST["regPassword"],
					           "perfil" => '20220003',			       
					           "foto"=>$ruta,
					           "estado" => 1);
				$respuesta = ModeloAdministradores::mdlIngresarUsuario($tabla, $datos);
			
				if($respuesta == "ok"){
					echo '<script>
						Swal.fire({
							icon: "success",
							title: "¡El usuario ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "usuario";
							}
						});	
					</script>';
				}	
			}else{
				echo '<script>
					Swal.fire({
						icon: "error",
						title: "¡El perfil no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){							
							window.location = "usuario";
						}
					});		
				</script>';
			}
		}
	}

	/*=============================================
	//tag: EDITAR USUARIO
	=============================================*/
	static public function ctrEditarUsuario(){		
		if(isset($_POST["idUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){
				/*=============================================
				//note: VALIDAR IMAGEN
				=============================================*/
				$ruta = $_POST["fotoActual"];
				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*======================================================
					//note: PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					======================================================*/
					if(!empty($_POST["fotoActual"])){
						unlink($_POST["fotoActual"]);
					}/*else{
						mkdir($directorio, 0755);
					}*/	

					/*========================================================================
					//note: DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					========================================================================*/
					if($_FILES["editarFoto"]["type"] == "image/jpeg"){
						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/perfiles/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);				
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES["editarFoto"]["type"] == "image/png"){
						/*=============================================
						//note: GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/perfiles/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);					
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuario";
				if($_POST["editarPassword"] != ""){
					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					}else{
						echo'<script>
							Swal.fire({
								icon: "error",
								title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then(function(result) {
								if (result.value) {
									window.location = "administrador";
								}
							})
						</script>';
					}
				}else{
					$encriptar = $_POST["passwordActual"];
				}

				//echo'<script> alert("id "+"'.$_POST["idUsuario"].'");</script>';
				$datos = array("idusuario" => $_POST["idUsuario"],
							   "nombre_completo" => $_POST["editarNombre"],
							   "email" => $_POST["editarEmail"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarUsuario"],
							   "foto" => $ruta);
				//echo'<script> alert("id1 "+"'.$datos["id"].'");</script>';
				$respuesta = ModeloAdministradores::mdlEditarPerfil($tabla, $datos);
				echo "respuesta: ".$respuesta;
				if($respuesta === "ok"){
					echo'<script>
						Swal.fire({
						  icon: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
							window.location = "usuario";
							}
						})
					</script>';
				}
			}else{
				echo'<script>
					Swal.fire({
						icon: "error",
						title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result) {
						if (result.value) {
						window.location = "usuario";
						}
					})
			  	</script>';
			}
		}
	}
}