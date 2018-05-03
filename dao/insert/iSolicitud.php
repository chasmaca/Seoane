<?php

session_start();

include_once("../../utiles/connectDBUtiles.php");
include_once("../../utiles/generaLog.php");
include_once("../../correos/envioMail.php");

date_default_timezone_set('Etc/UTC');



//Recuperamos los parametros
	if (isset($_GET['nombre'])){
	 	$nombre = utf8_decode(htmlspecialchars($_GET["nombre"]));	// Instructions if $_POST['value'] exist
	}else{
		$nombre = utf8_decode(htmlspecialchars($_POST["nombre"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['apellidos'])){
		$apellidos = utf8_decode(htmlspecialchars($_GET["apellidos"]));	// Instructions if $_POST['value'] exist
	}else{
		$apellidos = utf8_decode(htmlspecialchars($_POST["apellidos"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['email'])){
		$email = utf8_decode(htmlspecialchars($_GET["email"]));	// Instructions if $_POST['value'] exist
	}else{
		$email = utf8_decode(htmlspecialchars($_POST["email"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['edificio'])){
		$edificio = utf8_decode(htmlspecialchars($_GET["edificio"]));	// Instructions if $_POST['value'] exist
	}else{
		$edificio = utf8_decode(htmlspecialchars($_POST["edificio"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['sala'])){
		$sala = utf8_decode(htmlspecialchars($_GET["sala"]));	// Instructions if $_POST['value'] exist
	}else{
		$sala = utf8_decode(htmlspecialchars($_POST["sala"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['fecha'])){
		$fecha = utf8_decode(htmlspecialchars($_GET["fecha"]));	// Instructions if $_POST['value'] exist
	}else{
		$fecha = utf8_decode(htmlspecialchars($_POST["fecha"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['horaInicio'])){
		$horaInicio = utf8_decode(htmlspecialchars($_GET["horaInicio"]));	// Instructions if $_POST['value'] exist
	}else{
		$horaInicio = utf8_decode(htmlspecialchars($_POST["horaInicio"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['horaFin'])){
		$horaFin = utf8_decode(htmlspecialchars($_GET["horaFin"]));	// Instructions if $_POST['value'] exist
	}else{
		$horaFin = utf8_decode(htmlspecialchars($_POST["horaFin"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['tipoAntes'])){
		$tipoAntes = utf8_decode(htmlspecialchars($_GET["tipoAntes"]));	// Instructions if $_POST['value'] exist
	}else{
		$tipoAntes = utf8_decode(htmlspecialchars($_POST["tipoAntes"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['tipoDurante'])){
		$tipoDurante = utf8_decode(htmlspecialchars($_GET["tipoDurante"]));	// Instructions if $_POST['value'] exist
	}else{
		$tipoDurante = utf8_decode(htmlspecialchars($_POST["tipoDurante"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['tipoDespues'])){
		$tipoDespues = utf8_decode(htmlspecialchars($_GET["tipoDespues"]));	// Instructions if $_POST['value'] exist
	}else{
		$tipoDespues = utf8_decode(htmlspecialchars($_POST["tipoDespues"]));	// Instructions if $_POST['value'] exist
	}

	if (isset($_GET['descripcion'])){
		$descripcion = utf8_decode(htmlspecialchars($_GET["descripcion"]));	// Instructions if $_POST['value'] exist
	}else{
		$descripcion = utf8_decode(htmlspecialchars($_POST["descripcion"]));	// Instructions if $_POST['value'] exist
	}
	
	if (isset($_GET['departamento'])){
		$departamento = utf8_decode(htmlspecialchars($_GET["departamento"]));	// Instructions if $_POST['value'] exist
	}else{
		$departamento = utf8_decode(htmlspecialchars($_POST["departamento"]));	// Instructions if $_POST['value'] exist
	}

	

	
	//Definicion de variables
	global $mysqlCon;
	$jsondata = "";
	$autorizadorId = $_SESSION["userId_session"];

	$sqlInsercion = "INSERT INTO solicitudes
								(nombre,apellidos,
								 email,edificio,sala,
								 fechaTrabajo,horaInicio,horaFin,
								 antesEvento,duranteEvento,despuesEvento,
								 observaciones, status_id, usuario_id,departamento_id) values
								(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	$sqlInsercionComunicacion = "INSERT INTO comunicaciones
								(solicitud_id,fecha,hora,remitente,destinatario,email) values
								(?,?,?,?,?,?)";

	//Llamada a la función (Se hace asi, para poder reutilizar la 
	//clase de cara al futuro en caso de necesitarlo, para tener aislada la acción y no interferir en el funcionamiento
	guardarDatos();


    function guardarDatos(){

        global $sqlInsercion, $mysqlCon,$sqlInsercionComunicacion,$nombre,$apellidos,$email,$edificio,$sala,$fecha,$horaInicio,$horaFin,$tipoAntes,$tipoDurante,$tipoDespues,$descripcion,$jsondata,$stmt, $autorizadorId,$departamento;

        
        $jsondata["success"] = true;
        $statusNueva = 1;
       
        if ($tipoAntes == 'true'){
        	$tipoAntes = 1;
        }else {
        	$tipoAntes = 0;
        }
        
        if ($tipoDurante == 'true'){
        	$tipoDurante = 1;
        }else {
        	$tipoDurante = 0;
        }
        
        if ($tipoDespues == 'true'){
        	$tipoDespues = 1;
        }else {
        	$tipoDespues = 0;
        }
        

        $fechaArray = explode("/", $fecha);
        
        $fecha = $fechaArray[2]."-".$fechaArray[1]."-".$fechaArray[0]." 00:00:00";
                				
        if ($stmt = $mysqlCon->prepare($sqlInsercion)) {
        	$stmt->bind_param('ssssssssiiisiii',$nombre,$apellidos,$email,$edificio,$sala,$fecha,$horaInicio,$horaFin,$tipoAntes,$tipoDurante,$tipoDespues,$descripcion,$statusNueva, $autorizadorId,$departamento);
        	if ($stmt->execute()){
          		$last_id = $stmt->insert_id;

        		$parametros = $last_id.",".$nombre.",".$apellidos.",".$email;
        		escribirLog("insert/iSolicitud.php","insertarSolicitud",$sqlInsercion,$parametros,null,"inserciones.log");
        		
        		
        		$destino = "chasmaca@gmail.com";
        		$fechaCorreo = date("Y-m-d");
        		$horaCorreo = date("H:i:s");
        		$emailTexto ="Se ha generado la solicitud número " .$last_id . " con la solicitud de limpieza por parte de " .$nombre . " " . $apellidos;

        		$parametrosComunicacion = $last_id.",".$fechaCorreo.",".$horaCorreo.",".$email.",".$destino.",".$emailTexto;
        		
        		if ($stmt = $mysqlCon->prepare($sqlInsercionComunicacion)) {

        			$stmt->bind_param('isssss',$last_id,$fechaCorreo,$horaCorreo,$email,$destino,$emailTexto);
        			 
        			if ($stmt->execute()){
        				$resultadoMail = envioMailNuevo($last_id);
        				 
        				if ($resultadoMail){
        					escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"mailCorrecto.log");
        					$jsondata["success"] = true;
        				
        				}else {
        					escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",null,null,null,"erroresMail.log");
        					$jsondata["success"] = false;
        				
        				}
        				escribirLog("insert/iSolicitud.php","insertarComunicacion",$sqlInsercionComunicacion,$parametrosComunicacion,null,"inserciones.log");
        				$jsondata["success"] = true;
        				
        			}else{
        				escribirLog("insert/iSolicitud.php","insertarComunicacion",$sqlInsercionComunicacion,$parametrosComunicacion,$mysqlCon->error,"errores.log");
        			}
        		
        		}else{
        			escribirLog("insert/iSolicitud.php","insertarComunicacion",$sqlInsercionComunicacion,$parametrosComunicacion,$mysqlCon->error,"errores.log");
        			$jsondata["success"] = false;
        		}
        	}else{
        		$parametros = $nombre.",".$apellidos.",".$email.",".$edificio.",".$sala.",".$fecha.",".$horaInicio.",".$horaFin.",".$tipoAntes.",".$tipoDurante.",".$tipoDespues.",".$descripcion.",".$statusNueva.",". $autorizadorId;
        		escribirLog("insert/iSolicitud.php","insertarSolicitud",$sqlInsercion,$parametros,$mysqlCon->error,"errores.log");
        		$jsondata["success"] = false;
        	}
        } else {
        	$parametros = $nombre.",".$apellidos.",".$email.",".$edificio.",".$sala.",".$fecha.",".$horaInicio.",".$horaFin.",".$tipoAntes.",".$tipoDurante.",".$tipoDespues.",".$descripcion.",".$statusNueva.",". $autorizadorId;
        	escribirLog("insert/iSolicitud.php","insertarSolicitud",$sqlInsercion,$parametros,$mysqlCon->error,"errores.log");
        	$jsondata["success"] = false;
        }

        header('Content-type: application/json; charset=utf-8');
    	echo json_encode($jsondata, JSON_FORCE_OBJECT);

    }



?>