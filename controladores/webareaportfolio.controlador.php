<?php

class ControladorWebAreaPortfolio{

	/*=============================================
	MOSTRAR WEB ÁREA PORTFOLIOS
	=============================================*/

	static public function ctrMostrarWebAreaPortfolios($item, $valor){

		$tabla = "plantilla_web_area_portfolio";

		$respuesta = ModeloWebAreaPortfolio::mdlMostrarWebAreaPortfolios($tabla,$item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR WEB ÁREA PORTFOLIO
	=============================================*/

	static public function ctrCrearWebAreaPortfolio($datos){
		//echo ", seleccionarProveedor: ".$datos["seleccionarProveedor"];
		if(isset($datos["descripcion"])){

			//echo "seleccionarProveedor: ".$datos["seleccionarProveedor"];
			$datosWebAreaPortfolio = array(
						"descripcion"=>$datos["descripcion"]
					);
			
			$respuesta = ModeloWebAreaPortfolio::mdlIngresarWebAreaPortfolio("plantilla_web_area_portfolio", $datosWebAreaPortfolio);

			return $respuesta;
		
		}

	}

	/*=============================================
	EDITAR WEB ÁREA PORTFOLIO
	=============================================*/

	static public function ctrEditarWebAreaPortfolio($datos){

		if(isset($datos["idwebareaportfolioEd"])){
				
			$datosWebAreaPortfolio = array(
				"idplantillawebareaportfolio"=> $datos["idwebareaportfolioEd"],
				"descripcion"=> $datos["descripcionEd"]
			);

			$respuesta = ModeloWebAreaPortfolio::mdlEditarWebAreaPortfolio("plantilla_web_area_portfolio", $datosWebAreaPortfolio);

			return $respuesta;

		}
		
	}

}