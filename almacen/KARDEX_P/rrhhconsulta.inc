<?PHP
	$myserver="128.5.8.85";
	$myuser="farmacia";
	$mypass="DTIdesa@2K271.";
	$mydb="rrhh_farmacia";

$s=mssql_connect($myserver, $myuser,$mypass) or die ("no se pudo conectar al servidor $myserver");
$d=mssql_select_db($mydb, $s);
//variables para manejo de base de datos
$query="mssql_query";
$fetch_array="mssql_fetch_array";
$close="mssql_close";
?>