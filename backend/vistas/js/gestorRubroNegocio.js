/*=============================================
CARGAR LA TABLA DINÁMICA DE RUBRO	
=============================================*/
$(".tablaRubroNegocio").DataTable({
	 "ajax": "ajax/tablaRubroNegocio.ajax.php",
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
ACTIVAR RUBRO
=============================================*/
$('.tablaRubroNegocio tbody').on("click", ".btnActivar", function(){
	var idRubro = $(this).attr("idRubro");
	var estadoRubro = $(this).attr("estadoRubro");

	var datos = new FormData();
 	datos.append("activarId", idRubro);
  	datos.append("activarRubro", estadoRubro);

  	$.ajax({
		url:"ajax/rubronegocio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){              
			// console.log("respuesta", respuesta);
		}
  	})
	
	  //alert("estado: "+estadoMarca)

	if(estadoRubro == 0){
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoRubro',1);
  	}else{
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoRubro',0);
  	}
});

/*=============================================
REVISAR SI LA RUBRO YA EXISTE
=============================================*/
function validarRubro(mirubro){
	$(".alert").remove();

	var rubro = mirubro;
	var resultado = 0;

	var datos = new FormData();
	datos.append("validarrubro", rubro);

	$.ajax({
	    url:"ajax/rubronegocio.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
    		if(respuesta.length != 0){
    			$(".validarrubro").after('<div class="alert alert-warning">Este rubro ya existe en la base de datos</div>');
				$(".validarrubro").val("");
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
GUARDAR RUBRO
=============================================*/
$(".guardarRubro").click(function(){
	//validarRubro($(".descripcion").val());	
	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	//alert("llegó a guardar");
	if($(".descripcion").val() != "" ){
		agregarMiRubro();
	}else{
		toastr.error("Llenar todos los campos obligatorios");
		return;
	}
});

function agregarMiRubro(){
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DEL RUBRO
	=============================================*/
	var descripcion = $(".descripcion").val();//.toUpperCase()
	var datosRubro = new FormData();
	datosRubro.append("descripcion", descripcion);

	$.ajax({
		url:"ajax/rubronegocio.ajax.php",
		method: "POST",
		data: datosRubro,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			if(respuesta === "ok"){					
				toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
				$(".tablaRubroNegocio").DataTable().ajax.reload();
				$("#modalAgregarRubro").modal('hide');
			}			
		}
	})	
};

/*=============================================
EDITAR RUBRO
=============================================*/
$('.tablaRubroNegocio tbody').on("click", ".btnEditarRubro", function(){	
	var idRubro = $(this).attr("idRubro");
	//alert("llego a editar: "+idRubro);
	var datos = new FormData();
	datos.append("idRubroEdit", idRubro);
	
	$.ajax({
		url:"ajax/rubronegocio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		beforeSend: function () {
			//alert("dentro de editar: "+datos["idRubro"]);
		},
		success: function(respuesta){			
			/* console.log("respuesta", respuesta); */
			$("#modalEditarRubro .idRubro").val(respuesta[0]["idrubronegocio"]);
			$("#modalEditarRubro .descripcion").val(respuesta[0]["descripcion"]);
			
			/*=============================================
			GUARDAR CAMBIOS DEL RUBRO
			=============================================*/	
			$(".guardarCambiosRubro").click(function(){
				//validarRubro($("#modalEditarRubro .descripcion").val());

				//alert("llego a editar todo: "+$("#modalEditarRubro .idRubro").val());
				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/
				if($("#modalEditarRubro .descripcion").val() != "" ){
					editarMiRubro();	
				}else{
					toastr.error("Llenar todos los campos obligatorios");
					return;
				}
			})
		}
	})
});

function editarMiRubro(){
	//alert("editarararara: "+$("#modalEditarRubro .idRubro").val());
	var idrubro = $("#modalEditarRubro .idRubro").val();
	var descripcionrubro = $("#modalEditarRubro .descripcion").val();//.toUpperCase()

	var datosrubroEd = new FormData();
	datosrubroEd.append("idRubroEd", idrubro);
	datosrubroEd.append("descripcionRubroEd", descripcionrubro);

	$.ajax({
		url:"ajax/rubronegocio.ajax.php",
		method: "POST",
		data: datosrubroEd,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){									
			if(respuesta === "ok"){
				toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
				$(".tablaRubroNegocio").DataTable().ajax.reload();
				$("#modalEditarRubro").modal('hide');
			}
		}
	})	
};