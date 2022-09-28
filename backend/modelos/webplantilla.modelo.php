<?php

require_once "conexion.php";

class ModeloWebPlantilla{

	/*=============================================
	MOSTRAR PLANTILLAS WEB
	=============================================*/
	static public function mdlMostrarPlantillasWeb($tabla, $item, $valor){
		$conexion = new Conexion();

		if($item == 'descripcion'){
			$itemdb = "pws.".$item;
		}else{
			$itemdb = "pw.".$item;
		}

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT pw.idplantillaweb, pw.idnegocio, pw.idplantillawebseccion,
					CONCAT(n.razon_social,' - ',pws.descripcion) as descripcion, pw.contenido,
					pw.estado
				FROM $tabla pw
				INNER JOIN negocio n on n.idnegocio = pw.idnegocio
				INNER JOIN plantilla_web_seccion pws on pws.idplantillawebseccion = pw.idplantillawebseccion 
				WHERE $itemdb = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT pw.idplantillaweb, pw.idnegocio, pw.idplantillawebseccion,
				CONCAT(n.razon_social,' - ',pws.descripcion) as descripcion, pw.contenido,
				pw.estado
			FROM $tabla pw
			INNER JOIN negocio n on n.idnegocio = pw.idnegocio
			INNER JOIN plantilla_web_seccion pws on pws.idplantillawebseccion = pw.idplantillawebseccion
			ORDER BY idplantillaweb DESC");

			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	CREAR WEB PLANTILLA
	=============================================*/
	static public function mdlIngresarWebPlantilla($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(idnegocio, idplantillawebseccion, contenido,
			estado, usuariocrea, fechacrea) 
		VALUES (:idnegocio, :idplantillawebseccion, :contenido, 1, '20220001', NOW())");

		$stmt->bindParam(":idnegocio", $datos["idnegocio"], PDO::PARAM_STR); 
		$stmt->bindParam(":idplantillawebseccion", $datos["idplantillawebseccion"], PDO::PARAM_STR); 
		$stmt->bindParam(":contenido", $datos["contenido"], PDO::PARAM_STR); 

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
	EDITAR WEB PLANTILLA
	=============================================*/
	static public function mdlEditarWebPlantilla($tabla, $datos){
		//echo "idnegocioEd: ".$datos["idnegocio"];
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET idnegocio = :idnegocio, idplantillawebseccion = :idplantillawebseccion, 
			contenido = :contenido, 
			usuariomodifica = '20220002', fechamodifica = NOW()   
			WHERE idplantillaweb = :idplantillaweb");
		
		$stmt -> bindParam(":idplantillaweb", $datos["idplantillaweb"], PDO::PARAM_STR);
		$stmt -> bindParam(":idnegocio", $datos["idnegocio"], PDO::PARAM_STR);
		$stmt -> bindParam(":idplantillawebseccion", $datos["idplantillawebseccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":contenido", $datos["contenido"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;	
	}

	/*=============================================
	ACTUALIZAR WEB PLANTILLA
	=============================================*/

	static public function mdlActualizarWebPlantilla($tabla, $item1, $valor1, $item2, $valor2){
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
}