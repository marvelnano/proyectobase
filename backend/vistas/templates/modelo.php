<?php

	//TODO: Template Modelo
	require_once "conexion.php";

	class Modelo{CONTROLADOR}{

		/*=============================================
		//tag: MOSTRAR {CONTROLADORMAY}
		=============================================*/
		static public function mdlMostrar{CONTROLADOR}($tabla, $item, $valor){
			$conexion = new Conexion();

			if($item != null){
				$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();
			}else{
				$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY id{CONTROLADORMIN}");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}

			$stmt = null;
			$conexion = null;
		}

		/*=============================================
		//tag: CREAR {CONTROLADORMAY}
		=============================================*/
		static public function mdlIngresar{CONTROLADOR}($tabla, $datos){
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
		//tag: ACTUALIZAR ESTADO DE {CONTROLADORMAY}
		=============================================*/
		static public function mdlActualizar{CONTROLADOR}($tabla, $item1, $valor1, $item2, $valor2){
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
		//tag: EDITAR {CONTROLADORMAY}
		=============================================*/

		static public function mdlEditar{CONTROLADOR}($tabla, $datos){
			//echo "id{CONTROLADORMIN}Ed: ".$datos["id{CONTROLADORMIN}"];
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, usuariomodifica = '20220002', 
				fechamodifica = NOW()   
			WHERE id{CONTROLADORMIN}  = :id{CONTROLADORMIN}");		
			
			$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt -> bindParam(":id{CONTROLADORMIN}", $datos["id{CONTROLADORMIN}"], PDO::PARAM_INT);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";		
			}

			$stmt = null;
			$conexion = null;	
		}	
	}