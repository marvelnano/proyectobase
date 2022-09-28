<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>            
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">     
        <!-- Dropdown Menu Sidebar user panel (optional)-->
        <li class="nav-item dropdown">
            <a class="nav-link nav-panel-usuario" data-toggle="dropdown" href="#">
                <div class="user-panel d-flex">
                    <div class="image">
                        <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle" alt="User Image">
                    </div>                    
                    <div class="info">
                        <span class="d-block text-sm" style="color: #007bff;"><?php echo $_SESSION["nombre"] ?></span>
                    </div>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header btn-primary" style="color: white;">Información</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> <?php echo $_SESSION["nombre"] ?>                   
                    <span class="float-right text-muted text-sm"><?php echo $_SESSION["perfil"] ?> </span>
                </a>

                <div class="dropdown-divider"></div>
                <a href="salir" class="dropdown-item dropdown-footer">Salir</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->