<?php

require_once "../controladores/administradores.controlador.php";
require_once "../modelos/administradores.modelo.php";

class AjaxAdministradores{

	/*=============================================
	ACTIVAR PERFIL
	=============================================*/	
	public $activarPerfil;
	public $activarId;
	public function ajaxActivarPerfil(){
		$tabla = "usuario";
		$item1 = "estado";
		$valor1 = $this->activarPerfil;
		$item2 = "idusuario";
		$valor2 = $this->activarId;
		$respuesta = ModeloAdministradores::mdlActualizarPerfil($tabla, $item1, $valor1, $item2, $valor2);
		echo $respuesta;
	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/	
	public $idPerfil;
	public function ajaxEditarPerfil(){
		$item = "idusuario";
		$valor = $this->idPerfil;
		$respuesta = ControladorAdministradores::ctrMostrarAdministradores($item, $valor);
		echo json_encode($respuesta);
	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	
	public $activarUsuario;
	public $activarIdUsuario;
	public function ajaxActivarUsuario(){
		$tabla = "usuario";
		$item1 = "estado";
		$valor1 = $this->activarUsuario;
		$item2 = "idusuario";
		$valor2 = $this->activarIdUsuario;
		$respuesta = ModeloAdministradores::mdlActualizarPerfil($tabla, $item1, $valor1, $item2, $valor2);
		echo $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/	
	public $idUsuario;
	public function ajaxEditarUsuario(){
		$item = "idusuario";
		$valor = $this->idUsuario;
		$respuesta = ControladorAdministradores::ctrMostrarUsuarios($item, $valor);
		echo json_encode($respuesta);
	}

}

/*=============================================
ACTIVAR PERFIL
=============================================*/	
if(isset($_POST["activarPerfil"])){
	$activarPerfil = new AjaxAdministradores();
	$activarPerfil -> activarPerfil = $_POST["activarPerfil"];
	$activarPerfil -> activarId = $_POST["activarId"];
	$activarPerfil -> ajaxActivarPerfil();
}

/*=============================================
EDITAR PERFIL
=============================================*/
if(isset($_POST["idPerfil"])){
	$editar = new AjaxAdministradores();
	$editar -> idPerfil = $_POST["idPerfil"];
	$editar -> ajaxEditarPerfil();
}

/*=============================================
ACTIVAR USUARIO
=============================================*/	
if(isset($_POST["activarUsuario"])){
	$activarUsuario = new AjaxAdministradores();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarIdUsuario = $_POST["activarIdUsuario"];
	$activarUsuario -> ajaxActivarUsuario();
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idUsuario"])){
	$editarUsuario = new AjaxAdministradores();
	$editarUsuario -> idUsuario = $_POST["idUsuario"];
	$editarUsuario -> ajaxEditarUsuario();
}