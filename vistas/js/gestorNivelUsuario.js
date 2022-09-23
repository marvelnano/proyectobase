/*=============================================
CARGAR LA TABLA DINÁMICA DE NIVEL	
=============================================*/

$(".tablaNivelUsuario").DataTable({
	 "ajax": "ajax/tablaNivelUsuario.ajax.php",
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
ACTIVAR NIVEL
=============================================*/
$('.tablaNivelUsuario tbody').on("click", ".btnActivar", function(){
	var idNivel = $(this).attr("idNivel");
	var estadoNivel = $(this).attr("estadoNivel");

	var datos = new FormData();
 	datos.append("activarId", idNivel);
  	datos.append("activarNivel", estadoNivel);

  	$.ajax({
		url:"ajax/nivelusuario.ajax.php",
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

	if(estadoNivel == 0){
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoNivel',1);
  	}else{
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoNivel',0);
  	}
});

/*=============================================
REVISAR SI EL NIVEL YA EXISTE
=============================================*/
function validarNivel(minivel){
	$(".alert").remove();

	var nivel = minivel;
	var resultado = 0;

	var datos = new FormData();
	datos.append("validarnivel", nivel);

	$.ajax({
	    url:"ajax/nivelusuario.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
    		if(respuesta.length != 0){
    			$(".validarnivel").after('<div class="alert alert-warning">Este nivel ya existe en la base de datos</div>');
				$(".validarnivel").val("");
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
GUARDAR NIVEL
=============================================*/
$(".guardarNivel").click(function(){
	//validarNivel($(".descripcion").val());	
	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	//alert("llegó a guardar");
	if($(".descripcion").val() != "" ){
		agregarMiNivel();
	}else{
		toastr.error("Llenar todos los campos obligatorios");
		return;
	}
});

function agregarMiNivel(){
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DEL NIVEL
	=============================================*/
	var descripcion = $(".descripcion").val();//.toUpperCase()
	var datosNivel = new FormData();
	datosNivel.append("descripcion", descripcion);

	$.ajax({
		url:"ajax/nivelusuario.ajax.php",
		method: "POST",
		data: datosNivel,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			if(respuesta == "ok"){					
				toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
				$(".tablaNivelUsuario").DataTable().ajax.reload();
				$("#modalAgregarNivel").modal('hide');
			}				
		}
	})	
};

/*=============================================
EDITAR NIVEL
=============================================*/
$('.tablaNivelUsuario tbody').on("click", ".btnEditarNivel", function(){	
	var idNivel = $(this).attr("idNivel");
	//alert("llego a editar: "+idNivel);
	var datos = new FormData();
	datos.append("idNivelEdit", idNivel);
	
	$.ajax({
		url:"ajax/nivelusuario.ajax.php",
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
			$("#modalEditarNivel .idNivel").val(respuesta[0]["idnivelusuario"]);
			$("#modalEditarNivel .descripcion").val(respuesta[0]["descripcion"]);
			
			/*=============================================
			GUARDAR CAMBIOS DEL NIVEL
			=============================================*/	

			$(".guardarCambiosNivel").click(function(){
				//validarNivel($("#modalEditarNivel .descripcion").val());
				//alert("llego a editar todo: "+$("#modalEditarNivel .idNivel").val());
				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/

				if($("#modalEditarNivel .descripcion").val() != "" ){
					editarMiNivel();	
				}else{
					toastr.error("Llenar todos los campos obligatorios");
					return;
				}				
			})		
		}
	})
});

function editarMiNivel(){
	//alert("editarararara: "+$("#modalEditarNivel .idNivel").val());
	var idnivel = $("#modalEditarNivel .idNivel").val();
	var descripcionnivel = $("#modalEditarNivel .descripcion").val();//.toUpperCase()

	var datosnivelEd = new FormData();
	datosnivelEd.append("idNivelEd", idnivel);
	datosnivelEd.append("descripcionNivelEd", descripcionnivel);

	$.ajax({
		url:"ajax/nivelusuario.ajax.php",
		method: "POST",
		data: datosnivelEd,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){	
			if(respuesta == "ok"){
				toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
				$(".tablaNivelUsuario").DataTable().ajax.reload();
				$("#modalEditarNivel").modal('hide');
			}
		}
	})	
};