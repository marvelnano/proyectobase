<?php

	//TODO: Template Modelo
	require_once "conexion.php";

	class ModeloConsumidor{

		/*=============================================
		//tag: MOSTRAR CONSUMIDOR
		=============================================*/
		static public function mdlMostrarConsumidor($tabla, $item, $valor){
			$conexion = new Conexion();

			if($item != null){
				$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}else{
				$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY idconsumidor");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}

			$stmt = null;
			$conexion = null;
		}

		/*=============================================
		//tag: CREAR CONSUMIDOR
		=============================================*/
		static public function mdlIngresarConsumidor($tabla, $datos){
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(descripcion, imagen, estado, usuariocrea, fechacrea) 
			VALUES (:descripcion, :imagen, 1, '20220001', NOW())");

			$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);    
			$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
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
		//tag: ACTUALIZAR ESTADO DE CONSUMIDOR
		=============================================*/
		static public function mdlActualizarConsumidor($tabla, $item1, $valor1, $item2, $valor2){
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
		//tag: EDITAR CONSUMIDOR
		=============================================*/

		static public function mdlEditarConsumidor($tabla, $datos){
			//echo "idconsumidorEd: ".$datos["idconsumidor"];
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, imagen = :imagen, usuariomodifica = '20220002', 
				fechamodifica = NOW()   
				WHERE idconsumidor  = :idconsumidor");		
			
			$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
			$stmt -> bindParam(":idconsumidor", $datos["idconsumidor"], PDO::PARAM_INT);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";		
			}

			$stmt = null;
			$conexion = null;	
		}	
	}