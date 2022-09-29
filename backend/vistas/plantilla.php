<?php
  session_start();
  $design = ControladorDesign::ctrSeleccionarPlantilla();
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Intranet | Panel de Control</title>

  <?php echo '<link rel="icon" href="'.$design["icono"].'">'; ?>

  <!--tag:  PLANTILLA STYLE -->
  <link rel="stylesheet" href="vistas/css/plantilla.css">

  <link rel="stylesheet" type="text/css" href="vistas/css/toastr.min.css">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- summernote 
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.css">-->

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- JQVMap -->
  <link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!--tag: REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- ChartJS -->
  <script src="vistas/plugins/chart.js/Chart.min.js"></script>

  <!-- Sparkline -->
  <script src="vistas/plugins/sparklines/sparkline.js"></script>

  <!-- JQVMap -->
  <!-- <script src="vistas/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="vistas/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->

  <!-- daterangepicker -->
  <script src="vistas/plugins/moment/moment.min.js"></script>
  <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>

  <!-- Tempusdominus Bootstrap 4 -->
  <script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- overlayScrollbars -->
  <script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!--tag:Subir Imágenes Ckeditor -->
  <script src="vistas/plugins/ckeditor/ckeditor.js"></script>
  <script>
    var roxyFileman = 'vistas/plugins/ckeditor/plugins/fileman/index.html';
    $(function () {
      CKEDITOR.replace('ckeditor', {filebrowserBrowseUrl: roxyFileman,
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'});
    });
    $(function () {
      CKEDITOR.replace('ckeditorEd', {filebrowserBrowseUrl: roxyFileman,
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'});
    });
  </script>

  <!-- Summernote 
  <script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
  <script>
    $(function () {
      // Summernote
      $('.textarea').summernote()
    })
  </script>-->

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.js"></script>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="vistas/dist/js/pages/dashboard.js"></script> -->

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="vistas/dist/js/demo.js"></script> -->

</head>

  <?php

  if(isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok"){

    //note: CREAR ESTRUTURA DE ARCHIVOS
    if(isset($_GET["ruta"]) && $_GET["ruta"] == "crear"){
      echo '<body class="hold-transition login-page">';
      include "modulos/".$_GET["ruta"].".php";
    }else{
      echo '<body class="hold-transition sidebar-mini">';
      echo '<div class="wrapper">';

      /*=============================================
      //note: HEADER
      =============================================*/
      include "modulos/header.php";

      /*=============================================
      //note: LATERAL
      =============================================*/
      include "modulos/lateral.php";

      /*=============================================
      //note: CONTENIDO
      =============================================*/
      if(isset($_GET["ruta"])){
        if($_GET["ruta"] == "inicio" ||      
        $_GET["ruta"] == "usuario" ||
        $_GET["ruta"] == "design" ||
        $_GET["ruta"] == "proyecto" ||
        $_GET["ruta"] == "administrador" ||
        $_GET["ruta"] == "nivelusuario" ||
        $_GET["ruta"] == "rubronegocio" ||
        $_GET["ruta"] == "negocio" ||
        $_GET["ruta"] == "webseccion" ||
        $_GET["ruta"] == "webareaportfolio" ||
        $_GET["ruta"] == "webplantilla" ||
        $_GET["ruta"] == "webportfolio" ||  
        $_GET["ruta"] == "listanegocios" ||    
        /*$_GET["ruta"] == "categoria" ||  
        $_GET["ruta"] == "consumidor" ||  
        $_GET["ruta"] == "medida" ||  
        $_GET["ruta"] == "producto" ||*/
        $_GET["ruta"]== "salir"){
          include "modulos/".$_GET["ruta"].".php";
        }
      }else{
        include "modulos/inicio.php";
      }
      
      /*=============================================
      //note: FOOTER
      =============================================*/
      include 'modulos/footer.php';
      echo '</div>';
    }

  }else{
    if(isset($_GET["ruta"])){
      if($_GET["ruta"] == "registro"){
        echo '<body class="hold-transition login-page">';
        include "modulos/".$_GET["ruta"].".php";    
      }if($_GET["ruta"] == "ingreso"){
        echo '<body class="hold-transition login-page">';
        include "modulos/login.php";
      }if($_GET["ruta"] == "crear"){
        echo '<body class="hold-transition login-page">';
        include "modulos/".$_GET["ruta"].".php";
      }
    }else{
      echo '<body class="hold-transition login-page">';
      include "modulos/login.php";
    }
  }

  ?>

<!-- ./wrapper -->

<!--=====================================
//tag: JS DE MÓDULOS
======================================-->
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/gestorAdministradores.js"></script>
<script src="vistas/js/gestorUsuarios.js"></script>
<script src="vistas/js/gestorDesign.js"></script>
<script src="vistas/js/gestorProyecto.js"></script>
<script src="vistas/js/gestorNivelUsuario.js"></script>
<script src="vistas/js/gestorRubroNegocio.js"></script>
<script src="vistas/js/gestorNegocio.js"></script>
<script src="vistas/js/gestorWebSeccion.js"></script>
<script src="vistas/js/gestorWebAreaPortfolio.js"></script>
<script src="vistas/js/gestorWebPlantilla.js"></script>
<script src="vistas/js/gestorWebPortfolio.js"></script>
<!--fixme: Falta agregar
<script src="vistas/js/gestorCategoria.js"></script>
<script src="vistas/js/gestorConsumidor.js"></script>
<script src="vistas/js/gestorMedida.js"></script>
<script src="vistas/js/gestorProducto.js"></script>-->
<script src="vistas/js/toastr.min.js"></script>

</body>
</html>
