<?
	$hostname_cnn = "128.5.7.119";
	$database_cnn = "dae_boletin";
	$username_cnn = "mtdae";
	$password_cnn = "mtdae2009";

	$conexion = mysql_connect($hostname_cnn,$username_cnn,$password_cnn);
	print $conexion;
	mysql_select_db($database_cnn);
?>