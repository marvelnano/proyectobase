/*=============================================
SUBIR CERTIFICADO
=============================================*/

$("#subirCertificado").change(function(){

	var archivo = $("#subirCertificado").val();
	var certificadodigital = this.files[0];
	//alert("archivo "+archivo)
	var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
	//alert("extensión: "+extension);

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(extension != ".p12" && extension != ".pfx"){

  		$("#subirCertificado").val("");

  		swal({
		      title: "Error al subir el archivo",
		      text: "¡El archivo debe estar en formato P12 o PFX!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		});

  	/*=============================================
  	VALIDAMOS EL TAMAÑO DE LA IMAGEN
  	=============================================*/

  	}else if(certificadodigital["size"] > 2000000){

  		$("#subirCertificado").val("");

  		swal({
			title: "Error al subir el archivo",
			text: "¡El archivo no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else{
	  
		/*=============================================
		GUARDAR EL CERTIFICADO
		=============================================*/

		//alert("click en guardar: "+certificadodigital['name']);

		var datos = new FormData();
		datos.append("archivo", certificadodigital);

		$.ajax({

		  url:"ajax/design.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  success: function(respuesta){

			  if(respuesta == "ok"){

				  swal({
					title: "Cambios guardados",
					text: "¡El archivo ha sido subido correctamente!",
					type: "success",
					confirmButtonText: "¡Cerrar!"
				  });
		  
			  }

			  
		  }

	  })

	}

})

/*=============================================
SUBIR LOGOTIPO
=============================================*/

$("#subirLogo").change(function(){

	var imagenLogo = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenLogo["type"] != "image/jpeg" && imagenLogo["type"] != "image/png"){

  		$("#subirLogo").val("");

  		Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	/*=============================================
  	VALIDAMOS EL TAMAÑO DE LA IMAGEN
  	=============================================*/

  	}else if(imagenLogo["size"] > 2000000){

  		$("#subirLogo").val("");

		  Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	/*=============================================
  	PREVISUALIZAMOS LA IMAGEN
  	=============================================*/

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenLogo);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarLogo").attr("src", rutaImagen);

  		})

  	}

  	/*=============================================
  	GUARDAR EL LOGOTIPO
  	=============================================*/

  	$("#guardarLogo").click(function(){
		//alert("holaa: "+imagenLogo["name"]);
  		var datos = new FormData();
  		datos.append("imagenLogo", imagenLogo);

  		$.ajax({

			url:"ajax/design.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){

				if(respuesta == "ok"){

					Swal.fire({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      icon: "success",
					  confirmButtonText: "¡Cerrar!"
						}).then(function(result){
						if (result.value) {

						window.location = "design";

						}

				    });
			
				}

				
			}

		})


  	})

})

/*=============================================
SUBIR ICONO
=============================================*/

$("#subirIcono").change(function(){

	var imagenIcono = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenIcono["type"] != "image/jpeg" && imagenIcono["type"] != "image/png"){

  		$("#subirIcono").val("");

		  Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	/*=============================================
  	VALIDAMOS EL TAMAÑO DE LA IMAGEN
  	=============================================*/

  	}else if(imagenIcono["size"] > 2000000){

  		$("#subirIcono").val("");

		  Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

	/*=============================================
  	PREVISUALIZAMOS LA IMAGEN
  	=============================================*/

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenIcono);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarIcono").attr("src", rutaImagen);

  		})

  	}

  	/*=============================================
  	GUARDAR EL ICONO
  	=============================================*/

  	$("#guardarIcono").click(function(){

		var datos = new FormData();
		datos.append("imagenIcono", imagenIcono);

		$.ajax({

			url:"ajax/design.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				
				if(respuesta == "ok"){

					Swal.fire({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      icon: "success",
					  confirmButtonText: "¡Cerrar!"
						}).then(function(result){
						if (result.value) {

						window.location = "design";

						}

				    });
			
				}
		
			}

		});

	})

})

/*=============================================
SUBIR PORTADA DE CATEGORIA
=============================================*/

