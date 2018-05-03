<?php

session_start();

include '../../utiles/connectDBUtiles.php';
include '../../utiles/generaLog.php';

//Query para nuevas solicitudes
$querySolicitud = 	"select 
						solicitud_id,nombre,apellidos,email,edificio,sala,fechaTrabajo,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, usuario_id
					from 
						solicitudes 
					where 
						status_id = 1";

//Query para solicitudes en curso
$querySolicitudCurso = 	"select 
						solicitud_id,nombre,apellidos,email,edificio,sala,fechaTrabajo,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, usuario_id
					from 
						solicitudes 
					where 
						status_id = 2";

//Query para solicitudes aprobadas
$querySolicitudAprobada = 	"select
						solicitud_id,nombre,apellidos,email,edificio,sala,fechaTrabajo,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, usuario_id
					from
						solicitudes
					where
						status_id = 3";

//Query para solicitudes rechazadas
$querySolicitudRechazada = 	"select
						solicitud_id,nombre,apellidos,email,edificio,sala,fechaTrabajo,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, usuario_id
					from
						solicitudes
					where
						status_id = 4";

//Query para solicitudes cerradas
$querySolicitudCerrada = 	"select
						solicitud_id,nombre,apellidos,email,edificio,sala,fechaTrabajo,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, usuario_id
					from
						solicitudes
					where
						status_id = 6";

//Query para solicitudes abiertas por usuario
$querySolicitudUsuario = 	"select 
								solicitud_id,nombre,apellidos,email,edificio,sala,fechaTrabajo,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, usuario_id
							from 
								solicitudes 
							where 
								usuario_id = ?";

//Query para solicitudes abiertas por usuario
$querySolicitudGestor = 	"select
								solicitud_id,nombre,apellidos,email,edificio,sala,fechaTrabajo,horaInicio,horaFin,antesEvento,duranteEvento,despuesEvento,observaciones,status_id, usuario_id
							from
								solicitudes";

/*definimos el json*/
$jsondata = array();
$jsondata["data"] = array();

$origen = $_GET["origen"];
$solicitudes = $_GET["solicitud"];

if ($origen == "plantilla" && $solicitudes=="nueva"){
	recuperaSolicitudes();
}

if ($origen == "plantilla" && $solicitudes=="curso"){
	recuperaSolicitudesCurso();
}

if ($origen == "plantilla" && $solicitudes=="aprobada"){
	recuperaSolicitudesAprobada();
}

if ($origen == "plantilla" && $solicitudes=="rechazada"){
	recuperaSolicitudesRechazada();
}

if ($origen == "plantilla" && $solicitudes=="cerrada"){
	recuperaSolicitudesCerrada();
}

if ($origen == "solicitante"){
	$autorizadorId = $_SESSION["userId_session"];
	recuperaSolicitudesUsuario($autorizadorId);
}

if ($origen == "gestor"){
	$autorizadorId = $_SESSION["userId_session"];
	recuperaSolicitudesGestor();
}

/*Devolvemos el JSON con los datos de la consulta*/
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata, JSON_FORCE_OBJECT);

//Solicitudes Nuevas
function recuperaSolicitudes(){

	global $querySolicitud,$mysqlCon,$mysqlCon,$jsondata;

	$solicitud_id = "";
	$nombre = "";
	$apellidos = "";
	$email = "";
	$edificio = "";
	$sala = "";
	$fechaTrabajo = "";
	$horaInicio = "";
	$horaFin = "";
	$antesEvento = "";
	$duranteEvento = "";
	$despuesEvento = "";
	$observaciones = "";
	$status_id = "";
	$usuario_id="";
	
	/*Prepare Statement*/
	if ($stmt = $mysqlCon->prepare($querySolicitud)) {
		/*Asociacion de parametros*/
		if ($stmt->execute()){
			/*Almacenamos el resultSet*/
			$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $usuario_id);
			while($stmt->fetch()) {
				$tmp = array();

				$tmp["solicitud_id"] = $solicitud_id;
				$tmp["nombre"] = $nombre;
				$tmp["apellidos"] = $apellidos;
				$tmp["email"] =$email;
				$tmp["edificio"] =$edificio;
				$tmp["sala"] =$sala;
				$tmp["fechaTrabajo"] =$fechaTrabajo;
				$tmp["horaInicio"] =$horaInicio;
				$tmp["horaFin"] =$horaFin;
				$tmp["antesEvento"] =$antesEvento;
				$tmp["duranteEvento"] =$duranteEvento;
				$tmp["despuesEvento"] =$despuesEvento;
				$tmp["observaciones"] =$observaciones;
				$tmp["status_id"] =$status_id;
				$tmp["usuario_id"] =$usuario_id;

				array_push($jsondata["data"], $tmp);
			}

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudes",$querySolicitud,null,null,"query.log");
			$jsondata["success"] = true;

		}else{

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudes",$querySolicitud,null,$mysqlCon->error,"errores.log");
			$jsondata["success"] = false;
			$jsondata["message"] ="No se ha ejecutado la consulta.";

		}
	}
}

