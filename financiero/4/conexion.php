<?php
function conectar()
{
//	mysql_connect("localhost", "root", "");
//	mysql_connect("localhost", "root", "kalki");
$hostname_redes = "server_appl";
$database_redes = "financiero";
$username_redes = "sa";
$password_redes = "sa";
//	mssql_connect("server_appl", "sa", "sa");
	$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
	mssql_select_db($database_redes,$conexion);
//	mssql_select_db("financiero",$conexion);
}

function desconectar()
{
	mssql_close();
}
?>