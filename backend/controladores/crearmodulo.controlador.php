<?php

    class ControladorModulo{
        /*=============================================
        CREAR MÓDULO
        =============================================*/
        static public function ctrCrearModulo($datos){
            //echo " módulo: ".$datos["modulo"];
            if(isset($datos["modulo"])){

                //primera letra en mayúscula: ucfirst($datos["controlador"])
                $modulo = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/modulos/".$datos["modulo"].".php";
                $ajax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/ajax/".$datos["modulo"].".ajax.php";
                $controlador = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/controladores/".$datos["modulo"].".controlador.php";
                $modelo = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/modelos/".$datos["modulo"].".modelo.php";		
                
                if( file_exists($modulo) == true){
                    //echo "<p>El archivo existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El archivo no se ha encontrado</p>";

                    //CREAR MODULO
                    $archivomodulo = fopen($modulo, "w+b");    // Abrir el archivo, creándolo si no existe                    
                    if( $archivomodulo == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";
                        
                        $templatemodulo = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/templates/modulo.php";

                        $cadenamodulo = file_get_contents($templatemodulo);
                        $cadenamodulo = str_replace("{CONTROLADOR}", ucfirst($datos["modulo"]), $cadenamodulo);
                        $cadenamodulo = str_replace("{CONTROLADORMIN}", strtolower($datos["modulo"]), $cadenamodulo);
                        $cadenamodulo = str_replace("{CONTROLADORMAY}", strtoupper($datos["modulo"]), $cadenamodulo);
                        
                        file_put_contents($modulo, $cadenamodulo, FILE_APPEND);                        
                    }
                    fclose($archivomodulo);   // Cerrar el archivo

                    //CREAR AJAX
                    $archivoajax = fopen($ajax, "w+b");    // Abrir el archivo, creándolo si no existe                    
                    if( $archivoajax == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";
                        
                        $templateajax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/templates/ajax.php";

                        $cadenaajax = file_get_contents($templateajax);
                        $cadenaajax = str_replace("{CONTROLADOR}", ucfirst($datos["modulo"]), $cadenaajax);
                        $cadenaajax = str_replace("{CONTROLADORMIN}", strtolower($datos["modulo"]), $cadenaajax);
                        $cadenaajax = str_replace("{CONTROLADORMAY}", strtoupper($datos["modulo"]), $cadenaajax);
                        
                        file_put_contents($ajax, $cadenaajax, FILE_APPEND);                       
                    }
                    fclose($archivoajax);   // Cerrar el archivo

                    //CREAR CONTROLADOR
                    $archivocontrolador = fopen($controlador, "w+b");    // Abrir el archivo, creándolo si no existe                    
                    if( $archivocontrolador == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";
                        
                        $templatecontrolador = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/templates/controlador.php";

                        $cadenacontrolador = file_get_contents($templatecontrolador);
                        $cadenacontrolador = str_replace("{CONTROLADOR}", ucfirst($datos["modulo"]), $cadenacontrolador);
                        $cadenacontrolador = str_replace("{CONTROLADORMIN}", strtolower($datos["modulo"]), $cadenacontrolador);
                        $cadenacontrolador = str_replace("{CONTROLADORMAY}", strtoupper($datos["modulo"]), $cadenacontrolador);
                        
                        file_put_contents($controlador, $cadenacontrolador, FILE_APPEND);                       
                    }
                    fclose($archivocontrolador);   // Cerrar el archivo

                    //CREAR MODELO
                    $archivomodelo = fopen($modelo, "w+b");    // Abrir el archivo, creándolo si no existe                    
                    if( $archivomodelo == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";
                        
                        $templatemodelo = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/templates/modelo.php";

                        $cadenamodelo = file_get_contents($templatemodelo);
                        $cadenamodelo = str_replace("{CONTROLADOR}", ucfirst($datos["modulo"]), $cadenamodelo);
                        $cadenamodelo = str_replace("{CONTROLADORMIN}", strtolower($datos["modulo"]), $cadenamodelo);
                        $cadenamodelo = str_replace("{CONTROLADORMAY}", strtoupper($datos["modulo"]), $cadenamodelo);
                        
                        file_put_contents($modelo, $cadenamodelo, FILE_APPEND);                       
                    }
                    fclose($archivomodelo);   // Cerrar el archivo

                    $respuesta = "ok";
                }
                
                return $respuesta;		
            }
        }

        /*=============================================
        CREAR CONTROLADOR
        =============================================*/
        static public function ctrCrearControlador($datos){
            //echo ", controlador: ".$datos["controlador"];
            if(isset($datos["controlador"])){
                $js = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/js/gestor".$datos["controlador"].".js";
                $tablaAjax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/ajax/tabla".$datos["controlador"].".ajax.php";		
                
                if( file_exists($js) == true ){
                    //echo "<p>El archivo existe</p>";
                    $respuesta = "EXISTE";
                }else{
                    //echo "<p>El archivo no se ha encontrado</p>";

                    //CREAR JAVASCRIPT
                    $archivojs = fopen($js, "w+b");    // Abrir el archivo, creándolo si no existe                    
                    if( $archivojs == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";
                        
                        $templatejs = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/templates/javascript.js";

                        $cadenajs = file_get_contents($templatejs);
                        $cadenajs = str_replace("{CONTROLADOR}", ucfirst($datos["controlador"]), $cadenajs);
                        $cadenajs = str_replace("{CONTROLADORMIN}", strtolower($datos["controlador"]), $cadenajs);
                        $cadenajs = str_replace("{CONTROLADORMAY}", strtoupper($datos["controlador"]), $cadenajs);
                        
                        file_put_contents($js, $cadenajs, FILE_APPEND);
                    }
                    fclose($archivojs);   // Cerrar el archivo

                    //CREAR TABLA AJAX
                    $archivotablajax = fopen($tablaAjax, "w+b");                     
                    if( $archivotablajax == false ){
                        //echo "Error al crear el archivo";
                    }else{
                        //echo "El archivo ha sido creado";
                        
                        $templatetablaajax = $_SERVER["DOCUMENT_ROOT"]."/proyectobase/backend/vistas/templates/tablaAjax.php";

                        $cadenatajax = file_get_contents($templatetablaajax);
                        $cadenatajax = str_replace("{CONTROLADOR}", ucfirst($datos["controlador"]), $cadenatajax);
                        $cadenatajax = str_replace("{CONTROLADORMIN}", strtolower($datos["controlador"]), $cadenatajax);
                        $cadenatajax = str_replace("{CONTROLADORMAY}", strtoupper($datos["controlador"]), $cadenatajax);
                        
                        file_put_contents($tablaAjax, $cadenatajax, FILE_APPEND);

                    }
                    fclose($archivotablajax);   // Cerrar el archivo

                    $respuesta = "ok";
                }
                
                return $respuesta;		
            }
        }
    }
