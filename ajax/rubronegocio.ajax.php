<?php

require_once "../controladores/rubronegocio.controlador.php";
require_once "../modelos/rubronegocio.modelo.php";


class AjaxRubro{

	/*=============================================
	VALIDAR NO REPETIR RUBRO
	=============================================*/	

	public $validarRubro;

	public function ajaxValidarRubro(){

		$item = "descripcion";
		$valor = $this->validarRubro;

		$respuesta = ControladorRubro::ctrMostrarRubros($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
  	ACTIVAR RUBRO
 	=============================================*/	

 	public $activarRubro;
	public $activarId;

	public function ajaxActivarRubro(){

		$tabla = "rubro_negocio";

		$item1 = "estado";
		$valor1 = $this->activarRubro;

		$item2 = "idrubronegocio";
		$valor2 = $this->activarId;	

		$respuesta = ModeloRubro::mdlActualizarRubro($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	GUARDAR Y EDITAR RUBRO
	=============================================*/	

	public $descripcion;

	public function  ajaxCrearRubro(){
		//echo "antes de ir al controlador: ".$this->descripcion;
		$datosCab = array(
			"descripcion"=>$this->descripcion
			);

		$respuesta = ControladorRubro::ctrCrearRubro($datosCab);

		echo $respuesta;
	}

	/*=============================================
	TRAER RUBRO
	=============================================*/	

	public $idRubro;

	public function ajaxTraerRubro(){

		$item = "idrubronegocio";
		$valor = $this->idRubro;

		$respuesta = ControladorRubro::ctrMostrarRubros($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR RUBRO
	=============================================*/	

	public $idRubroEd;
	public $descripcionEd;

	public function ajaxEditarRubro(){

		$datos = array(
			"idrubroEd"=>$this->idRubroEd,
			"descripcionEd"=>$this->descripcionEd
			);

		$respuesta = ControladorRubro::ctrEditarRubro($datos);
	
		echo $respuesta;

	}
	

}

/*=============================================
VALIDAR NO REPETIR RUBRO
=============================================*/

if(isset($_POST["validarrubro"])){

	$valRubro = new AjaxRubro();
	$valRubro -> validarRubro = $_POST["validarrubro"];
	$valRubro -> ajaxValidarRubro();

}

/*=============================================
ACTIVAR RUBRO
=============================================*/	

if(isset($_POST["activarRubro"])){

	$activarRubro = new AjaxRubro();
	$activarRubro -> activarRubro = $_POST["activarRubro"];
	$activarRubro -> activarId = $_POST["activarId"];
	$activarRubro -> ajaxActivarRubro();

}

/*=============================================
CREAR RUBRO
=============================================*/
if(isset($_POST["descripcion"])){
	//echo "ruc: ".$_POST["descripcion"];
	$rubro = new AjaxRubro();
	$rubro -> descripcion = $_POST["descripcion"];

	$rubro -> ajaxCrearRubro();
}

/*=============================================
TRAER RUBRO
=============================================*/
if(isset($_POST["idRubroEdit"])){

	$traerRubro = new AjaxRubro();
	$traerRubro -> idRubro = $_POST["idRubroEdit"];
	$traerRubro -> ajaxTraerRubro();

}

/*=============================================
EDITAR RUBRO
=============================================*/
if(isset($_POST["idRubroEd"])){

	$editarRubro = new AjaxRubro();
	$editarRubro -> idRubroEd = $_POST["idRubroEd"];
	$editarRubro -> descripcionEd = $_POST["descripcionRubroEd"];

	$editarRubro -> ajaxEditarRubro();

}

