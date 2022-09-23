<?php

	$plantilla = ControladorDesign::ctrSeleccionarPlantilla();

?>

<div class="box box-primary">

	<!--=====================================
  	LOGOTIPO
	======================================-->
	  
	<div class="card card-primary card-outline">

		<div class="card-header">
			<h5 class="m-0">LOGOTIPO</h5>
		</div>
			  
		<div class="card-body">
			<!-- <h5 class="card-title">LOGOTIPO</h5> -->

			<p class="card-text">
				<label for="logo">Cambiar logotipo</label>

				<p class="float-right">
					
					<img src="<?php echo $plantilla["logo"]; ?>" class="img-thumbnail previsualizarLogo" width="200px">

				</p>

				<input type="file" id="subirLogo">

				<p class="help-block">Tamaño recomendado 500px * 100px</p>

			</p>
			
		</div>

		<div class="card-footer" >
			<button type="button" id="guardarLogo" class="btn btn-primary float-right">Guardar Logotipo</button>
		</div>

	</div>

	<!--=====================================
  	ICONO
	======================================-->
	  
	<div class="card card-primary card-outline">

		<div class="card-header">
			<h5 class="m-0">ICONO</h5>
		</div>
			  
		<div class="card-body">
			<!-- <h5 class="card-title">ICONO</h5> -->

			<p class="card-text">
				<label for="logo">Cambiar icono</label>

				<p class="float-right">
				
					<img src="<?php  echo $plantilla["icono"]; ?>" class="img-thumbnail previsualizarIcono" width="50px">

				</p>

				<input type="file" id="subirIcono">

				<p class="help-block">Tamaño recomendado 100px * 100px</p>

			</p>
			
		</div>

		<div class="card-footer" >
			<button type="button" id="guardarIcono" class="btn btn-primary float-right">Guardar Icono</button>
		</div>
		
	</div>

</div>