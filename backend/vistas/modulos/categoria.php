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
          <h1>Categoria</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Categoria</li>
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
        <button class="btn btn-primary agregarCategoria" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar Categoria
        </button>
      </div>

      <div class="card-body">        
        <table class="table table-bordered table-striped dt-responsive tablaCategoria">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Descripción</th>
              <th>Imágen</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $item = null;
            $valor = null;

            $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
            
             foreach ($categorias as $key => $value){

              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["descripcion"].'</td>';

                      if($value["imagen"] != ""){
                      echo '<td><button class="btn btnVerImagen" idCategoria="'.$value["idcategoria"].'" data-toggle="modal" data-target="#modalVerImagen"><img src="'.$value["imagen"].'" class="img-thumbnail" width="40px"></button></td>';
                      }else{
                        echo '<td><img src="vistas/img/categorias/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                      }

                      if($value["estado"] != 0){
                        echo '<td><button class="btn btn-success btn-xs btnActivar" idCategoria="'.$value["idcategoria"].'" estadoCategoria="0">Activado</button></td>';
                      }else{
                        echo '<td><button class="btn btn-danger btn-xs btnActivar" idCategoria="'.$value["idcategoria"].'" estadoCategoria="1">Desactivado</button></td>';
                      } 

                      echo '<td>
                        <div class="btn-group">                              
                          <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["idcategoria"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-user-edit"></i></button>
                          <!--<button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["idcategoria"].'" imagenCategoria="'.$value["imagen"].'"><i class="fa fa-times"></i></button>-->
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
// tag: MODAL AGREGAR CATEGORIA
======================================-->

<div id="modalAgregarCategoria" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">        
        <!--=====================================
        //note: CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar Categoria</h4>
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
              <input type="text" name="nuevaCategoria" class="col-sm-9 form-control form-control-sm descripcion" placeholder="Ingresar Descripción">
            </div>

            <!--=====================================
            ENTRADA PARA SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="nuevaImagen" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaImagen" name="nuevaImagen" placeholder="Elegir imagen">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/categorias/default/anonymous.png" class="img-thumbnail" width="100px">
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
          $crearCategoria = new ControladorCategoria();
          $crearCategoria -> ctrCrearCategoria();
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
//tag: MODAL EDITAR CATEGORIA
======================================-->

<div id="modalEditarCategoria" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        //note: CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Editar Categoria</h4>
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
              <input type="text" name="editarCategoria" class="col-sm-9 form-control form-control-sm editarCategoria" placeholder="Ingresar Descripción">
              <input type="hidden" class="idCategoria" name="idCategoria">			  
            </div>

            <!--=====================================
            EDITAR SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="nuevaImagen" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaImagen" name="editarImagen" placeholder="Elegir Imagen">
              <p class="help-block">Peso Máximo de la imagen 2 MB</p>
              <img src="vistas/img/categorias/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imagenActual" class="imagenActual">
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
          $editarCategoria = new ControladorCategoria();
          $editarCategoria -> ctrEditarCategoria();
        ?>      
      </form>
    </div>
  </div>
</div>

<!--=====================================
//tag: MODAL VER IMAGEN
======================================-->

<div id="modalVerImagen" class="modal fade">
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
              <img src="vistas/img/categorias/default/anonymous.png" class="img-responsive previsualizar" width="100%" style="display: block;margin-left: auto; margin-right: auto;">
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