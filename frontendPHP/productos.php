<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $productos = ControladorProducto::listarProductosInicio();
            $data = json_decode($productos, true);
            foreach ($data as $value) :
                echo '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            ';
                            if ($value['estado'] == 1) {
                                echo '<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>';
                            }
                            echo '                                
                            <!-- Product image-->
                            <img 
                                class="card-img-top" 
                                src="' . appUrlBackend . $value['imagen'] . '" 
                                alt="..." 
                            />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">' . $value['titulo'] . '</h5>
                                    <h6 class="fw-bolder">Para ' . $value['consumidor'] . '</h6>
                                    <!-- Product reviews-->
                                    <!-- <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div> -->
                                    <!-- Product price-->
                                    ';
                                    if ($value['precio_oferta'] != 0) {
                                        echo '<span style="font-size: 1.8rem">S/. ' . $value['precio_oferta']. '</span>';
                                        echo ' <span class="small text-muted text-decoration-line-through">S/. ' . $value['precio_venta'] . '</span>';
                                    } else {
                                        echo '<span style="font-size: 1.8rem">S/. ' . $value['precio_venta']. '</span>';
                                    }

                                    if ($value['estado'] == 0) {
                                        echo '<h5 class="fw-bolder text-danger">Agotado</h5>';
                                    } else {
                                        echo '<h5 class="fw-bolder text-success" *ngIf="producto.estado==1">Disponible</h5>';
                                    }
                                    echo '
                                    Stock: ' . $value['stock'] . '
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">';
                                    $textowp = 'Buen%20d%C3%ADa,%20me%20interesa%20conocer%20m%C3%A1s%20acerca%20del%20producto: '.$value['titulo'];
                                    echo '
                                    <a class="btn btn-outline-dark mt-auto " href="https://api.whatsapp.com/send?phone=51'.$numWhatsapp.'&text='.$textowp.'" target="_blank">WhatsApp</a>
                                </div>
                            </div>                            
                            ';
                            if ($value['estado'] == 0) {
                                echo '
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-outline-dark mt-auto not-active">Ver Detalle</a>
                                    </div>
                                </div>
                                ';
                            } else {
                                echo '
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-outline-dark mt-auto" href="'.appUrlFrontend.encrypt($value['idproducto']).'">Ver Detalle</a>
                                    </div>
                                </div>
                                ';
                            }
                            echo '                            
                        </div>
                    </div>';
            endforeach;
            ?>
        </div>
    </div>
</section>