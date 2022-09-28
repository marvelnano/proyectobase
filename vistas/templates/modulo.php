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
          <h1>{CONTROLADOR}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">{CONTROLADOR}</li>
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
        <button class="btn btn-primary agregar{CONTROLADOR}" data-toggle="modal" data-target="#modalAgregar{CONTROLADOR}">
          Agregar {CONTROLADOR}
        </button>
      </div>

      <div class="card-body">        
        <table class="table table-bordered table-striped dt-responsive tabla{CONTROLADOR}">
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
MODAL AGREGAR {CONTROLADORMAY}
======================================-->

<div id="modalAgregar{CONTROLADOR}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar {CONTROLADOR}</h4>
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
              <input type="text" name="descripcion" class="col-sm-9 form-control form-control-sm validarnivel descripcion" placeholder="Ingresar Descripción">
			  
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardar{CONTROLADOR}" >Agregar</button>
        </div>

    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR {CONTROLADORMAY}
======================================-->

<div id="modalEditar{CONTROLADOR}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Editar {CONTROLADOR}</h4>
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
              <input type="text" name="descripcion" class="col-sm-9 form-control form-control-sm validarnivel descripcion" placeholder="Ingresar Descripción">
              <input type="hidden" class="id{CONTROLADOR}">
			  
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardarCambios{CONTROLADOR}" >Guardar cambios</button>
        </div>

    </div>
  </div>
</div>