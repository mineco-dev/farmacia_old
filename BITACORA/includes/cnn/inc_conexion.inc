<?
$hostname_redes = "server_appl";
$database_redes = "helpdesk";
$username_redes = "bitacora";
$password_redes = "bitacora";
$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);
?>