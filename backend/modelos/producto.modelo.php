<?php

	//TODO: Template Modelo
	require_once "conexion.php";

	class ModeloProducto{

		/*=============================================
		//tag: MOSTRAR PRODUCTO
		=============================================*/
		static public function mdlMostrarProducto($tabla, $item, $valor){
			$conexion = new Conexion();

			if($item != null){
				$stmt = $conexion->conectar()->prepare("p.idproducto, n.idnegocio, n.razon_social, sc.idsubcategoria, sc.descripcion subcategoria,
					cat.idcategoria, cat.descripcion categoria, c.idconsumidor, c.descripcion consumidor, m.idmedida, m.descripcion medida,
					p.titulo, p.descripcion, p.codigo_sku, p.costo, p.precio, p.stock, p.imagen, p.estado 
					FROM $tabla p
					INNER JOIN subcategoria sc on sc.idsubcategoria = p.idsubcategoria 
					INNER JOIN categoria cat on cat.idcategoria = sc.idcategoria
					INNER JOIN consumidor c on c.idconsumidor = p.idconsumidor
					INNER join negocio n on n.idnegocio = p.idnegocio
					INNER JOIN medida m on m.idmedida = p.idmedida 
					WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}else{
				$stmt = $conexion->conectar()->prepare("p.idproducto, n.idnegocio, n.razon_social, sc.idsubcategoria, sc.descripcion subcategoria,
					cat.idcategoria, cat.descripcion categoria, c.idconsumidor, c.descripcion consumidor, m.idmedida, m.descripcion medida,
					p.titulo, p.descripcion, p.codigo_sku, p.costo, p.precio, p.stock, p.imagen, p.estado 
					FROM $tabla p
					INNER JOIN subcategoria sc on sc.idsubcategoria = p.idsubcategoria 
					INNER JOIN categoria cat on cat.idcategoria = sc.idcategoria
					INNER JOIN consumidor c on c.idconsumidor = p.idconsumidor
					INNER join negocio n on n.idnegocio = p.idnegocio
					INNER JOIN medida m on m.idmedida = p.idmedida 
					ORDER BY sc.idsubcategoria");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}

			$stmt = null;
			$conexion = null;
		}

		/*=============================================
		//tag: CREAR PRODUCTO
		=============================================*/
		static public function mdlIngresarProducto($tabla, $datos){
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("INSERT INTO $tabla(idnegocio, idsubcategoria, idconsumidor, idmedida, titulo, descripcion, codigo_sku,
				costo, precio, stock, imagen, estado, usuariocrea, fechacrea) 
				VALUES (:idnegocio, :idsubcategoria, :idconsumidor, :idmedida, :titulo, :descripcion, :codigo_sku, :costo, :precio, :stock, :imagen, 
				1, '20220001', NOW())");

			$stmt->bindParam(":idnegocio", $datos["idnegocio"], PDO::PARAM_STR);    
			$stmt->bindParam(":idsubcategoria", $datos["idsubcategoria"], PDO::PARAM_STR); 
			$stmt->bindParam(":idconsumidor", $datos["idconsumidor"], PDO::PARAM_STR); 
			$stmt->bindParam(":idmedida", $datos["idmedida"], PDO::PARAM_STR); 
			$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR); 
			$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR); 
			$stmt->bindParam(":codigo_sku", $datos["codigo_sku"], PDO::PARAM_STR); 
			$stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR); 
			$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR); 
			$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR); 
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
		//tag: ACTUALIZAR ESTADO DE PRODUCTO
		=============================================*/
		static public function mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2){
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
		//tag: EDITAR PRODUCTO
		=============================================*/

		static public function mdlEditarProducto($tabla, $datos){
			//echo "idproductoEd: ".$datos["idproducto"];
			$conexion = new Conexion();

			$stmt = $conexion->conectar()->prepare("UPDATE $tabla SET idnegocio = :idnegocio, idsubcategoria = :idsubcategoria, 
				idconsumidor = :idconsumidor, idmedida = :idmedida, titulo = :titulo, descripcion = :descripcion, 
				codigo_sku = :codigo_sku, costo = :costo, precio = :precio, stock = :stock, imagen = :imagen,  
				imagen = :imagen, usuariomodifica = '20220002', fechamodifica = NOW()   
				WHERE idproducto  = :idproducto");		
			
			$stmt -> bindParam(":idnegocio", $datos["idnegocio"], PDO::PARAM_STR);    
			$stmt -> bindParam(":idsubcategoria", $datos["idsubcategoria"], PDO::PARAM_STR); 
			$stmt -> bindParam(":idconsumidor", $datos["idconsumidor"], PDO::PARAM_STR); 
			$stmt -> bindParam(":idmedida", $datos["idmedida"], PDO::PARAM_STR); 
			$stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR); 
			$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR); 
			$stmt -> bindParam(":codigo_sku", $datos["codigo_sku"], PDO::PARAM_STR); 
			$stmt -> bindParam(":costo", $datos["costo"], PDO::PARAM_STR); 
			$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR); 
			$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR); 
			$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
			$stmt -> bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_INT);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";		
			}

			$stmt = null;
			$conexion = null;	
		}	
	}