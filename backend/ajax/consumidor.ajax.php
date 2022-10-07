<?php

	//TODO: Template Ajax
	require_once "../controladores/consumidor.controlador.php";
	require_once "../modelos/consumidor.modelo.php";


	class AjaxConsumidor{

		/*=============================================
		//tag: VALIDAR NO REPETIR CONSUMIDOR
		=============================================*/	

		public $validarConsumidor;

		public function ajaxValidarConsumidor(){
			$item = "descripcion";
			$valor = $this->validarConsumidor;

			$respuesta = ControladorConsumidor::ctrMostrarConsumidor($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: ACTIVAR CONSUMIDOR
		=============================================*/	

		public $activarConsumidor;
		public $activarId;

		public function ajaxActivarConsumidor(){
			$tabla = "consumidor";

			$item1 = "estado";
			$valor1 = $this->activarConsumidor;

			$item2 = "idconsumidor";
			$valor2 = $this->activarId;	

			$respuesta = ModeloConsumidor::mdlActualizarConsumidor($tabla, $item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		/*=============================================
		//tag: GUARDAR Y EDITAR CONSUMIDOR
		=============================================*/	

		public $descripcion;

		public function  ajaxCrearConsumidor(){
			//echo "antes de ir al controlador: ".$this->descripcion;
			$datosCab = array(
				"descripcion"=>$this->descripcion
				);

			$respuesta = ControladorConsumidor::ctrCrearConsumidor($datosCab);

			echo $respuesta;
		}

		/*=============================================
		//tag: TRAER CONSUMIDOR
		=============================================*/	

		public $idConsumidor;

		public function ajaxTraerConsumidor(){
			$item = "idconsumidor";
			$valor = $this->idConsumidor;

			$respuesta = ControladorConsumidor::ctrMostrarConsumidor($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//fixme: EDITAR CONSUMIDOR
		=============================================*/	

		/*public $idConsumidorEd;
		public $descripcionEd;

		public function ajaxEditarConsumidor(){
			$datos = array(
				"idconsumidorEd"=>$this->idConsumidorEd,
				"descripcionEd"=>$this->descripcionEd
				);

			$respuesta = ControladorConsumidor::ctrEditarConsumidor($datos);	
			echo $respuesta;
		}*/		

	}

	/*=============================================
	//note: VALIDAR NO REPETIR CONSUMIDOR
	=============================================*/

	if(isset($_POST["validarconsumidor"])){

		$valConsumidor = new AjaxConsumidor();
		$valConsumidor -> validarConsumidor = $_POST["validarconsumidor"];
		$valConsumidor -> ajaxValidarConsumidor();

	}

	/*=============================================
	//note: ACTIVAR CONSUMIDOR
	=============================================*/	

	if(isset($_POST["activarConsumidor"])){

		$activarConsumidor = new AjaxConsumidor();
		$activarConsumidor -> activarConsumidor = $_POST["activarConsumidor"];
		$activarConsumidor -> activarId = $_POST["activarId"];
		$activarConsumidor -> ajaxActivarConsumidor();

	}

	/*=============================================
	//note: CREAR CONSUMIDOR
	=============================================*/
	if(isset($_POST["descripcion"])){
		//echo "ruc: ".$_POST["descripcion"];
		$consumidor = new AjaxConsumidor();
		$consumidor -> descripcion = $_POST["descripcion"];

		$consumidor -> ajaxCrearConsumidor();
	}

	/*=============================================
	//note: TRAER CONSUMIDOR
	=============================================*/
	if(isset($_POST["idConsumidorEdit"])){

		$traerConsumidor = new AjaxConsumidor();
		$traerConsumidor -> idConsumidor = $_POST["idConsumidorEdit"];
		$traerConsumidor -> ajaxTraerConsumidor();

	}

	/*=============================================
	//fixme: EDITAR CONSUMIDOR
	=============================================*/
	/*if(isset($_POST["idConsumidorEd"])){

		$editarConsumidor = new AjaxConsumidor();
		$editarConsumidor -> idConsumidorEd = $_POST["idConsumidorEd"];
		$editarConsumidor -> descripcionEd = $_POST["descripcionConsumidorEd"];

		$editarConsumidor -> ajaxEditarConsumidor();

	}*/

