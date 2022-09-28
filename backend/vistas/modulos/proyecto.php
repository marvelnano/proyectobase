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
          <h1>Proyecto</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Proyecto</li>
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

        <button class="btn btn-primary agregarProyecto" data-toggle="modal" data-target="#modalAgregarProyecto">
          Agregar Proyecto
        </button>

      </div>

      <div class="card-body">
        
        <table class="table table-bordered table-striped dt-responsive tablaProyecto">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>RUC</th>
              <th>Razón Social</th>
              <th>Nombre Comercial</th>
              <th>Abreviatura</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Web</th>
              <th>Distrito</th>
              <th>Dirección</th>
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
MODAL AGREGAR PROYECTO
======================================-->

<div id="modalAgregarProyecto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar Proyecto</h4>
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
            ENTRADA PARA EL RUC
            ======================================-->
            <div class="form-group">

              <label for="ruc">RUC</label>
              <input type="text" name="ruc" class="form-control input-lg ruc" placeholder="Ingresar RUC">
			  
            </div>

            <!--=====================================
            ENTRADA PARA LA RAZÓN SOCIAL
            ======================================-->
            <div class="form-group">

              <label for="razonsocial">Razón Social</label>
              <input type="text" name="razonsocial" class="form-control input-lg razonsocial" placeholder="Ingresar Razón Social">
			  
            </div>

            <!--=====================================
            ENTRADA PARA EL NOMBRE COMERCIAL
            ======================================-->
            <div class="form-group">

              <label for="nombrecomercial">Nombre Comercial</label>
              <input type="text" name="nombrecomercial" class="form-control input-lg nombrecomercial" placeholder="Ingresar Nombre Comercial">
			  
            </div>

            <!--=====================================
            ENTRADA PARA LA ABREVIATURA
            ======================================-->
            <div class="form-group">

              <label for="abreviatura">Abreviatura</label>
              <input type="text" name="abreviatura" class="form-control input-lg abreviatura" placeholder="Ingresar Abreviatura">
			  
            </div>

            <!--=====================================
            ENTRADA PARA EL EMAIL
            ======================================-->
            <div class="form-group">

              <label for="email">Email</label>
              <input type="email" name="email" class="form-control input-lg email" placeholder="Ingresar Email">
			  
            </div>

            <!--=====================================
            ENTRADA PARA EL TELÉFONO
            ======================================-->
            <div class="form-group">

              <label for="telefono">Teléfono</label>
              <input type="telefono" name="telefono" class="form-control input-lg telefono" placeholder="Ingresar Teléfono">
			  
            </div>
			
            <!--=====================================
            ENTRADA PARA LA WEB
            ======================================-->
            <div class="form-group">

              <label for="web">Web</label>
              <input type="text" name="web" class="form-control input-lg web" placeholder="Ingresar Web">
			  
            </div>
			
            <!--=====================================
            ENTRADA PARA SELECCIONAR UBIGEO
            ======================================-->
            <div class="form-group">

              <label for="web">Lugar</label>
              <select class="form-control input-lg seleccionarUbigeo">

                <option value="">Selecionar Lugar</option>

                <?php

                $item = null; //campo
                $valor = null; //contenido del campo

                $ubigeos = ControladorProyecto::ctrMostrarUbigeos($item, $valor);

                foreach ($ubigeos as $key => $value) {

                  echo '<option value="' . $value["idubigeo"] . '">' . $value["descripcion"] . '</option>';
                }

                ?>

              </select>
			  
            </div>
			
            <!--=====================================
            ENTRADA PARA LA DIRECCIÓN
            ======================================-->
            <div class="form-group">

              <label for="direccion">Dirección</label>
              <input type="text" name="direccion" class="form-control input-lg direccion" placeholder="Ingresar Dirección">
			  
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardarProyecto" >Agregar</button>
        </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROYECTO
======================================-->

<div id="modalEditarProyecto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Editar Proyecto</h4>
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
            EDITAR EL RUC
            ======================================-->
            <div class="form-group">

              <label for="ruc">RUC</label>
              <input type="text" name="ruc" class="form-control input-lg ruc" placeholder="Ingresar RUC">
              <input type="hidden" class="idProyecto">
			  
            </div>

            <!--=====================================
            EDITAR LA RAZÓN SOCIAL
            ======================================-->
            <div class="form-group">

              <label for="razonsocial">Razón Social</label>
              <input type="text" name="razonsocial" class="form-control input-lg razonsocial" placeholder="Ingresar Razón Social">
			  
            </div>

            <!--=====================================
            EDITAR EL NOMBRE COMERCIAL
            ======================================-->
            <div class="form-group">

              <label for="nombrecomercial">Nombre Comercial</label>
              <input type="text" name="nombrecomercial" class="form-control input-lg nombrecomercial" placeholder="Ingresar Nombre Comercial">
			  
            </div>

            <!--=====================================
            EDITAR LA ABREVIATURA
            ======================================-->
            <div class="form-group">

              <label for="abreviatura">Abreviatura</label>
              <input type="text" name="abreviatura" class="form-control input-lg abreviatura" placeholder="Ingresar Abreviatura">
			  
            </div>

            <!--=====================================
            EDITAR EL EMAIL
            ======================================-->
            <div class="form-group">

              <label for="email">Email</label>
              <input type="email" name="email" class="form-control input-lg email" placeholder="Ingresar Email">
			  
            </div>

            <!--=====================================
            EDITAR EL TELÉFONO
            ======================================-->
            <div class="form-group">

              <label for="telefono">Teléfono</label>
              <input type="telefono" name="telefono" class="form-control input-lg telefono" placeholder="Ingresar Teléfono">
			  
            </div>
			
            <!--=====================================
            EDITAR LA WEB
            ======================================-->
            <div class="form-group">

              <label for="web">Web</label>
              <input type="text" name="web" class="form-control input-lg web" placeholder="Ingresar Web">
			  
            </div>
			
            <!--=====================================
            EDITAR SELECCIONAR UBIGEO
            ======================================-->
            <div class="form-group">

              <label for="web">Lugar</label>
              <select class="form-control input-lg seleccionarUbigeo">

                <option value="">Selecionar Lugar</option>

                <?php

                $item = null; //campo
                $valor = null; //contenido del campo

                $ubigeos = ControladorProyecto::ctrMostrarUbigeos($item, $valor);

                foreach ($ubigeos as $key => $value) {

                  echo '<option value="' . $value["idubigeo"] . '">' . $value["descripcion"] . '</option>';
                }

                ?>

              </select>
			  
            </div>
			
            <!--=====================================
            EDITAR LA DIRECCIÓN
            ======================================-->
            <div class="form-group">

              <label for="direccion">Dirección</label>
              <input type="text" name="direccion" class="form-control input-lg direccion" placeholder="Ingresar Dirección">
			  
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary guardarCambiosProyecto" >Guardar cambios</button>
        </div>

    </div>

  </div>

</div>