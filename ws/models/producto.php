<?php
    class Producto extends Conectar{
        public function get_negocio($web){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL obtenerNegocio(?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $web);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
        
        public function get_productos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL obtenerProductos();";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_producto_x_id($prod_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL obtenerProductoPorId(?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prod_id);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }

        public function get_categorias(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL obtenerCategorias();";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_subcategorias_x_idcat($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL obtenerSubcategoriasPorCat(?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_productos_x_idsubcat($subcat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL obtenerProductosPorSubcat(?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $subcat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /*public function insert_producto($cat_nom,$cat_obs){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_categoria(cat_id,cat_nom,cat_obs,est) VALUES (NULL,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_nom);
            $sql->bindValue(2, $cat_obs);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_producto($cat_id,$cat_nom,$cat_obs){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_categoria set
                cat_nom = ?,
                cat_obs = ?
                WHERE
                cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_nom);
            $sql->bindValue(2, $cat_obs);
            $sql->bindValue(3, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_producto($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_categoria set
                est = '0'
                WHERE
                cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }*/

    }
?>