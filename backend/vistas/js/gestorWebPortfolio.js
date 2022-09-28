/*=============================================
ACTIVAR WEBPORTFOLIO
=============================================*/
$(".tablaWebPortfolios").on("click", ".btnActivar", function(){
	var idWebPortfolio = $(this).attr("idWebPortfolio");
	var estadoWebPortfolio = $(this).attr("estadoWebPortfolio");

	var datos = new FormData();
 	datos.append("activarId", idWebPortfolio);
  datos.append("activarWebPortfolio", estadoWebPortfolio);

  $.ajax({
    url:"ajax/webportfolio.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){
      console.log("respuesta", respuesta);
    }
  })

  if(estadoWebPortfolio == 0){
    $(this).removeClass('btn-success');
    $(this).addClass('btn-danger');
    $(this).html('Desactivado');
    $(this).attr('estadoWebPortfolio',1);
  }else{
    $(this).addClass('btn-success');
    $(this).removeClass('btn-danger');
    $(this).html('Activado');
    $(this).attr('estadoWebPortfolio',0);
  }
});

/*=============================================
SUBIENDO LA FOTO DEL WEBPORTFOLIO
=============================================*/
$(".nuevaFoto").change(function(){
  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
      $(".nuevaFoto").val("");
      swal({
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
    }else if(imagen["size"] > 5000000){
      $(".nuevaFoto").val("");
      swal({
        title: "Error al subir la imagen",
        text: "¡La imagen no debe pesar más de 5MB!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
    }else{
      var datosImagen = new FileReader;
      datosImagen.readAsDataURL(imagen);

      $(datosImagen).on("load", function(event){
        var rutaImagen = event.target.result;
        $(".previsualizar").attr("src", rutaImagen);
      })
    }
});

/*=============================================
EDITAR WEBPORTFOLIO
=============================================*/
$(".tablaWebPortfolios").on("click", ".btnEditarWebPortfolio", function(){
  var idWebPortfolio = $(this).attr("idWebPortfolio");  
  var datos = new FormData();
  datos.append("idWebPortfolio", idWebPortfolio);

  $.ajax({
    url:"ajax/webportfolio.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){ 
      $("#modalEditarWebPortfolio .idwebportfolio").val(respuesta["idplantillawebportfolio"]);
      $("#modalEditarWebPortfolio .seleccionarplantillaweb").val(respuesta["idplantillaweb"]);
      $("#modalEditarWebPortfolio .seleccionarwebareaportfolio").val(respuesta["idplantillawebareaportfolio"]);
      $("#modalEditarWebPortfolio .descripcion").val(respuesta["descripcion"]);
      $("#modalEditarWebPortfolio .fotoActual").val(respuesta["imagen"]);

      if(respuesta["imagen"] != ""){
        $(".previsualizar").attr("src", respuesta["imagen"]);
      }
    }
  })
});

/*=============================================
ELIMINAR WEBPORTFOLIO
=============================================*/
$(".tablaWebPortfolios").on("click", ".btnEliminarWebPortfolio", function(){

  var idWebPortfolio = $(this).attr("idWebPortfolio");
  var fotoWebPortfolio = $(this).attr("fotoWebPortfolio");

  swal({
    title: '¿Está seguro de borrar el portfolio web?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar portfolio web!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=perfiles&idWebPortfolio="+idWebPortfolio+"&fotoWebPortfolio="+fotoWebPortfolio;
    }
  })
});