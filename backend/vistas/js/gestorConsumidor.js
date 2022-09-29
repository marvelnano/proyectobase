//TODO: Template Javascript
/*=============================================
//tag: CARGAR LA TABLA DINÁMICA DE CONSUMIDOR	
=============================================*/
$(".tablaConsumidor").DataTable({
    "ajax": "ajax/tablaConsumidor.ajax.php",
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
//tag: GUARDAR CONSUMIDOR
=============================================*/
$(".guardarConsumidor").click(function(){
   //validarConsumidor($(".descripcion").val());	

   /*=============================================
   //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
   =============================================*/
   //alert("llegó a guardar");
   if($(".descripcion").val() != "" ){
       agregarMiConsumidor();
   }else{
       toastr.error("Llenar todos los campos obligatorios");
       return;
   }
});

function agregarMiConsumidor(){
   /*=============================================
   //note: ALMACENAMOS TODOS LOS CAMPOS DE CONSUMIDOR
   =============================================*/
   var descripcion = $(".descripcion").val();//.toUpperCase()
   var datosConsumidor = new FormData();
   datosConsumidor.append("descripcion", descripcion);

   $.ajax({
       url:"ajax/consumidor.ajax.php",
       method: "POST",
       data: datosConsumidor,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){
           // console.log("respuesta", respuesta);
           if(respuesta === "ok"){					
               toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
               $(".tablaConsumidor").DataTable().ajax.reload();
               $("#modalAgregarConsumidor").modal('hide');
           }			
       }
   })	
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
       beforeSend: function () {
           //alert("dentro de editar: "+datos["idConsumidor"]);
       },
       success: function(respuesta){			
           /* console.log("respuesta", respuesta); */
           $("#modalEditarConsumidor .idConsumidor").val(respuesta[0]["idconsumidor"]);
           $("#modalEditarConsumidor .descripcion").val(respuesta[0]["descripcion"]);
           
           /*=============================================
           //note: CAPTURAMOS CAMBIOS DE Consumidor
           =============================================*/	
           $(".guardarCambiosConsumidor").click(function(){
               //validarConsumidor($("#modalEditarConsumidor .descripcion").val());

               //alert("llego a editar todo: "+$("#modalEditarConsumidor .idConsumidor").val());
               /*=============================================
               //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
               =============================================*/
               if($("#modalEditarConsumidor .descripcion").val() != "" ){
                   editarMiConsumidor();	
               }else{
                   toastr.error("Llenar todos los campos obligatorios");
                   return;
               }
           })
       }
   })
});

function editarMiConsumidor(){
    /*=============================================
    //note: GUARDAR CAMBIOS DE Consumidor
    =============================================*/
    //alert("editar: "+$("#modalEditarConsumidor .idConsumidor").val());
    var idConsumidor = $("#modalEditarConsumidor .idConsumidor").val();
    var descripcionConsumidor = $("#modalEditarConsumidor .descripcion").val();//.toUpperCase()

    var datosConsumidorEd = new FormData();
    datosConsumidorEd.append("idConsumidorEd", idConsumidor);
    datosConsumidorEd.append("descripcionConsumidorEd", descripcionConsumidor);

    $.ajax({
        url:"ajax/consumidor.ajax.php",
        method: "POST",
        data: datosConsumidorEd,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){									
            if(respuesta === "ok"){
                toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
                $(".tablaConsumidor").DataTable().ajax.reload();
                $("#modalEditarConsumidor").modal('hide');
            }
        }
    })	
};