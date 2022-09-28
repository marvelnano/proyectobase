<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Plantilla Web</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Plantilla Web</li>
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
        <button class="btn btn-primary agregarPlantillaWeb" data-toggle="modal" data-target="#modalAgregarWebPlantilla">
          Agregar Plantilla Web
        </button>
      </div>

      <div class="card-body">        
        <table class="table table-bordered table-striped dt-responsive tablaWebPlantilla">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Negocio</th>
              <th>Sección Web</th>
              <!--<th>Contenido</th>-->
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
MODAL AGREGAR PLANTILLA WEB
======================================-->
<div id="modalAgregarWebPlantilla" class="modal fade">
  <div class="modal-dialog modal-xl">  <!-- modal-lg -->
    <div class="modal-content">
      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header" style="background-color: #3c8dbc; color:white">
        <h4 class="modal-title">Agregar Plantilla Web</h4>
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
          ENTRADA PARA EL Negocio
          ======================================-->
          <div class="form-group row">
            <label for="negocio" class="col-sm-2 col-form-label">Negocio(*)</label>
            <select class="col-sm-10 form-control form-control-sm seleccionarNegocio" required>
              <option value="">Selecionar Negocio</option>
              <?php
                $item = null; //campo
                $valor = null; //razon_social del campo

                $rubros = ControladorNegocio::ctrMostrarNegocios($item, $valor);

                foreach ($rubros as $key => $value) {

                  echo '<option value="' . $value["idnegocio"] . '">' . $value["razon_social"] . '</option>';
                }
              ?>
            </select>			  
          </div>

          <!--=====================================
          ENTRADA PARA LA SECCION WEB
          ======================================-->
          <div class="form-group row">
            <label for="seccionweb" class="col-sm-2 col-form-label">Sección Web(*)</label>
            <select class="col-sm-10 form-control form-control-sm seleccionarSeccionWeb" required>
              <option value="">Selecionar Sección Web</option>
              <?php
                $item = null; //campo
                $valor = null; //razon_social del campo
                $rubros = ControladorWebSeccion::ctrMostrarWebSecciones($item, $valor);
                
                foreach ($rubros as $key => $value) {
                  echo '<option value="' . $value["idplantillawebseccion"] . '">' . $value["descripcion"] . '</option>';
                }
              ?>
            </select>			  
          </div>

          <!--=====================================
          ENTRADA PARA EL CONTENIDO
          ======================================-->
          <div class="form-group row">
            <label for="contenido" class="col-sm-2 col-form-label">Contenido(*)</label>
            <textarea id="ckeditor" name="ckeditor" class="col-sm-10 form-control form-control-sm contenido validarcontenido" placeholder="Ingresar Contenido" required></textarea>
          </div>
        </div>
      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-primary guardarWebPlantilla" >Agregar</button>
      </div>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR PLANTILLA WEB
======================================-->
<div id="modalEditarWebPlantilla" class="modal fade">
  <div class="modal-dialog modal-xl">  <!-- modal-lg -->
    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header" style="background-color: #3c8dbc; color:white">
        <h4 class="modal-title">Editar Plantilla Web</h4>
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
          ENTRADA PARA EL Negocio
          ======================================-->
          <div class="form-group row">
            <input type="hidden" class="idWebPlantilla">
            <label for="negocio" class="col-sm-2 col-form-label">Negocio(*)</label>
            <select class="col-sm-10 form-control form-control-sm seleccionarNegocio" required>
              <option value="">Selecionar Negocio</option>
              <?php
                $item = null; //campo
                $valor = null; //razon_social del campo
                $rubros = ControladorNegocio::ctrMostrarNegocios($item, $valor);

                foreach ($rubros as $key => $value) {
                  echo '<option value="' . $value["idnegocio"] . '">' . $value["razon_social"] . '</option>';
                }
              ?>
            </select>			  
          </div>

          <!--=====================================
          ENTRADA PARA LA SECCION WEB
          ======================================-->
          <div class="form-group row">
            <label for="seccionweb" class="col-sm-2 col-form-label">Sección Web(*)</label>
            <select class="col-sm-10 form-control form-control-sm seleccionarSeccionWeb" required>
              <option value="">Selecionar Sección Web</option>
              <?php
                $item = null; //campo
                $valor = null; //razon_social del campo

                $rubros = ControladorWebSeccion::ctrMostrarWebSecciones($item, $valor);

                foreach ($rubros as $key => $value) {

                  echo '<option value="' . $value["idplantillawebseccion"] . '">' . $value["descripcion"] . '</option>';
                }
              ?>
            </select>			  
          </div>

          <!--=====================================
          ENTRADA PARA EL CONTENIDO
          ======================================-->
          <div class="form-group row">
            <label for="contenido" class="col-sm-2 col-form-label">Contenido(*)</label>
            <textarea id="ckeditorEd" name="ckeditorEd" class="col-sm-10 form-control form-control-sm contenido validarcontenido" required></textarea>
          </div>
        </div>
      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-primary guardarCambiosWebPlantilla" >Guardar cambios</button>
      </div>
    </div>
  </div>
</div>