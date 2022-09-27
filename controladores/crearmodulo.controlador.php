<?php

    class ControladorModulo{
        /*=============================================
        CREAR MÓDULO
        =============================================*/
        static public function ctrCrearModulo($datos){
            //echo ", módulo: ".$datos["modulo"];
            if(isset($datos["modulo"])){

                //primera letra en mayúscula: ucfirst($datos["controlador"])
                $modulo = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/vistas/modulos/".$datos["modulo"].".php";
                $ajax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/ajax/".$datos["modulo"].".ajax.php";
                $controlador = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/controladores/".$datos["modulo"].".controlador.php";
                $modelo = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/modelos/".$datos["modulo"].".modelo.php";		
                
                if( file_exists($modulo) == true){
                    //echo "<p>El archivo existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El archivo no se ha encontrado</p>";
                    $archivo = fopen($modulo, "w+b");    // Abrir el archivo, creándolo si no existe
                    $archivo = fopen($ajax, "w+b"); 
                    //$archivo = fopen($controlador, "w+b"); 
                    //$archivo = fopen($modelo, "w+b"); 
                    
                    if( $archivo == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";

                        //CREAR MODULO
                        $templatemodulo = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/vistas/templates/modulo.php";

                        $cadenamodulo = file_get_contents($templatemodulo);
                        $cadenamodulo = str_replace("{CONTROLADOR}", ucfirst($datos["modulo"]), $cadenamodulo);
                        $cadenamodulo = str_replace("{CONTROLADORMIN}", strtolower($datos["modulo"]), $cadenamodulo);
                        $cadenamodulo = str_replace("{CONTROLADORMAY}", strtoupper($datos["modulo"]), $cadenamodulo);
                        //$cadena .= "\r\nMe encanta PHP!";
                        file_put_contents($modulo, $cadenamodulo, FILE_APPEND);

                        //CREAR AJAX
                        $templateajax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/vistas/templates/ajax.php";

                        $cadenaajax = file_get_contents($templateajax);
                        $cadenaajax = str_replace("{CONTROLADOR}", ucfirst($datos["modulo"]), $cadenaajax);
                        $cadenaajax = str_replace("{CONTROLADORMIN}", strtolower($datos["modulo"]), $cadenaajax);
                        $cadenaajax = str_replace("{CONTROLADORMAY}", strtoupper($datos["modulo"]), $cadenaajax);
                        //$cadena .= "\r\nMe encanta PHP!";
                        file_put_contents($ajax, $cadenaajax, FILE_APPEND);
                    }

                    fclose($archivo);   // Cerrar el archivo

                    /*
                    $cadena = file_get_contents("datos.txt");
                    $cadena .= "\r\nMe encanta PHP!";
                    file_put_contents("datos.txt", $cadena, FILE_APPEND);
                    */

                    $respuesta = "ok";
                }

                //para crear carpetas y subcarpetas                
                /*if( file_exists($this->modulo) == true ){
                    //echo "<p>El directorio existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El directorio no existe</p>";
                    $respuesta = "ok";
                }

                if( file_exists("./".$this->modulo."/") == true ){
                    //echo "<p>El directorio existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El directorio no existe</p>";
                    $respuesta = "ok";
                }*/
                
                return $respuesta;		
            }
        }

        /*=============================================
        CREAR CONTROLADOR
        =============================================*/
        static public function ctrCrearControlador($datos){
            //echo ", controlador: ".$datos["controlador"];
            if(isset($datos["controlador"])){
                $js = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/vistas/js/gestor".$datos["controlador"].".js";
                $tablaAjax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/ajax/tabla".$datos["controlador"].".ajax.php";		
                
                if( file_exists($js) == true ){
                    //echo "<p>El archivo existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El archivo no se ha encontrado</p>";
                    $archivo = fopen($js, "w+b");    // Abrir el archivo, creándolo si no existe
                    $archivo = fopen($tablaAjax, "w+b"); 
                    
                    if( $archivo == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";

                        //CREAR JAVASCRIPT
                        $templatejs = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/vistas/templates/javascript.js";

                        $cadenajs = file_get_contents($templatejs);
                        $cadenajs = str_replace("{CONTROLADOR}", ucfirst($datos["controlador"]), $cadenajs);
                        $cadenajs = str_replace("{CONTROLADORMIN}", strtolower($datos["controlador"]), $cadenajs);
                        $cadenajs = str_replace("{CONTROLADORMAY}", strtoupper($datos["controlador"]), $cadenajs);
                        //$cadena .= "\r\nMe encanta PHP!";
                        file_put_contents($js, $cadenajs, FILE_APPEND);

                        //CREAR TABLA AJAX
                        $templatetablaajax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/vistas/templates/tablaAjax.php";

                        $cadenatajax = file_get_contents($templatetablaajax);
                        $cadenatajax = str_replace("{CONTROLADOR}", ucfirst($datos["controlador"]), $cadenatajax);
                        $cadenatajax = str_replace("{CONTROLADORMIN}", strtolower($datos["controlador"]), $cadenatajax);
                        $cadenatajax = str_replace("{CONTROLADORMAY}", strtoupper($datos["controlador"]), $cadenatajax);
                        //$cadena .= "\r\nMe encanta PHP!";
                        file_put_contents($tablaAjax, $cadenatajax, FILE_APPEND);

                    }

                    fclose($archivo);   // Cerrar el archivo

                    /*
                    $cadena = file_get_contents("datos.txt");
                    $cadena .= "\r\nMe encanta PHP!";
                    file_put_contents("datos.txt", $cadena, FILE_APPEND);
                    */

                    $respuesta = "ok";
                }

                //para crear carpetas y subcarpetas                
                /*if( file_exists($this->modulo) == true ){
                    //echo "<p>El directorio existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El directorio no existe</p>";
                    $respuesta = "ok";
                }

                if( file_exists("./".$this->modulo."/") == true ){
                    //echo "<p>El directorio existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El directorio no existe</p>";
                    $respuesta = "ok";
                }*/
                
                return $respuesta;		
            }
        }
    }
