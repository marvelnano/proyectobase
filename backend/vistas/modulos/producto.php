<?php
  //TODO: Template Módulo
  if($_SESSION["perfil"] != "Administrador"){
  echo '<script>
  window.location = "inicio";
  </script>';

  return;
  }
?> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- tag: Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Producto</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Producto</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- tag: Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary agregarProducto" data-toggle="modal" data-target="#modalAgregarProducto">
          Agregar Producto
        </button>
      </div>

      <div class="card-body">        
        <table class="table table-bordered table-striped dt-responsive tablaProducto">
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
// tag: MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

        <!--=====================================
        //note: CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white;">&times;</span>
          </button>
        </div>

        <!--=====================================
        //note: CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">          
          <div class="card-body">

            <!--=====================================
            ENTRADA PARA LA DESCRIPCION
            ======================================-->
            <div class="form-group row">
              <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="text" name="descripcion" class="col-sm-9 form-control form-control-sm validarproducto descripcion" placeholder="Ingresar Descripción">
            </div>

            <!--=====================================
            ENTRADA PARA SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="nuevaFoto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaFoto" name="nuevaFoto" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">
            </div>

          </div>
        </div>

        <!--=====================================
        //note: PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardarProducto" >Agregar</button>
        </div>

    </div>
  </div>
</div>

<!--=====================================
//tag: MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

        <!--=====================================
        //note: CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Editar Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white;">&times;</span>
          </button>
        </div>

        <!--=====================================
        //note: CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">          
          <div class="card-body">

            <!--=====================================
            EDITAR LA DESCRIPCION
            ======================================-->
            <div class="form-group row">
              <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="text" name="descripcion" class="col-sm-9 form-control form-control-sm validarproducto descripcion" placeholder="Ingresar Descripción">
              <input type="hidden" class="idProducto">
            </div>

            <!--=====================================
            ENTRADA PARA SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="nuevaFoto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaFoto" name="nuevaFoto" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">
            </div>

          </div>
        </div>

        <!--=====================================
        //note: PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardarCambiosProducto" >Guardar cambios</button>
        </div>

    </div>
  </div>
</div>