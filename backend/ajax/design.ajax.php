<?php

require_once "../controladores/design.controlador.php";
require_once "../modelos/design.modelo.php";

require_once "../controladores/proyecto.controlador.php";
require_once "../modelos/proyecto.modelo.php";

class AjaxDesign{

	/*=============================================
	SUBIR ARCHIVO
	=============================================*/	

	public $archivo;

	public function ajaxCambiarArchivo(){

		$item3 = null;
		$valor3 = null;
		$proyecto = ControladorProyecto::ctrMostrarProyectos($item3, $valor3);

		$item = $proyecto[0]["ruc"];
		$valor = $this->archivo;

		$respuesta = ControladorDesign::ctrSubirArchivo($valor, $item);

		echo $respuesta;


	}

	/*=============================================
	CAMBIAR LOGOTIPO
	=============================================*/	

	public $imagenLogo;

	public function ajaxCambiarLogotipo(){

		$item = "logo";
		$valor = $this->imagenLogo;

		$respuesta = ControladorDesign::ctrActualizarLogoIcono($item, $valor);

		echo $respuesta;


	}

	/*=============================================
	CAMBIAR ICONO
	=============================================*/

	public $imagenIcono;	

	public function ajaxCambiarIcono(){

		$item = "icono";
		$valor = $this->imagenIcono;

		$respuesta = ControladorDesign::ctrActualizarLogoIcono($item, $valor);

		echo $respuesta;

	}

	/*=============================================
	CAMBIAR PORTADA DE CATEGORIA
	=============================================*/

	public $imagenPortadaCat;	

	public function ajaxCambiarPortadaCat(){

		$item = "categoria";
		$valor = $this->imagenPortadaCat;

		$respuesta = ControladorDesign::ctrActualizarLogoIcono($item, $valor);

		echo $respuesta;

	}


	/*=============================================
	CAMBIAR COLORES
	=============================================*/

	public $barraSuperior;
	public $textoSuperior;
	public $colorFondo;
	public $colorTexto;	

	public function ajaxCambiarColor(){

		$datos = array("barraSuperior"=>$this->barraSuperior,
					   "textoSuperior"=>$this->textoSuperior,
					   "colorFondo"=>$this->colorFondo,
					   "colorTexto"=>$this->colorTexto);

		$respuesta = ControladorDesign::ctrActualizarColores($datos);

		echo $respuesta;

	}

	/*=============================================
	CAMBIAR REDES SOCIALES
	=============================================*/

	public $redesSociales;

	public function ajaxCambiarRedes(){

		$item = "redesSociales";
		$valor = $this->redesSociales;

		$respuesta = ControladorDesign::ctrActualizarLogoIcono($item, $valor);

		echo $respuesta;

	}

	/*=============================================
	CAMBIAR SCRIPT
	=============================================*/

	public $apiFacebook;
	public $pixelFacebook;
	public $googleAnalytics;

	public function ajaxCambiarScript(){

		$datos = array("apiFacebook"=>$this->apiFacebook,
					   "pixelFacebook"=>$this->pixelFacebook,
					   "googleAnalytics"=>$this->googleAnalytics);

		$respuesta = ControladorDesign::ctrActualizarScript($datos);

		echo $respuesta;

	}

	/*=============================================
	CAMBIAR INFORMACIÓN
	=============================================*/

	public $impuesto;
	public $envioNacional;
	public $envioInternacional;
	public $tasaMinimaNal;
	public $tasaMinimaInt;
	public $seleccionarPais;
	public $modoFacturacion;
	public $modoPaypal;
	public $clienteIdPaypal;
	public $llaveSecretaPaypal;
	public $modoPayu;
	public $merchantIdPayu;
	public $accountIdPayu;
	public $apiKeyPayu;

	public $usuariosol;
	public $clavesol;
	public $passwordcertificado;

	public function ajaxCambiarInformacion(){

		$datos = array("impuesto"=>$this->impuesto,
						"envioNacional"=>$this->envioNacional,
						"envioInternacional"=>$this->envioInternacional,
						"tasaMinimaNal"=>$this->tasaMinimaNal,
						"tasaMinimaInt"=>$this->tasaMinimaInt,
						"seleccionarPais"=>$this->seleccionarPais,
						"modoFacturacion"=>$this->modoFacturacion,
						"modoPaypal"=>$this->modoPaypal,
						"clienteIdPaypal"=>$this->clienteIdPaypal,
						"llaveSecretaPaypal"=>$this->llaveSecretaPaypal,
						"modoPayu"=>$this->modoPayu,
						"merchantIdPayu"=>$this->merchantIdPayu,
						"accountIdPayu"=>$this->accountIdPayu,
						"apiKeyPayu"=>$this->apiKeyPayu,
						"idcomprobanteserie_boleta"=>$this->seleccionarBoleta,
						"usuariosol"=>$this->usuariosol,
						"clavesol"=>$this->clavesol,
						"passwordcertificado"=>$this->passwordcertificado,
						"idcomprobanteserie_factura"=>$this->seleccionarFactura);

		$respuesta = ControladorDesign::ctrActualizarInformacion($datos);

		echo $respuesta;

	}

}

