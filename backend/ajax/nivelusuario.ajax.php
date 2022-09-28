<?php

require_once "../controladores/nivelusuario.controlador.php";
require_once "../modelos/nivelusuario.modelo.php";


class AjaxNivel{

	/*=============================================
	VALIDAR NO REPETIR NIVEL
	=============================================*/	

	public $validarNivel;

	public function ajaxValidarNivel(){

		$item = "descripcion";
		$valor = $this->validarNivel;

		$respuesta = ControladorNivel::ctrMostrarNiveles($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
  	ACTIVAR NIVEL
 	=============================================*/	

 	public $activarNivel;
	public $activarId;

	public function ajaxActivarNivel(){

		$tabla = "nivel_usuario";

		$item1 = "estado";
		$valor1 = $this->activarNivel;

		$item2 = "idnivelusuario";
		$valor2 = $this->activarId;	

		$respuesta = ModeloNivel::mdlActualizarNivel($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	GUARDAR Y EDITAR NIVEL
	=============================================*/	

	public $descripcion;

	public function  ajaxCrearNivel(){
		//echo "antes de ir al controlador: ".$this->descripcion;
		$datosCab = array(
			"descripcion"=>$this->descripcion
			);

		$respuesta = ControladorNivel::ctrCrearNivel($datosCab);

		echo $respuesta;
	}

	/*=============================================
	TRAER NIVEL
	=============================================*/	

	public $idNivel;

	public function ajaxTraerNivel(){

		$item = "idnivelusuario";
		$valor = $this->idNivel;

		$respuesta = ControladorNivel::ctrMostrarNiveles($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR NIVEL
	=============================================*/	

	public $idNivelEd;
	public $descripcionEd;

	public function ajaxEditarNivel(){

		$datos = array(
			"idnivelEd"=>$this->idNivelEd,
			"descripcionEd"=>$this->descripcionEd
			);

		$respuesta = ControladorNivel::ctrEditarNivel($datos);
	
		echo $respuesta;

	}
	

}

/*=============================================
VALIDAR NO REPETIR NIVEL
=============================================*/

if(isset($_POST["validarnivel"])){

	$valNivel = new AjaxNivel();
	$valNivel -> validarNivel = $_POST["validarnivel"];
	$valNivel -> ajaxValidarNivel();

}

/*=============================================
ACTIVAR NIVEL
=============================================*/	

if(isset($_POST["activarNivel"])){

	$activarNivel = new AjaxNivel();
	$activarNivel -> activarNivel = $_POST["activarNivel"];
	$activarNivel -> activarId = $_POST["activarId"];
	$activarNivel -> ajaxActivarNivel();

}

/*=============================================
CREAR NIVEL
=============================================*/
if(isset($_POST["descripcion"])){
	//echo "ruc: ".$_POST["descripcion"];
	$nivel = new AjaxNivel();
	$nivel -> descripcion = $_POST["descripcion"];

	$nivel -> ajaxCrearNivel();
}

/*=============================================
TRAER NIVEL
=============================================*/
if(isset($_POST["idNivelEdit"])){

	$traerNivel = new AjaxNivel();
	$traerNivel -> idNivel = $_POST["idNivelEdit"];
	$traerNivel -> ajaxTraerNivel();

}

/*=============================================
EDITAR NIVEL
=============================================*/
if(isset($_POST["idNivelEd"])){

	$editarNivel = new AjaxNivel();
	$editarNivel -> idNivelEd = $_POST["idNivelEd"];
	$editarNivel -> descripcionEd = $_POST["descripcionNivelEd"];

	$editarNivel -> ajaxEditarNivel();

}

