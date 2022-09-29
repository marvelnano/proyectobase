//TODO: Template Javascript
/*=============================================
//tag: CARGAR LA TABLA DINÁMICA DE CATEGORIA	
=============================================*/
$(".tablaCategoria").DataTable({
    "ajax": "ajax/tablaCategoria.ajax.php",
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
//tag: REVISAR SI CATEGORIA YA EXISTE
=============================================*/
function validarCategoria(micategoria){
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
               $(".validarcategoria").after('<div class="alert alert-warning">Este categoria ya existe en la base de datos</div>');
               $(".validarcategoria").val("");
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
//tag: GUARDAR CATEGORIA
=============================================*/
$(".guardarCategoria").click(function(){
   //validarCategoria($(".descripcion").val());	

   /*=============================================
   //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
   =============================================*/
   //alert("llegó a guardar");
   if($(".descripcion").val() != "" ){
       agregarMiCategoria();
   }else{
       toastr.error("Llenar todos los campos obligatorios");
       return;
   }
});

function agregarMiCategoria(){
   /*=============================================
   //note: ALMACENAMOS TODOS LOS CAMPOS DE CATEGORIA
   =============================================*/
   var descripcion = $(".descripcion").val();//.toUpperCase()
   var datosCategoria = new FormData();
   datosCategoria.append("descripcion", descripcion);

   $.ajax({
       url:"ajax/categoria.ajax.php",
       method: "POST",
       data: datosCategoria,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){
           // console.log("respuesta", respuesta);
           if(respuesta === "ok"){					
               toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
               $(".tablaCategoria").DataTable().ajax.reload();
               $("#modalAgregarCategoria").modal('hide');
           }			
       }
   })	
};

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
       beforeSend: function () {
           //alert("dentro de editar: "+datos["idCategoria"]);
       },
       success: function(respuesta){			
           /* console.log("respuesta", respuesta); */
           $("#modalEditarCategoria .idCategoria").val(respuesta[0]["idcategoria"]);
           $("#modalEditarCategoria .descripcion").val(respuesta[0]["descripcion"]);
           
           /*=============================================
           //note: CAPTURAMOS CAMBIOS DE Categoria
           =============================================*/	
           $(".guardarCambiosCategoria").click(function(){
               //validarCategoria($("#modalEditarCategoria .descripcion").val());

               //alert("llego a editar todo: "+$("#modalEditarCategoria .idCategoria").val());
               /*=============================================
               //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
               =============================================*/
               if($("#modalEditarCategoria .descripcion").val() != "" ){
                   editarMiCategoria();	
               }else{
                   toastr.error("Llenar todos los campos obligatorios");
                   return;
               }
           })
       }
   })
});

function editarMiCategoria(){
    /*=============================================
    //note: GUARDAR CAMBIOS DE Categoria
    =============================================*/
    //alert("editar: "+$("#modalEditarCategoria .idCategoria").val());
    var idCategoria = $("#modalEditarCategoria .idCategoria").val();
    var descripcionCategoria = $("#modalEditarCategoria .descripcion").val();//.toUpperCase()

    var datosCategoriaEd = new FormData();
    datosCategoriaEd.append("idCategoriaEd", idCategoria);
    datosCategoriaEd.append("descripcionCategoriaEd", descripcionCategoria);

    $.ajax({
        url:"ajax/categoria.ajax.php",
        method: "POST",
        data: datosCategoriaEd,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){									
            if(respuesta === "ok"){
                toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
                $(".tablaCategoria").DataTable().ajax.reload();
                $("#modalEditarCategoria").modal('hide');
            }
        }
    })	
};