$("#subirPortadaCat").change(function(){

	var imagenPortadaCat = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenPortadaCat["type"] != "image/jpeg" && imagenPortadaCat["type"] != "image/png"){

  		$("#subirPortadaCat").val("");

  		swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	/*=============================================
  	VALIDAMOS EL TAMAÑO DE LA IMAGEN
  	=============================================*/

  	}else if(imagenPortadaCat["size"] > 2000000){

  		$("#subirPortadaCat").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	/*=============================================
  	PREVISUALIZAMOS LA IMAGEN
  	=============================================*/

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenPortadaCat);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarportcat").attr("src", rutaImagen);

  		})

  	}

  	/*=============================================
  	GUARDAR LA PORTADA DE CATEGORIA
  	=============================================*/

  	$("#guardarPortadaCat").click(function(){

  		var datos = new FormData();
  		datos.append("imagenPortadaCat", imagenPortadaCat);

  		$.ajax({

			url:"ajax/comercio.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){

				if(respuesta == "ok"){

					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
			
				}

				
			}

		})


  	})

})

/*=============================================
CAMBIAR COLOR
=============================================*/

$(".cambioColor").change(function(){

	var barraSuperior = $("#barraSuperior").val();

	var textoSuperior = $("#textoSuperior").val();

	var colorFondo = $("#colorFondo").val();

	var colorTexto = $("#colorTexto").val();

	$("#guardarColores").click(function(){

		var datos = new FormData();
		datos.append("barraSuperior", barraSuperior);
		datos.append("textoSuperior", textoSuperior);
		datos.append("colorFondo", colorFondo);
		datos.append("colorTexto", colorTexto);


		$.ajax({

			url:"ajax/comercio.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				console.log("respuesta", respuesta);
				
				if(respuesta == "ok"){

					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
			
				}


			}

		})

	})

})

/*=============================================
CAMBIAR COLOR REDES SOCIALES
=============================================*/

var checkBox = $(".seleccionarRed");

$("input[name='colorRedSocial']").on("ifChecked", function(){

	var color = $(this).val();
	var colorRed = null;

	var iconos = $(".redSocial");
	var redes = ["facebook", "youtube","twitter","google-plus","instagram"];
	
	if(color == "color"){

		colorRed = "Color";

	}else if(color == "blanco"){

		colorRed = "Blanco";

	}else{

		colorRed = "Negro";

	}

	for(var i = 0; i < iconos.length; i++){

		$(iconos[i]).attr("class","fa fa-"+redes[i]+" "+redes[i]+colorRed+" redSocial");
		$(checkBox[i]).attr("estilo", redes[i]+colorRed);

	}

	crearDatosJsonRedes();

})

/*=============================================
CAMBIAR URL REDES SOCIALES
=============================================*/
$(".cambiarUrlRed").change(function(){

	var cambiarUrlRed = $(".cambiarUrlRed");

	for(var i = 0; i < cambiarUrlRed.length; i++){

		$(checkBox[i]).attr("ruta", $(cambiarUrlRed[i]).val());

	}

	crearDatosJsonRedes();

})

/*=============================================
QUITAR RED SOCIAL
=============================================*/
$(".seleccionarRed").on("ifUnchecked",function(){

	$(this).attr("validarRed","");

	crearDatosJsonRedes();

})


/*=============================================
AGREGAR RED SOCIAL
=============================================*/

$(".seleccionarRed").on("ifChecked",function(){

	$(this).attr("validarRed", $(this).attr("red"));

	crearDatosJsonRedes();

})

/*=============================================
CREAR DATOS JSON PARA ALMACENAR EN BD
=============================================*/


