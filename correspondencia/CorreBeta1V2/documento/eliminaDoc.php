




<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url();
}
.Estilo2 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #FFFFFF;
}
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo8 {color: #FFFFFF}
-->

</style>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<?
session_start();
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 

		$SQL = "delete from tmp_doc_adj where da = $da";
		$result = mysql_query($SQL);
		// hasta aca inserto el archivo ahora le voy a poner nombre para q jamas se repita

		
		
/**************graba el seguimiento real del sistema**************************************************************************************************/

		$usuario = $_SESSION['codigoUsuario'];
		$fecha0 = date("Y-m-d");
		 $hora0 = date("H:i:s");
		$SQL210 = "INSERT INTO bitaSeg(docu,usuario,hora,fecha,descr) values ($docu,$usuario,'$hora0','$fecha0','Este archivo fue eliminado antes de enviarlo!! $nombreDoc')";
		$result210 = mysql_query($SQL210); // ingreso de documento
		$row210 = mysql_fetch_row($result210);
/****************************************************************************************************************/		
		mysql_close($db);
		
		
		
	header("location: documento.php?docu=$docu");
	?> 
		