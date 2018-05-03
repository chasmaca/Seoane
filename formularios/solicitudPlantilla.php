<?php 
	$idSolicitud = htmlspecialchars($_GET["solicitudId"]);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Solicitud de Limpieza</title>

<link rel='stylesheet prefetch' href='../css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='../css/bootstrap-theme.min.css'>
<link rel='stylesheet prefetch' href='../css/bootstrapValidator.min.css'>
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css" />
<link rel="stylesheet" href="../css/alertas.css">

<script src='../js/jquery.min.js'></script>
<script src='../js/bootstrap.min.js'></script>
<script src='../js/bootstrapvalidator.min.js'></script>
<script src='../js/modernizr-custom.js'></script>
<script src='../js/solicitudPlantilla.js'></script>

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
		<form class="well form-horizontal" id="contact_form">
			<input type="hidden" name="solicitudId" id="solicitudId" value="<?php echo $idSolicitud;?>"/>
			<fieldset>

				<!-- NOMBRE DEL FORMULARIO-->
				<legend>Solicitud de Limpieza Arosa</legend>

				<!-- DEPARTAMENTOS -->
				<div class="form-group">
					<label class="col-md-4 control-label">Departamento</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-user"></i></span> 
								<select
								name="departamento" id="departamento" class="form-control"></select>
						</div>
					</div>
				</div>
				<!-- NOMBRE -->
				<div class="form-group">
					<label class="col-md-4 control-label">Nombre</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-user"></i></span> <input
								name="nombre" id="nombre" placeholder="Nombre"
								class="form-control" type="text">
						</div>
					</div>
				</div>

				<!-- APELLIDOS -->
				<div class="form-group">
					<label class="col-md-4 control-label">Apellidos</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-user"></i></span> <input
								name="apellido" id="apellido" placeholder="Apellidos"
								class="form-control" type="text">
						</div>
					</div>
				</div>

				<!-- EMAIL-->
				<div class="form-group">
					<label class="col-md-4 control-label">E-Mail</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-envelope"></i></span> <input
								name="email" id="email" placeholder="E-Mail"
								class="form-control" type="text">
						</div>
					</div>
				</div>

				<!-- EDIFICIO -->
				<div class="form-group">
					<label class="col-md-4 control-label">Edificio</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-home"></i></span> <input
								name="edificio" id="edificio" placeholder="Edificio"
								class="form-control" type="text">
						</div>
					</div>
				</div>

				<!-- SALA-->
				<div class="form-group">
					<label class="col-md-4 control-label">Sala</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-home"></i></span> <input name="sala"
								id="sala" placeholder="Sala" class="form-control" type="text">
						</div>
					</div>
				</div>

				<!-- FECHA-->
				<div class="form-group">
					<label class="col-md-4 control-label">Fecha</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-calendar"></i></span> 
								<input name="fecha" id="fecha" placeholder="Fecha del Evento (dd/mm/yyyy)" class="form-control" type="text">
						</div>
					</div>
				</div>

				<!-- HORA-->
				<div class="form-group">
					<label class="col-md-4 control-label">Hora Inicio</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-time"></i></span> <input type="text"
								name="hora_inicio" id="hora_inicio" class="form-control">
						</div>
					</div>
				</div>

				<!-- HORA-->
				<div class="form-group">
					<label class="col-md-4 control-label">Hora Fin</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-time"></i></span> <input type="text"
								name="hora_fin" id="hora_fin" class="form-control">
						</div>
					</div>
				</div>

				<!-- CHECK BOX DE TIPO DE SERVICIO -->
				<div class="form-group">
					<label class="col-md-4 control-label">Tipo de Servicio</label>
					<div class="col-md-4">
						<div class="check">
							<label> <input type="checkbox" name="antes" id="antes"
								value="no" /> Antes del Evento
							</label>
						</div>
						<div class="check">
							<label> <input type="checkbox" name="durante" id="durante"
								value="no" /> Durante el Evento
							</label>
						</div>
						<div class="check">
							<label> <input type="checkbox" name="despues" id="despues"
								value="no" /> Despu&eacute;s del Evento
							</label>
						</div>
					</div>
				</div>

				<!-- OBSERVACIONES DETALLADAS. -->
				<div class="form-group">
					<label class="col-md-4 control-label">Descripci&oacute;n</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-pencil"></i></span>
							<textarea class="form-control" name="comment" id="comment"
								placeholder="Descripci&oacute;n Detallada"></textarea>
						</div>
					</div>
				</div>
				<!-- Listado de correos -->
				<table id="listaCorreo" style="width:90%;">
					<thead>
						<tr>
							<td>Remitente</td>
							<td>Correo</td>
							<td>Fecha</td>
							<td>Destinatario</td>
						</tr>
					</thead>
				</table>
				<!-- OBSERVACIONES DETALLADAS. -->
				<div class="form-group">
					<label class="col-md-4 control-label">Respuesta Email</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-pencil"></i></span>
							<textarea class="form-control" name="comment" id="respuesta"
								placeholder="Email Respuesta"></textarea>
						</div>
					</div>
				</div>
				<!-- Empleados -->
				<div class="form-group">
					<label class="col-md-4 control-label">Empleados</label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-user"></i></span> <input
								name="empleado" id="empleado" placeholder="Empleados"
								class="form-control" type="text">
						</div>
					</div>
				</div>
				<!-- Coste hora-->
				<div class="form-group">
					<label class="col-md-4 control-label">Coste</label>
					<div class="col-md-4 inputGroupContainer" style="width:50%;">
						<div class="input-group"  style="width:80%;">
							<span class="input-group-addon"><i
								class="glyphicon glyphicon-euro"></i></span>
								<input
								name="coste" id="coste" placeholder="Coste"
								class="form-control" type="text" style="width: 79%;">
							<div class="span-group"  style="width:15%;margin-top:3%;float:left;">
								<span>
									&euro; + IVA.
								</span>							
							</div>
						</div>
						
					</div>
				</div>			
				<!-- BOTONERA -->
				<div class="form-group">
					<label class="col-md-4 control-label"></label>
					<div class="col-md-4">
						<button type="button" name="enviar" id="enviar"
							class="btn btn-warning">
							Enviar <span class="glyphicon glyphicon-send"></span>
						</button>
						<button type="button" name="cerrar" id="cerrar"
							class="btn btn-warning">
							Cerrar <span class="glyphicon glyphicon-send"></span>
						</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	
	<div class="jconfirm jconfirm-light jconfirm-open" id="confirmacion">
		<div class="jconfirm-bg" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1);"></div>
		<div class="jconfirm-scrollpane">
			<div class="jconfirm-row">
				<div class="jconfirm-cell">
					<div class="jconfirm-holder" style="padding-top: 40px; padding-bottom: 40px;">
						<div class="jc-bs3-container container">
							<div class="jc-bs3-row row justify-content-md-center justify-content-sm-center justify-content-xs-center justify-content-lg-center">
								<div class="jconfirm-box-container jconfirm-animated col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 jconfirm-no-transition" style="transform: translate(0px, 0px); transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1);">
									<div class="jconfirm-box jconfirm-hilight-shake jconfirm-type-default jconfirm-type-animated" role="dialog" aria-labelledby="jconfirm-box33538" tabindex="-1" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); transition-property: all, margin;">
										<div class="jconfirm-closeIcon" style="display: none;">×</div>
										<div class="jconfirm-title-c">
											<span class="jconfirm-icon-c">
												<i class="fa fa-rocket"></i>
											</span>
											<span class="jconfirm-title">Comunicaci&oacute;n enviada!</span>
										</div>
										<div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 40px; max-height: 226px;">
											<div class="jconfirm-content" id="jconfirm-box33538">
												<div>Comunicaci&oacute;n enviada correctamente.</div>
											</div>
										</div>
										<div class="jconfirm-buttons"><button type="button" class="btn btn-blue" id="okey">Aceptar</button></div>
										<div class="jconfirm-clear"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
