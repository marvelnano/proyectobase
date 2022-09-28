<?php

require_once "conexion.php";

class ModeloRubro{

	/*=============================================
	MOSTRAR RUBROS
	=============================================*/
	static public function mdlMostrarRubros($tabla, $item, $valor){
		$conexion = new Conexion();

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY idrubronegocio");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	CREAR RUBRO NEGOCIO
	=============================================*/
	static public function mdlIngresarRubro($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(descripcion, estado, usuariocrea, fechacrea) 
		VALUES (:descripcion, 1, '20220001', NOW())");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);    
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
	ACTUALIZAR RUBRO NEGOCIO
	=============================================*/
	static public function mdlActualizarRubro($tabla, $item1, $valor1, $item2, $valor2){
		//echo("Datos: ".$item1." ".$valor1." ".$item2." ".$valor2);
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
	EDITAR RUBRO NEGOCIO
	=============================================*/

	static public function mdlEditarRubro($tabla, $datos){
		//echo "idnivelEd: ".$datos["idrubronegocio"];
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, usuariomodifica = '20220002', 
			fechamodifica = NOW()   
		WHERE idrubronegocio  = :idrubronegocio");		
		
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":idrubronegocio", $datos["idrubronegocio"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;	
	}	
}