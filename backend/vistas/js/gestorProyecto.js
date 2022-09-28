/*=============================================
CARGAR LA TABLA DINÁMICA DE PROYECTO	
=============================================*/
$(".tablaProyecto").DataTable({
	 "ajax": "ajax/tablaProyecto.ajax.php",
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
GUARDAR PROYECTO
=============================================*/
$(".guardarProyecto").click(function(){	
	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	//alert("llegó a guardar");
	if($(".ruc").val() != "" &&
	   $(".razonsocial").val() != "" &&
	   $(".nombrecomercial").val() != "" && 
	   $(".abreviatura").val() != "" &&
	   $(".email").val() != "" &&
	   $(".telefono").val() != "" &&
	   $(".web").val() != "" &&
	   $(".seleccionarUbigeo").val() != "" &&
	   $(".direccion").val() != "" /* &&
	   $(".firma").val() != "" &&
	   $(".usuariosol").val() != "" && 
	   $(".clavesol").val() != "" */){
		agregarMiProyecto();
	}else{
		toastr.error("Llenar todos los campos obligatorios");
		return;
	}
});

function agregarMiProyecto(){
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DEL PROYECTO
	=============================================*/
	var ruc = $(".ruc").val();
	var razonsocial = $(".razonsocial").val().toUpperCase();
	var nombrecomercial = $(".nombrecomercial").val().toUpperCase();
	var abreviatura = $(".abreviatura").val().toUpperCase();
	var email = $(".email").val().toLowerCase();
	var telefono = $(".telefono").val();
	var web = $(".web").val().toLowerCase();
	var seleccionarUbigeo = $(".seleccionarUbigeo").val();
	var direccion = $(".direccion").val().toUpperCase();
	/* var firma = $(".firma").val();
	var usuariosol = $(".usuariosol").val();
	var clavesol = $(".clavesol").val(); */

	var datosProyecto = new FormData();
	datosProyecto.append("ruc", ruc);
	datosProyecto.append("razonsocial", razonsocial);
	datosProyecto.append("nombrecomercial", nombrecomercial);
	datosProyecto.append("abreviatura", abreviatura);
	datosProyecto.append("email", email);
	datosProyecto.append("telefono", telefono);
	datosProyecto.append("web", web);
	datosProyecto.append("seleccionarUbigeo", seleccionarUbigeo);
	datosProyecto.append("direccion", direccion);
	/* datosProyecto.append("firma", firma);
	datosProyecto.append("usuariosol", usuariosol);
	datosProyecto.append("clavesol", clavesol); */

	$.ajax({
		url:"ajax/proyecto.ajax.php",
		method: "POST",
		data: datosProyecto,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			if(respuesta == "ok"){					
				toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
				$(".tablaProyecto").DataTable().ajax.reload();
				$("#modalAgregarProyecto").modal('hide');
			}				
		}
	})	
};

/*=============================================
EDITAR PROYECTO
=============================================*/
$('.tablaProyecto tbody').on("click", ".btnEditarProyecto", function(){	

	var idProyecto = $(this).attr("idProyecto");
	//alert("llego a editar: "+idProyecto);
	var datos = new FormData();
	datos.append("idProyectoEdit", idProyecto);
	
	$.ajax({
		url:"ajax/proyecto.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		beforeSend: function () {
			//alert("dentro de editar: "+datos["idProyecto"]);
		},
		success: function(respuesta){			
			/* console.log("respuesta", respuesta); */
			$("#modalEditarProyecto .idProyecto").val(respuesta[0]["idproyecto"]);
			$("#modalEditarProyecto .ruc").val(respuesta[0]["ruc"]);
			$("#modalEditarProyecto .razonsocial").val(respuesta[0]["razonsocial"]);
			$("#modalEditarProyecto .nombrecomercial").val(respuesta[0]["nombrecomercial"]);
			$("#modalEditarProyecto .abreviatura").val(respuesta[0]["abreviatura"]);
			$("#modalEditarProyecto .email").val(respuesta[0]["email"]);
			$("#modalEditarProyecto .telefono").val(respuesta[0]["telefono"]);
			$("#modalEditarProyecto .web").val(respuesta[0]["web"]);
			$("#modalEditarProyecto .seleccionarUbigeo").val(respuesta[0]["seleccionarUbigeo"]);
			$("#modalEditarProyecto .direccion").val(respuesta[0]["direccion"]);
			/* $("#modalEditarProyecto .firma").val(respuesta[0]["pass_firma"]);
			$("#modalEditarProyecto .usuariosol").val(respuesta[0]["usuario_sol"]);
			$("#modalEditarProyecto .clavesol").val(respuesta[0]["clave_sol"]); */
			
			/*=============================================
			GUARDAR CAMBIOS DEL proveedor
			=============================================*/	
			$(".guardarCambiosProyecto").click(function(){
				//alert("llego a editar todo: "+$("#modalEditarProyecto .idProyecto").val());
				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/
				if($("#modalEditarProyecto .ruc").val() != "" &&
					$("#modalEditarProyecto .razonsocial").val() != "" &&
					$("#modalEditarProyecto .nombrecomercial").val() != "" &&
					$("#modalEditarProyecto .abreviatura").val() != "" &&
					$("#modalEditarProyecto .email").val() != "" &&
					$("#modalEditarProyecto .telefono").val() != "" &&
					$("#modalEditarProyecto .web").val() != "" &&
					$("#modalEditarProyecto .seleccionarUbigeo").val() != "" &&
					$("#modalEditarProyecto .direccion").val() != "" /* &&
					$("#modalEditarProyecto .firma").val() != "" &&
					$("#modalEditarProyecto .usuariosol").val() != "" &&
					$("#modalEditarProyecto .clavesol").val() != "" */ ){
					editarMiProyecto();	
				}else{
					toastr.error("Llenar todos los campos obligatorios");
					return;
				}
			})					
		}
	})
});

