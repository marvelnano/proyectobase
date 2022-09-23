/*=============================================
CARGAR LA TABLA DINÁMICA DE WEB ÁREA PORTFOLIO	
=============================================*/
$(".tablaWebAreaPortfolio").DataTable({
	 "ajax": "ajax/tablaWebAreaPortfolio.ajax.php",
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
ACTIVAR WEB ÁREA PORTFOLIO
=============================================*/
$('.tablaWebAreaPortfolio tbody').on("click", ".btnActivar", function(){
	var idWebAreaPortfolio = $(this).attr("idWebAreaPortfolio");
	var estadoWebAreaPortfolio = $(this).attr("estadoWebAreaPortfolio");

	var datos = new FormData();
 	datos.append("activarId", idWebAreaPortfolio);
  	datos.append("activarWebAreaPortfolio", estadoWebAreaPortfolio);

  	$.ajax({
	  url:"ajax/webareaportfolio.ajax.php",
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

	if(estadoWebAreaPortfolio == 0){
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoWebAreaPortfolio',1);
  	}else{
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoWebAreaPortfolio',0);
  	}
});

/*=============================================
REVISAR SI LA WEB ÁREA PORTFOLIO YA EXISTE
=============================================*/

function validarWebAreaPortfolio(miwebareaportfolio){
	$(".alert").remove();

	var webareaportfolio = miwebareaportfolio;
	var resultado = 0;

	var datos = new FormData();
	datos.append("validarwebareaportfolio", webareaportfolio);

	$.ajax({
	    url:"ajax/webareaportfolio.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
    		if(respuesta.length != 0){
    			$(".validarwebareaportfolio").after('<div class="alert alert-warning">Esta área de portfolio web ya existe en la base de datos</div>');
				$(".validarwebareaportfolio").val("");
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
GUARDAR WEB ÁREA PORTFOLIO
=============================================*/
$(".guardarWebAreaPortfolio").click(function(){
	//validarWebAreaPortfolio($(".descripcion").val());
	
	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	//alert("llegó a guardar");
	if($(".descripcion").val() != "" ){
		agregarMiWebAreaPortfolio();
	}else{
		toastr.error("Llenar todos los campos obligatorios");
		return;
	}
});

function agregarMiWebAreaPortfolio(){
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DEL WEB ÁREA PORTFOLIO
	=============================================*/
	var descripcion = $(".descripcion").val().toUpperCase();//.toUpperCase()

	var datosWebAreaPortfolio = new FormData();
	datosWebAreaPortfolio.append("descripcion", descripcion);

	$.ajax({
		url:"ajax/webareaportfolio.ajax.php",
		method: "POST",
		data: datosWebAreaPortfolio,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			if(respuesta == "ok"){					
				toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
				$(".tablaWebAreaPortfolio").DataTable().ajax.reload();
				$("#modalAgregarWebAreaPortfolio").modal('hide');
			}				
		}
	})	
};

/*=============================================
EDITAR WEB ÁREA PORTFOLIO
=============================================*/
$('.tablaWebAreaPortfolio tbody').on("click", ".btnEditarWebAreaPortfolio", function(){	
	var idWebAreaPortfolio = $(this).attr("idWebAreaPortfolio");
	//alert("llego a editar: "+idWebAreaPortfolio);
	var datos = new FormData();
	datos.append("idWebAreaPortfolioEdit", idWebAreaPortfolio);
	
	$.ajax({
		url:"ajax/webareaportfolio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		beforeSend: function () {
			//alert("dentro de editar: "+datos["idWebAreaPortfolio"]);
		},
		success: function(respuesta){			
			/* console.log("respuesta", respuesta); */
			$("#modalEditarWebAreaPortfolio .idWebAreaPortfolio").val(respuesta[0]["idplantillawebareaportfolio"]);
			$("#modalEditarWebAreaPortfolio .descripcion").val(respuesta[0]["descripcion"]);
			
			/*=============================================
			GUARDAR CAMBIOS DEL WEB ÁREA PORTFOLIO
			=============================================*/	
			$(".guardarCambiosWebAreaPortfolio").click(function(){
				//validarWebAreaPortfolio($("#modalEditarWebAreaPortfolio .descripcion").val());

				//alert("llego a editar todo: "+$("#modalEditarWebAreaPortfolio .idWebAreaPortfolio").val());
				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/
				if($("#modalEditarWebAreaPortfolio .descripcion").val() != "" ){
					editarMiWebAreaPortfolio();	
				}else{
					toastr.error("Llenar todos los campos obligatorios");
					return;
				}
			})					
		}
	})
});

function editarMiWebAreaPortfolio(){
	//alert("editarararara: "+$("#modalEditarWebAreaPortfolio .idWebAreaPortfolio").val());
	var idwebareaportfolio = $("#modalEditarWebAreaPortfolio .idWebAreaPortfolio").val();
	var descripcionwebareaportfolio = $("#modalEditarWebAreaPortfolio .descripcion").val().toUpperCase();//.toUpperCase()

	var datoswebareaportfolioEd = new FormData();
	datoswebareaportfolioEd.append("idWebAreaPortfolioEd", idwebareaportfolio);
	datoswebareaportfolioEd.append("descripcionWebAreaPortfolioEd", descripcionwebareaportfolio);

	$.ajax({
		url:"ajax/webareaportfolio.ajax.php",
		method: "POST",
		data: datoswebareaportfolioEd,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){	
			if(respuesta == "ok"){
				toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
				$(".tablaWebAreaPortfolio").DataTable().ajax.reload();
				$("#modalEditarWebAreaPortfolio").modal('hide');
			}
		}
	})	
};