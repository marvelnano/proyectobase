<?php

require_once "../controladores/webplantilla.controlador.php";
require_once "../modelos/webplantilla.modelo.php";


class AjaxWebPlantilla{

	/*=============================================
	VALIDAR NO REPETIR CONTENIDO DE WEB PLANTILLA
	=============================================*/	

	public $validarContenido;

	public function ajaxValidarWebPlantilla(){

		$item = "contenido";
		$valor = $this->validarContenido;

		$respuesta = ControladorWebPlantilla::ctrMostrarPlantillasWeb($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
  	ACTIVAR WEB PLANTILLA
 	=============================================*/	

 	public $activarWebPlantilla;
	public $activarId;

	public function ajaxActivarWebPlantilla(){

		$tabla = "plantilla_web";

		$item1 = "estado";
		$valor1 = $this->activarWebPlantilla;

		$item2 = "idplantillaweb";
		$valor2 = $this->activarId;	

		$respuesta = ModeloWebPlantilla::mdlActualizarWebPlantilla($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	GUARDAR Y EDITAR WEB PLANTILLA
	=============================================*/	

	public $idnegocio;
	public $idseccionweb;
	public $contenido;

	public function  ajaxCrearWebPlantilla(){
		//echo "antes de ir al controlador: ".$this->descripcion;
		$datosCab = array(
				"idnegocio"=>$this->idnegocio,
				"idseccionweb"=>$this->idseccionweb,
				"contenido"=>$this->contenido
			);

		$respuesta = ControladorWebPlantilla::ctrCrearWebPlantilla($datosCab);

		echo $respuesta;
	}

	/*=============================================
	TRAER WEB PLANTILLA
	=============================================*/	

	public $idWebPlantilla;

	public function ajaxTraerWebPlantilla(){

		$item = "idplantillaweb";
		$valor = $this->idWebPlantilla;

		$respuesta = ControladorWebPlantilla::ctrMostrarPlantillasWeb($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR WEB PLANTILLA
	=============================================*/	

	public $idwebplantillaEd;
	public $idnegocioEd;
	public $idseccionwebEd;
	public $contenidoEd;

	public function ajaxEditarWebPlantilla(){

		$datos = array(
			"idwebplantillaEd"=>$this->idwebplantillaEd,
			"idnegocioEd"=>$this->idnegocioEd,
			"idseccionwebEd"=>$this->idseccionwebEd,
			"contenidoEd"=>$this->contenidoEd
			);

		$respuesta = ControladorWebPlantilla::ctrEditarWebPlantilla($datos);
	
		echo $respuesta;

	}
	
}

/*=============================================
VALIDAR NO REPETIR WEB PLANTILLA
=============================================*/

if(isset($_POST["validarcontenido"])){

	$valNivel = new AjaxWebPlantilla();
	$valNivel -> validarContenido = $_POST["validarcontenido"];
	$valNivel -> ajaxValidarWebPlantilla();

}

/*=============================================
ACTIVAR WEB PLANTILLA
=============================================*/	

if(isset($_POST["activarWebPlantilla"])){

	$activarWebPlantilla = new AjaxWebPlantilla();
	$activarWebPlantilla -> activarWebPlantilla = $_POST["activarWebPlantilla"];
	$activarWebPlantilla -> activarId = $_POST["activarId"];
	$activarWebPlantilla -> ajaxActivarWebPlantilla();

}

/*=============================================
CREAR WEB PLANTILLA
=============================================*/
if(isset($_POST["contenido"])){
	//echo "idseccionweb: ".$_POST["descripcion"];
	$plantilla_web = new AjaxWebPlantilla();
	$plantilla_web -> idnegocio = $_POST["idnegocio"];
	$plantilla_web -> idseccionweb = $_POST["idseccionweb"];
	$plantilla_web -> contenido = $_POST["contenido"];

	$plantilla_web -> ajaxCrearWebPlantilla();
}

/*=============================================
TRAER WEB PLANTILLA
=============================================*/
if(isset($_POST["idWebPlantillaEdit"])){

	$traerWebPlantilla = new AjaxWebPlantilla();
	$traerWebPlantilla -> idWebPlantilla = $_POST["idWebPlantillaEdit"];
	$traerWebPlantilla -> ajaxTraerWebPlantilla();

}

/*=============================================
EDITAR WEB PLANTILLA
=============================================*/
if(isset($_POST["idwebplantillaEd"])){

	$editarWebPlantilla = new AjaxWebPlantilla();
	$editarWebPlantilla -> idwebplantillaEd = $_POST["idwebplantillaEd"];
	$editarWebPlantilla -> idnegocioEd = $_POST["idnegocioEd"];
	$editarWebPlantilla -> idseccionwebEd = $_POST["idseccionwebEd"];
	$editarWebPlantilla -> contenidoEd = $_POST["contenidoEd"];
	$editarWebPlantilla -> ajaxEditarWebPlantilla();

}