function editarMiProyecto(){
	//alert("editarararara");
	var idproyecto = $("#modalEditarProyecto .idProyecto").val();
	var rucproyecto = $("#modalEditarProyecto .ruc").val();
	var razonsocialproyecto = $("#modalEditarProyecto .razonsocial").val();
	var nombrecomercialproyecto = $("#modalEditarProyecto .nombrecomercial").val();
	var abreviaturaproyecto = $("#modalEditarProyecto .abreviatura").val();
	var emailproyecto = $("#modalEditarProyecto .email").val();
	var telefonoproyecto = $("#modalEditarProyecto .telefono").val();
	var webproyecto = $("#modalEditarProyecto .web").val();
	var seleccionarubigeoproyecto = $("#modalEditarProyecto .seleccionarUbigeo").val();
	var direccionproyecto = $("#modalEditarProyecto .direccion").val();
	/* var firmaproyecto = $("#modalEditarProyecto .firma").val();
	var usuariosolproyecto = $("#modalEditarProyecto .usuariosol").val();
	var clavesolproyecto = $("#modalEditarProyecto .clavesol").val(); */

	var datosproyectoEd = new FormData();
	datosproyectoEd.append("idProyectoEd", idproyecto);
	datosproyectoEd.append("rucProyectoEd", rucproyecto);
	datosproyectoEd.append("razonsocialProyectoEd", razonsocialproyecto);
	datosproyectoEd.append("nombrecomercialProyectoEd", nombrecomercialproyecto);
	datosproyectoEd.append("abreviaturaProyectoEd", abreviaturaproyecto);
	datosproyectoEd.append("emailProyectoEd", emailproyecto);
	datosproyectoEd.append("telefonoProyectoEd", telefonoproyecto);
	datosproyectoEd.append("webProyectoEd", webproyecto);
	datosproyectoEd.append("seleccionarubigeoProyectoEd", seleccionarubigeoproyecto);
	datosproyectoEd.append("direccionProyectoEd", direccionproyecto);
	/* datosproyectoEd.append("firmaProyectoEd", firmaproyecto);
	datosproyectoEd.append("usuariosolProyectoEd", usuariosolproyecto);
	datosproyectoEd.append("clavesolProyectoEd", clavesolproyecto); */

	$.ajax({
		url:"ajax/proyecto.ajax.php",
		method: "POST",
		data: datosproyectoEd,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
				$(".tablaProyecto").DataTable().ajax.reload();
				$("#modalEditarProyecto").modal('hide');
			}
		}
	})	
};