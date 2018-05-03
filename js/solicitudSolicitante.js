$(document).ready(function(){

	$('#confirmacion').hide();
	
	var solicitudId =  $("#solicitudId").val();

	// recuperaPeriodo será nuestra función recuperar los perido con solicitudes    
	var recuperaSolicitud = function() {
		return $.getJSON("../dao/select/sSolicitudPlantilla.php", {
			solicitudId: solicitudId
		});
	}
	
	var recuperaComunicaciones = function() {
		return $.getJSON("../dao/select/sSolicitudPlantilla.php", {
			solicitudId: solicitudId
		});
	}

	var cierraParte = function() {
		return $.getJSON("../dao/update/uSolicitudSolicitante.php", {
			destino: destino, 
			cuerpo: cuerpo,
			solicitudId: solicitudId,
			operacion: "cierre"
		});
	}

	var enviaParte = function(destino,cuerpo) {
		return $.getJSON("../dao/update/uSolicitudSolicitante.php", {
			destino: destino, 
			cuerpo: cuerpo,
			solicitudId: solicitudId,
			operacion: "actualiza"
		});
	}

	var aprobarParte = function() {
		return $.getJSON("../dao/update/uSolicitudSolicitante.php", {
			destino: destino, 
			cuerpo: cuerpo,
			solicitudId: solicitudId,
			operacion: "aprobar"
		});
	}

	var rechazarParte = function() {
		return $.getJSON("../dao/update/uSolicitudSolicitante.php", {
			destino: destino, 
			cuerpo: cuerpo,
			solicitudId: solicitudId,
			operacion: "rechazar"
		});
	}
	
	var recuperaDepartamento = function() {
		return $.getJSON("../dao/select/sDepartamento.php", {
			usuario:sessionStorage.getItem("idUsuarioSession"),
			solicitud:solicitudId
		});
	}
	
	/*Cargamos el combo de departamentos*/
	recuperaDepartamento().done(function(response) {
		
		if (!response.success) {

			alert("Problema con el JSON");

		}else{
			
			var array = $.map(response.data, function(value, index) {
				return [value];
	
			});
			
			if (array.length==0){
				
				alert("no hay datos de departamentos");
			
			}else{
			
				for(var x=0; x<array.length;x++){

					$('#departamento').append($("<option></option>").attr("value",array[x].departamento_id).text(array[x].visualizacion)); 
				
				}
			}
		}

	})
	//Error en la consulta o comunicacion con la bbdd.
	.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Algo ha fallado: " + textStatus + "-->" + jqXHR.responseText);
	});
	
	/*Cargamos los datos de la solicitud*/
	recuperaSolicitud(solicitudId).done(function(response) {
		if (!response.success) {

			alert("Problema con el JSON");

		}else{

			var array = $.map(response.data, function(value, index) {
				return [value];
			});
			
			var listadoComunicaciones = $.map(response.data.comunicaciones, function(value, index) {
				return [value];
			});

			if (array.length==0){

				alert("No hay datos de la solicitud");

			}else{
				$("#nombre").val(array[2]);
        		$("#apellido").val(array[3]);
        		$("#email").val(array[4]);
    			$("#edificio").val(array[5]);
    			$("#sala").val(array[6]);
    			$("#fecha").val(array[7]);
    			$("#hora_inicio").val(array[8]);
    			$("#hora_fin").val(array[9]);
    			if (response.data.antesEvento == 1)
    				$("#antes").prop('checked', true); 

    			if (response.data.duranteEvento == 1)
    				$("#durante").prop('checked', true);
    			
    			if (response.data.despuesEvento == 1)
    				$("#despues").prop('checked', true);

    			$("#comment").val(array[13]);

    			
    			$("#coste").val(array[15]);
    			
    			$("#empleado").val(array[16]);
    			
    			for(var x=0; x<listadoComunicaciones.length;x++){
    				
    				var newRowContent = "<tr class='trStyle'>" +
											"<td>"+listadoComunicaciones[x].remitente+"</td>" +
											"<td>"+listadoComunicaciones[x].email+"</td>" +
											"<td>"+listadoComunicaciones[x].fecha+"</td>" +
											"<td>"+listadoComunicaciones[x].destinatario+"</td>" +
										"</tr>";
    				
    				$(newRowContent).appendTo($("#listaCorreo"));
    			}
			}
		}
	})
	//Error en la consulta o comunicacion con la bbdd.
	.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Algo ha fallado: " + textStatus + "-->" + jqXHR.responseText);
	});
	
	//Actualiza la solicitud
	 $('#enviar').click(function() {
		 var cuerpo = $("#respuesta").val();
		 var destino = $("#email").val();

		 enviaParte(destino, cuerpo).done(function(response) {
			 if (!response.success) {
					alert("Problema con el JSON");
				}else{
					$('#confirmacion').show();
				}
		 });
	 });
	 
	 $('#aprobar').click(function() {
		 aprobarParte().done(function(response) {
			 if (!response.success) {

					alert("Se ha producido un error. Por Favor, revise los datos.");

				}else{
					$('#confirmacion').show();
					
				}
		 });
	 });

	 
	 //Cierra Solicitud
	 $('#rechazar').click(function() {
		 rechazarParte().done(function(response) {
			 if (!response.success) {

					alert("Se ha producido un error. Por Favor, revise los datos.");

				}else{
					$('#confirmacion').show();
					
				}
		 });
	 });
	 
	 $('#okey').click(function() {
	    	location.href="homeSolicitante.php";
	    });

	$(document).on("click",".logout",function() {
		
		location.href="..";
	});

});