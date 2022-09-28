<?php

require_once "../controladores/negocio.controlador.php";
require_once "../modelos/negocio.modelo.php";

class AjaxNegocio{

	/*=============================================
	VALIDAR NO REPETIR TITULO DE NEGOCIO
	=============================================*/	

	public $validarRazonSocial;

	public function ajaxValidarNegocio(){

		$item = "razon_social";
		$valor = $this->validarRazonSocial;

		$respuesta = ControladorNegocio::ctrMostrarNegocios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
  	ACTIVAR NEGOCIO
 	=============================================*/	

 	public $activarNegocio;
	public $activarId;

	public function ajaxActivarNegocio(){

		$tabla = "negocio";

		$item1 = "estado";
		$valor1 = $this->activarNegocio;

		$item2 = "idnegocio";
		$valor2 = $this->activarId;	

		$respuesta = ModeloNegocio::mdlActualizarNegocio($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	GUARDAR Y EDITAR NEGOCIO
	=============================================*/	

	public $idrubronegocio;
	public $ruc;
	public $razon_social;
	public $direccion;
	public $celular;
	public $email;
	public $pagina_web;

	public function  ajaxCrearNegocio(){
		//echo "antes de ir al controlador: ".$this->descripcion;
		$datosCab = array(
				"idrubronegocio"=>$this->idrubronegocio,
				"ruc"=>$this->ruc,
				"razon_social"=>$this->razon_social,
				"direccion"=>$this->direccion,
				"celular"=>$this->celular,
				"email"=>$this->email,
				"pagina_web"=>$this->pagina_web
			);

		$respuesta = ControladorNegocio::ctrCrearNegocio($datosCab);

		echo $respuesta;
	}

	/*=============================================
	TRAER NEGOCIO
	=============================================*/	

	public $idNegocio;

	public function ajaxTraerNegocio(){

		$item = "idnegocio";
		$valor = $this->idNegocio;

		$respuesta = ControladorNegocio::ctrMostrarNegocios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR NEGOCIO
	=============================================*/	

	public $idNegocioEd;
	public $idrubronegocioEd;
	public $rucEd;
	public $razon_socialEd;
	public $direccionEd;
	public $celularEd;
	public $emailEd;
	public $pagina_webEd;

	public function ajaxEditarNegocio(){
		$datos = array(
			"idnegocioEd"=>$this->idNegocioEd,
			"idrubronegocioEd"=>$this->idrubronegocioEd,
			"rucEd"=>$this->rucEd,
			"razon_socialEd"=>$this->razon_socialEd,
			"direccionEd"=>$this->direccionEd,
			"celularEd"=>$this->celularEd,
			"emailEd"=>$this->emailEd,
			"pagina_webEd"=>$this->pagina_webEd
			);

		$respuesta = ControladorNegocio::ctrEditarNegocio($datos);
	
		echo $respuesta;
	}

	/*=============================================
	VER NEGOCIO
	=============================================*/	
	public $idVerNegocio;

	public function ajaxVerNegocio(){
		$valor = $this->idVerNegocio;
		$respuesta = ControladorNegocio::ctrVerNegocio($valor);
		echo json_encode($respuesta);
	}
	
}

/*=============================================
VALIDAR NO REPETIR NEGOCIO
=============================================*/

if(isset($_POST["validarrazon_social"])){

	$valNivel = new AjaxNegocio();
	$valNivel -> validarRazonSocial = $_POST["validarrazon_social"];
	$valNivel -> ajaxValidarNegocio();

}

/*=============================================
ACTIVAR NEGOCIOS
=============================================*/	

if(isset($_POST["activarNegocio"])){

	$activarNegocio = new AjaxNegocio();
	$activarNegocio -> activarNegocio = $_POST["activarNegocio"];
	$activarNegocio -> activarId = $_POST["activarId"];
	$activarNegocio -> ajaxActivarNegocio();

}

/*=============================================
CREAR NEGOCIO
=============================================*/
if(isset($_POST["razon_social"])){
	//echo "ruc: ".$_POST["descripcion"];
	$negocio = new AjaxNegocio();
	$negocio -> idrubronegocio = $_POST["idrubronegocio"];
	$negocio -> ruc = $_POST["ruc"];
	$negocio -> razon_social = $_POST["razon_social"];
	$negocio -> direccion = $_POST["direccion"];
	$negocio -> celular = $_POST["celular"];
	$negocio -> email = $_POST["email"];
	$negocio -> pagina_web = $_POST["pagina_web"];

	$negocio -> ajaxCrearNegocio();
}

/*=============================================
TRAER NEGOCIO
=============================================*/
if(isset($_POST["idNegocioEdit"])){

	$traerNegocio = new AjaxNegocio();
	$traerNegocio -> idNegocio = $_POST["idNegocioEdit"];
	$traerNegocio -> ajaxTraerNegocio();

}

/*=============================================
EDITAR NEGOCIO
=============================================*/
if(isset($_POST["idNegocioEd"])){

	$editarNegocio = new AjaxNegocio();
	$editarNegocio -> idNegocioEd = $_POST["idNegocioEd"];
	$editarNegocio -> idrubronegocioEd = $_POST["idrubronegocioEd"];
	$editarNegocio -> rucEd = $_POST["rucEd"];
	$editarNegocio -> razon_socialEd = $_POST["razon_socialEd"];
	$editarNegocio -> direccionEd = $_POST["direccionEd"];
	$editarNegocio -> celularEd = $_POST["celularEd"];
	$editarNegocio -> emailEd = $_POST["emailEd"];
	$editarNegocio -> pagina_webEd = $_POST["pagina_webEd"];

	$editarNegocio -> ajaxEditarNegocio();

}

/*=============================================
Ver NEGOCIO
=============================================*/
if(isset($_POST["idVerNegocio"])){
	$traerNegocioWeb = new AjaxNegocio();
	$traerNegocioWeb -> idVerNegocio = $_POST["idVerNegocio"];
	$traerNegocioWeb -> ajaxVerNegocio();
}
