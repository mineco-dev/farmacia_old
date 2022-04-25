<?
	$myserver="server_appl";
	$myuser="rrhh_marcaje";
	$mypass="123456789";
	$mydb="reloj_marcaje";


$s=mssql_connect($myserver, $myuser,$mypass) or die ("no se pudo conectar al servidor $myserver");
$d=mssql_select_db($mydb, $s);

$query="mssql_query";
$fetch_array="mssql_fetch_array";
$close="mssql_close";

?>