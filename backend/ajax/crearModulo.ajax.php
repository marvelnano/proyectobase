<?php

require_once "../controladores/crearmodulo.controlador.php";
//require_once "../modelos/crearmodulo.modelo.php";

class AjaxCrearModulo{

	/*=============================================
	CREAR MÓDULO
	=============================================*/	

	public $modulo;

	public function  ajaxCrearModulo(){
		//echo "antes de ir al controlador: ".$this->modulo;

		$datosModulo = array(
			"modulo"=>$this->modulo
		);

		$respuesta = ControladorModulo::ctrCrearModulo($datosModulo);

		echo $respuesta;
	}

	/*=============================================
	CREAR CONTROLADOR
	=============================================*/	

	public $controlador;

	public function  ajaxCrearControlador(){
		//echo "antes de ir al controlador: ".$this->controlador;

		$datosControlador = array(
			"controlador"=>$this->controlador
		);

		$respuesta = ControladorModulo::ctrCrearControlador($datosControlador);

		echo $respuesta;
	}
}

/*=============================================
CREAR MÓDULO
=============================================*/
if(isset($_POST["modulo"])){
	//echo "modulo: ".$_POST["modulo"];
	$modulo = new AjaxCrearModulo();
	$modulo -> modulo = $_POST["modulo"];

	$modulo -> ajaxCrearModulo();
}

/*=============================================
CREAR CONTROLADOR
=============================================*/
if(isset($_POST["controlador"])){
	//echo "controlador: ".$_POST["controlador"];
	$controlador = new AjaxCrearModulo();
	$controlador -> controlador = $_POST["controlador"];

	$controlador -> ajaxCrearControlador();
}