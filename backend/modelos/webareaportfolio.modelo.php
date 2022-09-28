<?php

require_once "conexion.php";

class ModeloWebAreaPortfolio{

	/*=============================================
	MOSTRAR WEB ÁREA PORTFOLIOS
	=============================================*/
	static public function mdlMostrarWebAreaPortfolios($tabla, $item, $valor){
		$conexion = new Conexion();

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY idplantillawebareaportfolio");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	CREAR WEB SECCIÓN
	=============================================*/
	static public function mdlIngresarWebAreaPortfolio($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(descripcion, estado, usuariocrea, fechacrea) 
		VALUES (:descripcion, 1, '202201', NOW())");
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
	ACTUALIZAR WEB SECCIÓN
	=============================================*/
	static public function mdlActualizarWebAreaPortfolio($tabla, $item1, $valor1, $item2, $valor2){
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
	EDITAR WEB SECCIÓN
	=============================================*/
	static public function mdlEditarWebAreaPortfolio($tabla, $datos){
		//echo "idnivelEd: ".$datos["idplantillawebareaportfolio"];
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, usuariomodifica = '202202', 
			fechamodifica = NOW()   
		WHERE idplantillawebareaportfolio  = :idplantillawebareaportfolio");	
			
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":idplantillawebareaportfolio", $datos["idplantillawebareaportfolio"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;	
	}	
}