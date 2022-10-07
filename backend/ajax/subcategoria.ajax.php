<?php

	//TODO: Template Ajax
	require_once "../controladores/subcategoria.controlador.php";
	require_once "../modelos/subcategoria.modelo.php";


	class AjaxSubCategoria{

		/*=============================================
		//tag: VALIDAR NO REPETIR SUBCATEGORIA
		=============================================*/	

		public $validarSubCategoria;

		public function ajaxValidarSubCategoria(){
			$item = "descripcion";
			$valor = $this->validarSubCategoria;

			$respuesta = ControladorSubCategoria::ctrMostrarSubCategoria($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: ACTIVAR SUBCATEGORIA
		=============================================*/	

		public $activarSubCategoria;
		public $activarId;

		public function ajaxActivarSubCategoria(){
			$tabla = "categoria";

			$item1 = "estado";
			$valor1 = $this->activarSubCategoria;

			$item2 = "idsubcategoria";
			$valor2 = $this->activarId;	

			$respuesta = ModeloSubCategoria::mdlActualizarSubCategoria($tabla, $item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		/*=============================================
		//note: TRAER SUBCATEGORIA
		=============================================*/	

		public $idSubCategoria;

		public function ajaxTraerSubCategoria(){
			$item = "idsubcategoria";
			$valor = $this->idSubCategoria;

			$respuesta = ControladorSubCategoria::ctrMostrarSubCategoria($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//fixme: EDITAR SUBCATEGORIA
		=============================================*/	

		/*public $idSubCategoriaEd;
		public $descripcionEd;

		public function ajaxEditarSubCategoria(){
			$datos = array(
				"idsubcategoriaEd"=>$this->idSubCategoriaEd,
				"descripcionEd"=>$this->descripcionEd
				);

			$respuesta = ControladorSubCategoria::ctrEditarSubCategoria($datos);	
			echo $respuesta;
		}*/		

	}

	/*=============================================
	//note: VALIDAR NO REPETIR SUBCATEGORIA
	=============================================*/

	if(isset($_POST["validarsubcategoria"])){

		$valSubCategoria = new AjaxSubCategoria();
		$valSubCategoria -> activarSubCategoria = $_POST["validarsubcategoria"];
		$valSubCategoria -> ajaxValidarSubCategoria();

	}

	/*=============================================
	//note: ACTIVAR SUBCATEGORIA
	=============================================*/	

	if(isset($_POST["activarSubCategoria"])){

		$activarSubCategoria = new AjaxSubCategoria();
		$activarSubCategoria -> activarSubCategoria = $_POST["activarSubCategoria"];
		$activarSubCategoria -> activarId = $_POST["activarId"];
		$activarSubCategoria -> ajaxActivarSubCategoria();

	}

	/*=============================================
	//note: TRAER SUBCATEGORIA
	=============================================*/
	if(isset($_POST["idSubCategoriaEdit"])){
		$traerSubCategoria = new AjaxSubCategoria();
		$traerSubCategoria -> idSubCategoria = $_POST["idSubCategoriaEdit"];
		$traerSubCategoria -> ajaxTraerSubCategoria();
	}

	/*=============================================
	//fixme: EDITAR CATEGORIA
	=============================================*/
	/*if(isset($_POST["idSubCategoriaEd"])){

		$editarCategoria = new AjaxCategoria();
		$editarCategoria -> idSubCategoriaEd = $_POST["idSubCategoriaEd"];
		$editarCategoria -> descripcionEd = $_POST["descripcionCategoriaEd"];

		$editarCategoria -> ajaxEditarCategoria();

	}*/

