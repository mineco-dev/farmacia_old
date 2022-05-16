<?
	session_start();
	
	require_once('../../connection/helpdesk.php'); 
					$consulta1="SELECT * FROM seg_visitante where codigo_visitante='$id'";
					$result1=$query($consulta1);	
					while($row1=$fetch_array($result1))
					{
						$nombre_visitante=$row1["nombre_visitante"];
					}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_dependencia.value == "0" && form.cbo_usuario.value =="0")
  { 
  	alert("Seleccione la dependencia o el nombre de la persona a donde se dirige"); 
	form.cbo_dependencia.focus(); 
	return;
 }
  if (form.cbo_motivo.value == "0")
  { 
  	alert("Indique el motivo de la visita, si no aparece seleccione OTRO y especifique"); 
	form.cbo_motivo.focus(); 
	return;
 }
   if (form.chk_arma.value == "1" && form.txt_casillero=="")
  { 
  	alert("Escriba el número de casillero donde deposito el arma"); 
	form.txt_casillero.focus(); 
	return;
 }
  if (form.txt_gafete.value == "")
  { 
  	alert("Escriba el N�mero de gafete proporcionado"); 
	form.txt_gafete.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_dependencia.focus(); 
}
</script>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
<style>
<!--
.bodyplainwhite { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: 98A2AB; font-weight: normal }
.bodyplain { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: #000000; font-weight: normal}
.credit { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; font-style: normal; color: #CCCCCC; font-weight: bold ; text-decoration: none }
-->
</style>



</head>

<body>

<div align="left">
  <table width="100%" border="0">
    <tr>
      <td><div align="center">Registro de visitas </div></td>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="gregistrar_visita.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td colspan="9">Datos Generales de la visita 
      <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>"></td>
    </tr>
    <tr>
      <td width="10%">Visitante:</td>
      <td colspan="8"><? echo $nombre_visitante; ?>	  </td>
    </tr>
    <tr>
      <td colspan="9" align="left" class="alt1">
	  <?					
					$consulta="SELECT * FROM dependencia ORDER BY nombre_dependencia";
					$result=$query($consulta);	
					echo('<select name="cbo_dependencia">');
					$nombre=":: Dependencia ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=$fetch_array($result))
					{
						echo'<option value="'.$row["codigo_dependencia"].'">'.$row["nombre_dependencia"].'</option>';
					}
					echo('</select>');					
				?>	    </td>
    </tr>
    <tr>
      <td colspan="9" align="left" class="alt1"><?					
					$consulta2="SELECT * FROM usuario WHERE activo=1 ORDER BY nombres";
					$result2=mssql_query($consulta2);	
					echo('<select name="cbo_usuario">');
					$nombre2=":: Nombre de usuario ::";
					echo'<option value="0">'.$nombre2.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_usuario"].'">'.$row2["nombres"].' '.$row2["apellidos"].'</option>';
					}
					echo('</select>');						
				?></td>
    </tr>
    <tr>
      <td colspan="9" align="left" class="alt1"><?
					$consulta3="SELECT * FROM seg_motivo_visita where activo=1 ORDER BY motivo_visita";
					$result3=$query($consulta3);	
					echo('<select name="cbo_motivo">');
					$nombre3=":: Motivo de la visita ::";
					echo'<option value="0">'.$nombre3.'</option>';
					while($row3=$fetch_array($result3))
					{
						echo'<option value="'.$row3["codigo_motivo"].'">'.$row3["motivo_visita"].'</option>';
					}
					echo('</select>');					
				?></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Especif&iacute;que: </td>
      <td colspan="8" align="left" class="alt1"><textarea name="txt_especifique" cols="40" id="txt_especifique"></textarea></td>
    </tr>
    <tr>
      <td align="left" class="alt1">No. gafete: </td>
      <td width="8%" align="left" class="alt1"><input name="txt_gafete" type="text" id="txt_gafete" size="10"></td>
      <td width="11%" align="left" class="alt1">Porta arma?</td>
      <td width="4%" align="left" class="alt1"><input name="chk_arma" type="checkbox" id="chk_arma" value="1"></td>
      <td width="7%" align="left" class="alt1">Casillero:</td>
      <td width="6%" align="left" class="alt1"><input name="txt_casillero" type="text" id="txt_casillero" size="5"></td>
      <td colspan="3" align="left" class="alt1">&nbsp;</td>
    </tr>
    <tr>
    <td align="left" class="alt1"><span class="alt2">   
   <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Enviar solicitud">
  </span></td>
      <td colspan="5" align="left" class="alt1"><span class="alt2">
      </span></td>
      <td align="left" class="alt1"><span class="alt2">
      </span><span class="alt2">
      </span></td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
