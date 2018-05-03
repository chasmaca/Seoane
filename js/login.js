$(document).ready(function(){
	
	/*Recogemos el click del boton de filtrado, validamos los parametros y si todo esta correcto, lanzamos el listado*/
	$( "#submit" ).click(function() {
		if (valida()){
			var usuario = $("input[name=login]").val();
			var password = $("input[name=password]").val();
			$.ajax({
				type:     'post',
				dataType : 'json',
		        data: 
		        { 
		        	usuario: usuario,
		        	password: password
	        	},
		        url: 'dao/select/sLogin.php',
			    success: function (response) {
			    	if (!response.success){
			    		alert("Error en la password y/o contraseña");
//			    		$( "#error" ).empty();
//						$('<label for="password" style="color:red;"><p>Error en la password y/o contraseña</p></label>').appendTo('#error');
			    	}else{
			    		var role = response.data[0].role_id;
			    		
			    		sessionStorage.setItem("idUsuarioSession", response.data[0].usuario_id);
			    		sessionStorage.setItem("roleUsuarioSession", role);
			    		sessionStorage.setItem("nombreUsuarioSession", response.data[0].nombre);
			    		sessionStorage.setItem("apellidoUsuarioSession", response.data[0].apellidos);
			    		sessionStorage.setItem("emailUsuarioSession", response.data[0].email);

			    		switch(role) {
					    case 1:
					    	location.href="formularios/homeAdministrador.php";
					        break;
					    case 2:
					    	location.href="formularios/homePlantilla.php";
					        break;
					    case 3:
					    	//location.href="formularios/solicitud.php";
					    	location.href="formularios/homeSolicitante.php";
					        break;
				    	case 4:
					    	//location.href="formularios/solicitud.php";
					    	location.href="formularios/homeGestor.php";
					        break;
						}
			    		
			    	}
		        },
        		error: function(xhr, status, error) {
        			  var err = eval("(" + xhr.responseText + ")");
        			  alert(err.Message);
        			}
			});

		}else{
			alert ("Se debe incluir usuario y contraseña");
		}
	});
	
});

/**
 * Funcion de validacion de formulario
 * @returns boolean resultado
 */

function valida(){
	
	var resultado = true;
	
	var usuario = $("input[name=login]").val();
	var password = $("input[name=password]").val();
	
	if (usuario == ""){
		resultado = false;
	}

	if (password == ""){
		resultado = false;
	}

	return resultado;
}
