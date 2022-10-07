//TODO: Template Javascript

/*=============================================
//tag: ACTIVAR CATEGORIA
=============================================*/
$('.tablaCategoria tbody').on("click", ".btnActivar", function(){
   var idCategoria = $(this).attr("idCategoria");
   var estadoCategoria = $(this).attr("estadoCategoria");

   var datos = new FormData();
    datos.append("activarId", idCategoria);
     datos.append("activarCategoria", estadoCategoria);

     $.ajax({
       url:"ajax/categoria.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){              
           // console.log("respuesta", respuesta);
       }
     })
   
     //alert("estado: "+estadoCategoria)

   if(estadoCategoria == 0){
         $(this).removeClass('btn-success');
         $(this).addClass('btn-danger');
         $(this).html('Desactivado');
         $(this).attr('estadoCategoria',1);
     }else{
         $(this).addClass('btn-success');
         $(this).removeClass('btn-danger');
         $(this).html('Activado');
         $(this).attr('estadoCategoria',0);
     }
});

/*=============================================
//tag: SUBIENDO LA IMAGEN DEL CATEGORIA
=============================================*/
$(".nuevaImagen").change(function(){
    var imagen = this.files[0];  
  
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/
      if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevaImagen").val("");
         swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });
      }else if(imagen["size"] > 2000000){
        $(".nuevaImagen").val("");
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
//fixme: REVISAR SI CATEGORIA YA EXISTE
=============================================*/
/*function validarCategoria(micategoria){
   $(".alert").remove();

   var categoria = micategoria;
   var resultado = 0;

   var datos = new FormData();
   datos.append("validarCategoria", categoria);

   $.ajax({
       url:"ajax/categoria.ajax.php",
       method:"POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success:function(respuesta){
           if(respuesta.length != 0){
               $(".validarcategoria").after('<div class="alert alert-warning">Esta categoria ya existe en la base de datos</div>');
               $(".validarcategoria").val("");
               resultado = false;
                 return false;				
           }else{
               resultado = true;
           }
       }
   })	   
   return resultado;
};*/

/*=============================================
//tag: EDITAR CATEGORIA
=============================================*/
$('.tablaCategoria tbody').on("click", ".btnEditarCategoria", function(){	
   var idCategoria = $(this).attr("idCategoria");
   //alert("llego a editar: "+idCategoria);
   var datos = new FormData();
   datos.append("idCategoriaEdit", idCategoria);
   
   $.ajax({
       url:"ajax/categoria.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success: function(respuesta){			
           // console.log("respuesta", respuesta); 
           $("#modalEditarCategoria .idCategoria").val(respuesta["idcategoria"]);
           $("#modalEditarCategoria .editarCategoria").val(respuesta["descripcion"]);
           $("#modalEditarCategoria .imagenActual").val(respuesta["imagen"]);
           if(respuesta["imagen"] != ""){
                $("#modalEditarCategoria .previsualizar").attr("src", respuesta["imagen"]);
            }
       }
   })
});

/*=============================================
//tag: VER IAMGEN
=============================================*/
$('.tablaCategoria tbody').on("click", ".btnVerImagen", function(){	
    var idCategoria = $(this).attr("idCategoria");
    //alert("llego a editar: "+idCategoria);
    var datos = new FormData();
    datos.append("idCategoriaEdit", idCategoria);
    
    $.ajax({
        url:"ajax/categoria.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){			
            // console.log("respuesta", respuesta); 
            if(respuesta["imagen"] != ""){
                $("#modalVerImagen .previsualizar").attr("src", respuesta["imagen"]);
            }
        }
    })
 });