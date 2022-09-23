<?php

require_once 'controladores/plantilla.controlador.php';
require_once 'controladores/design.controlador.php';
require_once 'controladores/proyecto.controlador.php';
require_once 'controladores/administradores.controlador.php';
require_once 'controladores/nivelusuario.controlador.php';
require_once 'controladores/rubronegocio.controlador.php';
require_once 'controladores/negocio.controlador.php';
require_once 'controladores/webseccion.controlador.php';
require_once 'controladores/webareaportfolio.controlador.php';
require_once 'controladores/webplantilla.controlador.php';
require_once 'controladores/webportfolio.controlador.php';

require_once "modelos/rutas.php";
require_once 'modelos/design.modelo.php';
require_once 'modelos/proyecto.modelo.php';
require_once 'modelos/administradores.modelo.php';
require_once 'modelos/nivelusuario.modelo.php';
require_once 'modelos/rubronegocio.modelo.php';
require_once 'modelos/negocio.modelo.php';
require_once 'modelos/webseccion.modelo.php';
require_once 'modelos/webareaportfolio.modelo.php';
require_once 'modelos/webplantilla.modelo.php';
require_once 'modelos/webportfolio.modelo.php';

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();