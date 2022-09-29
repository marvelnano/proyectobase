//TODO: Template Javascript
/*=============================================
//tag: CARGAR LA TABLA DINÁMICA DE PRODUCTO	
=============================================*/
$(".tablaProducto").DataTable({
    "ajax": "ajax/tablaProducto.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
        "sProcessing":     "Procesando...",
       "sLengthMenu":     "Mostrar _MENU_ registros",
       "sZeroRecords":    "No se encontraron resultados",
       "sEmptyTable":     "Ningún dato disponible en esta tabla",
       "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
       "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
       "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
       "sInfoPostFix":    "",
       "sSearch":         "Buscar:",
       "sUrl":            "",
       "sInfoThousands":  ",",
       "sLoadingRecords": "Cargando...",
       "oPaginate": {
           "sFirst":    "Primero",
           "sLast":     "Último",
           "sNext":     "Siguiente",
           "sPrevious": "Anterior"
       },
       "oAria": {
           "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
           "sSortDescending": ": Activar para ordenar la columna de manera descendente"
       }
   }
});

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
//tag: REVISAR SI PRODUCTO YA EXISTE
=============================================*/
function validarProducto(miproducto){
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
};

/*=============================================
//tag: GUARDAR PRODUCTO
=============================================*/
$(".guardarProducto").click(function(){
   //validarProducto($(".descripcion").val());	

   /*=============================================
   //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
   =============================================*/
   //alert("llegó a guardar");
   if($(".descripcion").val() != "" ){
       agregarMiProducto();
   }else{
       toastr.error("Llenar todos los campos obligatorios");
       return;
   }
});

function agregarMiProducto(){
   /*=============================================
   //note: ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
   =============================================*/
   var descripcion = $(".descripcion").val();//.toUpperCase()
   var datosProducto = new FormData();
   datosProducto.append("descripcion", descripcion);

   $.ajax({
       url:"ajax/producto.ajax.php",
       method: "POST",
       data: datosProducto,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){
           // console.log("respuesta", respuesta);
           if(respuesta === "ok"){					
               toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
               $(".tablaProducto").DataTable().ajax.reload();
               $("#modalAgregarProducto").modal('hide');
           }			
       }
   })	
};

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
       beforeSend: function () {
           //alert("dentro de editar: "+datos["idProducto"]);
       },
       success: function(respuesta){			
           /* console.log("respuesta", respuesta); */
           $("#modalEditarProducto .idProducto").val(respuesta[0]["idproducto"]);
           $("#modalEditarProducto .descripcion").val(respuesta[0]["descripcion"]);
           
           /*=============================================
           //note: CAPTURAMOS CAMBIOS DE Producto
           =============================================*/	
           $(".guardarCambiosProducto").click(function(){
               //validarProducto($("#modalEditarProducto .descripcion").val());

               //alert("llego a editar todo: "+$("#modalEditarProducto .idProducto").val());
               /*=============================================
               //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
               =============================================*/
               if($("#modalEditarProducto .descripcion").val() != "" ){
                   editarMiProducto();	
               }else{
                   toastr.error("Llenar todos los campos obligatorios");
                   return;
               }
           })
       }
   })
});

function editarMiProducto(){
    /*=============================================
    //note: GUARDAR CAMBIOS DE Producto
    =============================================*/
    //alert("editar: "+$("#modalEditarProducto .idProducto").val());
    var idProducto = $("#modalEditarProducto .idProducto").val();
    var descripcionProducto = $("#modalEditarProducto .descripcion").val();//.toUpperCase()

    var datosProductoEd = new FormData();
    datosProductoEd.append("idProductoEd", idProducto);
    datosProductoEd.append("descripcionProductoEd", descripcionProducto);

    $.ajax({
        url:"ajax/producto.ajax.php",
        method: "POST",
        data: datosProductoEd,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){									
            if(respuesta === "ok"){
                toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
                $(".tablaProducto").DataTable().ajax.reload();
                $("#modalEditarProducto").modal('hide');
            }
        }
    })	
};