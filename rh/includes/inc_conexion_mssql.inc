<?
	//session_start();
	
	$hostname_cnn = "nhernandez";
	$database_cnn = "rrhh";
	$username_cnn = "sa";
	$password_cnn = "sa";
	$conexion = mssql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mssql_select_db($database_cnn); 	
	

/*	
	$hostname_cnn = "server_appl";
	$database_cnn = "rrhh";
	$username_cnn = "rrhh";
	$password_cnn = "rrhh2009";
	$conexion = mssql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mssql_select_db($database_cnn); 	
*/

?>