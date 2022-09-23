<?php

require_once "../controladores/webportfolio.controlador.php";
require_once "../modelos/webportfolio.modelo.php";

class AjaxWebPortfolio{

	/*=============================================
	ACTIVAR WEBPORTFOLIO
	=============================================*/	

	public $activarWebPortfolio;
	public $activarId;

	public function ajaxActivarWebPortfolio(){
		$tabla = "plantilla_web_portfolio";

		$item1 = "estado";
		$valor1 = $this->activarWebPortfolio;

		$item2 = "idplantillawebportfolio";
		$valor2 = $this->activarId;

		$respuesta = ModeloWebPortfolio::mdlActualizarWebPortfolio($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;
	}

	/*=============================================
	EDITAR WEBPORTFOLIO
	=============================================*/	

	public $idWebPortfolio;

	public function ajaxEditarWebPortfolio(){
		$item = "idplantillawebportfolio";
		$valor = $this->idWebPortfolio;

		$respuesta = ControladorWebPortfolio::ctrMostrarWebPortfolios($item, $valor);

		echo json_encode($respuesta);
	}
}

/*=============================================
ACTIVAR WEBPORTFOLIO
=============================================*/	

if(isset($_POST["activarWebPortfolio"])){
	$activarWebPortfolio = new AjaxWebPortfolio();
	$activarWebPortfolio -> activarWebPortfolio = $_POST["activarWebPortfolio"];
	$activarWebPortfolio -> activarId = $_POST["activarId"];
	$activarWebPortfolio -> ajaxActivarWebPortfolio();
}

/*=============================================
EDITAR WEBPORTFOLIO
=============================================*/
if(isset($_POST["idWebPortfolio"])){
	$editar = new AjaxWebPortfolio();
	$editar -> idWebPortfolio = $_POST["idWebPortfolio"];
	$editar -> ajaxEditarWebPortfolio();
}