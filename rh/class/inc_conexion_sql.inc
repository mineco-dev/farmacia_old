<?
	session_start();
	
	$hostname_cnn = "ALMACEN-PC\DEV";
	$database_cnn = "rrhh";
	$username_cnn = "sa";
	$password_cnn = "abc123";

	$conexion = mysql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mysql_select_db($database_cnn);
?>