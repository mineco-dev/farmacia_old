<?
	session_start();
	
	$hostname_cnn = "nhernandez";
	$database_cnn = "rrhh";
	$username_cnn = "sa";
	$password_cnn = "sa";

	$conexion = mysql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mysql_select_db($database_cnn);
?>