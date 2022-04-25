<?
$hostname_redes = "server_appl";
$database_redes = "SIGRH";
$username_redes = "rrhh2012";
$password_redes = "123456789";
$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);
?>