<?php
  $design = ControladorDesign::ctrSeleccionarPlantilla();
?>

<div id="back"></div>
<div class="login-box">
  <div class="login-logo">
    <?php //echo '<img src="'.$design["logo"].'" class="img-fluid" style="padding-bottom: 30px">'; ?> <!-- style="padding: 30px 100px 0px 100px" -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <?php echo '<img src="'.$design["logo"].'" class="img-fluid" style="padding-bottom: 30px">'; ?>
      <p class="login-box-msg">Ingresar al sistema</p>
      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="ingEmail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-4"></div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
        </div>

        <p class="mb-0">
          <a href="registro" class="text-center">Registrarme</a>
        </p>

        <?php
          $login = new ControladorAdministradores();
          $login -> ctrIngresoAdministrador();
        ?>

      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>