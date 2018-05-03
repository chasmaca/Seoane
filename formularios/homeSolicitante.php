
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Limpiezas Arosa</title>
        <meta name="description" content="Aplicacion de Limpiezas Arosa para la universidad Francisco de Vitoria." />
        <meta name="keywords" content="Francisco de Vitoria, Limpieza, Arosa, Limpieza Arosa" />
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script src="../js/modernizr-custom.js"></script>
		<script src="../js/jquery.min.js"></script>
		<script src="../js/homeSolicitante.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Raleway:400,700);

		</style>
    </head>
    <body>
        <div class="container">

			<header>
				<div class="logout" style="float:right;">
					<span class="logoutSpan">Logout</span>
				</div>
				<img id="logo" src="../images/limpiezas-arosa.png" alt="Empresa de limpieza">
				<h2>Aplicaci&oacute;n de Limpieza para la Universidad Francisco de Vitoria</h2>
				<div class="support-note">
					<span class="note-ie">Perdon, unicamente esta soportado por navegadores modernos.</span>
				</div>

			</header>
			<section class="main">
				<table id="resultados" style="width:90%;">
					<thead>
						<tr>
							<td>Solicitud</td>
							<td>Solicitante</td>
							<td>Email Solicitante</td>
							<td>Edificio</td>
							<td>Sala</td>
							<td>Fecha</td>
							<td>Hora Inicio</td>
							<td>Hora Final</td>
							<td>Observaciones</td>
							<td>Status</td>
							<td>Id Usuario</td>
						</tr>
					</thead>
					<tbody id="cuerpoTabla">

					</tbody>
				</table>
			</section>
			<div id="botonNuevo" style="width:90%;">
				<input type="button" name="crear" id="crear" value="Crear Solicitud" class="boton"/>
			</div>
			
        </div>

    </body>
</html>