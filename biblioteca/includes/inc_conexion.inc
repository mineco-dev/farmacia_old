<?
	$hostname_cnn = "localhost";
	$database_cnn = "biblioteca";
	$username_cnn = "sa";
	$password_cnn = "Sup3rus3r2009";
	$conexion = mssql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mssql_select_db($database_cnn);

?>