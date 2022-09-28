/*=============================================
CARGAR LA TABLA DINÁMICA DE NEGOCIO	
=============================================*/
$(".tablaNegocio").DataTable({
	 "ajax": "ajax/tablaNegocio.ajax.php",
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
ACTIVAR NEGOCIO
=============================================*/
$('.tablaNegocio tbody').on("click", ".btnActivar", function(){
	var idNegocio = $(this).attr("idNegocio");
	var estadoNegocio = $(this).attr("estadoNegocio");

	var datos = new FormData();
 	datos.append("activarId", idNegocio);
  	datos.append("activarNegocio", estadoNegocio);

  	$.ajax({
		url:"ajax/negocio.ajax.php",
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

	if(estadoNegocio == 0){
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoNegocio',1);
  	}else{
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoNegocio',0);
  	}
});

/*=============================================
REVISAR SI EL NEGOCIO YA EXISTE
=============================================*/
$(".validarrazonsocial").change(function(){
	//alert("valida razon social");
	$(".alert").remove();

	var razon_social = $(this).val();

	var datos = new FormData();
	datos.append("validarrazon_social", razon_social);

	$.ajax({
	    url:"ajax/negocio.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
    		if(respuesta.length != 0){				
    			$(".validarrazonsocial").after('<div class="alert alert-warning">Este título ya existe en la base de datos</div>');
	    		$(".validarrazonsocial").val("");
    		}
	    }
   	})
});

/*=============================================
GUARDAR NEGOCIO
=============================================*/
$(".guardarNegocio").click(function(){	
	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	//alert("llegó a guardar");
	if( $(".seleccionarRubro").val() != "" &&
		$(".ruc").val() != "" &&
		$(".razon_social").val() != "" ){
		agregarMiNegocio();
	}else{
		toastr.error("Llenar todos los campos obligatorios");
		return;
	}
});

function agregarMiNegocio(){
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DEL NEGOCIO
	=============================================*/
	var rubronegocio = $(".seleccionarRubro").val();
	var ruc = $(".ruc").val();
	var razon_social = $(".razon_social").val().toUpperCase();
	var direccion = $(".direccion").val();
	var celular = $(".celular").val();
	var email = $(".email").val();
	var pagina_web = $(".pagina_web").val();

	var datosNegocio = new FormData();
	datosNegocio.append("idrubronegocio", rubronegocio);
	datosNegocio.append("ruc", ruc);
	datosNegocio.append("razon_social", razon_social);
	datosNegocio.append("direccion", direccion);
	datosNegocio.append("celular", celular);
	datosNegocio.append("email", email);
	datosNegocio.append("pagina_web", pagina_web);

	$.ajax({
		url:"ajax/negocio.ajax.php",
		method: "POST",
		data: datosNegocio,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			if(respuesta == "ok"){					
				toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
				$(".tablaNegocio").DataTable().ajax.reload();
				$("#modalAgregarNegocio").modal('hide');
			}				
		}
	})	
};

/*=============================================
EDITAR NEGOCIO
=============================================*/
$('.tablaNegocio tbody').on("click", ".btnEditarNegocio", function(){	
	var idNegocio = $(this).attr("idNegocio");
	//alert("llego a editar: "+idNegocio);
	var datos = new FormData();
	datos.append("idNegocioEdit", idNegocio);
	
	$.ajax({
		url:"ajax/negocio.ajax.php",
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
			$("#modalEditarNegocio .idNegocio").val(respuesta[0]["idnegocio"]);
			$("#modalEditarNegocio .seleccionarRubro").val(respuesta[0]["idrubronegocio"]);
			$("#modalEditarNegocio .ruc").val(respuesta[0]["ruc"]);
			$("#modalEditarNegocio .razon_social").val(respuesta[0]["razon_social"]);
			$("#modalEditarNegocio .direccion").val(respuesta[0]["direccion"]);
			$("#modalEditarNegocio .celular").val(respuesta[0]["celular"]);
			$("#modalEditarNegocio .email").val(respuesta[0]["email"]);
			$("#modalEditarNegocio .pagina_web").val(respuesta[0]["pagina_web"]);
			
			/*=============================================
			GUARDAR CAMBIOS DEL NEGOCIO
			=============================================*/	
			$(".guardarCambiosNegocio").click(function(){
				//validarNivel($("#modalEditarNivel .descripcion").val());
				//alert("llego a editar todo: "+$("#modalEditarNivel .idNivel").val());
				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/
				if( $("#modalEditarNegocio .seleccionarRubro").val() != "" &&
					$("#modalEditarNegocio .ruc").val() != "" &&
					$("#modalEditarNegocio .razon_social").val() != ""){
					editarMiNegocio();	
				}else{
					toastr.error("Llenar todos los campos obligatorios");
					return;
				}			
			})
		}
	})
});

function editarMiNegocio(){
	//alert("editarararara: "+$("#modalEditarNivel .idNivel").val());
	var idnegocio = $("#modalEditarNegocio .idNegocio").val();
	var rubronegocio = $("#modalEditarNegocio .seleccionarRubro").val();
	var rucnegocio = $("#modalEditarNegocio .ruc").val();
	var razon_socialnegocio = $("#modalEditarNegocio .razon_social").val().toUpperCase();
	var direccion = $("#modalEditarNegocio .direccion").val();
	var celular = $("#modalEditarNegocio .celular").val();
	var email = $("#modalEditarNegocio .email").val();
	var pagina_web = $("#modalEditarNegocio .pagina_web").val();

	var datosnegocioEd = new FormData();
	datosnegocioEd.append("idNegocioEd", idnegocio);
	datosnegocioEd.append("idrubronegocioEd", rubronegocio);
	datosnegocioEd.append("rucEd", rucnegocio);
	datosnegocioEd.append("razon_socialEd", razon_socialnegocio);
	datosnegocioEd.append("direccionEd", direccion);
	datosnegocioEd.append("celularEd", celular);
	datosnegocioEd.append("emailEd", email);
	datosnegocioEd.append("pagina_webEd", pagina_web);

	$.ajax({
		url:"ajax/negocio.ajax.php",
		method: "POST",
		data: datosnegocioEd,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
				$(".tablaNegocio").DataTable().ajax.reload();
				$("#modalEditarNegocio").modal('hide');
			}
		}
	})	
};

