<?php

include_once("../../utiles/connectDBUtiles.php");
include_once("../../utiles/generaLog.php");
include_once("../../correos/envioMail.php");

$idSolicitud = htmlspecialchars($_GET["solicitudId"]);
$operacion = htmlspecialchars($_GET["operacion"]);

$jsondata = "";

if ( isset($_GET["cuerpo"]))
	$cuerpo = "No Cuerpo";
else{
	$cuerpo = htmlspecialchars($_GET["cuerpo"]);
}


if ( isset($_GET["destino"]))
	$destino = "nodestino@nodestino.com";
else{
	$destino = htmlspecialchars($_GET["destino"]);
}

	
if ($operacion=="cierre"){
	cerrarSolicitud($cuerpo,$destino);
}

if ($operacion=="aprobar"){
	aprobarSolicitud($cuerpo,$destino);
}

if ($operacion=="rechazar"){
	rechazarSolicitud($cuerpo,$destino);
}

if ($operacion=="actualiza"){
	actualizarSolicitud($cuerpo,$destino);
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata, JSON_FORCE_OBJECT);

function aprobarSolicitud($cuerpo,$destino){
	global $idSolicitud,$mysqlCon,$mysqlCon,$jsondata;
	$sqlCerrarSolicitud = "update solicitudes set status_id = 3 WHERE solicitud_id = ?";

	if ($stmt = $mysqlCon->prepare($sqlCerrarSolicitud)) {

		$stmt->bind_param('i',$idSolicitud);

		if (!$stmt->execute()) {

			escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
			$jsondata["success"] = $mysqlCon->error;

		}else{

			escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,null,"updates.log");

			$jsondata["success"] = true;

			$resultadoMail = enviaMailCambioEstado($destino,$cuerpo,3,$solicitud_id);
			
			if ($resultadoMail){
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"mailCorrecto.log");
				$jsondata["success"] = true;
					
			}else {
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"erroresMail.log");
				$jsondata["success"] = false;
					
			}
				
		}
		$stmt->close();
	} else {

		escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
		$jsondata["success"] = $mysqlCon->error;

	}
}

function rechazarSolicitud($cuerpo,$destino){
	global $idSolicitud,$mysqlCon,$mysqlCon,$jsondata;
	$sqlCerrarSolicitud = "update solicitudes set status_id = 4 WHERE solicitud_id = ?";

	if ($stmt = $mysqlCon->prepare($sqlCerrarSolicitud)) {

		$stmt->bind_param('i',$idSolicitud);

		if (!$stmt->execute()) {

			escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
			$jsondata["success"] = $mysqlCon->error;

		}else{

			escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,null,"updates.log");

			$jsondata["success"] = true;

			$resultadoMail = enviaMailCambioEstado($destino,$cuerpo,4,$solicitud_id);
			
			if ($resultadoMail){
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"mailCorrecto.log");
				$jsondata["success"] = true;
					
			}else {
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"erroresMail.log");
				$jsondata["success"] = false;
					
			}
				
		}
		$stmt->close();
	} else {

		escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
		$jsondata["success"] = $mysqlCon->error;

	}
}

function cerrarSolicitud($cuerpo,$destino){
	global $idSolicitud,$mysqlCon,$mysqlCon,$jsondata;
	$sqlCerrarSolicitud = "update solicitudes set status_id = 6 WHERE solicitud_id = ?";

	if ($stmt = $mysqlCon->prepare($sqlCerrarSolicitud)) {

		$stmt->bind_param('i',$idSolicitud);

		if (!$stmt->execute()) {
				
			escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
			$jsondata["success"] = $mysqlCon->error;

		}else{
				
			escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,null,"updates.log");
			$jsondata["success"] = true;
			
			$resultadoMail = enviaMailCambioEstado($destino,$cuerpo,6,$solicitud_id);
				
			if ($resultadoMail){
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"mailCorrecto.log");
				$jsondata["success"] = true;
					
			}else {
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"erroresMail.log");
				$jsondata["success"] = false;
					
			}
				
		}
		$stmt->close();
	} else {

		escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
		$jsondata["success"] = $mysqlCon->error;

	}
}

function actualizarSolicitud($cuerpo,$destino){

	global $idSolicitud,$stmt,$mysqlCon,$jsondata;

	$sqlActualizarSolicitud = "update solicitudes set status_id = 2 WHERE solicitud_id = ?";

	$sqlInsercionComunicacion = "INSERT INTO COMUNICACIONES
								(solicitud_id,fecha,hora,remitente,destinatario,email) values
								(?,?,?,?,?,?)";

	if ($stmt = $mysqlCon->prepare($sqlInsercionComunicacion)) {

		$remitente = "LimpiezasArosa@gmail.com";
		$fechaCorreo = date("Y-m-d");
		$horaCorreo = date("H:i:s");

		
		$stmt->bind_param('isssss',$idSolicitud,$fechaCorreo,$horaCorreo,$remitente,$destino,$cuerpo);

		$parametros = $idSolicitud . "<->" . $fechaCorreo . "<->" . $horaCorreo . "<->" . $remitente . "<->" . $destino . "<->" . $cuerpo;

		if (!$stmt->execute()) {
				
			escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlInsercionComunicacion,$parametros,$mysqlCon->error,"errores.log");
			$jsondata["success"] = $mysqlCon->error;
				
		} else {
					
			escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlInsercionComunicacion,$parametros,null,"inserciones.log");
			$jsondata["success"] = true;

			// destinatario
// 			$para  = $destino;
// 			$desde = "limpiezaarosa@gmail.com";

			$resultadoMail = enviaMailCambioEstado($destino,$cuerpo,2,$solicitud_id);
			
			if ($resultadoMail){
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"mailCorrecto.log");
				$jsondata["success"] = true;
					
			}else {
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"erroresMail.log");
				$jsondata["success"] = false;
			
			}
			
		}
		$stmt->close();
	} else {
		escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlActualizarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
		$jsondata["success"] = $mysqlCon->error;
	}
}
?>