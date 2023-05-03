<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <!--<a class="navbar-brand" href="inicio"><?php //echo appTituloProd ?></a>-->
        <a class="navbar-brand" href="inicio"><img src="vistas/img/logo_front.png" width="180px"></img></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="inicio">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Acerca de</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Todos los Productos</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-item dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Subcategoria</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">subcate1</a></li>
                                <li><a class="dropdown-item" href="#!">subcate2</a></li>
                            </ul>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#!">Populares</a></li>
                        <li><a class="dropdown-item" href="#!">Novedades</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>                                
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            $categorias = ControladorProducto::listarCategorias();
                            $dataCat = json_decode($categorias, true);
                            foreach ($dataCat as $cat) :
                                echo '
                                    <li class="dropdown">
                                        <a class="dropdown-item dropdown-toggle" id="navbarDropdown" href="categoria'.$cat['idcategoria'].'" role="button" data-bs-toggle="dropdown" aria-expanded="false">'.$cat['descripcion'].'</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                        $subcategorias = ControladorProducto::listarSubCategoriasXCat($cat['idcategoria']);
                                        $dataSubCat = json_decode($subcategorias, true);
                                        foreach ($dataSubCat as $subcat) :
                                            echo '<li><a class="dropdown-item" href="#!">'.$subcat['descripcion'].'</a></li>';
                                        endforeach;
                                        echo '
                                        </ul>
                                    </li>
                                ';                                
                            endforeach;
                        ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Carrito
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>