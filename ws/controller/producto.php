<?php
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/producto.php");
    $producto = new Producto();

    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["op"]){

        case "GetAll":
            $datos=$producto->get_producto();
            echo json_encode($datos);
        break;

        case "GetId":
            $datos=$producto->get_producto_x_id($body["idproducto"]);
            echo json_encode($datos);
        break;

        /*case "Insert":
            $datos=$producto->insert_producto($body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Insert Correcto");
        break;

        case "Update":
            $datos=$producto->update_producto($body["cat_id"],$body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Update Correcto");
        break;

        case "Delete":
            $datos=$producto->delete_producto($body["cat_id"]);
            echo json_encode("Delete Correcto");
        break;*/
    }
?>