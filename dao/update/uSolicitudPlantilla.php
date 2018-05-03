<?php

include_once("../../utiles/connectDBUtiles.php");
include_once("../../utiles/generaLog.php");
include_once("../../correos/envioMail.php");

$idSolicitud = htmlspecialchars($_GET["solicitudId"]);
$operacion = htmlspecialchars($_GET["operacion"]);

$cuerpo = htmlspecialchars($_GET["cuerpo"]);
$destino = htmlspecialchars($_GET["destino"]);

$jsondata = "";



if ($operacion=="cierre"){
	cerrarSolicitud($cuerpo,$destino);
}

if ($operacion=="actualiza"){
	$precio =  htmlspecialchars($_GET["precio"]);
	$empleado =  htmlspecialchars($_GET["empleado"]);
	
	actualizarSolicitud($cuerpo,$destino,$precio,$empleado);
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata, JSON_FORCE_OBJECT);

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
			
			enviaMailCerrar($destino,$cuerpo);
		}
		$stmt->close();
	} else {

		escribirLog("update/uSolicitudPlantilla.php","cerrarSolicitud",$sqlCerrarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
		$jsondata["success"] = $mysqlCon->error;
		
	}
}

function actualizarSolicitud($cuerpo,$destino,$precio,$empleado){	
	
	global $idSolicitud,$stmt,$mysqlCon,$jsondata;
	
	$resultadoMail = false;

	$sqlActualizarSolicitud = "update solicitudes set status_id = 2, precio = ?, empleados=? WHERE solicitud_id = ?";
	
	$sqlInsercionComunicacion = "INSERT INTO COMUNICACIONES
								(solicitud_id,fecha,hora,remitente,destinatario,email) values
								(?,?,?,?,?,?)";

	if ($stmt = $mysqlCon->prepare($sqlActualizarSolicitud)) {
	
		$stmt->bind_param('dii',$precio,$empleado,$idSolicitud);
	
		if (!$stmt->execute()) {
				
			escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlActualizarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
			$jsondata["success"] = $mysqlCon->error;


		}else{
				
			escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlActualizarSolicitud,$idSolicitud,null,"updates.log");

			$remitente = "LimpiezasArosa@gmail.com";
			$fechaCorreo = date("Y-m-d");
			$horaCorreo = date("H:i:s");
				
			$stmt = $mysqlCon->prepare($sqlInsercionComunicacion);
			$stmt->bind_param('isssss',$idSolicitud,$fechaCorreo,$horaCorreo,$remitente,$destino,$cuerpo);
				
			$parametros = $idSolicitud . "<->" . $fechaCorreo . "<->" . $horaCorreo . "<->" . $remitente . "<->" . $destino . "<->" . $cuerpo;
				
			if (!$stmt->execute()) {
					
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlInsercionComunicacion,$parametros,$mysqlCon->error,"errores.log");
				$jsondata["success"] = $mysqlCon->error;
					
			} else {
					
				escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlInsercionComunicacion,$parametros,null,"inserciones.log");
				$jsondata["success"] = true;
				
				$resultadoMail = enviaMailCambioEstado($destino,$cuerpo,2);
				
				if ($resultadoMail){
					escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"mailCorrecto.log");
					$jsondata["success"] = true;
					
				}else {					
					escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"erroresMail.log");
					$jsondata["success"] = false;
						
				}
			}
		}
		$stmt->close();
	} else {
		escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud",$sqlActualizarSolicitud,$idSolicitud,$mysqlCon->error,"errores.log");
		$jsondata["success"] = $mysqlCon->error;
	}
}



?>