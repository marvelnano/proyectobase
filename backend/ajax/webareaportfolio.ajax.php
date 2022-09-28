<?php

require_once "../controladores/webareaportfolio.controlador.php";
require_once "../modelos/webareaportfolio.modelo.php";


class AjaxWebAreaPortfolio{

	/*=============================================
	VALIDAR NO REPETIR WEB ÁREA PORTFOLIO
	=============================================*/	

	public $validarWebAreaPortfolio;

	public function ajaxValidarWebAreaPortfolio(){

		$item = "descripcion";
		$valor = $this->validarWebAreaPortfolio;

		$respuesta = ControladorWebAreaPortfolio::ctrMostrarWebAreaPortfolios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
  	ACTIVAR WEB ÁREA PORTFOLIO
 	=============================================*/	

 	public $activarWebAreaPortfolio;
	public $activarId;

	public function ajaxActivarWebAreaPortfolio(){

		$tabla = "plantilla_web_area_portfolio";

		$item1 = "estado";
		$valor1 = $this->activarWebAreaPortfolio;

		$item2 = "idplantillawebareaportfolio";
		$valor2 = $this->activarId;	

		$respuesta = ModeloWebAreaPortfolio::mdlActualizarWebAreaPortfolio($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	GUARDAR Y EDITAR WEB ÁREA PORTFOLIO
	=============================================*/	

	public $descripcion;

	public function  ajaxCrearWebAreaPortfolio(){
		//echo "antes de ir al controlador: ".$this->descripcion;
		$datosCab = array(
			"descripcion"=>$this->descripcion
			);

		$respuesta = ControladorWebAreaPortfolio::ctrCrearWebAreaPortfolio($datosCab);

		echo $respuesta;
	}

	/*=============================================
	TRAER WEB ÁREA PORTFOLIO
	=============================================*/	

	public $idWebAreaPortfolio;

	public function ajaxTraerWebAreaPortfolio(){

		$item = "idplantillawebareaportfolio";
		$valor = $this->idWebAreaPortfolio;

		$respuesta = ControladorWebAreaPortfolio::ctrMostrarWebAreaPortfolios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR WEB ÁREA PORTFOLIO
	=============================================*/	

	public $idWebAreaPortfolioEd;
	public $descripcionEd;

	public function ajaxEditarWebAreaPortfolio(){

		$datos = array(
			"idwebareaportfolioEd"=>$this->idWebAreaPortfolioEd,
			"descripcionEd"=>$this->descripcionEd
			);

		$respuesta = ControladorWebAreaPortfolio::ctrEditarWebAreaPortfolio($datos);
	
		echo $respuesta;

	}
	

}

/*=============================================
VALIDAR NO REPETIR WEB ÁREA PORTFOLIO
=============================================*/

if(isset($_POST["validarwebareaportfolio"])){

	$valWebAreaPortfolio = new AjaxWebAreaPortfolio();
	$valWebAreaPortfolio -> validarWebAreaPortfolio = $_POST["validarwebareaportfolio"];
	$valWebAreaPortfolio -> ajaxValidarWebAreaPortfolio();

}

/*=============================================
ACTIVAR WEB ÁREA PORTFOLIO
=============================================*/	

if(isset($_POST["activarWebAreaPortfolio"])){

	$activarWebAreaPortfolio = new AjaxWebAreaPortfolio();
	$activarWebAreaPortfolio -> activarWebAreaPortfolio = $_POST["activarWebAreaPortfolio"];
	$activarWebAreaPortfolio -> activarId = $_POST["activarId"];
	$activarWebAreaPortfolio -> ajaxActivarWebAreaPortfolio();

}

/*=============================================
CREAR WEB ÁREA PORTFOLIO
=============================================*/
if(isset($_POST["descripcion"])){
	//echo "ruc: ".$_POST["descripcion"];
	$webareaportfolio = new AjaxWebAreaPortfolio();
	$webareaportfolio -> descripcion = $_POST["descripcion"];

	$webareaportfolio -> ajaxCrearWebAreaPortfolio();
}

/*=============================================
TRAER WEB ÁREA PORTFOLIO
=============================================*/
if(isset($_POST["idWebAreaPortfolioEdit"])){

	$traerWebAreaPortfolio = new AjaxWebAreaPortfolio();
	$traerWebAreaPortfolio -> idWebAreaPortfolio = $_POST["idWebAreaPortfolioEdit"];
	$traerWebAreaPortfolio -> ajaxTraerWebAreaPortfolio();

}

/*=============================================
EDITAR WEB ÁREA PORTFOLIO
=============================================*/
if(isset($_POST["idWebAreaPortfolioEd"])){

	$editarWebAreaPortfolio = new AjaxWebAreaPortfolio();
	$editarWebAreaPortfolio -> idWebAreaPortfolioEd = $_POST["idWebAreaPortfolioEd"];
	$editarWebAreaPortfolio -> descripcionEd = $_POST["descripcionWebAreaPortfolioEd"];

	$editarWebAreaPortfolio -> ajaxEditarWebAreaPortfolio();

}

