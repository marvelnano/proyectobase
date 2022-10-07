//TODO: Template Javascript

/*=============================================
//tag: ACTIVAR SUBCATEGORIA
=============================================*/
$('.tablaSubCategoria tbody').on("click", ".btnActivar", function(){
   var idSubCategoria = $(this).attr("idSubCategoria");
   var estadoSubCategoria = $(this).attr("estadoSubCategoria");

   var datos = new FormData();
    datos.append("activarId", idSubCategoria);
     datos.append("activarSubCategoria", estadoSubCategoria);

     $.ajax({
       url:"ajax/subcategoria.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){              
           // console.log("respuesta", respuesta);
       }
     })
   
     //alert("estado: "+estadoSubCategoria)

   if(estadoSubCategoria == 0){
         $(this).removeClass('btn-success');
         $(this).addClass('btn-danger');
         $(this).html('Desactivado');
         $(this).attr('estadoSubCategoria',1);
     }else{
         $(this).addClass('btn-success');
         $(this).removeClass('btn-danger');
         $(this).html('Activado');
         $(this).attr('estadoSubCategoria',0);
     }
});

/*=============================================
//tag: SUBIENDO LA IMAGEN DEL SUBCATEGORIA
=============================================*/
$(".nuevaImgSubCat").change(function(){
    var imagen = this.files[0];  
  
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/
      if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevaImgSubCat").val("");
         swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });
      }else if(imagen["size"] > 2000000){
        $(".nuevaImgSubCat").val("");
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
//fixme: REVISAR SI SUBCATEGORIA YA EXISTE
=============================================*/
/*function validarSubCategoria(misubcategoria){
   $(".alert").remove();

   var subcategoria = misubcategoria;
   var resultado = 0;

   var datos = new FormData();
   datos.append("validarSubCategoria", subcategoria);

   $.ajax({
       url:"ajax/subcategoria.ajax.php",
       method:"POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success:function(respuesta){
           if(respuesta.length != 0){
               $(".validarsubcategoria").after('<div class="alert alert-warning">Esta subcategoria ya existe en la base de datos</div>');
               $(".validarsubcategoria").val("");
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
//tag: EDITAR SUBCATEGORIA
=============================================*/
$('.tablaSubCategoria tbody').on("click", ".btnEditarSubCategoria", function(){	
   var idSubCategoria = $(this).attr("idSubCategoria");
   //alert("llego a editar: "+idSubCategoria);
   var datos = new FormData();
   datos.append("idSubCategoriaEdit", idSubCategoria);
   
   $.ajax({
       url:"ajax/subcategoria.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success: function(respuesta){			
           // console.log("respuesta", respuesta); 
           $("#modalEditarSubCategoria .idSubCategoria").val(respuesta["idsubcategoria"]);
           $("#modalEditarSubCategoria .seleccionarCategoria").val(respuesta["idcategoria"]);
           $("#modalEditarSubCategoria .editarSubCategoria").val(respuesta["descripcion"]);
           $("#modalEditarSubCategoria .imgSubCatActual").val(respuesta["imagen"]);
           if(respuesta["imagen"] != ""){
                $("#modalEditarSubCategoria .previsualizar").attr("src", respuesta["imagen"]);
            }
       }
   })
});

/*=============================================
//tag: VER IAMGEN
=============================================*/
$('.tablaSubCategoria tbody').on("click", ".btnVerImagen", function(){	
    var idSubCategoria = $(this).attr("idSubCategoria");
    //alert("llego a editar: "+idSubCategoria);
    var datos = new FormData();
    datos.append("idSubCategoriaEdit", idSubCategoria);
    
    $.ajax({
        url:"ajax/subcategoria.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){			
            // console.log("respuesta", respuesta); 
            if(respuesta["imagen"] != ""){
                $("#modalVerImgSubCat .previsualizar").attr("src", respuesta["imagen"]);
            }
        }
    })
 });