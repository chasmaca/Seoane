
$(document).ready(function(){
	// recuperaPeriodo será nuestra función recuperar los perido con solicitudes    
	var recuperaListado = function() {
		return $.getJSON("../dao/select/sSolicitud.php", {
			origen:"plantilla",
			solicitud:"nueva"
		});
	}

	// recuperaPeriodo será nuestra función recuperar los perido con solicitudes    
	var recuperaListadoCurso = function() {
		return $.getJSON("../dao/select/sSolicitud.php", {
			origen:"plantilla",
			solicitud:"curso"
		});
	}

	// recuperaPeriodo será nuestra función recuperar los perido con solicitudes    
	var recuperaListadoAprobadas = function() {
		return $.getJSON("../dao/select/sSolicitud.php", {
			origen:"plantilla",
			solicitud:"aprobada"
		});
	}

	// recuperaPeriodo será nuestra función recuperar los perido con solicitudes    
	var recuperaListadoRechazadas = function() {
		return $.getJSON("../dao/select/sSolicitud.php", {
			origen:"plantilla",
			solicitud:"rechazada"
		});
	}

	// recuperaPeriodo será nuestra función recuperar los perido con solicitudes    
	var recuperaListadoCerradas = function() {
		return $.getJSON("../dao/select/sSolicitud.php", {
			origen:"plantilla",
			solicitud:"cerrada"
		});
	}

	var dataSet = [];
	
	$('#resultados').hide();
	$('#resultadosEnCurso').hide();
	$('#resultadosAceptadas').hide();
	$('#resultadosRechazadas').hide();
	$('#resultadosCerrados').hide();

	$('#plegarNuevas').click(function() {
		if ($('#resultados').is(":visible"))
		{
			$('#resultados').hide();
		}else{
			$('#resultados').show();	
		}
	});
	
	$('#plegarCurso').click(function() {
		if ($('#resultadosEnCurso').is(":visible"))
		{
			$('#resultadosEnCurso').hide();
		}else{
			$('#resultadosEnCurso').show();	
		}
	});
	
	$('#plegarAprobadas').click(function() {
		if ($('#resultadosAceptadas').is(":visible"))
		{
			$('#resultadosAceptadas').hide();
		}else{
			$('#resultadosAceptadas').show();	
		}
	});
	
	$('#plegarRechazadas').click(function() {
		if ($('#resultadosRechazadas').is(":visible"))
		{
			$('#resultadosRechazadas').hide();
		}else{
			$('#resultadosRechazadas').show();	
		}
	});

	$('#plegarCerradas').click(function() {
		if ($('#resultadosCerrados').is(":visible"))
		{
			$('#resultadosCerrados').hide();
		}else{
			$('#resultadosCerrados').show();	
		}
	});

	/*Cargamos el combo de periodos*/
	recuperaListado().done(function(response) {

		var contador = 0;

		if (!response.success) {

			alert("Problema con el JSON");

		}else{

			var array = $.map(response.data, function(value, index) {
				return [value];
			});
			
			if (array.length==0){
				
				alert("no hay datos en el informe");
			
			}else{
				for(var x=0; x<array.length;x++){
					contador++;
					var newRowContent = "<tr class='trStyle' id='"+array[x].solicitud_id+"'>" +
											"<td>"+array[x].solicitud_id+"</td>" +
											"<td>"+array[x].nombre+"</td>" +
											"<td>"+array[x].email+"</td>" +
											"<td>"+array[x].edificio+"</td>" +
											"<td>"+array[x].sala+"</td>" +
											"<td>"+array[x].fechaTrabajo+"</td>" +
											"<td>"+array[x].horaInicio+"</td>" +
											"<td>"+array[x].horaFin+"</td>" +
											"<td>"+array[x].observaciones+"</td>" +
											"<td>Nueva</td>" +
										"</tr>";
	
	
					$(newRowContent).appendTo($("#cuerpoTabla"));
				}				
			}
		}

		$("#numeroNuevasSpan").text(contador);

	});

	/*Cargamos el combo de periodos*/
	recuperaListadoCurso().done(function(response) {

		var contador = 0;

		if (!response.success) {

			alert("Problema con el JSON");

		}else{

			var array = $.map(response.data, function(value, index) {
				return [value];
			});
			
			if (array.length==0){
				
				alert("no hay datos en el informe");
			
			}else{
				for(var x=0; x<array.length;x++){
					
					contador++;
					
					var newRowContent = "<tr class='trStyle' id='"+array[x].solicitud_id+"'>" +
											"<td>"+array[x].solicitud_id+"</td>" +
											"<td>"+array[x].nombre+"</td>" +
											"<td>"+array[x].email+"</td>" +
											"<td>"+array[x].edificio+"</td>" +
											"<td>"+array[x].sala+"</td>" +
											"<td>"+array[x].fechaTrabajo+"</td>" +
											"<td>"+array[x].horaInicio+"</td>" +
											"<td>"+array[x].horaFin+"</td>" +
											"<td>"+array[x].observaciones+"</td>" +
											"<td>En Curso</td>" +
										"</tr>";
	
	
					$(newRowContent).appendTo($("#cuerpoTablaEnCurso"));
				}				
			}
		}

		$("#numeroCursoSpan").text(contador);
		
	});

	/*Cargamos lista trabajos Aprobados*/
	recuperaListadoAprobadas().done(function(response) {

		var contador = 0;
		
		if (!response.success) {

			alert("Problema con el JSON");

		}else{

			var array = $.map(response.data, function(value, index) {
				return [value];
			});
			
			if (array.length==0){
				
				alert("no hay datos en el informe");
			
			}else{
				for(var x=0; x<array.length;x++){
					
					contador++;
					
					var newRowContent = "<tr class='trStyle' id='"+array[x].solicitud_id+"'>" +
											"<td>"+array[x].solicitud_id+"</td>" +
											"<td>"+array[x].nombre+"</td>" +
											"<td>"+array[x].email+"</td>" +
											"<td>"+array[x].edificio+"</td>" +
											"<td>"+array[x].sala+"</td>" +
											"<td>"+array[x].fechaTrabajo+"</td>" +
											"<td>"+array[x].horaInicio+"</td>" +
											"<td>"+array[x].horaFin+"</td>" +
											"<td>"+array[x].observaciones+"</td>" +
											"<td>Aprobada</td>" +
										"</tr>";
	
	
					$(newRowContent).appendTo($("#cuerpoAceptadas"));
				}				
			}
		}
		
		$("#numeroAceptadasSpan").text(contador);
		
	});

	/*Cargamos lista trabajos Cerrados*/
	recuperaListadoCerradas().done(function(response) {
		var contador = 0;
		if (!response.success) {

			alert("Problema con el JSON");

		}else{

			var array = $.map(response.data, function(value, index) {
				return [value];
			});
			
			if (array.length==0){
				
				alert("no hay datos en el informe");
			
			}else{
				
				for(var x=0; x<array.length;x++){
					
					dataSet.push([ 
							array[x].solicitud_id, 
							array[x].nombre, 
							array[x].email, 
							array[x].edificio,
							array[x].sala, 
							array[x].fechaTrabajo,
							array[x].horaInicio,
							array[x].horaFin,
							array[x].observaciones,
							"Cerrada"]);
					contador++;	
				}				
			}
		}
		$("#numeroCerradasSpan").text(contador);

		
		$('#resultadosCerrados').DataTable( {
			data: dataSet,
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
			]
		} );

	});

	/*Cargamos lista trabajos Cerrados*/
	recuperaListadoRechazadas().done(function(response) {
		var contador = 0;
		if (!response.success) {

			alert("Problema con el JSON");

		}else{

			var array = $.map(response.data, function(value, index) {
				return [value];
			});
			
			if (array.length==0){
				
				alert("no hay datos en el informe");
			
			}else{
				
				for(var x=0; x<array.length;x++){
					
					contador++;	
					
					var newRowContent = "<tr class='trStyle' id='"+array[x].solicitud_id+"'>" +
											"<td>"+array[x].solicitud_id+"</td>" +
											"<td>"+array[x].nombre+"</td>" +
											"<td>"+array[x].email+"</td>" +
											"<td>"+array[x].edificio+"</td>" +
											"<td>"+array[x].sala+"</td>" +
											"<td>"+array[x].fechaTrabajo+"</td>" +
											"<td>"+array[x].horaInicio+"</td>" +
											"<td>"+array[x].horaFin+"</td>" +
											"<td>"+array[x].observaciones+"</td>" +
											"<td>Rechazada</td>" +
										"</tr>";
	
	
					$(newRowContent).appendTo($("#cuerpoTablaRechazadas"));
				}				
			}
		}
		$("#numeroRechazadasSpan").text(contador);
		
	});

	$(document).on("click",".logout",function() {
		
		location.href="..";
	});
	
	$(document).on("click",".trStyle",function() {
		var id = $(this).attr('id');
		location.href="solicitudPlantilla.php?solicitudId="+id;
	});

});