function crearDatosJsonRedes(){

	var redesSociales = [];

	for(var i = 0; i < checkBox.length; i++){

		if($(checkBox[i]).attr("validarRed") != ""){

			redesSociales.push({"red": $(checkBox[i]).attr("red"),
								"estilo": $(checkBox[i]).attr("estilo"),
								"url": $(checkBox[i]).attr("ruta"),
								"activo": 1})


		}else{

			redesSociales.push({"red": $(checkBox[i]).attr("red"),
								"estilo": $(checkBox[i]).attr("estilo"),
								"url": $(checkBox[i]).attr("ruta"),
								"activo": 0})

		}

		$("#valorRedesSociales").val(JSON.stringify(redesSociales));

	}

}

/*=============================================
GUARDAR REDES SOCIALES
=============================================*/

$("#guardarRedesSociales").click(function(){

	var valorRedesSociales = $("#valorRedesSociales").val();

	var datos = new FormData();
	datos.append("redesSociales", valorRedesSociales);

	$.ajax({

		url:"ajax/comercio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

			if(respuesta == "ok"){

				swal({
			      title: "Cambios guardados",
			      text: "¡La plantilla ha sido actualizada correctamente!",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    });
		
			}

		}

	})

})

/*=============================================
CAMBIAR CÓDIGOS
=============================================*/

$(".cambioScript").change(function(){

	var apiFacebook = $("#apiFacebook").val();

	var pixelFacebook = $("#pixelFacebook").val();

	var googleAnalytics = $("#googleAnalytics").val();


	$("#guardarScript").click(function(){


		var datos = new FormData();
		datos.append("apiFacebook", apiFacebook);
		datos.append("pixelFacebook", pixelFacebook);
		datos.append("googleAnalytics", googleAnalytics);

		$.ajax({

			url:"ajax/comercio.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				
				if(respuesta == "ok"){

					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
			
				}
				
			}

		})

	})

})

/*=============================================
SELECCIONAR PAIS
=============================================*/

$.ajax({
	url:"vistas/js/countries.json",
	type: "GET",
	cache: false,
	contentType: false,
	processData:false,
	dataType:"json",
	success: function(respuesta){

		respuesta.forEach(seleccionarPais);

		function seleccionarPais(item, index){

			var pais = item.name;
			var codPais = item.code;

			if($("#codigoPais").val() == codPais){

				$("#paisSeleccionado").attr("value",codPais);
				$("#paisSeleccionado").html(pais);

			}

			$("#seleccionarPais").append('<option value="'+codPais+'">'+pais+'</option>');

		}

	}

})

/*=============================================
CAMBIAR INFORMACIÓN
=============================================*/

var impuesto = $("#impuesto").val();
var envioNacional = $("#envioNacional").val();
var envioInternacional = $("#envioInternacional").val();
var tasaMinimaNal = $("#tasaMinimaNal").val();
var tasaMinimaInt = $("#tasaMinimaInt").val();
var seleccionarPais = $("#codigoPais").val();
var clienteIdPaypal = $("#clienteIdPaypal").val();
var llaveSecretaPaypal = $("#llaveSecretaPaypal").val();
var merchantIdPayu = $("#merchantIdPayu").val();
var accountIdPayu = $("#accountIdPayu").val();
var apiKeyPayu = $("#apiKeyPayu").val();

var usuariosol = $("#usuariosol").val();
var clavesol = $("#clavesol").val();
var passwordcertificado = $("#passwordcertificado").val();

var seleccionarBoleta = $(".seleccionarBoleta").val();
var seleccionarFactura = $(".seleccionarFactura").val();

/*=============================================
CAMBIAR MODO FACTURACIÓN ELECTRÓNICA
=============================================*/
$("input[name='modoFacturacion']").on("ifChecked",function(){

	var modoFacturacion = $(this).val();
	var modoPaypal = $("input[name='modoPaypal']:checked").val();
	var modoPayu = $("input[name='modoPayu']:checked").val();

	$("#guardarInformacion").click(function(){

		cambiarInformacion(modoPaypal, modoPayu, modoFacturacion);

	});

})

/*=============================================
CAMBIAR MODO PAYPAL
=============================================*/
$("input[name='modoPaypal']").on("ifChecked",function(){

	var modoPaypal = $(this).val();
	var modoFacturacion = $("input[name='modoFacturacion']:checked").val();
	var modoPayu = $("input[name='modoPayu']:checked").val();

	$("#guardarInformacion").click(function(){

		cambiarInformacion(modoPaypal, modoPayu, modoFacturacion);

	});

})


