<?php

	//TODO: Template Ajax
	require_once "../controladores/categoria.controlador.php";
	require_once "../modelos/categoria.modelo.php";


	class AjaxCategoria{

		/*=============================================
		//tag: VALIDAR NO REPETIR CATEGORIA
		=============================================*/	

		public $validarCategoria;

		public function ajaxValidarCategoria(){
			$item = "descripcion";
			$valor = $this->validarCategoria;

			$respuesta = ControladorCategoria::ctrMostrarCategoria($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: ACTIVAR CATEGORIA
		=============================================*/	

		public $activarCategoria;
		public $activarId;

		public function ajaxActivarCategoria(){
			$tabla = "categoria";

			$item1 = "estado";
			$valor1 = $this->activarCategoria;

			$item2 = "idcategoria";
			$valor2 = $this->activarId;	

			$respuesta = ModeloCategoria::mdlActualizarCategoria($tabla, $item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		/*=============================================
		//note: TRAER CATEGORIA
		=============================================*/	

		public $idCategoria;

		public function ajaxTraerCategoria(){
			$item = "idcategoria";
			$valor = $this->idCategoria;

			$respuesta = ControladorCategoria::ctrMostrarCategoria($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: EDITAR CATEGORIA
		=============================================*/	

		public $idCategoriaEd;
		public $descripcionEd;

		public function ajaxEditarCategoria(){
			$datos = array(
				"idcategoriaEd"=>$this->idCategoriaEd,
				"descripcionEd"=>$this->descripcionEd
				);

			$respuesta = ControladorCategoria::ctrEditarCategoria($datos);	
			echo $respuesta;
		}
		

	}

	/*=============================================
	//note: VALIDAR NO REPETIR CATEGORIA
	=============================================*/

	if(isset($_POST["validarcategoria"])){

		$valCategoria = new AjaxCategoria();
		$valCategoria -> validarCategoria = $_POST["validarcategoria"];
		$valCategoria -> ajaxValidarCategoria();

	}

	/*=============================================
	//note: ACTIVAR CATEGORIA
	=============================================*/	

	if(isset($_POST["activarCategoria"])){

		$activarCategoria = new AjaxCategoria();
		$activarCategoria -> activarCategoria = $_POST["activarCategoria"];
		$activarCategoria -> activarId = $_POST["activarId"];
		$activarCategoria -> ajaxActivarCategoria();

	}

	/*=============================================
	//note: TRAER CATEGORIA
	=============================================*/
	if(isset($_POST["idCategoriaEdit"])){
		$traerCategoria = new AjaxCategoria();
		$traerCategoria -> idCategoria = $_POST["idCategoriaEdit"];
		$traerCategoria -> ajaxTraerCategoria();
	}

	/*=============================================
	//note: EDITAR CATEGORIA
	=============================================*/
	if(isset($_POST["idCategoriaEd"])){

		$editarCategoria = new AjaxCategoria();
		$editarCategoria -> idCategoriaEd = $_POST["idCategoriaEd"];
		$editarCategoria -> descripcionEd = $_POST["descripcionCategoriaEd"];

		$editarCategoria -> ajaxEditarCategoria();

	}

