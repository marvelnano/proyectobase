<?php

class Ruta{

	/*=============================================
	RUTA LADO DEL CLIENTE
	=============================================*/	
	public function ctrRuta(){
		return "http://localhost:8080/modo-desarrollo/frontend/";	
	}

	/*=============================================
	RUTA LADO DEL SERVIDOR(INTRANET)
	=============================================*/	
	public function ctrRutaServidor(){
		return "http://localhost:8080/modo-desarrollo/backend/";	
	}
}