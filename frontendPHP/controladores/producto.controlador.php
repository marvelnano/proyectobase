<?php 
    class ControladorProducto{

        static public function datosNegocio($web){
            $ws = appUrlWS.'GetNegocio';

            $data = array(
                "web" => $web,
            );

            //Invocamos el servicio
            $token = ''; //en caso quieras utilizar algún token generado desde tu sistema
            //codificamos la data
            $data_json = json_encode($data);        
            //print_r($data);exit();

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ws);
            curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Token token="' . $token . '"',
                    'Content-Type: application/json',
                )
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $rs = curl_exec($ch);
            curl_close($ch);
            
            return $rs;
        }

        static public function listarProductosInicio(){
            $ws = appUrlWS.'GetProdAll';

            $data = array();

            //Invocamos el servicio
            $token = ''; //en caso quieras utilizar algún token generado desde tu sistema
            //codificamos la data
            $data_json = json_encode($data);        
            //print_r($data);exit();

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ws);
            curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Token token="' . $token . '"',
                    'Content-Type: application/json',
                )
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $rs = curl_exec($ch);
            curl_close($ch);
            
            return $rs;
        }

        static public function productoDetalle($idprod){
            $ws = appUrlWS.'GetProdId';

            $data = array(
                "idproducto" => $idprod,
            );

            //Invocamos el servicio
            $token = ''; //en caso quieras utilizar algún token generado desde tu sistema
            //codificamos la data
            $data_json = json_encode($data);        
            //print_r($data);exit();

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ws);
            curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Token token="' . $token . '"',
                    'Content-Type: application/json',
                )
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $rs = curl_exec($ch);
            curl_close($ch);
            
            return $rs;
        }

        static public function listarCategorias(){
            $ws = appUrlWS.'GetCatAll';

            $data = array();

            //Invocamos el servicio
            $token = ''; //en caso quieras utilizar algún token generado desde tu sistema
            //codificamos la data
            $data_json = json_encode($data);        
            //print_r($data);exit();

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ws);
            curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Token token="' . $token . '"',
                    'Content-Type: application/json',
                )
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $rs = curl_exec($ch);
            curl_close($ch);
            
            return $rs;
        }

        static public function listarSubCategoriasXCat($idcat){
            $ws = appUrlWS.'GetSubCatIdCat';

            $data = array(
                "idcategoria" => $idcat,
            );

            //Invocamos el servicio
            $token = ''; //en caso quieras utilizar algún token generado desde tu sistema
            //codificamos la data
            $data_json = json_encode($data);        
            //print_r($data);exit();

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ws);
            curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Token token="' . $token . '"',
                    'Content-Type: application/json',
                )
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $rs = curl_exec($ch);
            curl_close($ch);
            
            return $rs;
        }

    }