
$(document).ready(function(){
	
	
	$( "#crear" ).click(function() {
		location.href="solicitud.php";
	});
	
	// recuperaPeriodo será nuestra función recuperar los perido con solicitudes    
	var recuperaListado = function() {
		return $.getJSON("../dao/select/sSolicitud.php", {
			origen:"solicitante",
			solicitud:"vacio"
		});
	}
	
	/*Cargamos el combo de periodos*/
	recuperaListado().done(function(response) {
		if (!response.success) {

			alert("Problema con el JSON");

		}else{

			var array = $.map(response.data, function(value, index) {
				return [value];
			});
			
			if (array.length==0){
				
				console.log("No hay solicitudes creadas.");
			}else{
				for(var x=0; x<array.length;x++){
				
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
											"<td>"+array[x].status_id+"</td>" +
											"<td>"+array[x].usuario_id+"</td>" +
										"</tr>";
	
	
					$(newRowContent).appendTo($("#cuerpoTabla"));
				}				
			}
		}
		
	});
	
	$(document).on("click",".trStyle",function() {
		var id = $(this).attr('id');
		location.href="solicitudSolicitante.php?solicitudId="+id;
	});

	$(document).on("click",".logout",function() {
		
		location.href="..";
	});
});
