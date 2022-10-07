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
          <h1>SubCategoria</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">SubCategoria</li>
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
        <button class="btn btn-primary agregarSubCategoria" data-toggle="modal" data-target="#modalAgregarSubCategoria">
          Agregar SubCategoria
        </button>
      </div>

      <div class="card-body">        
        <table class="table table-bordered table-striped dt-responsive tablaSubCategoria">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Categoría</th>
              <th>SubCategoría</th>
              <th>Imágen</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php
              $item = null;
              $valor = null;

              $subcategorias = ControladorSubCategoria::ctrMostrarSubCategoria($item, $valor);
              
              foreach ($subcategorias as $key => $value){

                echo ' <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["categoria"].'</td>
                        <td>'.$value["descripcion"].'</td>';

                        if($value["imagen"] != ""){
                        echo '<td><button class="btn btnVerImagen" idSubCategoria="'.$value["idsubcategoria"].'" data-toggle="modal" data-target="#modalVerImgSubCat"><img src="'.$value["imagen"].'" class="img-thumbnail" width="40px"></button></td>';
                        }else{
                          echo '<td><img src="vistas/img/subcategorias/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                        }

                        if($value["estado"] != 0){
                          echo '<td><button class="btn btn-success btn-xs btnActivar" idSubCategoria="'.$value["idsubcategoria"].'" estadoSubCategoria="0">Activado</button></td>';
                        }else{
                          echo '<td><button class="btn btn-danger btn-xs btnActivar" idSubCategoria="'.$value["idsubcategoria"].'" estadoSubCategoria="1">Desactivado</button></td>';
                        } 

                        echo '<td>
                          <div class="btn-group">                              
                            <button class="btn btn-warning btnEditarSubCategoria" idSubCategoria="'.$value["idsubcategoria"].'" data-toggle="modal" data-target="#modalEditarSubCategoria"><i class="fa fa-user-edit"></i></button>
                            <!--<button class="btn btn-danger btnEliminarSubCategoria" idSubCategoria="'.$value["idsubcategoria"].'" imagenSubCategoria="'.$value["imagen"].'"><i class="fa fa-times"></i></button>-->
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
// tag: MODAL AGREGAR SUBCATEGORIA
======================================-->

<div id="modalAgregarSubCategoria" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">        
        <!--=====================================
        //note: CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar SubCategoria</h4>
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
            ENTRADA PARA LA CATEGORIA
            ======================================-->
            <div class="form-group row">
              <label for="nivel" class="col-sm-3 col-form-label">Categoría</label>
              <select class="col-sm-9 form-control form-control-sm  seleccionarCategoria" name="nuevaCategoria">
                <option value="">Selecionar Categoría</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);

                  foreach ($categorias as $key => $value) {
                    echo '<option value="' . $value["idcategoria"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA LA DESCRIPCION
            ======================================-->
            <div class="form-group row">
              <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="text" name="nuevaSubCategoria" class="col-sm-9 form-control form-control-sm descripcion" placeholder="Ingresar Descripción">
            </div>

            <!--=====================================
            ENTRADA PARA SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="nuevaImgSubCat" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaImgSubCat" name="nuevaImgSubCat" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/subcategorias/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>

          </div>
        </div>

        <!--=====================================
        //note: PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" >Agregar</button>
        </div>

        <?php
          $crearSubCategoria = new ControladorSubCategoria();
          $crearSubCategoria -> ctrCrearSubCategoria();
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
//tag: MODAL EDITAR SUBCATEGORIA
======================================-->

<div id="modalEditarSubCategoria" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        //note: CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Editar SubCategoria</h4>
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
            ENTRADA PARA LA CATEGORIA
            ======================================-->
            <div class="form-group row">
              <input type="hidden" class="idSubCategoria" name="idSubCategoria">	
              <label for="nivel" class="col-sm-3 col-form-label">Categoría</label>
              <select class="col-sm-9 form-control form-control-sm  seleccionarCategoria" name="editarCategoria">
                <option value="">Selecionar Categoría</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);

                  foreach ($categorias as $key => $value) {
                    echo '<option value="' . $value["idcategoria"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            EDITAR LA DESCRIPCION
            ======================================-->
            <div class="form-group row">
              <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="text" name="editarSubCategoria" class="col-sm-9 form-control form-control-sm editarSubCategoria" placeholder="Ingresar Descripción">
            </div>

            <!--=====================================
            EDITAR SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="nuevaImgSubCat" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaImgSubCat" name="editarImgSubCat" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la imagen 2 MB</p>
              <img src="vistas/img/subcategorias/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imgSubCatActual" class="imgSubCatActual">
            </div>

          </div>
        </div>

        <!--=====================================
        //note: PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" >Guardar cambios</button>
        </div>

        <?php
          $editarSubCategoria = new ControladorSubCategoria();
          $editarSubCategoria -> ctrEditarSubCategoria();
        ?>      
      </form>
    </div>
  </div>
</div>

<!--=====================================
//tag: MODAL VER IMAGEN
======================================-->

<div id="modalVerImgSubCat" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        //note: CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">          
          <div class="card-body">
            <!--=====================================
            VER IMAGEN
            ======================================-->
            <div class="form-group row">
              <img src="vistas/img/subcategorias/default/anonymous.png" class="img-responsive previsualizar" width="100%" style="display: block;margin-left: auto; margin-right: auto;">
            </div>

          </div>
        </div>

        <!--=====================================
        //note: PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>      
      </form>
    </div>
  </div>
</div>