<?
	require_once('../Connection/helpdesk.php'); 
	$query="SELECT COUNT(codigo) AS votos FROM simpatia WHERE (chico = 1)";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
		$alex=$row["votos"];
	}	
	$query="SELECT COUNT(codigo) AS votos FROM simpatia WHERE (chico = 2)";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
		$milton=$row["votos"];
	}	
	$query="SELECT COUNT(codigo) AS votos FROM simpatia WHERE (chico = 3)";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
		$joaquin=$row["votos"];
	}	
	$query="SELECT COUNT(codigo) AS votos FROM simpatia WHERE (chica = 1)";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
		$linda=$row["votos"];
	}	
	$query="SELECT COUNT(codigo) AS votos FROM simpatia WHERE (chica = 2)";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
		$diana=$row["votos"];
	}	
	$query="SELECT COUNT(codigo) AS votos FROM simpatia WHERE (chica = 3)";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
		$julissa=$row["votos"];
	}	
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo1 {font-size: xx-large}
.Estilo3 {color: #0000FF}
.Estilo4 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo5 {color: #FFFFFF}
.Estilo8 {color: #000000}
-->
</style>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_chico.value == "0")
  { 
  	alert("Seleccione el nombre del chico de su simpatia"); 
	form.cbo_chico.focus(); 
	return;
  }
 if (form.cbo_chica.value == "0")
  { 
  	alert("Seleccione el nombre de la chica de su simpatia"); 
	form.cbo_chica.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_chico.focus(); 
}
</script>
</head>

<body>
<form name="form1" method="post" action="gpopup2.php">
  <table width="100%" border="5" bordercolor="#FFFFFF">
    <tr bgcolor="#00CC99">
      <td colspan="7"><div align="center" class="Estilo4">GRACIAS POR TU PARTICIPACI&Oacute;N</div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="11%"><div align="center">
          <p class="Estilo1 Estilo3"><img src="imagenes/alex.jpg" width="101" height="106"></p>
      </div></td>
      <td width="14%"><div align="center"><img src="imagenes/milton.jpg" width="92" height="108"></div></td>
      <td width="14%"><div align="center"><img src="imagenes/joaquin.jpg" width="97" height="113"></div></td>
      <td width="12%"><p align="center" class="Estilo1 Estilo5"><img src="imagenes/linda.jpg" width="110" height="109"></p></td>
      <td width="12%"><img src="imagenes/diana.jpg" width="113" height="109"></td>
      <td width="23%" colspan="2"><div align="center"><img src="imagenes/julissa.jpg" width="100" height="107"></div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td><div align="center">Alexi L&oacute;pez -Inform&aacute;tica-</div></td>
      <td><div align="center">Milt&oacute;n Rold&aacute;n MIPYME</div></td>
      <td><div align="center">Joaquin Zarce&ntilde;o -DACE-</div></td>
      <td><div align="center">Linda Cristales -Financiero-</div></td>
      <td><div align="center">Diana Villatoro -MIPYME- </div></td>
      <td colspan="2"><div align="center">Julissa Felipe -DACE-</div></td>
    </tr>
    <tr bgcolor="#000000">
      <td width="11%"><div align="center" class="Estilo5"><? echo $alex ?> Votos obtenidos </div></td>
      <td><div align="center" class="Estilo5"><? echo $milton ?> Votos obtenidos</div></td>
      <td><div align="center" class="Estilo5"><? echo $joaquin ?> Votos obtenidos</div></td>
      <td width="12%"><div align="center" class="Estilo5"><? echo $linda ?> Votos obtenidos</div></td>
      <td><div align="center" class="Estilo5"><? echo $diana ?> Votos obtenidos</div></td>
      <td colspan="2"><div align="center" class="Estilo5"><? echo $julissa ?> Votos obtenidos</div></td>
    </tr>
    <tr bgcolor="#00CC99">
      <td colspan="7"><div align="center">
          <p class="Estilo8">SONDEO para pre-elecci&oacute;n de MISS-MR simpatia 2006-2007, EDIFICIO CENTRAL </p>
          <p class="Estilo5"><span class="Estilo8"><strong>Gracias por utilizar &eacute;sta p&aacute;gina, es para brindarte un mejor servicio!! </strong></span></p>
          </div></td>
    </tr>
  </table>
</form>
</body>
</html>
