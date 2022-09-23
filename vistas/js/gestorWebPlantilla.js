/*=============================================
CARGAR LA TABLA DINÁMICA DE WEB PLANTILLA	
=============================================*/
$(".tablaWebPlantilla").DataTable({
	 "ajax": "ajax/tablaWebPlantilla.ajax.php",
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
		"sInfoFiltered":   "",
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
ACTIVAR WEB PLANTILLA
=============================================*/
$('.tablaWebPlantilla tbody').on("click", ".btnActivar", function(){
	var idWebPlantilla = $(this).attr("idWebPlantilla");
	var estadoWebPlantilla = $(this).attr("estadoWebPlantilla");

	var datos = new FormData();
 	datos.append("activarId", idWebPlantilla);
  	datos.append("activarWebPlantilla", estadoWebPlantilla);

  	$.ajax({
	  url:"ajax/webplantilla.ajax.php",
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

	if(estadoWebPlantilla == 0){
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoWebPlantilla',1);
  	}else{
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoWebPlantilla',0);
  	}
});

/*=============================================
REVISAR SI LA WEB PLANTILLA YA EXISTE
=============================================*/
$(".validarcontenido").change(function(){
	//alert("valida razon social");
	$(".alert").remove();

	var contenido = $(this).val();

	var datos = new FormData();
	datos.append("validarcontenido", contenido);

	 $.ajax({
	    url:"ajax/webplantilla.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
    		if(respuesta.length != 0){				
    			$(".validarcontenido").after('<div class="alert alert-warning">Este contenido ya existe en la base de datos</div>');
	    		$(".validarcontenido").val("");
    		}
	    }
   	})
});

/*=============================================
GUARDAR WEB PLANTILLA
=============================================*/
$(".guardarWebPlantilla").click(function(){
	var editorDataContenido	= CKEDITOR.instances['ckeditor'].getData();
	postContenido			= editorDataContenido.replace(/&nbsp;/gi,' ');

	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	//alert("llegó a guardar");
	if( $(".seleccionarNegocio").val() != "" &&
		$(".seleccionarSeccionWeb").val() != "" &&
		postContenido != "" ){
		agregarMiWebPlantilla();
	}else{
		toastr.error("Llenar todos los campos obligatorios");
		return;
	}
});

function agregarMiWebPlantilla(){
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DE LA WEB PLANTILLA
	=============================================*/	
	var negocio = $(".seleccionarNegocio").val();
	var seccionweb = $(".seleccionarSeccionWeb").val();
	var contenido = postContenido;

	var datosWebPlantilla = new FormData();
	datosWebPlantilla.append("idnegocio", negocio);
	datosWebPlantilla.append("idseccionweb", seccionweb);
	datosWebPlantilla.append("contenido", contenido);

	$.ajax({
		url:"ajax/webplantilla.ajax.php",
		method: "POST",
		data: datosWebPlantilla,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			if(respuesta == "ok"){					
				toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
				$(".tablaWebPlantilla").DataTable().ajax.reload();
				$("#modalAgregarWebPlantilla").modal('hide');
			}				
		}
	})	
};

/*=============================================
EDITAR WEB PLANTILLA
=============================================*/
function CKupdate(){
	for(instance in CKEDITOR.instance){
		CKEDITOR.instances['ckeditorEd'].updateElement();
	}
};

$('.tablaWebPlantilla tbody').on("click", ".btnEditarWebPlantilla", function(){	
	var idWebPlantilla = $(this).attr("idWebPlantilla");
	//alert("llego a editar: "+idWebPlantilla);

	var datos = new FormData();
	datos.append("idWebPlantillaEdit", idWebPlantilla);
	
	$.ajax({
		url:"ajax/webplantilla.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		beforeSend: function () {
			//alert("dentro de editar: "+datos["idNivel"]);
		},
		success: function(respuesta){			
			/* console.log("respuesta", respuesta); */
			$("#modalEditarWebPlantilla .idWebPlantilla").val(respuesta[0]["idplantillaweb"]);
			$("#modalEditarWebPlantilla .seleccionarNegocio").val(respuesta[0]["idnegocio"]);
			$("#modalEditarWebPlantilla .seleccionarSeccionWeb").val(respuesta[0]["idplantillawebseccion"]);
			$("#modalEditarWebPlantilla #ckeditorEd").text(respuesta[0]["contenido"]);
			CKupdate();
			CKEDITOR.instances['ckeditorEd'].setData(ckeditorEd);
			//contenidoWebEd = CKEDITOR.replace('ckeditorEd',respuesta[0]["contenido"]);
			
			/*=============================================
			GUARDAR CAMBIOS DE LA WEB PLANTILLA
			=============================================*/	

			$(".guardarCambiosWebPlantilla").click(function(){
				var editorDataContenido	= CKEDITOR.instances['ckeditorEd'].getData();
				postContenidoEd			= editorDataContenido.replace(/&nbsp;/gi,' ');
				//validarNivel($("#modalEditarNivel .descripcion").val());

				//alert("llego a editar todo: "+$("#modalEditarNivel .idNivel").val());
				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/
				if( $("#modalEditarWebPlantilla .seleccionarNegocio").val() != "" &&
					$("#modalEditarWebPlantilla .seleccionarSeccionWeb").val() != "" &&
					postContenidoEd != ""){
					editarMiWebPlantilla();	
				}else{
					toastr.error("Llenar todos los campos obligatorios");
					return;
				}				

			})					
		}
	})
});

function editarMiWebPlantilla(){
	//alert("editarararara: "+$("#modalEditarNivel .idNivel").val());
	var idwebplantilla = $("#modalEditarWebPlantilla .idWebPlantilla").val();
	var idnegocio = $("#modalEditarWebPlantilla .seleccionarNegocio").val();
	var idseccionweb = $("#modalEditarWebPlantilla .seleccionarSeccionWeb").val();
	var contenido = postContenidoEd;//$("#modalEditarWebPlantilla .contenido").val();

	var datoswebplantillaEd = new FormData();
	datoswebplantillaEd.append("idwebplantillaEd", idwebplantilla);
	datoswebplantillaEd.append("idnegocioEd", idnegocio);
	datoswebplantillaEd.append("idseccionwebEd", idseccionweb);
	datoswebplantillaEd.append("contenidoEd", contenido);

	$.ajax({
			url:"ajax/webplantilla.ajax.php",
			method: "POST",
			data: datoswebplantillaEd,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){							
				if(respuesta == "ok"){
					toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
					$(".tablaWebPlantilla").DataTable().ajax.reload();
					$("#modalEditarWebPlantilla").modal('hide');
				}
			}
	})	
};