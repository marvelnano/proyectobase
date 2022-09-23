<?php

require_once "conexion.php";

class ModeloNegocio{

	/*=============================================
	VER NEGOCIOS
	=============================================*/
	static public function mdlVerNegocio($valor){
		//echo "idnegocio: ".$valor;
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("SELECT n.idnegocio, n.razon_social, pws.descripcion as seccion, 
				pw.contenido 
			FROM negocio n
			INNER JOIN plantilla_web pw on pw.idnegocio = n.idnegocio
			INNER JOIN plantilla_web_seccion pws on pws.idplantillawebseccion = pw.idplantillawebseccion
			WHERE n.idnegocio = :idnegocio AND pw.estado = 1");
		$stmt -> bindParam(":idnegocio", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	MOSTRAR NEGOCIOS WEB
	=============================================*/
	static public function mdlMostrarNegociosWeb($tabla, $item, $valor){
		$conexion = new Conexion();

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT n.idnegocio, n.razon_social, r.descripcion as rubro,
					n.estado
				FROM $tabla n
				INNER JOIN rubro_negocio r on r.idrubronegocio = n.idrubronegocio
				WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT n.idnegocio, n.razon_social, r.descripcion as rubro,
					n.estado
				FROM $tabla n
				INNER JOIN rubro_negocio r on r.idrubronegocio = n.idrubronegocio
				ORDER BY idnegocio DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	MOSTRAR NEGOCIOS
	=============================================*/
	static public function mdlMostrarNegocios($tabla, $item, $valor){
		$conexion = new Conexion();

		if($item != null){
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla ORDER BY idnegocio DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	CREAR NEGOCIO
	=============================================*/
	static public function mdlIngresarNegocio($tabla, $datos){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(idrubronegocio, ruc, razon_social, direccion, celular, email, pagina_web,
			estado, usuariocrea, fechacrea) 
		VALUES (:idrubronegocio, :ruc, :razon_social, :direccion, :celular, :email, :pagina_web, 1, '20220001', NOW())");

		$stmt->bindParam(":idrubronegocio", $datos["idrubronegocio"], PDO::PARAM_STR); 
		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR); 
		$stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);  
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR); 
		$stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR); 
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);       
		$stmt->bindParam(":pagina_web", $datos["pagina_web"], PDO::PARAM_STR); 

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
	EDITAR NEGOCIO
	=============================================*/
	static public function mdlEditarNegocio($tabla, $datos){
		//echo "idnegocioEd: ".$datos["idnegocio"];
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET idrubronegocio = :idrubronegocio, ruc = :ruc, 
			razon_social = :razon_social, direccion = :direccion, celular = :celular, email = :email, pagina_web = :pagina_web,
			usuariomodifica = '20220002', fechamodifica = NOW()   
			WHERE idnegocio = :idnegocio");
		
		$stmt -> bindParam(":idnegocio", $datos["idnegocio"], PDO::PARAM_STR);
		$stmt -> bindParam(":idrubronegocio", $datos["idrubronegocio"], PDO::PARAM_STR);
		$stmt -> bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt -> bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":pagina_web", $datos["pagina_web"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;	
	}

	/*=============================================
	ACTUALIZAR NEGOCIO
	=============================================*/
	static public function mdlActualizarNegocio($tabla, $item1, $valor1, $item2, $valor2){
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