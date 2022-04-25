<?
$hostname_redes = "128.5.6.5";
$database_redes = "CIE";
$username_redes = "MRuiz";
$password_redes = "matias";
//$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
//mssql_select_db($database_redes,$conexion);
$link=mssql_connect("128.5.6.5","MRuiz","matias");
mssql_select_db("CIE",$link);
?>