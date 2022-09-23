<?php

require_once "conexion.php";

class ModeloProyecto{

	/*=============================================
	MOSTRAR UBIGEOS
	=============================================*/
	static public function mdlMostrarUbigeos($tabla, $item, $valor){
		$conexion = new Conexion();

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY idubigeo DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	MOSTRAR PROYECTOS
	=============================================*/	
	static public function mdlMostrarProyectos($tabla, $item, $valor){
		$conexion = new Conexion();
		
		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY idproyecto DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();			
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	CREAR PROYECTO
	=============================================*/
	static public function mdlIngresarProyecto($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(ruc, razonsocial, nombrecomercial, abreviatura, email, telefono, web, idubigeo, direccion/* , pass_firma, usuario_sol, clave_sol */, estado, fechacrea) VALUES (:ruc, :razonsocial, :nombrecomercial, :abreviatura, :email, :telefono, :web, :seleccionarUbigeo, :direccion/* , :firma, :usuariosol, :clavesol */, 1, NOW())");

		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":razonsocial", $datos["razonsocial"], PDO::PARAM_STR);
		$stmt->bindParam(":nombrecomercial", $datos["nombrecomercial"], PDO::PARAM_STR);  
		$stmt->bindParam(":abreviatura", $datos["abreviatura"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR); 
		$stmt->bindParam(":web", $datos["web"], PDO::PARAM_STR);
		$stmt->bindParam(":seleccionarUbigeo", $datos["seleccionarUbigeo"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);  
		/* $stmt->bindParam(":firma", $datos["firma"], PDO::PARAM_STR);
		$stmt->bindParam(":usuariosol", $datos["usuariosol"], PDO::PARAM_STR);
		$stmt->bindParam(":clavesol", $datos["clavesol"], PDO::PARAM_STR);    */           

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		//$stmt -> execute();
		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	ACTUALIZAR PROYECTO	->	falta implementar
	mdlActualizarCompra(tabla,campo1,contenidoaguardar1,campo2,contenidoaguardar2)
	=============================================*/
	static public function mdlActualizarProyecto($tabla, $item1, $valor1, $item2, $valor2){
		/* $conexion = new Conexion();
		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt = null;
		$conexion = null; */
	}

	/*=============================================
	EDITAR PROYECTO
	=============================================*/
	static public function mdlEditarProyecto($tabla, $datos){
		$conexion = new Conexion();

		//echo "idproyectoEd: ".$datos["idproyecto"];
		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET ruc = :ruc, razonsocial = :razonsocial, nombrecomercial = :nombrecomercial, abreviatura = :abreviatura, email = :email, telefono = :telefono, web = :web, idubigeo = :seleccionarUbigeo, direccion = :direccion/* , pass_firma = :firma, usuario_sol = :usuariosol, clave_sol = :clavesol */ WHERE idproyecto = :idproyecto");
		
		$stmt -> bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt -> bindParam(":razonsocial", $datos["razonsocial"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombrecomercial", $datos["nombrecomercial"], PDO::PARAM_STR);
		$stmt -> bindParam(":abreviatura", $datos["abreviatura"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":web", $datos["web"], PDO::PARAM_STR);
		$stmt -> bindParam(":seleccionarUbigeo", $datos["seleccionarUbigeo"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		/* $stmt -> bindParam(":firma", $datos["firma"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuariosol", $datos["usuariosol"], PDO::PARAM_STR);
		$stmt -> bindParam(":clavesol", $datos["clavesol"], PDO::PARAM_STR); */
		$stmt -> bindParam(":idproyecto", $datos["idproyecto"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;	
	}
}