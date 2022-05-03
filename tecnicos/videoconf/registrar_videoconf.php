<?
	//retorna contenido de los objetos de los dos formularios anteriores.
	session_start();	
	$cbo_usuario=($_SESSION["cbo_usuario"]);	 
	$salon=($_SESSION["salon"]);   	
	$dia=($_SESSION["dia"]);   	
	$mes=($_SESSION["mes"]);   	
	$anio=($_SESSION["anio"]);   	
	$inicia=($_SESSION["inicia"]);   	
	$finaliza=($_SESSION["finaliza"]);   	
	$comentario=($_SESSION["detalle"]);  	
	require_once('../../connection/helpdesk.php'); 
		$consulta1="SELECT * FROM usuario where codigo_usuario='$cbo_usuario'";
		$result1=$query($consulta1);	
		while($row1=$fetch_array($result1))
		{
			$nombre_solicitante=$row1["nombres"]." ".$row1["apellidos"];
		}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{   
  if (form.cbo_destino.value == "0")
  { 
  	alert("Seleccione el destino de la conexión, sino existe seleccione OTRO y descr�balo brevemente en el campo de la derecha"); 
	form.cbo_destino.focus(); 
	return;
  } 
  if ((form.cbo_destino.value == "1") && (form.txt_destino.value == ""))
  { 
  	alert("Describa hacia donde es la conexión o seleccione un destino en el combo de la izquierda"); 
	form.txt_destino.focus(); 
	return;
  }
if (form.cbo_tipo_conexion.value == "0")
  { 
  	alert("Seleccione el tipo de conexión"); 
	form.cbo_tipo_conexion.focus(); 
	return;
 }
 if (form.txt_asistentes.value == "")
  { 
  	alert("Ingrese la cantidad de asistentes dentro del sal�n"); 
	form.txt_asistentes.focus(); 
	return;
 }
 form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_destino.focus(); 
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
      <td><div align="left">Informaci&oacute;n general de la videoconferencia </div></td>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="gregistrar_videoconf.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td width="106">Solicitante:</td>
      <td colspan="7"><? echo $nombre_solicitante; ?>	  </td>
    </tr>
    <tr>
      <td align="left" class="alt1">Fecha:</td>
      <td colspan="7" align="left" class="alt1">
	  <?
	  		echo $dia."/".$mes."/".$anio." de ".$inicia.":00 a ".$finaliza.":00 horas";		
	  ?>	  
	  </td>
    </tr>
    <tr>
      <td align="left" class="alt1">Destino conexi&oacute;n</td>
      <td align="left" class="alt1"><?
					require_once('../../connection/helpdesk.php'); 
					$query2="SELECT * FROM videoconf_destino ORDER BY destino";
					$result2=mssql_query($query2);	
					echo('<select name="cbo_destino">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_destino"].'">'.$row2["destino"].'</option>';
					}
					echo('</select>');				
					mssql_close($s);					
				?></td>
      <td colspan="6" align="left" class="alt1">Otro: 
        <input name="txt_destino" type="text" id="txt_destino"></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Tipo de conexi&oacute;n</td>
      <td width="100" align="left" class="alt1"><select name="cbo_tipo_conexion" id="cbo_tipo_conexion">
        <option value="0" selected>- Seleccione -</option>
        <option value="1">IP</option>
        <option value="2">ISDN</option>
      </select></td>
      <td width="85" align="left" class="alt1"># asistentes:</td>
      <td width="645" colspan="5" align="left" class="alt1"><input name="txt_asistentes" type="text" id="txt_asistentes" size="5"></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Observaciones:</td>
      <td colspan="7" align="left" class="alt1"><textarea name="textfield" cols="40"><? echo $comentario; ?></textarea></td>
    </tr>
    <tr>
      <td align="left" class="alt1"><span class="alt2">
        <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Continuar...">
      </span></td>
      <td colspan="7" align="left" class="alt1">&nbsp;</td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