//Solicitudes Curso
function recuperaSolicitudesCurso(){

	global $querySolicitudCurso,$mysqlCon,$querySolicitudCurso,$mysqlCon,$jsondata;

	$solicitud_id = "";
	$nombre = "";
	$apellidos = "";
	$email = "";
	$edificio = "";
	$sala = "";
	$fechaTrabajo = "";
	$horaInicio = "";
	$horaFin = "";
	$antesEvento = "";
	$duranteEvento = "";
	$despuesEvento = "";
	$observaciones = "";
	$status_id = "";
	$usuario_id="";

	/*Prepare Statement*/
	if ($stmt = $mysqlCon->prepare($querySolicitudCurso)) {
		/*Asociacion de parametros*/
		if ($stmt->execute()){
			/*Almacenamos el resultSet*/
			$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $usuario_id);
			while($stmt->fetch()) {
				$tmp = array();

				$tmp["solicitud_id"] = $solicitud_id;
				$tmp["nombre"] = $nombre;
				$tmp["apellidos"] = $apellidos;
				$tmp["email"] =$email;
				$tmp["edificio"] =$edificio;
				$tmp["sala"] =$sala;
				$tmp["fechaTrabajo"] =$fechaTrabajo;
				$tmp["horaInicio"] =$horaInicio;
				$tmp["horaFin"] =$horaFin;
				$tmp["antesEvento"] =$antesEvento;
				$tmp["duranteEvento"] =$duranteEvento;
				$tmp["despuesEvento"] =$despuesEvento;
				$tmp["observaciones"] =$observaciones;
				$tmp["status_id"] =$status_id;
				$tmp["usuario_id"] =$usuario_id;

				array_push($jsondata["data"], $tmp);
			}

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesCurso",$querySolicitudCurso,null,null,"query.log");
			$jsondata["success"] = true;

		}else{

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesCurso",$querySolicitudCurso,null,$mysqlCon->error,"errores.log");
			$jsondata["success"] = false;
			$jsondata["message"] ="No se ha ejecutado la consulta.";
		
		}
	}
}

//Solicitudes Aprobadas
function recuperaSolicitudesAprobada(){

	global $querySolicitudAprobada,$mysqlCon,$querySolicitudCurso,$mysqlCon,$jsondata;
	
	$solicitud_id = "";
	$nombre = "";
	$apellidos = "";
	$email = "";
	$edificio = "";
	$sala = "";
	$fechaTrabajo = "";
	$horaInicio = "";
	$horaFin = "";
	$antesEvento = "";
	$duranteEvento = "";
	$despuesEvento = "";
	$observaciones = "";
	$status_id = "";
	$usuario_id="";
	
	/*Prepare Statement*/
	if ($stmt = $mysqlCon->prepare($querySolicitudAprobada)) {
		/*Asociacion de parametros*/
		if ($stmt->execute()){
			/*Almacenamos el resultSet*/
			$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $usuario_id);
			while($stmt->fetch()) {
				$tmp = array();
	
				$tmp["solicitud_id"] = $solicitud_id;
				$tmp["nombre"] = $nombre;
				$tmp["apellidos"] = $apellidos;
				$tmp["email"] =$email;
				$tmp["edificio"] =$edificio;
				$tmp["sala"] =$sala;
				$tmp["fechaTrabajo"] =$fechaTrabajo;
				$tmp["horaInicio"] =$horaInicio;
				$tmp["horaFin"] =$horaFin;
				$tmp["antesEvento"] =$antesEvento;
				$tmp["duranteEvento"] =$duranteEvento;
				$tmp["despuesEvento"] =$despuesEvento;
				$tmp["observaciones"] =$observaciones;
				$tmp["status_id"] =$status_id;
				$tmp["usuario_id"] =$usuario_id;
	
				array_push($jsondata["data"], $tmp);
			}

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesAprobada",$querySolicitudAprobada,null,null,"query.log");
			$jsondata["success"] = true;

		}else{

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesAprobada",$querySolicitudAprobada,null,$mysqlCon->error,"errores.log");
			$jsondata["success"] = false;
			$jsondata["message"] ="No se ha ejecutado la consulta.";

		}
	}
}

