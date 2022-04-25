

<?php

	/* CONFIGURACION DE PARAMETROS GENERALES DE CONEXION */
	$SERVIDOR="localhost";
	$BASE_DATOS="dtmineco";
	$USUARIO="";
	$PASSWORD="";	
	
	$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
	mysql_select_db($BASE_DATOS,$db);
	
?>
