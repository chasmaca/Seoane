<?php

function envioMailNuevo($id){

	//Variable Resultado
	$resultadoMail = false;
	
	// destinatario
	$para  = "chasmaca@gmail.com";

	// título
	$titulo = 'Se ha registrado una nueva solicitud de limpieza.';
	
	$mensaje = '<html>';
	$mensaje .= '<head>';
	$mensaje .= '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
	$mensaje .= '</head>';
	$mensaje .= '<body>';
	$mensaje .= '<div style="width:100%;height:20%;">';
	$mensaje .= '<header style="display:block; float:right; width:100%;">';
	$mensaje .= '<div class="header__logo">';
	$mensaje .= '<a href="http://www.limpiezasarosa.com/" target="_self" title="Limpiezas Arosa">';
	$mensaje .= '<img src=\"cid:logoimg\" />';
	$mensaje .= '</a> ';
	$mensaje .= '</div>';
	$mensaje .= '</header>';
	$mensaje .= '</div>';
	$mensaje .= '<br>';
	$mensaje .= '<hr class="separador_post" style="color: #DC5500;display: inline-block;position: relative;top: -0.7em;font-size: 1.5em;padding: 0 0.25em;background: white;"/>';
	$mensaje .= '<div style="width:100%;height:80%;">';
	$mensaje .= '<br>';
	$mensaje .= '<p>Buenos d&iacute;as:</p>';
	$mensaje .= '<p>Se ha recibido una nueva solicitud de limpieza procedente de la Universidad Francisco de Vitoria con id <b>'.$id.'</b></p>';
	$mensaje .= '<p>Por favor, acceda a la aplicaci&oacute;n para su gesti&oacute;n lo antes posible, pulsando <a href="http://www.limpiezasarosa.com/ufv/">AQUI</a>.</p>';
	$mensaje .= '<p>Gracias.</p>';
	$mensaje .= '<p>Por favor, no responda a este mensaje, esta direcci&oacute;n de e-mail s&oacute;lo se utiliza para realizar env&iacute;os.</p>';
	$mensaje .= '</div>';
	$mensaje .= '<br/><br/>';
	$mensaje .= '</body>';
	$mensaje .= '</html>';
	
	$resultadoMail = envioGenericoMail($para, null,$titulo, $mensaje);
	
	return $resultadoMail;
}

function enviaMailCambioEstado($destino,$cuerpo,$estado,$id){
	
	//Variable Resultado
	
	$resultadoMail = false;
	// destinatario
	$para  = $destino;
	$desde = "limpiezaarosa@gmail.com";
	// título
	
	$estadoLiteral = "";
	
	if ($estado==2){
		$estadoLiteral = "En Curso";
	}
	if ($estado==3){
		$estadoLiteral = "Aprobada";
	}
	
	if ($estado==4){
		$estadoLiteral = "Rechazada";
	}
	if ($estado==6){
		$estadoLiteral = "Cerrada";
	}
	
	$titulo = 'Se ha actualizado una nueva solicitud de limpieza.';

	$mensaje = '<html>';
	$mensaje .= '<head>';
	$mensaje .= '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
	$mensaje .= '</head>';
	$mensaje .= '<body>';
	$mensaje .= '<div style="width:100%;height:20%;">';
	$mensaje .= '<header style="display:block; float:right; width:100%;">';
	$mensaje .= '<div class="header__logo">';
	$mensaje .= '<a href="http://www.limpiezasarosa.com/" target="_self" title="Limpiezas Arosa">';
	$mensaje .= '<img src=\"cid:logoimg\" />';
	$mensaje .= '</a> ';
	$mensaje .= '</div>';
	$mensaje .= '</header>';
	$mensaje .= '</div>';
	$mensaje .= '<br>';
	$mensaje .= '<hr class="separador_post" style="color: #DC5500;display: inline-block;position: relative;top: -0.7em;font-size: 1.5em;padding: 0 0.25em;background: white;"/>';
	$mensaje .= '<div style="width:100%;height:80%;">';
	$mensaje .= '<br>';
	$mensaje .= '<p>Buenos d&iacute;as:</p>';
	$mensaje .= '<p>Se ha recibido una nueva actualizaci&oacute;n de limpieza procedente de la Universidad Francisco de Vitoria para la solicitud id <b>'.$id.'</b></p>';
	$mensaje .= '<p>El nuevo estado de la solicitud es <b>'.$estadoLiteral.'</b></p>';
	$mensaje .= '<p>Por favor, acceda a la aplicaci&oacute;n para su gesti&oacute;n lo antes posible, pulsando <a href="http://www.limpiezasarosa.com/ufv/">AQUI</a>.</p>';
	$mensaje .= '<p>Gracias.</p>';
	$mensaje .= '<p>Por favor, no responda a este mensaje, esta direcci&oacute;n de e-mail s&oacute;lo se utiliza para realizar env&iacute;os.</p>';
	$mensaje .= '</div>';
	$mensaje .= '<br/><br/>';
	$mensaje .= '</body>';
	$mensaje .= '</html>';

	$resultadoMail = envioGenericoMail($para, $desde,$titulo, $mensaje);
	
	return $resultadoMail;
}



