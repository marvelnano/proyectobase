<?php

require_once "conexion.php";

class ModeloDesign{

	/*=============================================
	SELECCIONAR PLANTILLA
	=============================================*/
	static public function mdlSeleccionarPlantilla($tabla){
		$conexion = new Conexion();

		$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetch();

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	ACTUALIZAR LOGO O ICONO
	=============================================*/
	static public function mdlActualizarLogoIcono($tabla, $id, $item, $valor){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	ACTUALIZAR COLORES
	=============================================*/
	static public function mdlActualizarColores($tabla, $id, $datos){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET barraSuperior = :barraSuperior, textoSuperior = :textoSuperior, colorFondo = :colorFondo, colorTexto = :colorTexto  WHERE id = :id");

		$stmt->bindParam(":barraSuperior", $datos["barraSuperior"], PDO::PARAM_STR);
		$stmt->bindParam(":textoSuperior", $datos["textoSuperior"], PDO::PARAM_STR);
		$stmt->bindParam(":colorFondo", $datos["colorFondo"], PDO::PARAM_STR);
		$stmt->bindParam(":colorTexto", $datos["colorTexto"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	ACTUALIZAR SCRIPT
	=============================================*/
	static public function mdlActualizarScript($tabla, $id, $datos){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET apiFacebook = :apiFacebook, pixelFacebook = :pixelFacebook, googleAnalytics = :googleAnalytics WHERE id = :id");

		$stmt->bindParam(":apiFacebook", $datos["apiFacebook"], PDO::PARAM_STR);
		$stmt->bindParam(":pixelFacebook", $datos["pixelFacebook"], PDO::PARAM_STR);
		$stmt->bindParam(":googleAnalytics", $datos["googleAnalytics"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	SELECCIONAR DESIGN - NO USADO
	=============================================*/
	static public function mdlSeleccionarDesign($tabla){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetch();

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	SELECCIONAR COMPROBANTE
	=============================================*/

	static public function mdlMostrarComprobantes($tabla, $item, $valor){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("SELECT * FROM $tabla where $item = $valor");
		$stmt -> execute();
		return $stmt -> fetchAll();

		$stmt = null;
		$conexion = null;
	}

	/*=============================================
	ACTUALIZAR INFORMACION
	=============================================*/

	static public function mdlActualizarInformacion($tabla, $id, $datos){
		$conexion = new Conexion();
		
		$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET impuesto = :impuesto,
		envioNacional = :envioNacional, envioInternacional = :envioInternacional, tasaMinimaNal = :tasaMinimaNal, tasaMinimaInt = :tasaMinimaInt, pais = :pais,
		modoFacturacion = :modoFacturacion, modoPaypal = :modoPaypal, clienteIdPaypal = :clienteIdPaypal, llaveSecretaPaypal = :llaveSecretaPaypal, modoPayu = :modoPayu, merchantIdPayu = :merchantIdPayu, accountIdPayu = :accountIdPayu, apiKeyPayu = :apiKeyPayu,
		idcomprobanteserie_boleta = :idcomprobanteserie_boleta, idcomprobanteserie_factura = :idcomprobanteserie_factura WHERE id = :id");

		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":envioNacional", $datos["envioNacional"], PDO::PARAM_STR); 
		$stmt->bindParam(":envioInternacional", $datos["envioInternacional"], PDO::PARAM_STR); 
		$stmt->bindParam(":tasaMinimaNal", $datos["tasaMinimaNal"], PDO::PARAM_STR); 
		$stmt->bindParam(":tasaMinimaInt", $datos["tasaMinimaInt"], PDO::PARAM_STR); 
		$stmt->bindParam(":pais", $datos["seleccionarPais"], PDO::PARAM_STR);
		$stmt->bindParam(":modoFacturacion", $datos["modoFacturacion"], PDO::PARAM_STR); 
		$stmt->bindParam(":modoPaypal", $datos["modoPaypal"], PDO::PARAM_STR); 
		$stmt->bindParam(":clienteIdPaypal", $datos["clienteIdPaypal"], PDO::PARAM_STR); 
		$stmt->bindParam(":llaveSecretaPaypal", $datos["llaveSecretaPaypal"], PDO::PARAM_STR);
		$stmt->bindParam(":modoPayu", $datos["modoPayu"], PDO::PARAM_STR); 
		$stmt->bindParam(":merchantIdPayu", $datos["merchantIdPayu"], PDO::PARAM_STR); 
		$stmt->bindParam(":accountIdPayu", $datos["accountIdPayu"], PDO::PARAM_STR); 
		$stmt->bindParam(":apiKeyPayu", $datos["apiKeyPayu"], PDO::PARAM_STR);
		$stmt->bindParam(":idcomprobanteserie_boleta", $datos["idcomprobanteserie_boleta"], PDO::PARAM_STR); 
		$stmt->bindParam(":idcomprobanteserie_factura", $datos["idcomprobanteserie_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute()){
			$stmt = $conexion->conectar()->prepare("UPDATE mae_proyecto SET usuario_sol = :usuariosol, clave_sol = :clavesol, pass_firma = :passwordcertificado");

			$stmt -> bindParam(":usuariosol", $datos["usuariosol"], PDO::PARAM_STR);
			$stmt -> bindParam(":clavesol", $datos["clavesol"], PDO::PARAM_STR);
			$stmt -> bindParam(":passwordcertificado", $datos["passwordcertificado"], PDO::PARAM_STR);
			$stmt->execute();
			return "ok";
		}else{
			return "error";		
		}

		$stmt = null;
		$conexion = null;
	}
}