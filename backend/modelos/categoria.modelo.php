<?php

	//TODO: Template Modelo
	require_once "conexion.php";

	class ModeloCategoria{

		/*=============================================
		//tag: MOSTRAR CATEGORIA
		=============================================*/
		static public function mdlMostrarCategoria($tabla, $item, $valor){
			$conexion = new Conexion();

			if($item != null){
				$stmt = $conexion->conectar()->prepare("SELECT idcategoria, descripcion, imagen FROM $tabla WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}else{
				$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY idcategoria");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}

			$stmt = null;
			$conexion = null;
		}

		/*=============================================
		//tag: CREAR CATEGORIA
		=============================================*/
		static public function mdlIngresarCategoria($tabla, $datos){
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
		//tag: ACTUALIZAR ESTADO DE CATEGORIA
		=============================================*/
		static public function mdlActualizarCategoria($tabla, $item1, $valor1, $item2, $valor2){
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
		//tag: EDITAR CATEGORIA
		=============================================*/

		static public function mdlEditarCategoria($tabla, $datos){
			//echo "idcategoriaEd: ".$datos["idcategoria"];
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, imagen = :imagen, usuariomodifica = '20220002', 
				fechamodifica = NOW()   
			WHERE idcategoria  = :idcategoria");		
			
			$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
			$stmt -> bindParam(":idcategoria", $datos["idcategoria"], PDO::PARAM_INT);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";		
			}

			$stmt = null;
			$conexion = null;	
		}	
	}