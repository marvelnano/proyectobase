<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Negocio</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Negocio</li>
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

        <button class="btn btn-primary agregarNegocio" data-toggle="modal" data-target="#modalAgregarNegocio">
          Agregar Negocio
        </button>

      </div>

      <div class="card-body">
        
        <table class="table table-bordered table-striped dt-responsive tablaNegocio">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Rubro</th>
              <th>RUC</th>
              <th>Razón Social</th>              
              <th>Dirección</th>
              <th>Celular</th>
              <th>Email</th>
              <th>Página Web</th>
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
MODAL AGREGAR NEGOCIO
======================================-->

<div id="modalAgregarNegocio" class="modal fade">
  <div class="modal-dialog">  <!-- modal-lg -->
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar Negocio</h4>
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
            ENTRADA PARA EL RUBRO
            ======================================-->
            <div class="form-group row">
              <label for="rubro" class="col-sm-2 col-form-label">Rubro(*)</label>
              <select class="col-sm-10 form-control form-control-sm seleccionarRubro" required>
                <option value="">Selecionar Rubro</option>
                <?php
                  $item = null; //campo
                  $valor = null; //razon_social del campo

                  $rubros = ControladorRubro::ctrMostrarRubros($item, $valor);

                  foreach ($rubros as $key => $value) {

                    echo '<option value="' . $value["idrubronegocio"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>			  
            </div>

            <!--=====================================
            ENTRADA PARA LA IMAGEN
            ======================================-->
            <!-- <div class="form-group">

              <label for="imagen">Imagen</label>
              <input type="text" name="imagen" class="form-control form-control-sm imagen" placeholder="Ingresar imagen">
			  
            </div> -->

            <!--=====================================
            ENTRADA PARA EL RUC
            ======================================-->
            <div class="form-group row">
              <label for="ruc" class="col-sm-2 col-form-label">RUC(*)</label>
              <input maxlength="11" type="text" name="ruc" class="col-sm-10 form-control form-control-sm ruc" placeholder="Ingresar RUC" required>
            </div>

            <!--=====================================
            ENTRADA PARA RAZÓN SOCIAL
            ======================================-->
            <div class="form-group row">
              <label for="razon_social" class="col-sm-2 col-form-label">Razón Social(*)</label>
              <input type="text" name="razon_social" class="col-sm-10 form-control form-control-sm razon_social validarrazonsocial" placeholder="Ingresar razon_social del negocio" required>
            </div>

            <!--=====================================
            ENTRADA PARA DIRECCIÓN
            ======================================-->
            <div class="form-group row">
              <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
              <input type="text" name="direccion" class="col-sm-10 form-control form-control-sm direccion" placeholder="Ingresar dirección del negocio">
            </div>

            <!--=====================================
            ENTRADA PARA EL CELULAR
            ======================================-->
            <div class="form-group row">
              <label for="celular" class="col-sm-2 col-form-label">Celular</label>
              <input maxlength="9" type="text" name="celular" class="col-sm-10 form-control form-control-sm celular" placeholder="Ingresar celular del negocio">
            </div>

            <!--=====================================
            ENTRADA PARA EMAIL
            ======================================-->
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <input type="text" name="email" class="col-sm-10 form-control form-control-sm email" placeholder="Ingresar email del negocio">
            </div>

            <!--=====================================
            ENTRADA PARA PÁGINA WEB
            ======================================-->
            <div class="form-group row">
              <label for="pagina_web" class="col-sm-2 col-form-label">Página Web</label>
              <input type="text" name="pagina_web" class="col-sm-10 form-control form-control-sm pagina_web" placeholder="Ingresar página web del negocio">
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardarNegocio" >Agregar</button>
        </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR NEGOCIO
======================================-->

<div id="modalEditarNegocio" class="modal fade">
  <div class="modal-dialog">  <!-- modal-lg -->
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Editar Negocio</h4>
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
            ENTRADA PARA EL RUBRO
            ======================================-->
            <div class="form-group row">
              <input type="hidden" class="idNegocio">
              <label for="rubro" class="col-sm-2 col-form-label">Rubro(*)</label>
              <select class="col-sm-10 form-control form-control-sm seleccionarRubro" required>
                <option value="">Selecionar Rubro</option>
                <?php
                  $item = null; //campo
                  $valor = null; //rubro_negocio del campo

                  $rubros = ControladorRubro::ctrMostrarRubros($item, $valor);

                  foreach ($rubros as $key => $value) {

                    echo '<option value="' . $value["idrubronegocio"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>			  
            </div>

            <!--=====================================
            ENTRADA PARA LA IMAGEN
            ======================================-->
            <!-- <div class="form-group">

              <label for="imagen">Imagen</label>
              <input type="text" name="imagen" class="form-control form-control-sm imagen" placeholder="Ingresar imagen">
			  
            </div> -->

            <!--=====================================
            ENTRADA PARA EL RUC
            ======================================-->
            <div class="form-group row">
              <label for="ruc" class="col-sm-2 col-form-label">RUC(*)</label>
              <input maxlength="11" type="text" name="ruc" class="col-sm-10 form-control form-control-sm ruc" placeholder="Ingresar RUC" required>
            </div>

            <!--=====================================
            ENTRADA PARA RAZÓN SOCIAL
            ======================================-->
            <div class="form-group row">
              <label for="razon_social" class="col-sm-2 col-form-label">Razón Social(*)</label>
              <input type="text" name="razon_social" class="col-sm-10 form-control form-control-sm razon_social validarrazonsocial" placeholder="Ingresar razon_social del negocio" required>
            </div>

            <!--=====================================
            ENTRADA PARA DIRECCIÓN
            ======================================-->
            <div class="form-group row">
              <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
              <input type="text" name="direccion" class="col-sm-10 form-control form-control-sm direccion" placeholder="Ingresar dirección del negocio">
            </div>

            <!--=====================================
            ENTRADA PARA EL CELULAR
            ======================================-->
            <div class="form-group row">
              <label for="celular" class="col-sm-2 col-form-label">Celular</label>
              <input maxlength="9" type="text" name="celular" class="col-sm-10 form-control form-control-sm celular" placeholder="Ingresar celular del negocio">
            </div>

            <!--=====================================
            ENTRADA PARA EMAIL
            ======================================-->
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <input type="text" name="email" class="col-sm-10 form-control form-control-sm email" placeholder="Ingresar email del negocio">
            </div>

            <!--=====================================
            ENTRADA PARA PÁGINA WEB
            ======================================-->
            <div class="form-group row">
              <label for="pagina_web" class="col-sm-2 col-form-label">Página Web</label>
              <input type="text" name="pagina_web" class="col-sm-10 form-control form-control-sm pagina_web" placeholder="Ingresar página web del negocio">
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardarCambiosNegocio" >Guardar cambios</button>
        </div>

    </div>

  </div>

</div>