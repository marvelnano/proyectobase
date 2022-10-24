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
        <table class="table table-responsive table-bordered table-striped dt-responsive-producto tablaProducto">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Negocio</th>
              <th>Categoría</th>
              <th>Subcategoría</th>
              <th>Consumidor</th>
              <th>Medida</th>
              <th>Titulo</th>
              <th>Descripción</th>
              <th>Código SKU</th>
              <th>Costo</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Imágen</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php
              $item = null;
              $valor = null;

              $productos = ControladorProducto::ctrMostrarProducto($item, $valor);
              
              if($productos){
                foreach ($productos as $key => $value){                
                  echo ' <tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["razon_social"].'</td>
                          <td>'.$value["categoria"].'</td>
                          <td>'.$value["subcategoria"].'</td>
                          <td>'.$value["consumidor"].'</td>
                          <td>'.$value["medida"].'</td>
                          <td>'.$value["titulo"].'</td>
                          <td>'.$value["descripcion"].'</td>
                          <td>'.$value["codigo_sku"].'</td>
                          <td>'.$value["precio_costo"].'</td>
                          <td>'.$value["precio_venta"].'</td>
                          <td>'.$value["stock"].'</td>';

                          if($value["imagen"] != ""){
                          echo '<td><button class="btn btnVerImagen" idProducto="'.$value["idproducto"].'" data-toggle="modal" data-target="#modalVerImgProducto"><img src="'.$value["imagen"].'" class="img-thumbnail" width="40px"></button></td>';
                          }else{
                            echo '<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                          }

                          if($value["estado"] != 0){
                            echo '<td><button class="btn btn-success btn-xs btnActivar" idProducto="'.$value["idproducto"].'" estadoProducto="0">Activado</button></td>';
                          }else{
                            echo '<td><button class="btn btn-danger btn-xs btnActivar" idProducto="'.$value["idproducto"].'" estadoProducto="1">Desactivado</button></td>';
                          } 

                          echo '<td>
                            <div class="btn-group">                              
                              <button class="btn btn-warning btnEditarProducto" idProducto="'.$value["idproducto"].'" data-toggle="modal" data-target="#modalEditarProducto"><i class="fa fa-user-edit"></i></button>
                              <!--<button class="btn btn-danger btnEliminarProducto" idProducto="'.$value["idproducto"].'" imagenProducto="'.$value["imagen"].'"><i class="fa fa-times"></i></button>-->
                            </div>  
                          </td>
                        </tr>'; 
                }
              }else{
                echo '<tr><td colspan="14">No se encontraron resultados</td></tr>';
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
// tag: MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">  
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
            ENTRADA PARA EL NEGOCIO
            ======================================-->
            <div class="form-group row">
              <label for="nuevoNegocio" class="col-sm-3 col-form-label">Negocio</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarNegocio" name="nuevoNegocio">
                <option value="">Selecionar Negocio</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $negocios = ControladorNegocio::ctrMostrarNegocios($item, $valor);

                  foreach ($negocios as $key => $value) {
                    echo '<option value="' . $value["idnegocio"] . '">' . $value["razon_social"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA LA CATEGORIA
            ======================================-->
            <div class="form-group row">
              <label for="nuevaCategoria" class="col-sm-3 col-form-label">Categoría</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarCategoriaX" name="nuevaCategoria">
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
            ENTRADA PARA LA SUBCATEGORIA
            ======================================-->
            <div class="form-group row">
              <label for="nuevaSubCategoria" class="col-sm-3 col-form-label">SubCategoría</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarSubCategoriaX" name="nuevaSubCategoria">
                <option value="">Selecionar SubCategoría</option>
                <?php
                  /*$item = null; //campo
                  $valor = null; //contenido del campo
                  $subcategorias = ControladorSubCategoria::ctrMostrarSubCategoria($item, $valor);

                  foreach ($subcategorias as $key => $value) {
                    echo '<option value="' . $value["idsubcategoria"] . '">' . $value["descripcion"] . '</option>';
                  }*/
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA EL CONSUMIDOR
            ======================================-->
            <div class="form-group row">
              <label for="nuevoConsumidor" class="col-sm-3 col-form-label">Consumidor</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarConsumidor" name="nuevoConsumidor">
                <option value="">Selecionar Consumidor</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $consumidores = ControladorConsumidor::ctrMostrarConsumidor($item, $valor);

                  foreach ($consumidores as $key => $value) {
                    echo '<option value="' . $value["idconsumidor"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA LA MEDIDA
            ======================================-->
            <div class="form-group row">
              <label for="nuevaMedida" class="col-sm-3 col-form-label">Medida</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarMedida" name="nuevaMedida">
                <option value="">Selecionar Medida</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $medidas = ControladorMedida::ctrMostrarMedida($item, $valor);

                  foreach ($medidas as $key => $value) {
                    echo '<option value="' . $value["idmedida"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA EL TITULO
            ======================================-->
            <div class="form-group row">
              <label for="nuevoTitulo" class="col-sm-3 col-form-label">Título</label>
              <input type="text" name="nuevoTitulo" class="col-sm-9 form-control form-control-sm nuevoTitulo" placeholder="Ingresar Título">
            </div>

            <!--=====================================
            ENTRADA PARA LA DESCRIPCION
            ======================================-->
            <div class="form-group row">
              <label for="nuevaDescripcion" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="text" name="nuevaDescripcion" class="col-sm-9 form-control form-control-sm nuevaDescripcion" placeholder="Ingresar Descripción">
            </div>

            <!--=====================================
            ENTRADA PARA EL CODIGO SKU
            ======================================-->
            <div class="form-group row">
              <label for="nuevoCodigoSku" class="col-sm-3 col-form-label">Código SKU</label>
              <input maxlength="15" type="text" name="nuevoCodigoSku" class="col-sm-9 form-control form-control-sm nuevoCodigoSku" placeholder="Ingresar Código SKU">
            </div>

            <!--=====================================
            ENTRADA PARA EL COSTO
            ======================================-->
            <div class="form-group row">
              <label for="nuevoPrecioCosto" class="col-sm-3 col-form-label">Costo</label>
              <input type="number" name="nuevoPrecioCosto" class="col-sm-9 form-control form-control-sm nuevoPrecioCosto" placeholder="Ingresar Precio Costo">
            </div>

            <!--=====================================
            ENTRADA PARA EL PRECIO
            ======================================-->
            <div class="form-group row">
              <label for="nuevoPrecioVenta" class="col-sm-3 col-form-label">Precio</label>
              <input type="number" name="nuevoPrecioVenta" class="col-sm-9 form-control form-control-sm nuevoPrecioVenta" placeholder="Ingresar Precio Venta">
            </div>

            <!--=====================================
            ENTRADA PARA EL STOCK
            ======================================-->
            <div class="form-group row">
              <label for="nuevoStock" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="number" name="nuevoStock" class="col-sm-9 form-control form-control-sm nuevoStock" placeholder="Ingresar Stock">
            </div>

            <!--=====================================
            ENTRADA PARA SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="nuevaImgProducto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaImgProducto" name="nuevaImgProducto" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
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
          $crearProducto = new ControladorProducto();
          $crearProducto -> ctrCrearProducto();
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
//tag: MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">  
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
            ENTRADA PARA EL NEGOCIO
            ======================================-->
            <div class="form-group row">
            <input type="hidden" class="idProducto" name="idProducto">	
              <label for="editarNegocio" class="col-sm-3 col-form-label">Negocio</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarNegocio" name="editarNegocio">
                <option value="">Selecionar Negocio</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $negocios = ControladorNegocio::ctrMostrarNegocios($item, $valor);

                  foreach ($negocios as $key => $value) {
                    echo '<option value="' . $value["idnegocio"] . '">' . $value["razon_social"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA LA CATEGORIA
            ======================================-->
            <div class="form-group row">
              <label for="editarCategoria" class="col-sm-3 col-form-label">Categoría</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarCategoriaX" name="editarCategoria">
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
            ENTRADA PARA LA SUBCATEGORIA
            ======================================-->
            <div class="form-group row">
              <label for="editarSubCategoria" class="col-sm-3 col-form-label">SubCategoría</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarSubCategoriaX" name="editarSubCategoria">
                <option value="">Selecionar SubCategoría</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $subcategorias = ControladorSubCategoria::ctrMostrarSubCategoria($item, $valor);

                  foreach ($subcategorias as $key => $value) {
                    echo '<option value="' . $value["idsubcategoria"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA EL CONSUMIDOR
            ======================================-->
            <div class="form-group row">
              <label for="editarConsumidor" class="col-sm-3 col-form-label">Consumidor</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarConsumidor" name="editarConsumidor">
                <option value="">Selecionar Consumidor</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $consumidores = ControladorConsumidor::ctrMostrarConsumidor($item, $valor);

                  foreach ($consumidores as $key => $value) {
                    echo '<option value="' . $value["idconsumidor"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA LA MEDIDA
            ======================================-->
            <div class="form-group row">
              <label for="editarMedida" class="col-sm-3 col-form-label">Medida</label>
              <select class="col-sm-9 form-control form-control-sm seleccionarMedida" name="editarMedida">
                <option value="">Selecionar Medida</option>
                <?php
                  $item = null; //campo
                  $valor = null; //contenido del campo
                  $medidas = ControladorMedida::ctrMostrarMedida($item, $valor);

                  foreach ($medidas as $key => $value) {
                    echo '<option value="' . $value["idmedida"] . '">' . $value["descripcion"] . '</option>';
                  }
                ?>
              </select>
            </div>

            <!--=====================================
            ENTRADA PARA EL TITULO
            ======================================-->
            <div class="form-group row">
              <label for="editarTitulo" class="col-sm-3 col-form-label">Título</label>
              <input type="text" name="editarTitulo" class="col-sm-9 form-control form-control-sm editarTitulo" placeholder="Ingresar Título">
            </div>

            <!--=====================================
            ENTRADA PARA LA DESCRIPCION
            ======================================-->
            <div class="form-group row">
              <label for="editarDescripcion" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="text" name="editarDescripcion" class="col-sm-9 form-control form-control-sm editarDescripcion" placeholder="Ingresar Descripción">
            </div>

            <!--=====================================
            ENTRADA PARA EL CODIGO SKU
            ======================================-->
            <div class="form-group row">
              <label for="editarCodigoSku" class="col-sm-3 col-form-label">Código SKU</label>
              <input maxlength="15" type="text" name="editarCodigoSku" class="col-sm-9 form-control form-control-sm editarCodigoSku" placeholder="Ingresar Código SKU">
            </div>

            <!--=====================================
            ENTRADA PARA EL COSTO
            ======================================-->
            <div class="form-group row">
              <label for="editarPrecioCosto" class="col-sm-3 col-form-label">Costo</label>
              <input type="number" name="editarPrecioCosto" class="col-sm-9 form-control form-control-sm editarPrecioCosto" placeholder="Ingresar Precio Costo">
            </div>

            <!--=====================================
            ENTRADA PARA EL PRECIO
            ======================================-->
            <div class="form-group row">
              <label for="editarPrecioVenta" class="col-sm-3 col-form-label">Precio</label>
              <input type="number" name="editarPrecioVenta" class="col-sm-9 form-control form-control-sm editarPrecioVenta" placeholder="Ingresar Precio Venta">
            </div>

            <!--=====================================
            ENTRADA PARA EL STOCK
            ======================================-->
            <div class="form-group row">
              <label for="editarStock" class="col-sm-3 col-form-label">Descripcion</label>
              <input type="number" name="editarStock" class="col-sm-9 form-control form-control-sm editarStock" placeholder="Ingresar Stock">
            </div>

            <!--=====================================
            ENTRADA PARA SUBIR IMAGEN
            ======================================-->
            <div class="form-group row">
              <label for="editarImgProducto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaImgProducto" name="editarImgProducto" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imgProductoActual" class="imgProductoActual">
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
          $editarProducto = new ControladorProducto();
          $editarProducto -> ctrEditarProducto();
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
//tag: MODAL VER IMAGEN
======================================-->

<div id="modalVerImgProducto" class="modal fade">
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
              <img src="vistas/img/productos/default/anonymous.png" class="img-responsive previsualizar" width="100%" style="display: block;margin-left: auto; margin-right: auto;">
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