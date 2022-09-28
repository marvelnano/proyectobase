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
          <h1>Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Administrar Usuarios</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar Usuario
        </button>
      </div>

      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive-perfil tablaUsuarios">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>            
          </thead>
          <tbody>

            <?php

            $item = null;
            $valor = null;

            $perfiles = ControladorAdministradores::ctrMostrarUsuarios($item, $valor);
            
             foreach ($perfiles as $key => $value){

              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["nombre_completo"].'</td>
                      <td>'.$value["email"].'</td>';

                      if($value["foto"] != ""){
                      echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                      }else{
                        echo '<td><img src="vistas/img/perfiles/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                    }

                    echo '<td>'.$value["perfil"].'</td>';
                      if($value["estado"] != 0){
                      echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["idusuario"].'" estadoUsuario="0">Activado</button></td>';
                    }else{
                      echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["idusuario"].'" estadoUsuario="1">Desactivado</button></td>';
                    } 

                      echo '<td>
                      <div class="btn-group">                              
                        <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["idusuario"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-user-edit"></i></button>
                        <!--<button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["idusuario"].'" fotoUsuario="'.$value["foto"].'"><i class="fa fa-times"></i></button>-->
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
<div id="modalAgregarUsuario" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Agregar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white;">&times;</span>
          </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          
          <div class="card-body">

            <!-- ENTRADA PARA EL USUARIO -->
            <div class="form-group row" style="display: none;">
              <label for="usuario" class="col-sm-3 col-form-label">Usuario</label>
              <input type="text" class="col-sm-9 form-control form-control-sm  usuario" placeholder="Ingresar Usuario">
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group row">            
              <div class="input-group">
              <label for="nombreusuario" class="col-sm-3 col-form-label">Usuario</label>
                <!--<div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>-->
                <input type="text" class="col-sm-9 form-control form-control-sm  nombres"  name="regNombres" placeholder="Ingresar Nombre de Usuario">
              </div>
            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            <div class="form-group row">            
              <div class="input-group">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
                <!--<div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>-->
                <input type="text" class="col-sm-9 form-control form-control-sm  email" name="regEmail" placeholder="Ingresar Email">
              </div>
            </div>

            <!-- ENTRADA PARA EL PASSWORD -->
            <div class="form-group row">            
              <div class="input-group">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
                <input type="password" class="col-sm-9 form-control form-control-sm  password" name="regPassword" placeholder="Ingresar Password">
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group row">
              <label for="nuevaFoto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
              <input type="file" class="col-sm-9 form-control form-control-sm nuevaFoto" name="nuevaFoto" placeholder="Elegir Foto">
              <p class="help-block">Peso Máximo de la foto 2 MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">
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
          $crearPerfil = new ControladorAdministradores();
          $crearPerfil -> ctrRegistroUsuario();
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

    <form method="post" enctype="multipart/form-data">
      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header" style="background-color: #3c8dbc; color:white">
        <h4 class="modal-title">Editar Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">&times;</span>
        </button>
      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">        
        <div class="card-body">
          <!-- EDITAR EL USUARIO -->
          <div class="form-group row" style="display: none;">
            <label for="usuario">Usuario</label>
            <input type="text" class="col-sm-9 form-control form-control-sm  usuario" placeholder="Ingresar Usuario">
          </div>

          <!-- EDITAR EL NOMBRE -->
          <div class="form-group row">
            <div class="input-group">    
            <label for="nombreusuario" class="col-sm-3 col-form-label">Usuario</label>        
              <!--<div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>-->
              <input type="text" class="col-sm-9 form-control form-control-sm  editarNombre" name="editarNombre" placeholder="Ingresar Nombre de Usuario" required>
              <input type="hidden" class="idUsuario" name="idUsuario" >
            </div>
          </div>

          <!-- EDITAR EL EMAIL -->
          <div class="form-group row">
            <div class="input-group"> 
            <label for="email" class="col-sm-3 col-form-label">Email</label>           
              <!--<div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              </div>-->
              <input type="text" class="col-sm-9 form-control form-control-sm  editarEmail" name="editarEmail" placeholder="Ingresar Email">
            </div>
          </div>

          <!-- EDITAR EL PASSWORD -->
          <div class="form-group row">          
            <div class="input-group">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
              <input type="password" class="col-sm-9 form-control form-control-sm " name="editarPassword" placeholder="Ingresar Password">
              <input type="hidden" class="passwordActual" name="passwordActual">
            </div>
          </div>

          <!-- EDITAR LOS PERFILES -->
          <div class="form-group row">
            <input type="hidden" class="idTema">
            <label for="nivel" class="col-sm-3 col-form-label">Perfil</label>
            <select class="col-sm-9 form-control form-control-sm seleccionarPerfil" name="editarUsuario">
              <option value="">Selecionar Perfil</option>
              <?php
                $item = null; //campo
                $valor = null; //contenido del campo

                $niveles = ControladorNivel::ctrMostrarNiveles($item, $valor);

                foreach ($niveles as $key => $value) {

                  echo '<option value="' . $value["idnivelusuario"] . '" >' . $value["descripcion"] . '</option>';
                }
              ?>
            </select>
          </div>

          <!-- EDITAR SUBIR FOTO -->
          <div class="form-group row">
            <label for="nuevaFoto" class="col-sm-3 col-form-label">SUBIR FOTO</label>
            <!-- <input type="file" class="col-sm-9 form-control form-control-sm  fotoActual" placeholder="Elegir Foto"> -->
            <input type="file" class="col-sm-9 form-control form-control-sm nuevaFoto"  name="editarFoto">
            <p class="help-block">Peso Máximo de la foto 2 MB</p>
            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            <input type="hidden" name="fotoActual" class="fotoActual">
          </div>
        </div>
      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Modificar Usuario</button>
      </div>

      <?php
        $editarUsuario = new ControladorAdministradores();
        $editarUsuario -> ctrEditarUsuario();
      ?>
    </form>
    </div>
  </div>
</div>