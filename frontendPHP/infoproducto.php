<!-- Product Info section-->
<section class="py-3">
  <?php
    $idprod = decrypt($urlidprod);
    //echo 'idprod: '.$idprod;
    $detalleProd = ControladorProducto::productoDetalle($idprod);
    $detalleProd = json_decode($detalleProd, true);
    //echo $detalleProd;

    if (empty($detalleProd['idproducto'])) {
      if (count($detalleProd) <= 0) {
        header("Location: " . appUrlFrontend . "");
      }
    }
  ?>
  <div class="container px-4 px-lg-5 my-3">
    <div>
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item text-sm"><i class="fas fa-tachometer-alt"></i> <a href="inicio">Inicio</a></li>
        <li class="breadcrumb-item text-sm active">Detalle</li>
      </ol>
    </div>
    <div class="row gx-4 gx-lg-5 align-items-center">
      <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo appUrlBackend . $detalleProd['imagen']; ?>" alt="..." /></div>
      <div class="col-md-6">
        <div class="small mb-1">SKU: <?php echo $detalleProd['codigo_sku']; ?></div>
        <h1 class="display-5 fw-bolder"><?php echo $detalleProd['titulo']; ?></h1>
        <div class="fs-5 mb-5">
          <?php
          if ($detalleProd['precio_oferta'] != 0) {
            echo '<span style="font-size: 1.8rem">S/. ' . $detalleProd['precio_oferta']. '</span>';
            echo ' <span class="small text-muted text-decoration-line-through">S/. ' . $detalleProd['precio_venta'] . '</span>';
          } else {
            echo '<span style="font-size: 1.8rem">S/. ' . $detalleProd['precio_venta']. '</span>';
          }
          ?>
        </div>
        <div class="fw-bolder mb-1">Stock: <?php echo $detalleProd['stock']; ?></div>
        <p class="lead"><?php echo $detalleProd['descripcion']; ?></p>
        <div class="d-flex">
          <!--<input disabled class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
          <button class="btn btn-outline-dark flex-shrink-0" type="button" disabled>
            <i class="bi-cart-fill me-1"></i>
            Agregar al carrito
          </button>-->
          <?php
            $textowp = 'Buen%20d%C3%ADa,%20me%20interesa%20conocer%20m%C3%A1s%20acerca%20del%20producto: '.$detalleProd['titulo'];
            echo '
              <input disabled class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
              <a class="btn btn-outline-dark flex-shrink-0" href="https://api.whatsapp.com/send?phone=51'.$numWhatsapp.'&text='.$textowp.'" target="_blank">
                <i class="bi-cart-fill me-1"></i>
                Realizar pedido
              </a>
            ';
          ?>
        </div>
      </div>
    </div>
  </div>
</section>