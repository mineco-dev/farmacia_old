<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="helpdesk.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	font-size: xx-large;
	color: #0000FF;
}
-->
</style>
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td><?
	$ip=$_SERVER['REMOTE_ADDR'];	
	phpinfo();
	$entro=0;
	$aceptado=1;
	$chico=$_REQUEST["cbo_chico"];
	$chica=$_REQUEST["cbo_chica"];
	require_once('../Connection/helpdesk.php'); 
	$query="SELECT * FROM simpatia WHERE ip='$ip'";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
		$aceptado=2;
		$mensaje="S�LO PUEDE VOTAR UNA VEZ";
	}	
	mssql_query($query);
	if ($aceptado==1)
	{
			$mensaje="SU VOTO ESTA SIENDO PROCESADO, GRACIAS POR PARTICIPAR";
			$query="INSERT INTO simpatia(ip, chico,chica) values ('$ip', '$chico', '$chica')";
			$result=mssql_query($query);	
			header("Location: popup2.php"); 
	}
	mssql_close($s);	
?></td>
  </tr>
  <tr>
    <td>
	  <div align="center"><span class="Estilo1">
	    <?
		echo $mensaje;
	?>
	    </span>
	    </div></td>
  </tr>
  <tr>
  </tr>
</table>
</body>
</html>
