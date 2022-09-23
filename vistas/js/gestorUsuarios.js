/*=============================================
ACTIVAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnActivar", function(){
  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");

  var datos = new FormData();
  datos.append("activarIdUsuario", idUsuario);
  datos.append("activarUsuario", estadoUsuario);

  $.ajax({
    url:"ajax/administradores.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){
      console.log("respuesta", respuesta);
    }
  })

  if(estadoUsuario == 0){
    $(this).removeClass('btn-success');
    $(this).addClass('btn-danger');
    $(this).html('Desactivado');
    $(this).attr('estadoUsuario',1);
  }else{
    $(this).addClass('btn-success');
    $(this).removeClass('btn-danger');
    $(this).html('Activado');
    $(this).attr('estadoUsuario',0);
  }
});

/*=============================================
SUBIENDO LA FOTO DEL USUARIO
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
    }else if(imagen["size"] > 2000000){
      $(".nuevaFoto").val("");
       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
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
EDITAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnEditarUsuario", function(){
  var idUsuario = $(this).attr("idUsuario");    
  var datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url:"ajax/administradores.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){ 
      $("#modalEditarUsuario .editarNombre").val(respuesta["nombre_completo"]);
      $("#modalEditarUsuario .idUsuario").val(respuesta["idusuario"]);
      $("#modalEditarUsuario .editarEmail").val(respuesta["email"]);
      $("#modalEditarUsuario .seleccionarPerfil").val(respuesta["idnivelusuario"]);
      $("#modalEditarUsuario .fotoActual").val(respuesta["foto"]);
      $("#modalEditarUsuario .passwordActual").val(respuesta["password"]);
      if(respuesta["foto"] != ""){
        $("#modalEditarUsuario .previsualizar").attr("src", respuesta["foto"]);
      }
    }
  })
});

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnEliminarUsuario", function(){
  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");

  swal({
    title: '¿Está seguro de borrar el perfil?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar perfil!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=perfiles&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario;
    }
  })
});