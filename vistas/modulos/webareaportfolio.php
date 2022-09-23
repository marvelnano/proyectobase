<?php
  if($_SESSION["perfil"] != "Administrador"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
  }
?> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Web Área Portfolio</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Web Área Portfolio</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary agregarWebAreaPortfolio" data-toggle="modal" data-target="#modalAgregarWebAreaPortfolio">
          Agregar Web Área Portfolio
        </button>
      </div>

      <div class="card-body">        
        <table class="table table-bordered table-striped dt-responsive tablaWebAreaPortfolio">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Descripción</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- <div class="card-footer">
        Footer
      </div> -->
    </div>
  </section>

</div>

<!--=====================================
MODAL AGREGAR WEB ÁREA PORTFOLIO
======================================-->
<div id="modalAgregarWebAreaPortfolio" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header" style="background-color: #3c8dbc; color:white">
        <h4 class="modal-title">Agregar Web Área Portfolio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">&times;</span>
        </button>
      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">          
        <div class="card-body">
          <!--=====================================
          ENTRADA PARA LA DESCRIPCION
          ======================================-->
          <div class="form-group row">
            <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
            <input type="text" name="descripcion" class="col-sm-9 form-control form-control-sm validarwebareaportfolio descripcion" placeholder="Ingresar Descripción">	  
          </div>
        </div>
      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-primary guardarWebAreaPortfolio" >Agregar</button>
      </div>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR WEB ÁREA PORTFOLIO
======================================-->
<div id="modalEditarWebAreaPortfolio" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header" style="background-color: #3c8dbc; color:white">
        <h4 class="modal-title">Editar Web Área Portfolio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">&times;</span>
        </button>
      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">          
        <div class="card-body">
          <!--=====================================
          EDITAR LA DESCRIPCION
          ======================================-->
          <div class="form-group row">
            <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
            <input type="text" name="descripcion" class="col-sm-9 form-control form-control-sm validarwebareaportfolio descripcion" placeholder="Ingresar Descripción">
            <input type="hidden" class="idWebAreaPortfolio">			  
          </div>
        </div>
      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-primary guardarCambiosWebAreaPortfolio" >Guardar cambios</button>
      </div>
    </div>
  </div>
</div>