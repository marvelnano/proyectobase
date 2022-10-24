<?php

	//TODO: Template Modelo
	require_once "conexion.php";

	class ModeloSubCategoria{

		/*=============================================
		//tag: MOSTRAR SUBCATEGORIA
		=============================================*/
		static public function mdlMostrarSubCategoria($tabla, $item, $valor){
			$conexion = new Conexion();

			if($item != null){
				$stmt = $conexion->conectar()->prepare("SELECT sc.idsubcategoria, c.idcategoria, c.descripcion categoria,
					sc.descripcion, sc.imagen, sc.estado 
					FROM $tabla sc
					INNER JOIN categoria c on c.idcategoria = sc.idcategoria 
					WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}else{
				$stmt = $conexion->conectar()->prepare("SELECT sc.idsubcategoria, c.idcategoria, c.descripcion categoria,
				sc.descripcion, sc.imagen, sc.estado
				FROM $tabla sc
				INNER JOIN categoria c on c.idcategoria = sc.idcategoria
				ORDER BY sc.idsubcategoria");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}

			$stmt = null;
			$conexion = null;
		}

		/*=============================================
		//tag: MOSTRAR SUBCATEGORIAS POR CATEGORIA
		=============================================*/
		static public function mdlMostrarSubCategoriaXCategoria($tabla, $item, $valor){
			$conexion = new Conexion();

			if($item != null){
				$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE idcategoria = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();
			}

			$stmt = null;
			$conexion = null;
		}

		/*=============================================
		//tag: CREAR SUBCATEGORIA
		=============================================*/
		static public function mdlIngresarSubCategoria($tabla, $datos){
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(idcategoria, descripcion, imagen, estado, usuariocrea, fechacrea) 
			VALUES (:idcategoria, :descripcion, :imagen, 1, '20220001', NOW())");

			$stmt->bindParam(":idcategoria", $datos["idcategoria"], PDO::PARAM_STR);
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
		//tag: ACTUALIZAR ESTADO DE SUBCATEGORIA
		=============================================*/
		static public function mdlActualizarSubCategoria($tabla, $item1, $valor1, $item2, $valor2){
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
		//tag: EDITAR SUBCATEGORIA
		=============================================*/

		static public function mdlEditarSubCategoria($tabla, $datos){
			//echo "idsubcategoriaEd: ".$datos["idsubcategoria"];
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET idcategoria = :idcategoria, descripcion = :descripcion, 
				imagen = :imagen, usuariomodifica = '20220002', fechamodifica = NOW()   
			WHERE idsubcategoria  = :idsubcategoria");		
			
			$stmt -> bindParam(":idcategoria", $datos["idcategoria"], PDO::PARAM_STR);
			$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
			$stmt -> bindParam(":idsubcategoria", $datos["idsubcategoria"], PDO::PARAM_INT);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";		
			}

			$stmt = null;
			$conexion = null;	
		}	
	}