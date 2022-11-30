<?php 
    //require_once "../modelo/producto.modelo.php";

    class ControladorProducto{

        static public function listarProductosInicio(){
            $ws = 'http://localhost:83/proyectobase/ws/controller/producto.php?op=GetAll';

            $data = array();

            //print_r($data); exit();
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
            //echo 'mmm: ';print_r($data_json);//exit();
            //print_r($rs);exit();
            
            $response = json_decode($rs, true);//echo 'llegó a controlador producto: '.$ws;
            echo $response;
        }

        static public function productoDetalle($idprod){
            $ws = 'http://localhost:83/proyectobase/ws/controller/producto.php?op=GetId';

            $data = array(
                "idproducto" => $idprod,
            );

            //print_r($data); exit();
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
            
            //echo 'mmm: ';print_r($data_json);//exit();
            //print_r($rs);exit();
            
            $response = json_decode($rs, true);//echo 'llegó a controlador producto: '.$ws;
            //echo $rs;
            return $response;
        }

    }