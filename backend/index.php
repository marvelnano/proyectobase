<?php

    //todo: Se declara los controladores y modelos
    //tag: Controladores
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
    //fixme: Falta agregar
    /*require_once 'controladores/categoria.controlador.php';
    require_once 'controladores/consumidor.controlador.php';
    require_once 'controladores/medida.controlador.php';
    require_once 'controladores/producto.controlador.php';*/

    //tag: Modelos
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
    //fixme: Falta agregar
    /*require_once 'modelos/categoria.modelo.php';
    require_once 'modelos/consumidor.modelo.php';
    require_once 'modelos/medida.modelo.php';
    require_once 'modelos/producto.modelo.php';*/

    $plantilla = new ControladorPlantilla();
    $plantilla -> ctrPlantilla();