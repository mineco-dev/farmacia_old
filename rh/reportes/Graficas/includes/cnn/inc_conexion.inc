<?
$hostname_redes = "server_appl";
$database_redes = "informacion";
$username_redes = "mtdba";
$password_redes = "mtdba0411$";
$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);
?>