/*=============================================
CAMBIAR ARCHIVO
=============================================*/	
if(isset($_FILES["archivo"])){

	$logotipo = new AjaxDesign();
	$logotipo -> archivo = $_FILES["archivo"];
	$logotipo -> ajaxCambiarArchivo();

}

/*=============================================
CAMBIAR LOGOTIPO
=============================================*/	
if(isset($_FILES["imagenLogo"])){

	$logotipo = new AjaxDesign();
	$logotipo -> imagenLogo = $_FILES["imagenLogo"];
	$logotipo -> ajaxCambiarLogotipo();

}

/*=============================================
CAMBIAR ICONO
=============================================*/	
if(isset($_FILES["imagenIcono"])){

	$icono = new AjaxDesign();
	$icono -> imagenIcono = $_FILES["imagenIcono"];
	$icono -> ajaxCambiarIcono();

}

/*=============================================
CAMBIAR PORTADA DE CATEGORIA
=============================================*/	
if(isset($_FILES["imagenPortadaCat"])){

	$portadacat = new AjaxDesign();
	$portadacat -> imagenPortadaCat = $_FILES["imagenPortadaCat"];
	$portadacat -> ajaxCambiarPortadaCat();

}

/*=============================================
CAMBIAR COLORES
=============================================*/	

if(isset($_POST["barraSuperior"])){

	$colores = new AjaxDesign();
	$colores -> barraSuperior = $_POST["barraSuperior"];
	$colores -> textoSuperior = $_POST["textoSuperior"];
	$colores -> colorFondo = $_POST["colorFondo"];
	$colores -> colorTexto = $_POST["colorTexto"];
	$colores -> ajaxCambiarColor();

}


/*=============================================
CAMBIAR REDES SOCIALES
=============================================*/	

if(isset($_POST["redesSociales"])){

	$redesSociales = new AjaxDesign();
	$redesSociales -> redesSociales = $_POST["redesSociales"];
	$redesSociales -> ajaxCambiarRedes();

}

/*=============================================
CAMBIAR SCRIPT
=============================================*/	

if(isset($_POST["apiFacebook"])){

	$script = new AjaxDesign();
	$script -> apiFacebook = $_POST["apiFacebook"];
	$script -> pixelFacebook = $_POST["pixelFacebook"];
	$script -> googleAnalytics = $_POST["googleAnalytics"];
	$script -> ajaxCambiarScript();

}

/*=============================================
CAMBIAR INFORMACION
=============================================*/	

if(isset($_POST["impuesto"])){

	$informacion = new AjaxDesign();
	$informacion -> impuesto = $_POST["impuesto"];
	$informacion -> envioNacional = $_POST["envioNacional"];
	$informacion -> envioInternacional = $_POST["envioInternacional"];
	$informacion -> tasaMinimaNal = $_POST["tasaMinimaNal"];
	$informacion -> tasaMinimaInt = $_POST["tasaMinimaInt"];
	$informacion -> seleccionarPais = $_POST["seleccionarPais"];
	$informacion -> modoFacturacion = $_POST["modoFacturacion"];
	$informacion -> modoPaypal = $_POST["modoPaypal"];
	$informacion -> clienteIdPaypal = $_POST["clienteIdPaypal"];
	$informacion -> llaveSecretaPaypal = $_POST["llaveSecretaPaypal"];
	$informacion -> modoPayu = $_POST["modoPayu"];
	$informacion -> merchantIdPayu = $_POST["merchantIdPayu"];
	$informacion -> accountIdPayu = $_POST["accountIdPayu"];
	$informacion -> apiKeyPayu = $_POST["apiKeyPayu"];
	$informacion -> seleccionarBoleta = $_POST["seleccionarBoleta"];
	$informacion -> seleccionarFactura = $_POST["seleccionarFactura"];
	$informacion -> usuariosol = $_POST["usuariosol"];
	$informacion -> clavesol = $_POST["clavesol"];
	$informacion -> passwordcertificado = $_POST["passwordcertificado"];
	$informacion -> ajaxCambiarInformacion();

}

