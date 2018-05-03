$(document).ready(function(){

	var insercionSolicitud = function(nombre, apellidos, email, edificio,sala,fecha,horaInicio,horaFin,tipoAntes,tipoDurante,tipoDespues,descripcion,departamento){
		return $.getJSON("../dao/insert/iSolicitud.php", {
			"nombre":nombre,
			"apellidos":apellidos,
			"email":email,
			"edificio":edificio,
			"sala":sala,
			"fecha":fecha,
			"horaInicio":horaInicio,
			"horaFin":horaFin,
			"tipoAntes":tipoAntes,
			"tipoDurante":tipoDurante,
			"tipoDespues":tipoDespues,
			"descripcion":descripcion,
			"departamento":departamento
		});
	}
	
	$('#confirmacion').hide();

	$('#hora_inicio').timepicker({
	    timeFormat: "HH:mm:ss"
	});


    $('#hora_fin').timepicker({
	    timeFormat: "HH:mm:ss"
	});

    var recuperaDepartamento = function() {
		return $.getJSON("../dao/select/sDepartamento.php", {
			usuario:sessionStorage.getItem("idUsuarioSession")
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
	
	//Cargamos los datos de nombre, apellido y correo.
	$("#nombre").val(sessionStorage.getItem("nombreUsuarioSession"));
	$("#apellido").val(sessionStorage.getItem("apellidoUsuarioSession"));
	$("#email").val(sessionStorage.getItem("emailUsuarioSession"));
	
    //Al hacer click enviamos la info a la clase php con la inserción de valores.
    $('#enviar').click(function() {

    	var antes = $('#antes').is(":checked");
    	var durante = $('#durante').is(":checked");
    	var despues = $('#despues').is(":checked");
    	var nombre = $("#nombre").val();
    	var apellidos = $("#apellido").val();
    	var email = $("#email").val();
    	var edificio = $("#edificio").val();
    	var sala = $("#sala").val();
    	var fecha = $("#fecha").val();
    	var horaInicio = $("#hora_inicio").val();
    	var horaFin = $("#hora_fin").val();
    	var descripcion = $("#comment").val();
    	var departamento = $("#departamento").val();
    	
		insercionSolicitud(
    				nombre,
    				apellidos,
    				email,
    				edificio,
    				sala,
    				fecha,
    				horaInicio,
    				horaFin,
    				antes,
    				durante,
    				despues,
    				descripcion,
    				departamento
    	).done(function(response) {
			if (!response.success) {
				alert("Error de datos, vuelva a intentarlo.");
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