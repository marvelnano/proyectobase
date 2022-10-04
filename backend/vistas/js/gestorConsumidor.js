//TODO: Template Javascript

/*=============================================
//tag: ACTIVAR CONSUMIDOR
=============================================*/
$('.tablaConsumidor tbody').on("click", ".btnActivar", function(){
   var idConsumidor = $(this).attr("idConsumidor");
   var estadoConsumidor = $(this).attr("estadoConsumidor");

   var datos = new FormData();
    datos.append("activarId", idConsumidor);
     datos.append("activarConsumidor", estadoConsumidor);

     $.ajax({
       url:"ajax/consumidor.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){              
           // console.log("respuesta", respuesta);
       }
     })
   
     //alert("estado: "+estadoConsumidor)

   if(estadoConsumidor == 0){
         $(this).removeClass('btn-success');
         $(this).addClass('btn-danger');
         $(this).html('Desactivado');
         $(this).attr('estadoConsumidor',1);
     }else{
         $(this).addClass('btn-success');
         $(this).removeClass('btn-danger');
         $(this).html('Activado');
         $(this).attr('estadoConsumidor',0);
     }
});

/*=============================================
//tag: SUBIENDO LA IMAGEN DEL CONSUMIDOR
=============================================*/
$(".nuevaImgConsumidor").change(function(){
    var imagen = this.files[0];  
  
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/
      if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevaImgConsumidor").val("");
         swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });
      }else if(imagen["size"] > 2000000){
        $(".nuevaImgConsumidor").val("");
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
//tag: REVISAR SI CONSUMIDOR YA EXISTE
=============================================*/
function validarConsumidor(miconsumidor){
   $(".alert").remove();

   var consumidor = miconsumidor;
   var resultado = 0;

   var datos = new FormData();
   datos.append("validarConsumidor", consumidor);

   $.ajax({
       url:"ajax/consumidor.ajax.php",
       method:"POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success:function(respuesta){
           if(respuesta.length != 0){
               $(".validarconsumidor").after('<div class="alert alert-warning">Este consumidor ya existe en la base de datos</div>');
               $(".validarconsumidor").val("");
               resultado = false;
                 return false;				
           }else{
               resultado = true;
           }
       }
   })	   
   return resultado;
};

/*=============================================
//tag: EDITAR CONSUMIDOR
=============================================*/
$('.tablaConsumidor tbody').on("click", ".btnEditarConsumidor", function(){	
   var idConsumidor = $(this).attr("idConsumidor");
   //alert("llego a editar: "+idConsumidor);
   var datos = new FormData();
   datos.append("idConsumidorEdit", idConsumidor);
   
   $.ajax({
       url:"ajax/consumidor.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success: function(respuesta){			
           /* console.log("respuesta", respuesta); */
           $("#modalEditarConsumidor .idConsumidor").val(respuesta["idconsumidor"]);
           $("#modalEditarConsumidor .editarConsumidor").val(respuesta["descripcion"]);
           $("#modalEditarConsumidor .imgActual").val(respuesta["imagen"]);
           if(respuesta["imagen"] != ""){
                $("#modalEditarConsumidor .previsualizar").attr("src", respuesta["imagen"]);
            }
       }
   })
});

/*=============================================
//tag: VER IAMGEN
=============================================*/
$('.tablaConsumidor tbody').on("click", ".btnVerImgConsumidor", function(){	
    var idConsumidor = $(this).attr("idConsumidor");
    //alert("llego a editar: "+idConsumidor);
    var datos = new FormData();
    datos.append("idConsumidorEdit", idConsumidor);
    
    $.ajax({
        url:"ajax/consumidor.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){			
            // console.log("respuesta", respuesta); 
            if(respuesta["imagen"] != ""){
                $("#modalVerImgConsumidor .previsualizar").attr("src", respuesta["imagen"]);
            }
        }
    })
 });