<?php

include '../../utiles/connectDBUtiles.php';

	$DepartamentosQuery = "SELECT departamento.DEPARTAMENTO_ID, departamento.DEPARTAMENTOS_DESC,departamento.CECO,departamento.VISUALIZACION FROM departamento inner join usuariodepartamento on usuariodepartamento.departamento_id = departamento.departamento_id where departamento.markfordelete = 0 and usuariodepartamento.usuario_id = ?";
	$DepartamentoSolicitudQuery = "SELECT departamento.DEPARTAMENTO_ID, departamento.DEPARTAMENTOS_DESC,departamento.CECO,departamento.VISUALIZACION FROM departamento inner join solicitudes on solicitudes.departamento_id = departamento.departamento_id where departamento.markfordelete = 0 and solicitudes.solicitud_id = ?";
	
	$usuario = "";
	$solicitud = "";
	
	/*Recuperamos la request*/
	if( isset($_GET['usuario'])) {
		$usuario = utf8_decode($_GET['usuario']);
	}
	
	/*Recuperamos la request*/
	if( isset($_GET['solicitud'])) {
		$solicitud = utf8_decode($_GET['solicitud']);
	}
	
	if ($solicitud==""){
		/*Realizamos la llamada a la funcion que devolvera los departamentos*/
		recuperamosDepartamentos($usuario);
	}else{
		recuperamosDepartamentoSolicitud($usuario,$solicitud);
	}
	
	
	/*Funcion que recupera todos los departamentos*/
	function recuperamosDepartamentos($usuario){
		
		/*Declaramos como global la conexion y la query*/
		global $mysqlCon,$DepartamentosQuery;
		
		/*definimos el json*/
		$jsondata = array();
		$jsondata["data"] = array();
		$departamento_id = "";
		$departamentos_desc ="";
		$ceco ="";
		$visualizacion ="";
		
		if ($stmt = $mysqlCon->prepare($DepartamentosQuery)) {
			/*Asociacion de parametros*/
				
			///echo $queryLogon . $usuario . $password;
				
			$stmt->bind_param('i',$usuario);
		
			if ($stmt->execute()){
				/*Almacenamos el resultSet*/
				//usuario_id, email, password, nombre, apellidos, role_id
				$stmt->bind_result($departamento_id, $departamentos_desc, $ceco, $visualizacion);
				while($stmt->fetch()) {
					$tmp = array();
						
					$tmp["departamento_id"] = $departamento_id;
					$tmp["departamentos_desc"] = utf8_decode($departamentos_desc);
					$tmp["ceco"] = $ceco;
					$tmp["visualizacion"] = utf8_decode($visualizacion);
					
					array_push($jsondata["data"], $tmp);
				}
					
				$stmt->close();
				
				if (count($jsondata["data"]) == 0){
					//echo "Es Zero";
					$jsondata["success"] = false;
					$jsondata["message"] ="No hay departamentos asociados";
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

	/*Funcion que recupera todos los departamentos*/
	function recuperamosDepartamentoSolicitud($usuario,$solicitud){
	
		/*Declaramos como global la conexion y la query*/
		global $mysqlCon,$DepartamentoSolicitudQuery;
	
		/*definimos el json*/
		$jsondata = array();
		$jsondata["data"] = array();
		$departamento_id = "";
		$departamentos_desc ="";
		$ceco ="";
		$visualizacion ="";
	
		if ($stmt = $mysqlCon->prepare($DepartamentoSolicitudQuery)) {
			/*Asociacion de parametros*/
	
			///echo $queryLogon . $usuario . $password;
	
			$stmt->bind_param('i',$solicitud);
	
			if ($stmt->execute()){
				/*Almacenamos el resultSet*/
				//usuario_id, email, password, nombre, apellidos, role_id
				$stmt->bind_result($departamento_id, $departamentos_desc, $ceco, $visualizacion);
				while($stmt->fetch()) {
					$tmp = array();
	
					$tmp["departamento_id"] = $departamento_id;
					$tmp["departamentos_desc"] = utf8_decode($departamentos_desc);
					$tmp["ceco"] = $ceco;
					$tmp["visualizacion"] = utf8_decode($visualizacion);
						
					array_push($jsondata["data"], $tmp);
				}
					
				$stmt->close();
	
				if (count($jsondata["data"]) == 0){
					//echo "Es Zero";
					$jsondata["success"] = false;
					$jsondata["message"] ="No hay departamentos asociados";
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