//Solicitudes Rechazadas
function recuperaSolicitudesRechazada(){
	
	global $querySolicitudRechazada,$mysqlCon,$querySolicitudCurso,$mysqlCon,$jsondata;
	
	$solicitud_id = "";
	$nombre = "";
	$apellidos = "";
	$email = "";
	$edificio = "";
	$sala = "";
	$fechaTrabajo = "";
	$horaInicio = "";
	$horaFin = "";
	$antesEvento = "";
	$duranteEvento = "";
	$despuesEvento = "";
	$observaciones = "";
	$status_id = "";
	$usuario_id="";
	
	/*Prepare Statement*/
	if ($stmt = $mysqlCon->prepare($querySolicitudRechazada)) {
		/*Asociacion de parametros*/
		if ($stmt->execute()){
			/*Almacenamos el resultSet*/
			$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $usuario_id);
			while($stmt->fetch()) {
				$tmp = array();
	
				$tmp["solicitud_id"] = $solicitud_id;
				$tmp["nombre"] = $nombre;
				$tmp["apellidos"] = $apellidos;
				$tmp["email"] =$email;
				$tmp["edificio"] =$edificio;
				$tmp["sala"] =$sala;
				$tmp["fechaTrabajo"] =$fechaTrabajo;
				$tmp["horaInicio"] =$horaInicio;
				$tmp["horaFin"] =$horaFin;
				$tmp["antesEvento"] =$antesEvento;
				$tmp["duranteEvento"] =$duranteEvento;
				$tmp["despuesEvento"] =$despuesEvento;
				$tmp["observaciones"] =$observaciones;
				$tmp["status_id"] =$status_id;
				$tmp["usuario_id"] =$usuario_id;
	
				array_push($jsondata["data"], $tmp);
			}
	
			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesRechazada",$querySolicitudRechazada,null,null,"query.log");
			$jsondata["success"] = true;
	
		}else{

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesRechazada",$querySolicitudRechazada,null,$mysqlCon->error,"errores.log");
			$jsondata["success"] = false;
			$jsondata["message"] ="No se ha ejecutado la consulta.";
		
		}
	}
}

//Solicitudes Rechazadas
function recuperaSolicitudesCerrada(){

	global $querySolicitudCerrada,$mysqlCon,$querySolicitudCurso,$mysqlCon,$jsondata;

	$solicitud_id = "";
	$nombre = "";
	$apellidos = "";
	$email = "";
	$edificio = "";
	$sala = "";
	$fechaTrabajo = "";
	$horaInicio = "";
	$horaFin = "";
	$antesEvento = "";
	$duranteEvento = "";
	$despuesEvento = "";
	$observaciones = "";
	$status_id = "";
	$usuario_id="";

	/*Prepare Statement*/
	if ($stmt = $mysqlCon->prepare($querySolicitudCerrada)) {
		/*Asociacion de parametros*/
		if ($stmt->execute()){
			/*Almacenamos el resultSet*/
			$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $usuario_id);
			while($stmt->fetch()) {
				$tmp = array();

				$tmp["solicitud_id"] = $solicitud_id;
				$tmp["nombre"] = $nombre;
				$tmp["apellidos"] = $apellidos;
				$tmp["email"] =$email;
				$tmp["edificio"] =$edificio;
				$tmp["sala"] =$sala;
				$tmp["fechaTrabajo"] =$fechaTrabajo;
				$tmp["horaInicio"] =$horaInicio;
				$tmp["horaFin"] =$horaFin;
				$tmp["antesEvento"] =$antesEvento;
				$tmp["duranteEvento"] =$duranteEvento;
				$tmp["despuesEvento"] =$despuesEvento;
				$tmp["observaciones"] =$observaciones;
				$tmp["status_id"] =$status_id;
				$tmp["usuario_id"] =$usuario_id;

				array_push($jsondata["data"], $tmp);
			}

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesRechazada",$querySolicitudCerrada,null,null,"query.log");
			$jsondata["success"] = true;

		}else{

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesRechazada",$querySolicitudCerrada,null,$mysqlCon->error,"errores.log");
			$jsondata["success"] = false;
			$jsondata["message"] ="No se ha ejecutado la consulta.";

		}
	}
}

