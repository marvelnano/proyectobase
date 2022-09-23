<?php
  $design = ControladorDesign::ctrSeleccionarPlantilla();
?>

<div id="back"></div>
<div class="register-box">
  <div class="register-logo">
    <?php echo '<img src="'.$design["logo"].'" class="img-fluid" >'; ?> <!-- style="padding: 30px 100px 0px 100px" -->
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrar Nuevo Usuario</p>
      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Apellidos y Nombres" name="regNombres">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="regEmail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="regPassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Repetir password" name="regClaveInicial">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Acepto los <a href="#">términos</a>
              </label>
            </div>
          </div>

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
          <!-- /.col -->
        </div>

        <?php
          $login = new ControladorAdministradores();
          $login -> ctrRegistroUsuario();
        ?>

      </form>

      <!--<div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>-->

      <a href="login" style="text-align: center;">Ya tengo una cuenta</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
