//TODO: Template Javascript

/*=============================================
//tag: ACTIVAR PRODUCTO
=============================================*/
$('.tablaProducto tbody').on("click", ".btnActivar", function(){
   var idProducto = $(this).attr("idProducto");
   var estadoProducto = $(this).attr("estadoProducto");

   var datos = new FormData();
    datos.append("activarId", idProducto);
    datos.append("activarProducto", estadoProducto);

    $.ajax({
        url:"ajax/producto.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){              
            // console.log("respuesta", respuesta);
        }
    })
   
    //alert("estado: "+estadoProducto)

    if(estadoProducto == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoProducto',1);
    }else{
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoProducto',0);
    }
});

/*=============================================
//tag: SUBIENDO LA IMAGEN DEL PRODUCTO
=============================================*/
$(".nuevaImgProducto").change(function(){
    var imagen = this.files[0];  
  
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/
      if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevaImgProducto").val("");
         swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });
      }else if(imagen["size"] > 2000000){
        $(".nuevaImgProducto").val("");
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
//fixme: REVISAR SI PRODUCTO YA EXISTE
=============================================*/
/*function validarProducto(miproducto){
   $(".alert").remove();

   var producto = miproducto;
   var resultado = 0;

   var datos = new FormData();
   datos.append("validarProducto", producto);

   $.ajax({
       url:"ajax/producto.ajax.php",
       method:"POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success:function(respuesta){
           if(respuesta.length != 0){
               $(".validarproducto").after('<div class="alert alert-warning">Este producto ya existe en la base de datos</div>');
               $(".validarproducto").val("");
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
//tag: MOSTRAR SUBCATEGORIAS
=============================================*/
$('.seleccionarCategoriaX').on("change", function(){	
    var idCategoria = $(".seleccionarCategoriaX").val();
    //alert("llego a change categoria: "+idCategoria);
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);
    
    $.ajax({
        url:"ajax/subcategoria.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){		
            //console.log("respuesta", respuesta);
            if(respuesta.length !== 0){
                //alert('idCategoria: '+idCategoria);
                respuesta.forEach(seleccionarSubCategoria);	

                function seleccionarSubCategoria(item, index){
                    var subcategoria = item.descripcion;
                    var idsubcategoria = item.idsubcategoria;

                    if($(".seleccionarSubCategoriaX").val() == idsubcategoria){
                        $(".seleccionarSubCategoriaX").attr("value",idsubcategoria);
                        $(".seleccionarSubCategoriaX").html(subcategoria);
                    }

                    $(".seleccionarSubCategoriaX").append('<option value="'+idsubcategoria+'">'+subcategoria+'</option>');              
                }
            }else{
                //alert('idCategoriaVacio: '+idCategoria);
                $(".seleccionarSubCategoriaX").html('<option value="">Selecionar SubCategoría</option>');
            }
        }
    })
 });

/*=============================================
//tag: EDITAR PRODUCTO
=============================================*/
$('.tablaProducto tbody').on("click", ".btnEditarProducto", function(){	
   var idProducto = $(this).attr("idProducto");
   //alert("llego a editar: "+idProducto);
   var datos = new FormData();
   datos.append("idProductoEdit", idProducto);
   
   $.ajax({
        url:"ajax/producto.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){			
            // console.log("respuesta", respuesta);
            $("#modalEditarProducto .idProducto").val(respuesta["idproducto"]);
            $("#modalEditarProducto .seleccionarNegocio").val(respuesta["idnegocio"]);
            $("#modalEditarProducto .seleccionarCategoriaX").val(respuesta["idcategoria"]);
            $("#modalEditarProducto .seleccionarSubCategoriaX").val(respuesta["idsubcategoria"]);
            $("#modalEditarProducto .seleccionarConsumidor").val(respuesta["idconsumidor"]);
            $("#modalEditarProducto .seleccionarMedida").val(respuesta["idmedida"]);
            $("#modalEditarProducto .titulo").val(respuesta["titulo"]);
            $("#modalEditarProducto .descripcion").val(respuesta["descripcion"]);
            $("#modalEditarProducto .codigo_sku").val(respuesta["codigo_sku"]);
            $("#modalEditarProducto .costo").val(respuesta["costo"]);
            $("#modalEditarProducto .precio").val(respuesta["precio"]);
            $("#modalEditarProducto .stock").val(respuesta["stock"]);
            if(respuesta["imagen"] != ""){
                $("#modalEditarProducto .previsualizar").attr("src", respuesta["imagen"]);
            }
        }
    })
});

/*=============================================
//tag: VER IAMGEN
=============================================*/
$('.tablaProducto tbody').on("click", ".btnVerImagen", function(){	
    var idProducto = $(this).attr("idProducto");
    //alert("llego a editar: "+idSubCategoria);
    var datos = new FormData();
    datos.append("idProductoEdit", idProducto);
    
    $.ajax({
        url:"ajax/producto.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){			
            // console.log("respuesta", respuesta); 
            if(respuesta["imagen"] != ""){
                $("#modalVerImgProducto .previsualizar").attr("src", respuesta["imagen"]);
            }
        }
    })
 });