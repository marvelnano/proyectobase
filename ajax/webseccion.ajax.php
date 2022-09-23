<?php

require_once "../controladores/webseccion.controlador.php";
require_once "../modelos/webseccion.modelo.php";


class AjaxWebSeccion{

	/*=============================================
	VALIDAR NO REPETIR WEB SECCIÓN
	=============================================*/	

	public $validarWebSeccion;

	public function ajaxValidarWebSeccion(){

		$item = "descripcion";
		$valor = $this->validarWebSeccion;

		$respuesta = ControladorWebSeccion::ctrMostrarWebSecciones($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
  	ACTIVAR WEB SECCIÓN
 	=============================================*/	

 	public $activarWebSeccion;
	public $activarId;

	public function ajaxActivarWebSeccion(){

		$tabla = "plantilla_web_seccion";

		$item1 = "estado";
		$valor1 = $this->activarWebSeccion;

		$item2 = "idplantillawebseccion";
		$valor2 = $this->activarId;	

		$respuesta = ModeloWebSeccion::mdlActualizarWebSeccion($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	GUARDAR Y EDITAR WEB SECCIÓN
	=============================================*/	

	public $descripcion;

	public function  ajaxCrearWebSeccion(){
		//echo "antes de ir al controlador: ".$this->descripcion;
		$datosCab = array(
			"descripcion"=>$this->descripcion
			);

		$respuesta = ControladorWebSeccion::ctrCrearWebSeccion($datosCab);

		echo $respuesta;
	}

	/*=============================================
	TRAER WEB SECCIÓN
	=============================================*/	

	public $idWebSeccion;

	public function ajaxTraerWebSeccion(){

		$item = "idplantillawebseccion";
		$valor = $this->idWebSeccion;

		$respuesta = ControladorWebSeccion::ctrMostrarWebSecciones($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR WEB SECCIÓN
	=============================================*/	

	public $idWebSeccionEd;
	public $descripcionEd;

	public function ajaxEditarWebSeccion(){

		$datos = array(
			"idwebseccionEd"=>$this->idWebSeccionEd,
			"descripcionEd"=>$this->descripcionEd
			);

		$respuesta = ControladorWebSeccion::ctrEditarWebSeccion($datos);
	
		echo $respuesta;

	}
	

}

/*=============================================
VALIDAR NO REPETIR WEB SECCIÓN
=============================================*/

if(isset($_POST["validarwebseccion"])){

	$valWebSeccion = new AjaxWebSeccion();
	$valWebSeccion -> validarWebSeccion = $_POST["validarwebseccion"];
	$valWebSeccion -> ajaxValidarWebSeccion();

}

/*=============================================
ACTIVAR WEB SECCIÓN
=============================================*/	

if(isset($_POST["activarWebSeccion"])){

	$activarWebSeccion = new AjaxWebSeccion();
	$activarWebSeccion -> activarWebSeccion = $_POST["activarWebSeccion"];
	$activarWebSeccion -> activarId = $_POST["activarId"];
	$activarWebSeccion -> ajaxActivarWebSeccion();

}

/*=============================================
CREAR WEB SECCIÓN
=============================================*/
if(isset($_POST["descripcion"])){
	//echo "ruc: ".$_POST["descripcion"];
	$webseccion = new AjaxWebSeccion();
	$webseccion -> descripcion = $_POST["descripcion"];

	$webseccion -> ajaxCrearWebSeccion();
}

/*=============================================
TRAER WEB SECCIÓN
=============================================*/
if(isset($_POST["idWebSeccionEdit"])){

	$traerWebSeccion = new AjaxWebSeccion();
	$traerWebSeccion -> idWebSeccion = $_POST["idWebSeccionEdit"];
	$traerWebSeccion -> ajaxTraerWebSeccion();

}

/*=============================================
EDITAR WEB SECCIÓN
=============================================*/
if(isset($_POST["idWebSeccionEd"])){

	$editarWebSeccion = new AjaxWebSeccion();
	$editarWebSeccion -> idWebSeccionEd = $_POST["idWebSeccionEd"];
	$editarWebSeccion -> descripcionEd = $_POST["descripcionWebSeccionEd"];

	$editarWebSeccion -> ajaxEditarWebSeccion();

}

