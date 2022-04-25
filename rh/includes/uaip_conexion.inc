<?
	$hostname_cnn = "server_appl";
	$database_cnn = "rrhh";
	$username_cnn = "consulta";
	$password_cnn = "consulta2009";
	$conexion = mssql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mssql_select_db($database_cnn);
?>

