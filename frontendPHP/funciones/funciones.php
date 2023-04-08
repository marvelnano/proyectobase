<?php
    function encrypt($string) {
        $key = '4l155@.c0M/4l155@.c0M-4l155@.c0M>4l155@.c0M';
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
           $result.=$char;
        }
        return str_replace('=','Ab',base64_encode($result));
    }

    function decrypt($string) {
        $key = '4l155@.c0M/4l155@.c0M-4l155@.c0M>4l155@.c0M';
        $result = '';
        $string = base64_decode(str_replace('Ab','=',$string));
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)-ord($keychar));
           $result.=$char;
        }
        return $result;
    }

    function encriptar($cadena) {
        $salt = "AquiPuedesPonerUnTextoAleatorio"; // Puedes cambiar esto por un texto aleatorio
        $hash = hash('sha256', $salt.$cadena);
        return $hash;
    }

    function producto($id) {  
        $idprod = substr(decrypt($id), 0, 2);
        if ($idprod == '20'){
            return  'infoproducto';
        }
        return 'error';
    }

    function limitar_cadena($cadena, $limite=85, $sufijo="..."){
        // Si la longitud es mayor que el límite...
        if(strlen($cadena) > $limite){
            // Entonces corta la cadena y ponle el sufijo
            return substr($cadena, 0, $limite) . $sufijo;
        }
    
        // Si no, entonces devuelve la cadena normal
        return $cadena;
    }
    
    function eliminar_tildes($cadena){
    
        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //$cadena = utf8_encode($cadena);
    
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
    
        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );
    
        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );
    
        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );
    
        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );
    
        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );
    
        return $cadena;
    }
?>