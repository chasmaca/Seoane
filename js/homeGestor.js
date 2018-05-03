
$(document).ready(function(){

	// recupera el listado de todas las solicitudes 
	var recuperaListado = function() {
		return $.getJSON("../dao/select/sSolicitud.php", {
			origen:"gestor",
			solicitud:"todas"
		});
	}

	var dataSet = [];
	

	/*Cargamos la tabla de solicitudes*/
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
					
					var statusDesc = "";

					if (array[x].status_id == "1")
						statusDesc = "Cerrada";
					
					if (array[x].status_id == "2")
						statusDesc = "En Curso";
					
					if (array[x].status_id == "3")
						statusDesc = "Aprobada";
					
					if (array[x].status_id == "4")
						statusDesc = "Rechazada";
					
					if (array[x].status_id == "5")
						statusDesc = "Reabierta";
					
					if (array[x].status_id == "6")
						statusDesc = "Cerrada";

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
							statusDesc]);
					contador++;	
				}				
			}
		}
		$("#numeroSpan").text(contador);

		
		$('#resultados').DataTable( {
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



	$(document).on("click",".logout",function() {
		
		location.href="..";
	});

});