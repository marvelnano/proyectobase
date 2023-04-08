<!-- Product Info section-->
<section class="py-5">
    <?php 
        $idprod = decrypt($urlidprod);
        //echo 'idprod: '.$idprod;
        $detalleProd = ControladorProducto::productoDetalle($idprod);
        $detalleProd = json_decode($detalleProd, true);
        //echo $detalleProd;

        if(empty($detalleProd['idproducto'])){
            if(count($detalleProd) <= 0){
                header("Location: http://localhost:83/frontendPHP/");
            }
        }
        
    ?>
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo appUrlBackend.$detalleProd['imagen'];?>" alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: <?php echo $detalleProd['codigo_sku'];?></div>
                <h1 class="display-5 fw-bolder"><?php echo $detalleProd['titulo'];?></h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">S/. <?php echo ($detalleProd['precio_venta']+10);?></span>
                    <span>S/. <?php echo $detalleProd['precio_venta'];?></span>
                </div>
                <p class="lead"><?php echo $detalleProd['descripcion'];?></p>
                <div class="d-flex">
                    <input disabled class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                    <button class="btn btn-outline-dark flex-shrink-0" type="button" disabled>
                        <i class="bi-cart-fill me-1"></i>
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
