<?php
    class Producto extends Conectar{
        public function get_producto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT p.idproducto, n.idnegocio, n.razon_social, cat.idcategoria, cat.descripcion categoria,
            sc.idsubcategoria, sc.descripcion subcategoria, c.idconsumidor, c.descripcion consumidor, m.idmedida, m.descripcion medida,
            p.titulo, p.descripcion, p.codigo_sku, p.precio_costo, p.precio_venta, p.stock, p.imagen, p.estado 
            FROM producto p
            INNER JOIN subcategoria sc on sc.idsubcategoria = p.idsubcategoria 
            INNER JOIN categoria cat on cat.idcategoria = sc.idcategoria
            INNER JOIN consumidor c on c.idconsumidor = p.idconsumidor
            INNER join negocio n on n.idnegocio = p.idnegocio
            INNER JOIN medida m on m.idmedida = p.idmedida 
            ORDER BY sc.idsubcategoria";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_producto_x_id($prod_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT p.idproducto, n.idnegocio, n.razon_social, cat.idcategoria, cat.descripcion categoria,
            sc.idsubcategoria, sc.descripcion subcategoria, c.idconsumidor, c.descripcion consumidor, m.idmedida, m.descripcion medida,
            p.titulo, p.descripcion, p.codigo_sku, p.precio_costo, p.precio_venta, p.stock, p.imagen, p.estado 
            FROM producto p
            INNER JOIN subcategoria sc on sc.idsubcategoria = p.idsubcategoria 
            INNER JOIN categoria cat on cat.idcategoria = sc.idcategoria
            INNER JOIN consumidor c on c.idconsumidor = p.idconsumidor
            INNER join negocio n on n.idnegocio = p.idnegocio
            INNER JOIN medida m on m.idmedida = p.idmedida
            WHERE p.estado=1 AND p.idproducto = ? 
            ORDER BY sc.idsubcategoria";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prod_id);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
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