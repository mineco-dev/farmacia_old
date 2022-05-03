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
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo1 {font-size: xx-large}
.Estilo2 {font-size: large}
.Estilo3 {color: #0000FF}
.Estilo4 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo5 {color: #FFFFFF}
.Estilo7 {font-size: 12px}
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
    <tr bgcolor="#69696B">
      <td colspan="7"><div align="center" class="Estilo4">QUEREMOS SABER TU OPINION INICIAL </div></td>
    </tr>
    <tr>
      <td width="11%" bgcolor="#CCCCCC"><div align="center">
          <p class="Estilo1 Estilo3"><img src="imagenes/alex.jpg" width="101" height="106"></p>
      </div></td>
      <td width="14%" bgcolor="#CCCCCC"><div align="center"><img src="imagenes/milton.jpg" width="92" height="108"></div></td>
      <td width="14%" bgcolor="#CCCCCC"><div align="center"><img src="imagenes/joaquin.jpg" width="97" height="113"></div></td>
      <td width="12%" bgcolor="#CCCCCC"><p align="center" class="Estilo1 Estilo5"><img src="imagenes/linda.jpg" width="110" height="109"></p></td>
      <td width="12%" bgcolor="#CCCCCC"><img src="imagenes/diana.jpg" width="113" height="109"></td>
      <td colspan="2" bgcolor="#CCCCCC"><div align="center"><img src="imagenes/julissa.jpg" width="100" height="107"></div></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><div align="center">Alexi L&oacute;pez</div></td>
      <td bgcolor="#CCCCCC"><div align="center">Milt&oacute;n Rold&aacute;n</div></td>
      <td bgcolor="#CCCCCC"><div align="center">Joaquin Zarce&ntilde;o </div></td>
      <td bgcolor="#CCCCCC"><div align="center">Linda Cristales</div></td>
      <td bgcolor="#CCCCCC"><div align="center">Diana Villatoro </div></td>
      <td colspan="2" bgcolor="#CCCCCC"><div align="center">Julissa Felipe </div></td>
    </tr>
    <tr>
      <td width="11%" bgcolor="#CCCCCC"><div align="center">Votos (<? echo $alex ?>)</div></td>
      <td bgcolor="#CCCCCC"><div align="center">Votos (<? echo $milton ?>)</div></td>
      <td bgcolor="#CCCCCC"><div align="center">Votos (<? echo $joaquin ?>)</div></td>
      <td width="12%" bgcolor="#CCCCCC"><div align="center">Votos (<? echo $linda ?>)</div></td>
      <td bgcolor="#CCCCCC"><div align="center">Votos (<? echo $diana ?>)</div></td>
      <td colspan="2" bgcolor="#CCCCCC"><div align="center">Votos (<? echo $julissa ?>)</div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#CCCCCC">CHICO SIMPATIA
          <select name="cbo_chico" id="select">
            <option value="0">-- Seleccione --</option>
            <option value="1">Alexi L&oacute;pez</option>
            <option value="2">Milt&oacute;n Rold&aacute;n</option>
            <option value="3">Joaquin Zarce&ntilde;o</option>
            <option value="4">Ninguno</option>
        </select>
      </td>
      <td colspan="3" bgcolor="#CCCCCC">
        <div align="left">CHICA SIMPATIA:
            <select name="cbo_chica" id="select4">
              <option value="0">-- Seleccione --</option>
              <option value="1">Linda Cristales</option>
              <option value="2">Diana Villatoro</option>
              <option value="3">Julissa Felipe</option>
              <option value="4">Ninguna</option>
          </select>
      </div></td>
      <td width="23%" bgcolor="#CCCCCC"><input name="bt_votar" type="button" onClick="Validar(this.form)" id="bt_votar" value="Votar"></td>
    </tr>
    <tr bgcolor="#666666">
      <td colspan="7"><div align="center">
          <p class="Estilo5">SONDEO para elecci&oacute;n de mr-miss simpatia</p>
          <p class="Estilo5"><strong>Gracias por utilizar &eacute;sta p&aacute;gina, es para brindarte un mejor servicio</strong><strong>!! </strong></p>
          </div></td>
    </tr>
  </table>
</form>
</body>
</html>