function recuperaSolicitudesUsuario($autorizadorId){

	global $querySolicitudUsuario,$mysqlCon,$jsondata;

	$solicitud_id = "";
	$nombre = "";
	$apellidos = "";
	$email = "";
	$edificio = "";
	$sala = "";
	$fechaTrabajo = "";
	$horaInicio = "";
	$horaFin = "";
	$antesEvento = "";
	$duranteEvento = "";
	$despuesEvento = "";
	$observaciones = "";
	$status_id = "";
	$usuario_id="";
	
	/*Prepare Statement*/
	if ($stmt = $mysqlCon->prepare($querySolicitudUsuario)) {
		/*Asociacion de parametros*/
		$stmt->bind_param('i',$autorizadorId);

		if ($stmt->execute()){
			/*Almacenamos el resultSet*/
			$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $usuario_id);
			while($stmt->fetch()) {
				$tmp = array();

				$tmp["solicitud_id"] = $solicitud_id;
				$tmp["nombre"] = $nombre;
				$tmp["apellidos"] = $apellidos;
				$tmp["email"] =$email;
				$tmp["edificio"] =$edificio;
				$tmp["sala"] =$sala;
				$tmp["fechaTrabajo"] =$fechaTrabajo;
				$tmp["horaInicio"] =$horaInicio;
				$tmp["horaFin"] =$horaFin;
				$tmp["antesEvento"] =$antesEvento;
				$tmp["duranteEvento"] =$duranteEvento;
				$tmp["despuesEvento"] =$despuesEvento;
				$tmp["observaciones"] =$observaciones;
				$tmp["status_id"] =$status_id;
				$tmp["usuario_id"] =$usuario_id;

				array_push($jsondata["data"], $tmp);
			}

			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesUsuario",$querySolicitudUsuario,$autorizadorId,null,"query.log");
			$jsondata["success"] = true;

		}else{
			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudesUsuario",$querySolicitudUsuario,$autorizadorId,$mysqlCon->error,"errores.log");
			$jsondata["success"] = false;
			$jsondata["message"] ="No se ha ejecutado la consulta.";
		}
	}
}

function recuperaSolicitudesGestor(){
	global $querySolicitudGestor,$mysqlCon,$jsondata;

	$solicitud_id = "";
	$nombre = "";
	$apellidos = "";
	$email = "";
	$edificio = "";
	$sala = "";
	$fechaTrabajo = "";
	$horaInicio = "";
	$horaFin = "";
	$antesEvento = "";
	$duranteEvento = "";
	$despuesEvento = "";
	$observaciones = "";
	$status_id = "";
	$usuario_id="";
	
	/*Prepare Statement*/
	if ($stmt = $mysqlCon->prepare($querySolicitudGestor)) {
		/*Asociacion de parametros*/
		if ($stmt->execute()){
			/*Almacenamos el resultSet*/
			$stmt->bind_result($solicitud_id, $nombre, $apellidos, $email, $edificio, $sala, $fechaTrabajo, $horaInicio, $horaFin, $antesEvento, $duranteEvento, $despuesEvento, $observaciones, $status_id, $usuario_id);
			while($stmt->fetch()) {

				$tmp = array();
	
				$tmp["solicitud_id"] = utf8_encode($solicitud_id);
				$tmp["nombre"] = utf8_encode($nombre);
				$tmp["apellidos"] = utf8_encode($apellidos);
				$tmp["email"] = utf8_encode($email);
				$tmp["edificio"] = utf8_encode($edificio);
				$tmp["sala"] = utf8_encode($sala);
				$tmp["fechaTrabajo"] = utf8_encode($fechaTrabajo);
				$tmp["horaInicio"] = utf8_encode($horaInicio);
				$tmp["horaFin"] = utf8_encode($horaFin);
				$tmp["antesEvento"] = utf8_encode($antesEvento);
				$tmp["duranteEvento"] = utf8_encode($duranteEvento);
				$tmp["despuesEvento"] = utf8_encode($despuesEvento);
				$tmp["observaciones"] = utf8_encode($observaciones);
				$tmp["status_id"] = utf8_encode($status_id);
				$tmp["usuario_id"] = utf8_encode($usuario_id);
	
				array_push($jsondata["data"], $tmp);
			}
	
			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudes",$querySolicitudGestor,null,null,"query.log");
			$jsondata["success"] = true;
	
		}else{
	
			$stmt->close();
			escribirLog("select/sSolicitud.php","recuperaSolicitudes",$querySolicitudGestor,null,$mysqlCon->error,"errores.log");
			$jsondata["success"] = false;
			$jsondata["message"] ="No se ha ejecutado la consulta.";
	
		}
	}
	
}
?>