$(document).ready(function() {
    $('.dt-responsive-perfil').DataTable({
        responsive: true
	});
	
	$('.dt-responsive-listanegocios').DataTable({
        responsive: true
	});
	
	// Set the options that I want
    toastr.options = {
		"closeButton": true,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",//"toast-bottom-center",
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
} );

var postContenido;
var postContenidoEd;
//var contenidoWeb = CKEDITOR.replace('ckeditor');
//var contenidoWebEd = CKEDITOR.replace('ckeditorEd');

/*=============================================
CREAR MÓDULO
=============================================*/
$(document).on("click", ".crearModulo", function(){
	crearModulo();
});

$(".modulo").keyup(function(event) {
	if (event.keyCode === 13) {
		crearModulo();
	}
});

function crearModulo(){
	var modulo = $(".modulo").val().toLowerCase();
	
	if(modulo !== ''){
		var datosModulo = new FormData();
		datosModulo.append("modulo", modulo);

		//alert('generar módulo: '+modulo);
		
		$.ajax({
			url:"ajax/crearModulo.ajax.php",
			method: "POST",
			data: datosModulo,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				//console.log("respuesta: ", respuesta);
				if(respuesta === "ok"){					
					toastr.success("Módulo generado correctamente.","Aviso del Sistema:");
					$(".modulo").val('');
				}else if(respuesta === "EXISTE"){					
					toastr.error("Módulo ya existe.","Aviso del Sistema:");
					$(".modulo").val('');
				}			
			}
		})	
	}else{
		toastr.error("debe de escribir un nombre.","Aviso del Sistema:");
	}
};

/*=============================================
CREAR CONTROLADOR
=============================================*/
$(document).on("click", ".crearControlador", function(){
	crearControlador();
});

$(".controlador").keyup(function(event) {
	if (event.keyCode === 13) {
		crearControlador();
	}
});

function crearControlador(){
	var controlador = $(".controlador").val();

	if(controlador !== ''){
		var datosControlador = new FormData();
		datosControlador.append("controlador", controlador);

		//alert('generar controlador: '+controlador);
		
		$.ajax({
			url:"ajax/crearModulo.ajax.php",
			method: "POST",
			data: datosControlador,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				//console.log("respuesta: ", respuesta);
				if(respuesta === "ok"){					
					toastr.success("Controlador generado correctamente.","Aviso del Sistema:");
					$(".controlador").val('');
				}else if(respuesta === "EXISTE"){					
					toastr.error("Controlador ya existe.","Aviso del Sistema:");
					$(".controlador").val('');
				}			
			}
		})	
	}else{
		toastr.error("debe de escribir un nombre.","Aviso del Sistema:");
	}
};

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND	
=============================================*/
/* if(window.matchMedia("(max-width:767px)").matches){	
	$("body").removeClass('sidebar-collapse');
}else{
	$("body").addClass('sidebar-collapse');
} */

/*=============================================
ACTIVAR SIDEBAR
=============================================*/
/* $(document).on("click", ".sidebar-menu li", function(){
	localStorage.setItem("botonera", $(this).children().attr("href"));
})

if(localStorage.getItem("botonera") == null){
	$(".sidebar-menu li").removeClass("active");
	$(".sidebar-menu li a[href='inicio']").parent().addClass("active")	
}else{
	$(".sidebar-menu li").removeClass("active");
	$("a[href='"+localStorage.getItem("botonera")+"']").parent().addClass("active")	
} */