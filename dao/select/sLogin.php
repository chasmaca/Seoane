<?php
session_start();

include '../../utiles/connectDBUtiles.php';

$queryLogon = "SELECT usuario_id, email, password, nombre, apellidos, role_id from usuarios where email = ? and password = ?";

/*Definimos las variables*/
$usuario = "";
$password = "";

/*Recuperamos la request*/
if( isset($_POST['usuario'])) {
	$usuario = utf8_decode($_POST['usuario']);
}

/*Recuperamos la request*/
if( isset($_POST['password'])) {
	$password = utf8_decode($_POST['password']);
}else{
	$password ="NOOOO";
}

/*Realizamos la llamada a la funcion*/
if ($usuario != "" && $password != "")
	recuperaUsuario($usuario,$password);

	function recuperaUsuario($usuario,$password){
	
		global $queryLogon,$mysqlCon;
	
		$usuario_id = "";
		$email = "";
		$nombre = "";
		$apellidos = "";
		$role_id = "";

		/*definimos el json*/
		$jsondata = array();
		$jsondata["data"] = array();

		/*Prepare Statement*/
		if ($stmt = $mysqlCon->prepare($queryLogon)) {
			/*Asociacion de parametros*/
			
			///echo $queryLogon . $usuario . $password;
			
			$stmt->bind_param('ss',$usuario,$password);

			if ($stmt->execute()){
				/*Almacenamos el resultSet*/
				//usuario_id, email, password, nombre, apellidos, role_id
				$stmt->bind_result($usuario_id, $email, $password, $nombre, $apellidos, $role_id);
				while($stmt->fetch()) {		
					$tmp = array();
					
					$tmp["usuario_id"] = $usuario_id;
					$tmp["email"] = $email;
					$tmp["password"] = $password;
					$tmp["nombre"] = utf8_decode($nombre);
 					$tmp["apellidos"] = utf8_decode($apellidos);
					$tmp["role_id"] = $role_id;
					
					$_SESSION["role_session"] = $role_id;
					$_SESSION["userId_session"] = $usuario_id;
					
					array_push($jsondata["data"], $tmp);
				}

				$stmt->close();

				if (count($jsondata["data"]) == 0){
					//echo "Es Zero";
					$jsondata["success"] = false;
					$jsondata["message"] ="El usuario no existe.";
				}else{
					//echo "Es Mayor de Zero";
					$jsondata["success"] = true;
				}

			}else{
				$stmt->close();
				$jsondata["success"] = false;
				$jsondata["message"] ="No se ha ejecutado la consulta.";
			}
		}

		/*Devolvemos el JSON con los datos de la consulta*/
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata, JSON_FORCE_OBJECT);
	}

?>