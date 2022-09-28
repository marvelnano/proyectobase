<?php

require_once "conexion.php";

class ModeloWebPortfolio{

	/*=============================================
	MOSTRAR WEBPORTFOLIOS
	=============================================*/
	static public function mdlMostrarWebPortfolios($tabla, $item, $valor){
		$conexion = new Conexion();
		$itemdb = "pwp.".$item;

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT pwp.idplantillawebportfolio, pwp.idplantillaweb, 
					pwp.idplantillawebareaportfolio, CONCAT(n.razon_social,' - ',pws.descripcion,' - ',pwap.descripcion) as negocio, 
					pwp.imagen, pwp.descripcion, pwp.estado
				FROM $tabla pwp 
				INNER JOIN plantilla_web pw on pw.idplantillaweb = pwp.idplantillaweb
				INNER JOIN negocio n on n.idnegocio = pw.idnegocio 
				INNER JOIN plantilla_web_seccion pws on pws.idplantillawebseccion = pw.idplantillawebseccion 
				INNER JOIN plantilla_web_area_portfolio pwap on pwap.idplantillawebareaportfolio = pwp.idplantillawebareaportfolio
				WHERE $itemdb = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT pwp.idplantillawebportfolio, pwp.idplantillaweb, 
					pwp.idplantillawebareaportfolio, CONCAT(n.razon_social,' - ',pws.descripcion,' - ',pwap.descripcion) as negocio, 
					pwp.imagen, pwp.descripcion, pwp.estado
				FROM $tabla pwp 
				INNER JOIN plantilla_web pw on pw.idplantillaweb = pwp.idplantillaweb
				INNER JOIN negocio n on n.idnegocio = pw.idnegocio  
				INNER JOIN plantilla_web_seccion pws on pws.idplantillawebseccion = pw.idplantillawebseccion
				INNER JOIN plantilla_web_area_portfolio pwap on pwap.idplantillawebareaportfolio = pwp.idplantillawebareaportfolio ");

			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	ACTUALIZAR WEBPORTFOLIO
	=============================================*/
	static public function mdlActualizarWebPortfolio($tabla, $item1, $valor1, $item2, $valor2){
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
	REGISTRO DE WEBPORTFOLIO
	=============================================*/
	static public function mdlIngresarWebPortfolio($tabla, $datos){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(idplantillaweb, idplantillawebareaportfolio, descripcion,
			imagen, estado, usuariocrea, fechacrea) VALUES(:idplantillaweb,
			:idplantillawebareaportfolio, :descripcion, :imagen, 1, '20220001', NOW())");

		$stmt->bindParam(":idplantillaweb", $datos["idplantillaweb"], PDO::PARAM_STR);
		$stmt->bindParam(":idplantillawebareaportfolio", $datos["idplantillawebareaportfolio"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	EDITAR WEBPORTFOLIO
	=============================================*/
	static public function mdlEditarWebPortfolio($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET idplantillaweb = :idplantillaweb, 
			idplantillawebareaportfolio = :idplantillawebareaportfolio, 
			descripcion = :descripcion, imagen = :imagen, usuariomodifica = '20220002', fechamodifica = NOW()   
			WHERE idplantillawebportfolio = :idplantillawebportfolio");

		$stmt -> bindParam(":idplantillaweb", $datos["idplantillaweb"], PDO::PARAM_STR);
		$stmt -> bindParam(":idplantillawebareaportfolio", $datos["idplantillawebareaportfolio"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":idplantillawebportfolio", $datos["idplantillawebportfolio"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	ELIMINAR WEBPORTFOLIO
	=============================================*/
	static public function mdlEliminarWebPortfolio($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("DELETE FROM $tabla WHERE idplantillawebportfolio = :idplantillawebportfolio");
		$stmt -> bindParam(":idplantillawebportfolio", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt = null;
		$conexion = null;
	}
}