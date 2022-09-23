<?php

require_once "../controladores/proyecto.controlador.php";
require_once "../modelos/proyecto.modelo.php";


class AjaxProyecto{

	/*=============================================
	GUARDAR Y EDITAR PROYECTO
	=============================================*/	

	public $ruc;
	public $razonsocial;
	public $nombrecomercial;
	public $abreviatura;			
	public $email;
	public $telefono;
	public $web;
	public $seleccionarUbigeo;
	public $direccion;
	/* public $firma;
	public $usuariosol;
	public $clavesol; */

	public function  ajaxCrearProyecto(){
		//echo "antes de ir al controlador: ".$this->ruc;
		$datosCab = array(
			"ruc"=>$this->ruc,
			"razonsocial"=>$this->razonsocial,
			"nombrecomercial"=>$this->nombrecomercial,
			"abreviatura"=>$this->abreviatura,
			"email"=>$this->email,
			"telefono"=>$this->telefono,
			"web"=>$this->web,
			"seleccionarUbigeo"=>$this->seleccionarUbigeo,
			"direccion"=>$this->direccion/* ,
			"firma"=>$this->firma,
			"usuariosol"=>$this->usuariosol,
			"clavesol"=>$this->clavesol */
			);

		$respuesta = ControladorProyecto::ctrCrearProyecto($datosCab);

		echo $respuesta;
	}

	/*=============================================
	TRAER PROYECTO
	=============================================*/	

	public $idProyecto;

	public function ajaxTraerProyecto(){

		$item = "idproyecto";
		$valor = $this->idProyecto;

		$respuesta = ControladorProyecto::ctrMostrarProyectos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR PROYECTO
	=============================================*/	

	public $idProyectoEd;
	public $rucEd;
	public $razonsocialEd;
	public $nombrecomercialEd;
	public $abreviaturaEd;			
	public $emailEd;
	public $telefonoEd;
	public $webEd;
	public $seleccionarUbigeoEd;
	public $direccionEd;
	/* public $firmaEd;
	public $usuariosolEd;
	public $clavesolEd; */

	public function ajaxEditarProyecto(){

		$datos = array(
			"idproyectoEd"=>$this->idProyectoEd,
			"rucEd"=>$this->rucEd,
			"razonsocialEd"=>$this->razonsocialEd,
			"nombrecomercialEd"=>$this->nombrecomercialEd,
			"abreviaturaEd"=>$this->abreviaturaEd,
			"emailEd"=>$this->emailEd,
			"telefonoEd"=>$this->telefonoEd,
			"webEd"=>$this->webEd,
			"seleccionarUbigeoEd"=>$this->seleccionarUbigeoEd,
			"direccionEd"=>$this->direccionEd/* ,
			"firmaEd"=>$this->firmaEd,
			"usuariosolEd"=>$this->usuariosolEd,
			"clavesolEd"=>$this->clavesolEd */
			);

		$respuesta = ControladorProyecto::ctrEditarProyecto($datos);
	
		echo $respuesta;

	}
	

}

/*=============================================
CREAR PROYECTO
=============================================*/
if(isset($_POST["ruc"])){
	//echo "ruc: ".$_POST["ruc"];
	$proyecto = new AjaxProyecto();
	$proyecto -> ruc = $_POST["ruc"];
	$proyecto -> razonsocial = $_POST["razonsocial"];
	$proyecto -> nombrecomercial = $_POST["nombrecomercial"];
	$proyecto -> abreviatura = $_POST["abreviatura"];
	$proyecto -> email = $_POST["email"];
	$proyecto -> telefono = $_POST["telefono"];
	$proyecto -> web = $_POST["web"];
	$proyecto -> seleccionarUbigeo = $_POST["seleccionarUbigeo"];
	$proyecto -> direccion = $_POST["direccion"];
	/* $proyecto -> firma = $_POST["firma"];
	$proyecto -> usuariosol = $_POST["usuariosol"];
	$proyecto -> clavesol = $_POST["clavesol"]; */

	$proyecto -> ajaxCrearProyecto();
}

/*=============================================
TRAER PROYECTO
=============================================*/
if(isset($_POST["idProyectoEdit"])){

	$traerProyecto = new AjaxProyecto();
	$traerProyecto -> idProyecto = $_POST["idProyectoEdit"];
	$traerProyecto -> ajaxTraerProyecto();

}

/*=============================================
EDITAR PROYECTO
=============================================*/
if(isset($_POST["idProyectoEd"])){

	$editarProyecto = new AjaxProyecto();
	$editarProyecto -> idProyectoEd = $_POST["idProyectoEd"];
	$editarProyecto -> rucEd = $_POST["rucProyectoEd"];
	$editarProyecto -> razonsocialEd = $_POST["razonsocialProyectoEd"];
	$editarProyecto -> nombrecomercialEd = $_POST["nombrecomercialProyectoEd"];
	$editarProyecto -> abreviaturaEd = $_POST["abreviaturaProyectoEd"];
	$editarProyecto -> emailEd = $_POST["emailProyectoEd"];
	$editarProyecto -> telefonoEd = $_POST["telefonoProyectoEd"];
	$editarProyecto -> webEd = $_POST["webProyectoEd"];
	$editarProyecto -> seleccionarUbigeoEd = $_POST["seleccionarubigeoProyectoEd"];
	$editarProyecto -> direccionEd = $_POST["direccionProyectoEd"];
	/* $editarProyecto -> firmaEd = $_POST["firmaProyectoEd"];
	$editarProyecto -> usuariosolEd = $_POST["usuariosolProyectoEd"];
	$editarProyecto -> clavesolEd = $_POST["clavesolProyectoEd"]; */

	$editarProyecto -> ajaxEditarProyecto();

}

