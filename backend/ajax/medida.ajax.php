<?php

	//TODO: Template Ajax
	require_once "../controladores/medida.controlador.php";
	require_once "../modelos/medida.modelo.php";


	class AjaxMedida{

		/*=============================================
		//tag: VALIDAR NO REPETIR MEDIDA
		=============================================*/	

		public $validarMedida;

		public function ajaxValidarMedida(){
			$item = "descripcion";
			$valor = $this->validarMedida;

			$respuesta = ControladorMedida::ctrMostrarMedida($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: ACTIVAR MEDIDA
		=============================================*/	

		public $activarMedida;
		public $activarId;

		public function ajaxActivarMedida(){
			$tabla = "medida";

			$item1 = "estado";
			$valor1 = $this->activarMedida;

			$item2 = "idmedida";
			$valor2 = $this->activarId;	

			$respuesta = ModeloMedida::mdlActualizarMedida($tabla, $item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		/*=============================================
		//tag: GUARDAR Y EDITAR MEDIDA
		=============================================*/	

		public $descripcion;

		public function  ajaxCrearMedida(){
			//echo "antes de ir al controlador: ".$this->descripcion;
			$datosCab = array(
				"descripcion"=>$this->descripcion
				);

			$respuesta = ControladorMedida::ctrCrearMedida($datosCab);

			echo $respuesta;
		}

		/*=============================================
		//tag: TRAER MEDIDA
		=============================================*/	

		public $idMedida;

		public function ajaxTraerMedida(){
			$item = "idmedida";
			$valor = $this->idMedida;

			$respuesta = ControladorMedida::ctrMostrarMedida($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: EDITAR MEDIDA
		=============================================*/	

		public $idMedidaEd;
		public $descripcionEd;

		public function ajaxEditarMedida(){
			$datos = array(
				"idmedidaEd"=>$this->idMedidaEd,
				"descripcionEd"=>$this->descripcionEd
				);

			$respuesta = ControladorMedida::ctrEditarMedida($datos);	
			echo $respuesta;
		}
		

	}

	/*=============================================
	//note: VALIDAR NO REPETIR MEDIDA
	=============================================*/

	if(isset($_POST["validarmedida"])){

		$valMedida = new AjaxMedida();
		$valMedida -> validarMedida = $_POST["validarmedida"];
		$valMedida -> ajaxValidarMedida();

	}

	/*=============================================
	//note: ACTIVAR MEDIDA
	=============================================*/	

	if(isset($_POST["activarMedida"])){

		$activarMedida = new AjaxMedida();
		$activarMedida -> activarMedida = $_POST["activarMedida"];
		$activarMedida -> activarId = $_POST["activarId"];
		$activarMedida -> ajaxActivarMedida();

	}

	/*=============================================
	//note: CREAR MEDIDA
	=============================================*/
	if(isset($_POST["descripcion"])){
		//echo "ruc: ".$_POST["descripcion"];
		$medida = new AjaxMedida();
		$medida -> descripcion = $_POST["descripcion"];

		$medida -> ajaxCrearMedida();
	}

	/*=============================================
	//note: TRAER MEDIDA
	=============================================*/
	if(isset($_POST["idMedidaEdit"])){

		$traerMedida = new AjaxMedida();
		$traerMedida -> idMedida = $_POST["idMedidaEdit"];
		$traerMedida -> ajaxTraerMedida();

	}

	/*=============================================
	//note: EDITAR MEDIDA
	=============================================*/
	if(isset($_POST["idRubroEd"])){

		$editarMedida = new AjaxMedida();
		$editarMedida -> idMedidaEd = $_POST["idMedidaEd"];
		$editarMedida -> descripcionEd = $_POST["descripcionMedidaEd"];

		$editarMedida -> ajaxEditarMedida();

	}

