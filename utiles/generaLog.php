<?php 
function escribirLog($fichero,$metodo,$query,$parametros,$error,$ficheroDestino){

	$ficheroLog = "../../log/".$ficheroDestino;
	
	$log  =
	"Fichero: ".$fichero.PHP_EOL.
	"Metodo: ".$metodo.PHP_EOL.
	"Query: ".$query.PHP_EOL.
	"Parametros: ".$parametros.PHP_EOL.
	"Message: ".$error.PHP_EOL.
	"-------------------------".PHP_EOL;
	
	error_log($log, 3, $ficheroLog);

}
?>