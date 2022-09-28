<?php
  if($_SESSION["perfil"] != "Administrador"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
  }
?>

<!-- Content Wrapper. Contenido de la Página -->
<div class="content-wrapper">
  <!-- Content Header (Cabecera de Página) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Portfolios Web</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Administrar Portfolios Web</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarWebPortfolio">
          Agregar Portfolio Web
        </button>
      </div>

      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive-perfil tablaWebPortfolios">
          <thead>
            <tr>
              <th>#</th>
              <th>Negocio</th>
              <th>Imágen</th>
              <th>Descripción</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr> 
          </thead>
          <tbody>
            <?php
              $item = null;
              $valor = null;

              $webportfolios = ControladorWebPortfolio::ctrMostrarWebPortfolios($item, $valor);
              
              foreach ($webportfolios as $key => $value){
                echo ' <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["negocio"].'</td>';

                        if($value["imagen"] != ""){
                        echo '<td><img src="'.$value["imagen"].'" class="img-thumbnail" width="40px"></td>';
                        }else{
                          echo '<td><img src="vistas/img/portfolios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                      }

                      echo '<td>'.$value["descripcion"].'</td>';
                        if($value["estado"] != 0){
                        echo '<td><button class="btn btn-success btn-xs btnActivar" idWebPortfolio="'.$value["idplantillawebportfolio"].'" estadoWebPortfolio="0">Activado</button></td>';
                      }else{
                        echo '<td><button class="btn btn-danger btn-xs btnActivar" idWebPortfolio="'.$value["idplantillawebportfolio"].'" estadoWebPortfolio="1">Desactivado</button></td>';
                      } 

                      echo '<td>
                      <div class="btn-group">                              
                        <button class="btn btn-warning btnEditarWebPortfolio" idWebPortfolio="'.$value["idplantillawebportfolio"].'" data-toggle="modal" data-target="#modalEditarWebPortfolio"><i class="fa fa-user-edit"></i></button>
                        <!--<button class="btn btn-danger btnEliminarWebPortfolio" idWebPortfolio="'.$value["idplantillawebportfolio"].'" fotoWebPortfolio="'.$value["imagen"].'"><i class="fa fa-times"></i></button>-->
                      </div>    
                    </td>
                  </tr>';            
              }
            ?>
          </tbody>
        </table>
      </div>
      <!-- <div class="card-footer">
        Footer
      </div> -->
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->
<div id="modalAgregarWebPortfolio" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar Portfolio Web</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white;">&times;</span>
          </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">          
          <div class="card-body">
            <!-- ENTRADA PARA LAS PLANTILLAS WEB -->
            <div class="form-group row">
              <label for="nivel" class="col-sm-3 col-form-label">WebPortfolio</label>
              <select class="col-sm-9 form-control form-control-sm  seleccionarplantillaweb" name="idplantillaweb">
                <option value="">Selecionar Plantilla Web</option>
                <?php
                  $item = 'descripcion'; //campo
                  $valor = 'PORTFOLIO'; //contenido del campo
                  $niveles = ControladorWebPlantilla::ctrMostrarPlantillasWeb($item, $valor);

                  foreach ($niveles as $key => $value) {
                    echo '<option value="' . $value["idplantillaweb"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!-- ENTRADA PARA LAS AREAS PORTFOLIO WEB -->
            <div class="form-group row">
              <label for="nivel" class="col-sm-3 col-form-label">WebPortfolio</label>
              <select class="col-sm-9 form-control form-control-sm  seleccionarwebareaportfolio" name="idwebareaportfolio">
                <option value="">Selecionar WebAreaPortfolio</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $niveles = ControladorWebAreaPortfolio::ctrMostrarWebAreaPortfolios($item, $valor);

                  foreach ($niveles as $key => $value) {
                    echo '<option value="' . $value["idplantillawebareaportfolio"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="form-group row">            
              <div class="input-group">
              <label for="descripcion" class="col-sm-3 col-form-label">Descripción</label>
                <input type="text" class="col-sm-9 form-control form-control-sm  descripcion"  name="nuevadescripcion" placeholder="Ingresar Descripción">
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group row">
              <label for="nuevaFoto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaFoto" name="nuevaFoto" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/portfolios/default/anonymous.png" class="img-thumbnail" width="100px">
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" >Agregar</button>
        </div>

        <?php
          $crearWebPortfolio = new ControladorWebPortfolio();
          $crearWebPortfolio -> ctrCrearWebPortfolio();
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div id="modalEditarWebPortfolio" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post" enctype="multipart/form-data">
      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header" style="background-color: #3c8dbc; color:white">
        <h4 class="modal-title">Editar WebPortfolio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">&times;</span>
        </button>
      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">        
        <div class="card-body">
          <!-- EDITAR LAS PLANTILLAS WEB -->
          <div class="form-group row">            
            <label for="nivel" class="col-sm-3 col-form-label">WebPortfolio</label>
            <select class="col-sm-9 form-control form-control-sm  seleccionarplantillaweb" name="idplantillaweb">
              <option value="">Selecionar Plantilla Web</option>
              <?php
                $item = 'descripcion'; //campo
                $valor = 'PORTFOLIO'; //contenido del campo
                $niveles = ControladorWebPlantilla::ctrMostrarPlantillasWeb($item, $valor);

                foreach ($niveles as $key => $value) {
                  echo '<option value="' . $value["idplantillaweb"] . '">' . $value["descripcion"] . '</option>';
                }
              ?>
            </select>
          </div>

          <!-- EDITAR LAS AREAS PORTFOLIO WEB -->
          <div class="form-group row">
              <label for="nivel" class="col-sm-3 col-form-label">WebPortfolio</label>
              <select class="col-sm-9 form-control form-control-sm  seleccionarwebareaportfolio" name="idwebareaportfolio">
                <option value="">Selecionar WebAreaPortfolio</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $niveles = ControladorWebAreaPortfolio::ctrMostrarWebAreaPortfolios($item, $valor);

                  foreach ($niveles as $key => $value) {
                    echo '<option value="' . $value["idplantillawebareaportfolio"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
          </div>

          <!-- ENTRADA PARA LA DESCRIPCIÓN -->
          <div class="form-group row">            
              <div class="input-group">
              <label for="descripcion" class="col-sm-3 col-form-label">Descripción</label>
                <input type="text" class="col-sm-9 form-control form-control-sm  descripcion"  name="descripcion" placeholder="Ingresar Descripción">
                <input type="hidden" class="idwebportfolio" name="idwebportfolio" >
              </div>
            </div>    

          <!-- EDITAR SUBIR FOTO -->
          <div class="form-group row">
            <label for="nuevaFoto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
            <!-- <input type="file" class="col-sm-9 form-control form-control-sm  fotoActual" placeholder="Elegir Foto"> -->
            <input type="file" class="col-sm-9 form-control form-control-sm nuevaFoto"  name="editarFoto">
            <p class="help-block">Peso Máximo de la foto 2 MB</p>
            <img src="vistas/img/portfolios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            <input type="hidden" name="fotoActual" class="fotoActual">
          </div>
        </div>
      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Modificar WebPortfolio</button>
      </div>

      <?php
        $editarWebPortfolio = new ControladorWebPortfolio();
        $editarWebPortfolio -> ctrEditarWebPortfolio();
      ?>

    </form>
    </div>
  </div>
</div>