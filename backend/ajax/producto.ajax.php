<?php

	//TODO: Template Ajax
	require_once "../controladores/producto.controlador.php";
	require_once "../modelos/producto.modelo.php";


	class AjaxProducto{

		/*=============================================
		//tag: VALIDAR NO REPETIR PRODUCTO
		=============================================*/	

		public $validarProducto;

		public function ajaxValidarProducto(){
			$item = "descripcion";
			$valor = $this->validarProducto;

			$respuesta = ControladorProducto::ctrMostrarProducto($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: ACTIVAR PRODUCTO
		=============================================*/	

		public $activarProducto;
		public $activarId;

		public function ajaxActivarProducto(){
			$tabla = "producto";

			$item1 = "estado";
			$valor1 = $this->activarProducto;

			$item2 = "idproducto";
			$valor2 = $this->activarId;	

			$respuesta = ModeloProducto::mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		/*=============================================
		//tag: GUARDAR Y EDITAR PRODUCTO
		=============================================*/	

		public $descripcion;

		public function  ajaxCrearProducto(){
			//echo "antes de ir al controlador: ".$this->descripcion;
			$datosCab = array(
				"descripcion"=>$this->descripcion
				);

			$respuesta = ControladorProducto::ctrCrearProducto($datosCab);

			echo $respuesta;
		}

		/*=============================================
		//tag: TRAER PRODUCTO
		=============================================*/	

		public $idProducto;

		public function ajaxTraerProducto(){
			$item = "idproducto";
			$valor = $this->idProducto;

			$respuesta = ControladorProducto::ctrMostrarProducto($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: EDITAR PRODUCTO
		=============================================*/	

		public $idProductoEd;
		public $descripcionEd;

		public function ajaxEditarProducto(){
			$datos = array(
				"idproductoEd"=>$this->idProductoEd,
				"descripcionEd"=>$this->descripcionEd
				);

			$respuesta = ControladorProducto::ctrEditarProducto($datos);	
			echo $respuesta;
		}
		

	}

	/*=============================================
	//note: VALIDAR NO REPETIR PRODUCTO
	=============================================*/

	if(isset($_POST["validarproducto"])){

		$valProducto = new AjaxProducto();
		$valProducto -> validarProducto = $_POST["validarproducto"];
		$valProducto -> ajaxValidarProducto();

	}

	/*=============================================
	//note: ACTIVAR PRODUCTO
	=============================================*/	

	if(isset($_POST["activarProducto"])){

		$activarProducto = new AjaxProducto();
		$activarProducto -> activarProducto = $_POST["activarProducto"];
		$activarProducto -> activarId = $_POST["activarId"];
		$activarProducto -> ajaxActivarProducto();

	}

	/*=============================================
	//note: CREAR PRODUCTO
	=============================================*/
	if(isset($_POST["descripcion"])){
		//echo "ruc: ".$_POST["descripcion"];
		$producto = new AjaxProducto();
		$producto -> descripcion = $_POST["descripcion"];

		$producto -> ajaxCrearProducto();
	}

	/*=============================================
	//note: TRAER PRODUCTO
	=============================================*/
	if(isset($_POST["idProductoEdit"])){

		$traerProducto = new AjaxProducto();
		$traerProducto -> idProducto = $_POST["idProductoEdit"];
		$traerProducto -> ajaxTraerProducto();

	}

	/*=============================================
	//note: EDITAR PRODUCTO
	=============================================*/
	if(isset($_POST["idProductoEd"])){

		$editarProducto = new AjaxProducto();
		$editarProducto -> idProductoEd = $_POST["idProductoEd"];
		$editarProducto -> descripcionEd = $_POST["descripcionProductoEd"];

		$editarProducto -> ajaxEditarProducto();

	}

