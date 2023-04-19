<?php    
    //echo $_SERVER['SERVER_NAME'];
    //echo $_SERVER['HTTP_HOST'];
    if($_SERVER['HTTP_HOST'] === "localhost:83"){
        require_once "./config/development.php";
	    //header("Location: http://localhost:83/frontendPHP/", true, 301);
	    //exit();
    }elseif($_SERVER['HTTP_HOST'] === "alissabazar.com"){
        require_once "./config/production.php";
	    //header("Location: http://alissabazar.com/proyectobase/frontendPHP/", true, 301);
	    //exit();
    }else{
        exit();
    }

    require_once "./controladores/producto.controlador.php";
    require_once "./funciones/funciones.php";    
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo appTitulo ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="vistas/css/styles.css" rel="stylesheet" />
    </head>

    <body>
        <?php
            $ruta = null;
            //echo 'ruta: '.$_GET["ruta"];

            if(isset($_GET["ruta"])){
                //echo 'ruta: '.$_GET["ruta"].'<br>';
                $rutas = explode("/", $_GET["ruta"]);
                $valor =  $rutas[0];        
                //echo $valor; 
                
                $producto = producto($_GET["ruta"]);  

                if($producto == "infoproducto"){
                    $urlidprod = $_GET["ruta"];
                    include "plantillas/menu.php";
                    include 'infoproducto.php';
                }else{
                    include "plantillas/menu.php";
                    include "plantillas/cabecera.php";
                    include "./productos.php";
                } 

                include "plantillas/footer.php";
            }else{
                include "plantillas/menu.php";
                include "plantillas/cabecera.php";
                include "./productos.php";
                include "plantillas/footer.php";
            }
        ?>