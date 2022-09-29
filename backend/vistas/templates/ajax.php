<?php

	//TODO: Template Ajax
	require_once "../controladores/{CONTROLADORMIN}.controlador.php";
	require_once "../modelos/{CONTROLADORMIN}.modelo.php";


	class Ajax{CONTROLADOR}{

		/*=============================================
		//tag: VALIDAR NO REPETIR {CONTROLADORMAY}
		=============================================*/	

		public $validar{CONTROLADOR};

		public function ajaxValidar{CONTROLADOR}(){
			$item = "descripcion";
			$valor = $this->validar{CONTROLADOR};

			$respuesta = Controlador{CONTROLADOR}::ctrMostrar{CONTROLADOR}($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: ACTIVAR {CONTROLADORMAY}
		=============================================*/	

		public $activar{CONTROLADOR};
		public $activarId;

		public function ajaxActivar{CONTROLADOR}(){
			$tabla = "{CONTROLADORMIN}";

			$item1 = "estado";
			$valor1 = $this->activar{CONTROLADOR};

			$item2 = "id{CONTROLADORMIN}";
			$valor2 = $this->activarId;	

			$respuesta = Modelo{CONTROLADOR}::mdlActualizar{CONTROLADOR}($tabla, $item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		/*=============================================
		//tag: GUARDAR Y EDITAR {CONTROLADORMAY}
		=============================================*/	

		public $descripcion;

		public function  ajaxCrear{CONTROLADOR}(){
			//echo "antes de ir al controlador: ".$this->descripcion;
			$datosCab = array(
				"descripcion"=>$this->descripcion
				);

			$respuesta = Controlador{CONTROLADOR}::ctrCrear{CONTROLADOR}($datosCab);

			echo $respuesta;
		}

		/*=============================================
		//tag: TRAER {CONTROLADORMAY}
		=============================================*/	

		public $id{CONTROLADOR};

		public function ajaxTraer{CONTROLADOR}(){
			$item = "id{CONTROLADORMIN}";
			$valor = $this->id{CONTROLADOR};

			$respuesta = Controlador{CONTROLADOR}::ctrMostrar{CONTROLADOR}($item, $valor);
			echo json_encode($respuesta);
		}

		/*=============================================
		//tag: EDITAR {CONTROLADORMAY}
		=============================================*/	

		public $id{CONTROLADOR}Ed;
		public $descripcionEd;

		public function ajaxEditar{CONTROLADOR}(){
			$datos = array(
				"id{CONTROLADORMIN}Ed"=>$this->id{CONTROLADOR}Ed,
				"descripcionEd"=>$this->descripcionEd
				);

			$respuesta = Controlador{CONTROLADOR}::ctrEditar{CONTROLADOR}($datos);	
			echo $respuesta;
		}
		

	}

	/*=============================================
	//note: VALIDAR NO REPETIR {CONTROLADORMAY}
	=============================================*/

	if(isset($_POST["validar{CONTROLADORMIN}"])){

		$val{CONTROLADOR} = new Ajax{CONTROLADOR}();
		$val{CONTROLADOR} -> validar{CONTROLADOR} = $_POST["validar{CONTROLADORMIN}"];
		$val{CONTROLADOR} -> ajaxValidar{CONTROLADOR}();

	}

	/*=============================================
	//note: ACTIVAR {CONTROLADORMAY}
	=============================================*/	

	if(isset($_POST["activar{CONTROLADOR}"])){

		$activar{CONTROLADOR} = new Ajax{CONTROLADOR}();
		$activar{CONTROLADOR} -> activar{CONTROLADOR} = $_POST["activar{CONTROLADOR}"];
		$activar{CONTROLADOR} -> activarId = $_POST["activarId"];
		$activar{CONTROLADOR} -> ajaxActivar{CONTROLADOR}();

	}

	/*=============================================
	//note: CREAR {CONTROLADORMAY}
	=============================================*/
	if(isset($_POST["descripcion"])){
		//echo "ruc: ".$_POST["descripcion"];
		${CONTROLADORMIN} = new Ajax{CONTROLADOR}();
		${CONTROLADORMIN} -> descripcion = $_POST["descripcion"];

		${CONTROLADORMIN} -> ajaxCrear{CONTROLADOR}();
	}

	/*=============================================
	//note: TRAER {CONTROLADORMAY}
	=============================================*/
	if(isset($_POST["id{CONTROLADOR}Edit"])){

		$traer{CONTROLADOR} = new Ajax{CONTROLADOR}();
		$traer{CONTROLADOR} -> id{CONTROLADOR} = $_POST["id{CONTROLADOR}Edit"];
		$traer{CONTROLADOR} -> ajaxTraer{CONTROLADOR}();

	}

	/*=============================================
	//note: EDITAR {CONTROLADORMAY}
	=============================================*/
	if(isset($_POST["id{CONTROLADOR}Ed"])){

		$editar{CONTROLADOR} = new Ajax{CONTROLADOR}();
		$editar{CONTROLADOR} -> id{CONTROLADOR}Ed = $_POST["id{CONTROLADOR}Ed"];
		$editar{CONTROLADOR} -> descripcionEd = $_POST["descripcion{CONTROLADOR}Ed"];

		$editar{CONTROLADOR} -> ajaxEditar{CONTROLADOR}();

	}