/*=============================================
CAMBIAR MODO PAYU
=============================================*/

$("input[name='modoPayu']").on("ifChecked",function(){

	var modoPayu = $(this).val();
	var modoFacturacion = $("input[name='modoFacturacion']:checked").val();
	var modoPaypal = $("input[name='modoPaypal']:checked").val();

	$("#guardarInformacion").click(function(){

		cambiarInformacion(modoPaypal, modoPayu, modoFacturacion);

	});

})


/*=============================================
GUARDAR LA INFORMACION
=============================================*/

$(".cambioInformacion").change(function(){

	impuesto = $("#impuesto").val();

	envioNacional = $("#envioNacional").val();

	envioInternacional = $("#envioInternacional").val();

	tasaMinimaNal = $("#tasaMinimaNal").val();

	tasaMinimaInt = $("#tasaMinimaInt").val();

	seleccionarPais = $("#seleccionarPais").val();

	modoFacturacion = $("input[name='modoFacturacion']:checked").val();

	modoPaypal = $("input[name='modoPaypal']:checked").val();

	clienteIdPaypal = $("#clienteIdPaypal").val();

	llaveSecretaPaypal = $("#llaveSecretaPaypal").val();

	modoPayu = $("input[name='modoPayu']:checked").val();

	merchantIdPayu = $("#merchantIdPayu").val();

	accountIdPayu = $("#accountIdPayu").val();

	apiKeyPayu = $("#apiKeyPayu").val();

	seleccionarBoleta = $(".seleccionarBoleta").val();

	seleccionarFactura = $(".seleccionarFactura").val();

	usuariosol = $("#usuariosol").val();

	clavesol = $("#clavesol").val();

	passwordcertificado = $("#passwordcertificado").val();

	$("#guardarInformacion").click(function(){

		//alert("idBoleta: "+seleccionarBoleta+", Boleta:"+$(".seleccionarBoleta option:selected").text());
		//alert("idFactura: "+seleccionarFactura+", Factura:"+$(".seleccionarFactura option:selected").text());

		cambiarInformacion(modoPaypal, modoPayu, modoFacturacion);
	
	})	

})

/*=============================================
// FUNCIÓN PARA CAMBIAR LA INFORMACIÓN
=============================================*/

function cambiarInformacion(modoPaypal, modoPayu, modoFacturacion){
	//alert("modoFacturacion: "+modoFacturacion);
	var datos = new FormData();
	datos.append("impuesto", impuesto);
	datos.append("envioNacional", envioNacional);
	datos.append("envioInternacional", envioInternacional);
	datos.append("tasaMinimaNal", tasaMinimaNal);
	datos.append("tasaMinimaInt", tasaMinimaInt);
	datos.append("seleccionarPais", seleccionarPais);
	datos.append("modoFacturacion", modoFacturacion);	
	datos.append("modoPaypal", modoPaypal);	
	datos.append("clienteIdPaypal", clienteIdPaypal);
	datos.append("llaveSecretaPaypal", llaveSecretaPaypal);
	datos.append("modoPayu", modoPayu);	
	datos.append("merchantIdPayu", merchantIdPayu);
	datos.append("accountIdPayu", accountIdPayu);
	datos.append("apiKeyPayu", apiKeyPayu);

	datos.append("usuariosol", usuariosol);
	datos.append("clavesol", clavesol);
	datos.append("passwordcertificado", passwordcertificado);

	datos.append("seleccionarBoleta", seleccionarBoleta);
	datos.append("seleccionarFactura", seleccionarFactura);

	$.ajax({

		url:"ajax/comercio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
			if(respuesta == "ok"){

				swal({
			      title: "Cambios guardados",
			      text: "¡El comercio ha sido actualizado correctamente!",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    });
			
			}
							
		}

	})

}


