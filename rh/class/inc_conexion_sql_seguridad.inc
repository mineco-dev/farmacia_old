<?
	//session_start();
	
	$hostname_cnn = "ALMACEN-PC\DEV";
	$database_cnn = "helpdesk";
	$username_cnn = "sa";
	$password_cnn = "abc123";
	$conexion = mssql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mssql_select_db($database_cnn);
?>