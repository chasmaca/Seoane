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
		return $.getJSON("../dao/update/uSolicitudPlantilla.php", {
			solicitudId: solicitudId,
			operacion: "cierre"
		});
	}

	var enviaParte = function(destino,cuerpo,precio, empleado) {
		return $.getJSON("../dao/update/uSolicitudPlantilla.php", {
			destino: destino, 
			cuerpo: cuerpo,
			solicitudId: solicitudId,
			precio:precio,
			empleado:empleado,
			operacion: "actualiza"
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

					$('#departamento').append($("<option></option>").attr("value",array[x].identificador).text(array[x].visualizacion)); 
				
				}
			}
		}

	})
	//Error en la consulta o comunicacion con la bbdd.
	.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Algo ha fallado: " + textStatus + "-->" + jqXHR.responseText);
	});
	
	/*Cargamos el combo de periodos*/
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
		 var precio = $('#coste').val();
		 var empleado = $('#empleado').val();

		 enviaParte(destino, cuerpo, precio, empleado).done(function(response) {
			 if (!response.success) {
					alert("Problema con el JSON");
				}else{
					$('#confirmacion').show();
				}
		 });
	 });
	 
	 
	 //Cierra Solicitud
	 $('#cerrar').click(function() {
		 cierraParte().done(function(response) {
			 if (!response.success) {
					alert("Se ha producido un error. Por Favor, revise los datos.");

				}else{
					$('#confirmacion').show();
					
				}
		 });
	 });
	 
	 $('#okey').click(function() {
	    	location.href="homePlantilla.php";
	    });
	 
	 $('#empleado').blur(function(){
		 
		 var hInicio = new Date($('#fecha').val() + " " + $('#hora_inicio').val());
		 
		 var hFin = new Date($('#fecha').val() + " " + $('#hora_fin').val());
		 
		//La diferencia se da en milisegundos así que debes dividir entre 1000
		 var horaResta = ((hFin-hInicio)/3600000);

		 var precio = $('#empleado').val()* 15.50 * horaResta;
		 $('#coste').val(precio);
		});


		$(document).on("click",".logout",function() {
			
			location.href="..";
		});
 
});