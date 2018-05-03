<?php

include_once("../../utiles/connectDBUtiles.php");

$solicitudId = intval($_GET["solicitudId"]);
global $mysqlCon;
/*JSON de vuelta*/

$jsondata = "";
$jsondata["data"]["comunicaciones"]=array();


$sqlSelectSolicitud = "SELECT solicitud_id, nombre,apellidos,email,edificio,sala,DATE_FORMAT(fechaTrabajo, '%d/%m/%Y') ,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, precio,empleados FROM solicitudes WHERE solicitud_id = ?";
$sqlSelectComunicaciones = "SELECT comunicacion_id, solicitud_id, fecha, hora, remitente, email, destinatario FROM comunicaciones WHERE solicitud_id = ?";

/*Prepare Statement*/
if ($stmt = $mysqlCon->prepare($sqlSelectSolicitud)) {
	
	$stmt->bind_param('i',$solicitudId);
	/*Asociacion de parametros*/
	if ($stmt->execute()){
		
		$solicitud_id ="";
		$nombre="";
		$apellidos="";
		$email="";
		$edificio="";
		$sala="";
		$fechaTrabajo="";
		$horaInicio="";
		$horaFin="";
		$antesEvento="";
		$duranteEvento="";
		$despuesEvento="";
		$observaciones="";
		$status_id="";
		$precio = "";
		$empleados = "";
		/*Almacenamos el resultSet*/
		$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $precio, $empleados);
		
		while($stmt->fetch()) {
			
			$jsondata["data"]["solicitud_id"] = $solicitud_id;
			$jsondata["data"]["nombre"] = $nombre;
			$jsondata["data"]["apellidos"] = $apellidos;
			$jsondata["data"]["email"] =$email;
			$jsondata["data"]["edificio"] =$edificio;
			$jsondata["data"]["sala"] =$sala;
			$jsondata["data"]["fechaTrabajo"] =$fechaTrabajo;
			$jsondata["data"]["horaInicio"] =$horaInicio;
			$jsondata["data"]["horaFin"] =$horaFin;
			$jsondata["data"]["antesEvento"] =$antesEvento;
			$jsondata["data"]["duranteEvento"] =$duranteEvento;
			$jsondata["data"]["despuesEvento"] =$despuesEvento;
			$jsondata["data"]["observaciones"] =$observaciones;
			$jsondata["data"]["status_id"] =$status_id;
			$jsondata["data"]["precio"] =$precio;
			$jsondata["data"]["empleados"] =$empleados;
			}

		if ($stmt = $mysqlCon->prepare($sqlSelectComunicaciones)) {

			$comunicacion_id="";
			$solicitud_id="";
			$fecha="";
			$hora="";
			$remitente="";
			$emailTexto="";
			$destinatario="";
			
			$stmt->bind_param('i',$solicitudId);
			if ($stmt->execute()){
				$stmt->bind_result($comunicacion_id, $solicitud_id, $fecha, $hora, $remitente, $emailTexto, $destinatario);
				while($stmt->fetch()) {
					$tmp = array();
					$tmp["comunicacion_id"] = $comunicacion_id;
					$tmp["solicitud_id"] = $solicitud_id;
					$tmp["fecha"] = $fecha;
					$tmp["hora"] = $hora;
					$tmp["remitente"] = utf8_encode($remitente);
					$tmp["email"] = utf8_encode($emailTexto);
					$tmp["destinatario"] =utf8_encode($destinatario);

					/*Asociamos el resultado en forma de array en el json*/
					array_push($jsondata["data"]["comunicaciones"], $tmp);
				}
			}
		}
		
		$jsondata["success"] = true;
		
	}else{
		$jsondata["message"] = "no pasa por el execute:" . $mysqlCon->error;
		$jsondata["success"] = false;
		exit;
		
	}
}else{
	$jsondata["message"] = "no pasa por el prepare:" . $mysqlCon->error;
	$jsondata["success"] = false;
	exit;
	
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata, JSON_FORCE_OBJECT);


?>