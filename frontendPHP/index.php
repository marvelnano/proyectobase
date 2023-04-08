<?php 
    require_once "controladores/plantilla.controlador.php";

    date_default_timezone_set('America/Lima');
    $plantilla = new ControladorPlantilla();
    $plantilla -> plantilla();
?>