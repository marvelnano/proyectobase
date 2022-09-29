//TODO: Template Javascript
/*=============================================
//tag: CARGAR LA TABLA DINÁMICA DE MEDIDA	
=============================================*/
$(".tablaMedida").DataTable({
    "ajax": "ajax/tablaMedida.ajax.php",
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
//tag: ACTIVAR MEDIDA
=============================================*/
$('.tablaMedida tbody').on("click", ".btnActivar", function(){
   var idMedida = $(this).attr("idMedida");
   var estadoMedida = $(this).attr("estadoMedida");

   var datos = new FormData();
    datos.append("activarId", idMedida);
     datos.append("activarMedida", estadoMedida);

     $.ajax({
       url:"ajax/medida.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){              
           // console.log("respuesta", respuesta);
       }
     })
   
     //alert("estado: "+estadoMedida)

   if(estadoMedida == 0){
         $(this).removeClass('btn-success');
         $(this).addClass('btn-danger');
         $(this).html('Desactivado');
         $(this).attr('estadoMedida',1);
     }else{
         $(this).addClass('btn-success');
         $(this).removeClass('btn-danger');
         $(this).html('Activado');
         $(this).attr('estadoMedida',0);
     }
});

/*=============================================
//tag: REVISAR SI MEDIDA YA EXISTE
=============================================*/
function validarMedida(mimedida){
   $(".alert").remove();

   var medida = mimedida;
   var resultado = 0;

   var datos = new FormData();
   datos.append("validarMedida", medida);

   $.ajax({
       url:"ajax/medida.ajax.php",
       method:"POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success:function(respuesta){
           if(respuesta.length != 0){
               $(".validarmedida").after('<div class="alert alert-warning">Este medida ya existe en la base de datos</div>');
               $(".validarmedida").val("");
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
//tag: GUARDAR MEDIDA
=============================================*/
$(".guardarMedida").click(function(){
   //validarMedida($(".descripcion").val());	

   /*=============================================
   //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
   =============================================*/
   //alert("llegó a guardar");
   if($(".descripcion").val() != "" ){
       agregarMiMedida();
   }else{
       toastr.error("Llenar todos los campos obligatorios");
       return;
   }
});

function agregarMiMedida(){
   /*=============================================
   //note: ALMACENAMOS TODOS LOS CAMPOS DE MEDIDA
   =============================================*/
   var descripcion = $(".descripcion").val();//.toUpperCase()
   var datosMedida = new FormData();
   datosMedida.append("descripcion", descripcion);

   $.ajax({
       url:"ajax/medida.ajax.php",
       method: "POST",
       data: datosMedida,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){
           // console.log("respuesta", respuesta);
           if(respuesta === "ok"){					
               toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
               $(".tablaMedida").DataTable().ajax.reload();
               $("#modalAgregarMedida").modal('hide');
           }			
       }
   })	
};

/*=============================================
//tag: EDITAR MEDIDA
=============================================*/
$('.tablaMedida tbody').on("click", ".btnEditarMedida", function(){	
   var idMedida = $(this).attr("idMedida");
   //alert("llego a editar: "+idMedida);
   var datos = new FormData();
   datos.append("idMedidaEdit", idMedida);
   
   $.ajax({
       url:"ajax/medida.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       beforeSend: function () {
           //alert("dentro de editar: "+datos["idMedida"]);
       },
       success: function(respuesta){			
           /* console.log("respuesta", respuesta); */
           $("#modalEditarMedida .idMedida").val(respuesta[0]["idmedida"]);
           $("#modalEditarMedida .descripcion").val(respuesta[0]["descripcion"]);
           
           /*=============================================
           //note: CAPTURAMOS CAMBIOS DE Medida
           =============================================*/	
           $(".guardarCambiosMedida").click(function(){
               //validarMedida($("#modalEditarMedida .descripcion").val());

               //alert("llego a editar todo: "+$("#modalEditarMedida .idMedida").val());
               /*=============================================
               //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
               =============================================*/
               if($("#modalEditarMedida .descripcion").val() != "" ){
                   editarMiMedida();	
               }else{
                   toastr.error("Llenar todos los campos obligatorios");
                   return;
               }
           })
       }
   })
});

function editarMiMedida(){
    /*=============================================
    //note: GUARDAR CAMBIOS DE Medida
    =============================================*/
    //alert("editar: "+$("#modalEditarMedida .idMedida").val());
    var idMedida = $("#modalEditarMedida .idMedida").val();
    var descripcionMedida = $("#modalEditarMedida .descripcion").val();//.toUpperCase()

    var datosMedidaEd = new FormData();
    datosMedidaEd.append("idMedidaEd", idMedida);
    datosMedidaEd.append("descripcionMedidaEd", descripcionMedida);

    $.ajax({
        url:"ajax/medida.ajax.php",
        method: "POST",
        data: datosMedidaEd,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){									
            if(respuesta === "ok"){
                toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
                $(".tablaMedida").DataTable().ajax.reload();
                $("#modalEditarMedida").modal('hide');
            }
        }
    })	
};