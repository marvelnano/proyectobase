<!-- Brand Logo - Icono y texto -->
<!-- <a href="inicio" class="brand-link sidebar-dark-primary">
    <img src="vistas/img/plantilla/icono-blanco.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">
        tuempresa.com
    </span>
</a> -->

<!-- Brand Logo - Icono y texto -->
<a href="#" class="brand-link logo-switch">
  <?php echo '<img src="'.$design["icono"].'" alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs">'; ?>
  <?php echo '<img src="vistas/img/plantilla/logo_blanco.png" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl" style="left: 12px">'; ?>
</a>
   
<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

            <li class="nav-item active">
                <a href="inicio" class="nav-link">
                    <i class="nav-icon fa fa-home"></i> 
                    <p>Inicio</p>
                </a>
            </li>

            <?php
                if($_SESSION["perfil"] == "Administrador"){
                    echo    
                        '<li class="nav-item">
                            <a href="design" class="nav-link">
                                <i class="nav-icon fas fa-palette"></i>
                                <p>Gestor Plantilla</p>
                            </a>
                        </li>            

                        <li class="nav-item">
                            <a href="proyecto" class="nav-link">
                                <i class="nav-icon far fa-building"></i>
                                <p>Gestor Proyecto</p>
                            </a>
                        </li>';
                    }
            ?>
            
            <?php
                if($_SESSION["perfil"] == "Administrador"){
                    echo    
                        '<li class="nav-item has-treeview">				
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Gestor Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="nivelusuario" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Nivel</p>
                                    </a>
                                </li>
                            </ul>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="administrador" class="nav-link">
                                    <i class="fa fa-user-plus nav-icon"></i>
                                    <p>Administrador</p>
                                    </a>
                                </li>
                            </ul>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="usuario" class="nav-link">
                                    <i class="fa fa-user-plus nav-icon"></i>
                                    <p>Usuario</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">				
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-city"></i>
                                <p>
                                    Gestor Negocios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="rubronegocio" class="nav-link">
                                    <i class="fa fa-clone nav-icon"></i>
                                    <p>Rubro Negocio</p>
                                    </a>
                                </li>
                            </ul>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="negocio" class="nav-link">
                                    <i class="fa fa-briefcase nav-icon"></i>
                                    <p>Negocio</p>
                                    </a>
                                </li>
                            </ul>
                            
                        </li>';
                }

            ?>

            <?php
                if($_SESSION["perfil"] == "Administrador"){
                    echo    
                        '<li class="nav-item has-treeview">				
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-th"></i>
                                <p>
                                    Gestor Plantilla Web
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="webseccion" class="nav-link">
                                    <i class="fa fa-th-list nav-icon"></i>
                                    <p>Secciones</p>
                                    </a>
                                </li>
                            </ul>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="webareaportfolio" class="nav-link">
                                    <i class="fa fa-folder-open nav-icon"></i>
                                    <p>Área de Portfolio</p>
                                    </a>
                                </li>
                            </ul> 
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="webplantilla" class="nav-link">
                                    <i class="fa fa-cloud nav-icon"></i>
                                    <p>Plantilla Web</p>
                                    </a>
                                </li>
                            </ul> 

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="webportfolio" class="nav-link">
                                    <i class="fa fa-th-large nav-icon"></i>
                                    <p>Portfolio Web</p>
                                    </a>
                                </li>
                            </ul> 
                        </li>';
                }
            ?>

            <!-- <li class="nav-item">
                <a href="productos" class="nav-link">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>Gestor Productos</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="test" class="nav-link">
                    <i class="nav-icon fa fa-map"></i>
                    <p>Gestor Test</p>
                </a>
            </li> -->

            <?php

                if($_SESSION["perfil"] == "Administrador"){

                echo    '<li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Plantilla Web
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            ';

                        }

                    ?>
                    <li class="nav-item">
                        <a href="listanegocios" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Negocios</p>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Simple Link
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li> -->
            
        </ul>
    </nav>
</div>