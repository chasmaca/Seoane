<?php

$mysqlCon = new mysqli("localhost:3306", "root", "", "seoane");
//$mysqlCon = new mysqli("host2123.digitalvalley.com", "usuarioufv", "Acceso01", "arosa_universidad");

// Check connection
if (!$mysqlCon) {
	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

?>