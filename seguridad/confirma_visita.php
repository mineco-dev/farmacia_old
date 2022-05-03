<?		
$grupo_id=2; // Para agentes de seguridad 
include("../restringir.php");	
?>
<?	
	$id=($_SESSION["visita"]);
	$dependencia=($_SESSION["dependencia_temp"]);
	$visitado=($_SESSION["visitado"]);
	$visitante=($_SESSION["visitante"]);			
	require_once('../connection/helpdesk.php'); 
					$consulta1="SELECT * FROM seg_visita where codigo_visita='$visitante'";
					$result1=$query($consulta1);	
					while($row1=$fetch_array($result1))
					{
						$codigo_visitante=$row1["codigo_visitante"];
					}
					$consulta1="SELECT * FROM seg_visitante where codigo_visitante='$codigo_visitante'";
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
if (form.cbo_usuario_visitado.value == "3")
  { 
  	alert("Seleccione el nombre del empleado visitado"); 
	form.cbo_usuario_visitado.focus(); 
	return;
 }  
 if (form.cbo_dependencia.value == "33")
  { 
  	alert("Seleccione el nombre de la dependencia"); 
	form.cbo_dependencia.focus(); 
	return;
 }  
  if (form.cbo_motivo.value == "0")
  { 
  	alert("Indique el motivo de la visita, si no aparece seleccione OTRO y especifique"); 
	form.cbo_motivo.focus(); 
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
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
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
      <td><div align="center">Confirmaci&oacute;n de los datos del visitante </div></td>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="gconfirmar_visita.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td width="16%" class="detalletabla1">Visitante:</td>
      <td colspan="4" class="detalletabla1"><? echo $nombre_visitante; ?>	  
      <td width="2%"></td>
    </tr>
    <tr>
      <td align="left" class="detalletabla2">Dependencia:</td>
      <td colspan="4" align="left" class="detalletabla2"><?
					//Para desplegar como primer elemento del combo el titulo actual					
					$consulta2="SELECT * FROM dependencia where codigo_dependencia='$dependencia'";
					$result2=$query($consulta2);	
					while($row2=$fetch_array($result2))
					{
						$nombre=$row2["nombre_dependencia"];
					}
					//Para mostrar los elementos siguientes del combo
					$consulta2="SELECT * FROM dependencia where codigo_dependencia<>'$dependencia' order by nombre_dependencia";
					$result2=$query($consulta2);	
					echo('<select name="cbo_dependencia">');
					echo'<option value="'.$dependencia.'">'.$nombre.'</option>';
					while($row2=$fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_dependencia"].'">'.$row2["nombre_dependencia"].'</option>';
					}
					echo('</select>');
	?></td>
    </tr>
    <tr>
      <td align="left" class="detalletabla1">Visita a: </td>
      <td colspan="4" align="left" class="detalletabla1"><?					
					//Para desplegar como primer elemento del combo el nombre del usuario seleccionado previamente
					$consulta3="SELECT * FROM usuario where codigo_usuario='$visitado'";
					$result3=$query($consulta3);	
					while($row3=$fetch_array($result3))
					{
						$nombre_visitado=$row3["nombres"].' '.$row3["apellidos"];
					}
					//Para mostrar los elementos siguientes del combo
					$consulta3="SELECT * FROM usuario where codigo_usuario<>'$visitado' order by nombres";
					$result3=$query($consulta3);	
					echo('<select name="cbo_usuario_visitado">');
					echo'<option value="'.$visitado.'">'.$nombre_visitado.'</option>';
					while($row3=$fetch_array($result3))
					{
						echo'<option value="'.$row3["codigo_usuario"].'">'.$row3["nombres"].' '.$row3["apellidos"].'</option>';
					}
					echo('</select>');
				?></td>
    </tr>
    <tr>
      <td align="left" class="detalletabla2">Motivo:				</td>
      <td colspan="4" align="left" class="detalletabla2"><?
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
					mssql_close($s);
					?></td>
    </tr>
    <tr>
      <td width="16%" align="left" class="detalletabla1">Especif&iacute;que: </td>
      <td colspan="4" align="left" class="detalletabla1"><textarea name="txt_especifique" cols="40" id="txt_especifique"></textarea></td>
    </tr>
    <tr>
    <td align="left" class="alt1"><span class="alt2">   
   <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Guardar cambios">
  </span></td>
      <td align="left" class="alt1"><span class="alt2">
        <input name="txt_dependencia_temp" type="hidden" id="txt_dependencia_temp">
      </span></td>
      <td width="34%" align="left" class="alt1"><span class="alt2">
      </span><span class="alt2">
      </span></td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