/*=============================================
VER NEGOCIO
=============================================*/
$('.tablaNegocios tbody').on("click", ".btnVerNegocio", function(){
	var idNegocioWeb = $(this).attr("idNegocioWeb");
	//alert("llego a editar: "+idNegocioWeb);
	var datos = new FormData();
	datos.append("idVerNegocio", idNegocioWeb);
	
	$.ajax({
		url:"ajax/negocio.ajax.php",
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
			$("#modalVerNegocio .seccion").html("");
			$("#modalVerNegocio .contenido").html("");
			$("#modalVerNegocio .btnSubir").html("");

			var opc='';			
			$.each(respuesta, function(key, index){	
				opc += '<li class="nav-item">';
				opc += "<a class='nav-link' href='#"+index["seccion"].toLowerCase()+"'>"+index["seccion"]+"</a>"; //"+index["seccion"].toLowerCase()+"
				opc += '</li>';
			});
			var menu = '<nav class="navbar navbar-expand-sm bg-dark navbar-dark"><ul class="navbar-nav">';
			opc += '<li class="nav-item">';
			opc += '<a class="nav-link" href="#" data-dismiss="modal">CERRAR</a>';// style="padding-left:650px;"
			opc += '</li>';			
			menu += opc+'</ul></nav>';	
			$("#modalVerNegocio .seccion").append(menu);

			var content='';
			$.each(respuesta, function(key, index){
				//$("#modalVerNegocio .contenido").append("<div>"+index["contenido"]+"</div>");	
				content += "<section id='"+index["seccion"].toLowerCase()+"'>";
				content += "<div>"+index["contenido"]+"</div>";
				content += '</section>';
			});
			$("#modalVerNegocio .contenido").append(content);	 
			$("#modalVerNegocio .btnSubir").append('<a href="#tittle" class="back-to-top-modal"><i class="fa fa-chevron-up"></i></a>');	
			//$("#modalVerNegocio .btnSubir").append('holaaa');
		}
	})
});

/*=============================================
WHATSAPP
=============================================*/
let buttonWhatsapp =  document.getElementById('button-whatsapp');
buttonWhatsapp.addEventListener("click", function(){			
	let popupchat = document.getElementById('container-interior-w');
	let msginicial = document.getElementById('msg-inicial-w');
	let fa = document.getElementById('fa-whatsapp');
	let link = document.getElementsByClassName('popup-link-p')
	let active = popupchat.classList.contains('active-popup-whatsapp-p');
	//alert(active)
	if (active) {
		popupchat.classList.remove('active-popup-whatsapp-p');
		msginicial.classList.add('active-popup-whatsapp-msg-p');
		buttonWhatsapp.classList.remove('active-button-whatsapp-p');
		fa.classList.remove('fa-times');
		fa.classList.add('fa-whatsapp');
	}else {
		popupchat.classList.add('active-popup-whatsapp-p');
		msginicial.classList.remove('active-popup-whatsapp-msg-p');
		buttonWhatsapp.classList.add('active-button-whatsapp-p');
		fa.classList.remove('fa-whatsapp');
		fa.classList.add('fa-times');				
	}
});

/*=============================================
VER CÓDIGO GENERADO
=============================================*/
$('.tablaNegocios tbody').on("click", ".btnVerCodigo", function(){
	var idNegWeb = $(this).attr("idNegWeb");
	//var code = "<div>"+idNegWeb+"</div>";
	//$("#modalVerCodigo .codigo").append(code);	
	alert("llego a ver código: "+idNegWeb);
	/*var datos = new FormData();
	datos.append("idVerNegocio", idNegWeb);
	
	$.ajax({
		url:"ajax/negocio.ajax.php",
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
			// console.log("respuesta", respuesta);
			$("#modalVerNegocio .codigo").html("");

			var codigo='';
			$.each(respuesta, function(key, index){
				//$("#modalVerNegocio .contenido").append("<div>"+index["codigo"]+"</div>");
				codigo += "<div>"+index["contenido"]+"</div>";
			});
			$("#modalVerNegocio .codigo").append(codigo);	 
			//$("#modalVerNegocio .btnSubir").append('holaaa');
		}
	})*/
});