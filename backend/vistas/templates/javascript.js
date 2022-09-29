//TODO: Template Javascript
/*=============================================
//tag: CARGAR LA TABLA DINÁMICA DE {CONTROLADORMAY}	
=============================================*/
$(".tabla{CONTROLADOR}").DataTable({
    "ajax": "ajax/tabla{CONTROLADOR}.ajax.php",
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
//tag: ACTIVAR {CONTROLADORMAY}
=============================================*/
$('.tabla{CONTROLADOR} tbody').on("click", ".btnActivar", function(){
   var id{CONTROLADOR} = $(this).attr("id{CONTROLADOR}");
   var estado{CONTROLADOR} = $(this).attr("estado{CONTROLADOR}");

   var datos = new FormData();
    datos.append("activarId", id{CONTROLADOR});
     datos.append("activar{CONTROLADOR}", estado{CONTROLADOR});

     $.ajax({
       url:"ajax/{CONTROLADORMIN}.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){              
           // console.log("respuesta", respuesta);
       }
     })
   
     //alert("estado: "+estado{CONTROLADOR})

   if(estado{CONTROLADOR} == 0){
         $(this).removeClass('btn-success');
         $(this).addClass('btn-danger');
         $(this).html('Desactivado');
         $(this).attr('estado{CONTROLADOR}',1);
     }else{
         $(this).addClass('btn-success');
         $(this).removeClass('btn-danger');
         $(this).html('Activado');
         $(this).attr('estado{CONTROLADOR}',0);
     }
});

/*=============================================
//tag: REVISAR SI {CONTROLADORMAY} YA EXISTE
=============================================*/
function validar{CONTROLADOR}(mi{CONTROLADORMIN}){
   $(".alert").remove();

   var {CONTROLADORMIN} = mi{CONTROLADORMIN};
   var resultado = 0;

   var datos = new FormData();
   datos.append("validar{CONTROLADOR}", {CONTROLADORMIN});

   $.ajax({
       url:"ajax/{CONTROLADORMIN}.ajax.php",
       method:"POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success:function(respuesta){
           if(respuesta.length != 0){
               $(".validar{CONTROLADORMIN}").after('<div class="alert alert-warning">Este {CONTROLADORMIN} ya existe en la base de datos</div>');
               $(".validar{CONTROLADORMIN}").val("");
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
//tag: GUARDAR {CONTROLADORMAY}
=============================================*/
$(".guardar{CONTROLADOR}").click(function(){
   //validar{CONTROLADOR}($(".descripcion").val());	

   /*=============================================
   //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
   =============================================*/
   //alert("llegó a guardar");
   if($(".descripcion").val() != "" ){
       agregarMi{CONTROLADOR}();
   }else{
       toastr.error("Llenar todos los campos obligatorios");
       return;
   }
});

function agregarMi{CONTROLADOR}(){
   /*=============================================
   //note: ALMACENAMOS TODOS LOS CAMPOS DE {CONTROLADORMAY}
   =============================================*/
   var descripcion = $(".descripcion").val();//.toUpperCase()
   var datos{CONTROLADOR} = new FormData();
   datos{CONTROLADOR}.append("descripcion", descripcion);

   $.ajax({
       url:"ajax/{CONTROLADORMIN}.ajax.php",
       method: "POST",
       data: datos{CONTROLADOR},
       cache: false,
       contentType: false,
       processData: false,
       success: function(respuesta){
           // console.log("respuesta", respuesta);
           if(respuesta === "ok"){					
               toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
               $(".tabla{CONTROLADOR}").DataTable().ajax.reload();
               $("#modalAgregar{CONTROLADOR}").modal('hide');
           }			
       }
   })	
};

/*=============================================
//tag: EDITAR {CONTROLADORMAY}
=============================================*/
$('.tabla{CONTROLADOR} tbody').on("click", ".btnEditar{CONTROLADOR}", function(){	
   var id{CONTROLADOR} = $(this).attr("id{CONTROLADOR}");
   //alert("llego a editar: "+id{CONTROLADOR});
   var datos = new FormData();
   datos.append("id{CONTROLADOR}Edit", id{CONTROLADOR});
   
   $.ajax({
       url:"ajax/{CONTROLADORMIN}.ajax.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       beforeSend: function () {
           //alert("dentro de editar: "+datos["id{CONTROLADOR}"]);
       },
       success: function(respuesta){			
           /* console.log("respuesta", respuesta); */
           $("#modalEditar{CONTROLADOR} .id{CONTROLADOR}").val(respuesta[0]["id{CONTROLADORMIN}"]);
           $("#modalEditar{CONTROLADOR} .descripcion").val(respuesta[0]["descripcion"]);
           
           /*=============================================
           //note: CAPTURAMOS CAMBIOS DE {CONTROLADOR}
           =============================================*/	
           $(".guardarCambios{CONTROLADOR}").click(function(){
               //validar{CONTROLADOR}($("#modalEditar{CONTROLADOR} .descripcion").val());

               //alert("llego a editar todo: "+$("#modalEditar{CONTROLADOR} .id{CONTROLADOR}").val());
               /*=============================================
               //note: PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
               =============================================*/
               if($("#modalEditar{CONTROLADOR} .descripcion").val() != "" ){
                   editarMi{CONTROLADOR}();	
               }else{
                   toastr.error("Llenar todos los campos obligatorios");
                   return;
               }
           })
       }
   })
});

function editarMi{CONTROLADOR}(){
    /*=============================================
    //note: GUARDAR CAMBIOS DE {CONTROLADOR}
    =============================================*/
    //alert("editar: "+$("#modalEditar{CONTROLADOR} .id{CONTROLADOR}").val());
    var id{CONTROLADOR} = $("#modalEditar{CONTROLADOR} .id{CONTROLADOR}").val();
    var descripcion{CONTROLADOR} = $("#modalEditar{CONTROLADOR} .descripcion").val();//.toUpperCase()

    var datos{CONTROLADOR}Ed = new FormData();
    datos{CONTROLADOR}Ed.append("id{CONTROLADOR}Ed", id{CONTROLADOR});
    datos{CONTROLADOR}Ed.append("descripcion{CONTROLADOR}Ed", descripcion{CONTROLADOR});

    $.ajax({
        url:"ajax/{CONTROLADORMIN}.ajax.php",
        method: "POST",
        data: datos{CONTROLADOR}Ed,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){									
            if(respuesta === "ok"){
                toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
                $(".tabla{CONTROLADOR}").DataTable().ajax.reload();
                $("#modalEditar{CONTROLADOR}").modal('hide');
            }
        }
    })	
};