function enviaMailCerrar($destino,$cuerpo,$id){
	
	$resultadoMail = false;
	// destinatario
	$para  = $destino;
	$desde = "limpiezaarosa@gmail.com";
	// título
	$mensaje = '<html>';
	$mensaje .= '<head>';
	$mensaje .= '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
	$mensaje .= '</head>';
	$mensaje .= '<body>';
	$mensaje .= '<div style="width:100%;height:20%;">';
	$mensaje .= '<header style="display:block; float:right; width:100%;">';
	$mensaje .= '<div class="header__logo">';
	$mensaje .= '<a href="http://www.limpiezasarosa.com/" target="_self" title="Limpiezas Arosa">';
	$mensaje .= '<img src=\"cid:logoimg\" />';
	$mensaje .= '</a> ';
	$mensaje .= '</div>';
	$mensaje .= '</header>';
	$mensaje .= '</div>';
	$mensaje .= '<br>';
	$mensaje .= '<hr class="separador_post" style="color: #DC5500;display: inline-block;position: relative;top: -0.7em;font-size: 1.5em;padding: 0 0.25em;background: white;"/>';
	$mensaje .= '<div style="width:100%;height:80%;">';
	$mensaje .= '<br>';
	$mensaje .= '<p>Buenos d&iacute;as:</p>';
	$mensaje .= '<p>Se ha recibido la notificaci&oacute;n de Cierre para la solicitud id <b>'.$id.'</b></p>';
	$mensaje .= '<p>Por favor, si desea m&aacute;s informaci&oacute;n acceda a la aplicaci&oacute;n para su gesti&oacute;n lo antes posible, pulsando <a href="http://www.limpiezasarosa.com/ufv/">AQUI</a>.</p>';
	$mensaje .= '<p>Ante cualquier duda pongase en contacto con nosotros..</p>';
	$mensaje .= '<p>Gracias.</p>';
	$mensaje .= '<p>Por favor, no responda a este mensaje, esta direcci&oacute;n de e-mail s&oacute;lo se utiliza para realizar env&iacute;os.</p>';
	$mensaje .= '</div>';
	$mensaje .= '<br/><br/>';
	$mensaje .= '</body>';
	$mensaje .= '</html>';

	$resultadoMail = envioGenericoMail($para, $desde,$titulo, $mensaje);
	
	return $resultadoMail;

}


function envioGenericoMail($para, $desde,$titulo, $mensaje){
	
	require '../../utiles/phpmailer/PHPMailerAutoload.php';

	date_default_timezone_set('Etc/UTC');
	
	try {
			
		$mail = new PHPMailer(); // create a new object
		//$mail->IsSMTP(); // enable SMTP Produccion
		$mail->isMail();
		//$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->SMTPSecure = 'tls';
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;//465; // or 587
		$mail->IsHTML(true);
		$mail->Username = "limpiezaarosa@gmail.com";
		$mail->Password = "Acceso01";
		$mail->SetFrom("limpiezaarosa@gmail.com");
		$mail->Subject = $titulo;
		$mail->Body = $mensaje;
		$mail->AddAddress($para);
		$mail->AddEmbeddedImage('../images/limpiezas-arosa.png', 'logoimg', 'limpiezas-arosa.png');
			
		if(!$mail->Send()) {
			return false;
// 			escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",$para,$desde,$mail->ErrorInfo,"erroresMail.log");
// 			$jsondata["success"] = $mail->ErrorInfo;
		} else {
			return true;
// 			escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",$para,$desde,null,"mailCorrecto.log");
// 			$jsondata["success"] = true;
		}
	} catch (Exception $e) {
		return false;
// 		escribirLog("update/uSolicitudPlantilla.php","actualizarSolicitud(cuerpo,destino)",$para,$desde,$mail->ErrorInfo,"erroresMail.log");
// 		$jsondata["success"] = $mail->ErrorInfo;
	}
	
}

?>