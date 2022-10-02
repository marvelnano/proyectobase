<?php

require_once "conexion.php";

class ModeloAdministradores{

	/*=============================================
	//tag: MOSTRAR USUARIOS
	=============================================*/
	static public function mdlMostrarUsuarios($tabla, $item, $valor){
		$conexion = new Conexion();
		$itemdb = "u.".$item;

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT u.idusuario, u.idnivelusuario, u.nombre_completo, u.foto, u.email, u.password, 
			u.estado, n.descripcion as perfil FROM $tabla u INNER JOIN nivel_usuario n on n.idnivelusuario = u.idnivelusuario  
			WHERE $itemdb = :$item AND u.idnivelusuario = '20220003'");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT u.idusuario, u.idnivelusuario, u.nombre_completo, u.foto, u.email, u.password, 
			u.estado, n.descripcion as perfil FROM $tabla u INNER JOIN nivel_usuario n on n.idnivelusuario = u.idnivelusuario 
			WHERE u.idnivelusuario = '20220003'");

			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	//tag: MOSTRAR ADMINISTRADORES
	=============================================*/
	static public function mdlMostrarAdministradores($tabla, $item, $valor){
		$conexion = new Conexion();
		$itemdb = "u.".$item;

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT u.idusuario, u.idnivelusuario, u.nombre_completo, u.foto, u.email, u.password, 
			u.estado, n.descripcion as perfil FROM $tabla u INNER JOIN nivel_usuario n on n.idnivelusuario = u.idnivelusuario  
			WHERE $itemdb = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT u.idusuario, u.idnivelusuario, u.nombre_completo, u.foto, u.email, u.password, 
			u.estado, n.descripcion as perfil FROM $tabla u INNER JOIN nivel_usuario n on n.idnivelusuario = u.idnivelusuario 
			WHERE u.idnivelusuario != '20220003'");

			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	//tag: ACTUALIZAR PERFIL
	=============================================*/
	static public function mdlActualizarPerfil($tabla, $item1, $valor1, $item2, $valor2){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	//tag: REGISTRO DE USUARIO
	=============================================*/
	static public function mdlIngresarUsuario($tabla, $datos){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(idnivelusuario, nombre_completo, email, usuario, password, clave_inicial, 
			foto, estado, usuariocrea, fechacrea) VALUES(:perfil,
			:nombre_completo, :email, :email, :password, :clave_inicial, :foto, :estado, '20220001', NOW())");

		$stmt->bindParam(":nombre_completo", $datos["nombre_completo"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":clave_inicial", $datos["clave_inicial"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	//tag: EDITAR PERFIL
	=============================================*/
	static public function mdlEditarPerfil($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET idnivelusuario = :perfil, nombre_completo = :nombre_completo, 
			email = :email, password = :password, foto = :foto, usuariomodifica = '20220002', fechamodifica = NOW()   
			WHERE idusuario = :idusuario");

		$stmt -> bindParam(":nombre_completo", $datos["nombre_completo"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	//tag: ELIMINAR PERFIL
	=============================================*/

	static public function mdlEliminarPerfil($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("DELETE FROM $tabla WHERE idusuario = :idusuario");
		$stmt -> bindParam(":idusuario", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt = null;
		$conexion = null;
	}
}