/*=============================================
CARGAR LA TABLA DINÁMICA DE WEB SECCIÓN	
=============================================*/
$(".tablaWebSeccion").DataTable({
	 "ajax": "ajax/tablaWebSeccion.ajax.php",
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
ACTIVAR WEB SECCIÓN
=============================================*/
$('.tablaWebSeccion tbody').on("click", ".btnActivar", function(){
	var idWebSeccion = $(this).attr("idWebSeccion");
	var estadoWebSeccion = $(this).attr("estadoWebSeccion");

	var datos = new FormData();
 	datos.append("activarId", idWebSeccion);
  	datos.append("activarWebSeccion", estadoWebSeccion);

  	$.ajax({
	  url:"ajax/webseccion.ajax.php",
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

	if(estadoWebSeccion == 0){
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoWebSeccion',1);
  	}else{
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoWebSeccion',0);
  	}
});

/*=============================================
REVISAR SI LA WEB SECCIÓN YA EXISTE
=============================================*/
function validarWebSeccion(miwebseccion){
	$(".alert").remove();

	var webseccion = miwebseccion;
	var resultado = 0;

	var datos = new FormData();
	datos.append("validarwebseccion", webseccion);

	$.ajax({
	    url:"ajax/webseccion.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
    		if(respuesta.length != 0){
    			$(".validarwebseccion").after('<div class="alert alert-warning">Esta sección web ya existe en la base de datos</div>');
				$(".validarwebseccion").val("");
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
GUARDAR WEB SECCIÓN
=============================================*/
$(".guardarWebSeccion").click(function(){
	//validarWebSeccion($(".descripcion").val());	
	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	//alert("llegó a guardar");
	if($(".descripcion").val() != "" ){
		agregarMiWebSeccion();
	}else{
		toastr.error("Llenar todos los campos obligatorios");
		return;
	}
});

function agregarMiWebSeccion(){
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DEL WEB SECCIÓN
	=============================================*/
	var descripcion = $(".descripcion").val().toUpperCase();//.toUpperCase()

	var datosWebSeccion = new FormData();
	datosWebSeccion.append("descripcion", descripcion);

	$.ajax({
		url:"ajax/webseccion.ajax.php",
		method: "POST",
		data: datosWebSeccion,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			if(respuesta == "ok"){					
				toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
				$(".tablaWebSeccion").DataTable().ajax.reload();
				$("#modalAgregarWebSeccion").modal('hide');
			}				
		}
	})	
};

/*=============================================
EDITAR WEB SECCIÓN
=============================================*/
$('.tablaWebSeccion tbody').on("click", ".btnEditarWebSeccion", function(){	
	var idWebSeccion = $(this).attr("idWebSeccion");
	//alert("llego a editar: "+idWebSeccion);
	var datos = new FormData();
	datos.append("idWebSeccionEdit", idWebSeccion);
	
	$.ajax({
		url:"ajax/webseccion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		beforeSend: function () {
			//alert("dentro de editar: "+datos["idWebSeccion"]);
		},
		success: function(respuesta){			
			/* console.log("respuesta", respuesta); */
			$("#modalEditarWebSeccion .idWebSeccion").val(respuesta[0]["idplantillawebseccion"]);
			$("#modalEditarWebSeccion .descripcion").val(respuesta[0]["descripcion"]);			
			/*=============================================
			GUARDAR CAMBIOS DEL WEB SECCIÓN
			=============================================*/	
			$(".guardarCambiosWebSeccion").click(function(){
				//validarWebSeccion($("#modalEditarWebSeccion .descripcion").val());

				//alert("llego a editar todo: "+$("#modalEditarWebSeccion .idWebSeccion").val());
				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/
				if($("#modalEditarWebSeccion .descripcion").val() != "" ){
					editarMiWebSeccion();	
				}else{
					toastr.error("Llenar todos los campos obligatorios");
					return;
				}			
			})					
		}
	})
});

function editarMiWebSeccion(){
	//alert("editarararara: "+$("#modalEditarWebSeccion .idWebSeccion").val());
	var idwebseccion = $("#modalEditarWebSeccion .idWebSeccion").val();
	var descripcionwebseccion = $("#modalEditarWebSeccion .descripcion").val().toUpperCase();//.toUpperCase()

	var datoswebseccionEd = new FormData();
	datoswebseccionEd.append("idWebSeccionEd", idwebseccion);
	datoswebseccionEd.append("descripcionWebSeccionEd", descripcionwebseccion);

	$.ajax({
		url:"ajax/webseccion.ajax.php",
		method: "POST",
		data: datoswebseccionEd,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
				$(".tablaWebSeccion").DataTable().ajax.reload();
				$("#modalEditarWebSeccion").modal('hide');
			}
		}
	})	
};