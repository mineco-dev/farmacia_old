<?	
$grupo_id=2; // Para agentes de seguridad 
include("../restringir.php");	
?>
<?
					require_once('../connection/helpdesk.php'); 
					$consulta = "select a.nombre_visitante, b.impedir_salida, b.motivo_impedir, b.codigo_usuario_impide, c.nombres, c.apellidos from seg_visita b inner join seg_visitante a on b.codigo_visitante=a.codigo_visitante inner join usuario c on codigo_usuario=b.codigo_usuario_impide where b.codigo_visita='$id'";					
					$result1=$query($consulta);	
					while($row1=$fetch_array($result1))
					{
						$observacion=$row1["motivo_impedir"];
						$usuario_impide=$row1["nombres"]." ".$row1["apellidos"];	
						$nombre_visitante=$row1["nombre_visitante"];						
					}
					mssql_close($s);
	 ?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_observacion.value == "")
  { 
  	alert("Describa el motivo"); 
	form.txt_observacion.focus(); 
	return;
 }
 if (form.cbo_permite_salir.value == "0")
  { 
  	alert("No ha seleccionado ninguna opción del combo"); 
	form.cbo_permite_salir.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_observacion.focus(); 
}
</script>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
      <td><div align="left">Raz&oacute;n por la cual se impidi&oacute; que el visitante  se retire: </div></td>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="gimpide_salida.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr class="detalletabla1">
      <td width="14%" class="detalletabla1">Visitante:</td>
      <td colspan="5"><? echo $nombre_visitante ?>
	  
</td>
    </tr>
    <tr class="detalletabla2">
      <td height="82" align="left" class="alt1">Observaciones:</td>
      <td colspan="5" align="left" class="alt1"><textarea name="txt_observacion" cols="50" wrap="PHYSICAL" id="txt_observacion"><? echo $observacion ?></textarea></td>
    </tr>
    <tr class="detalletabla1">
    
    <td height="38" align="left" class="alt1">Impedir la salida? </td>
    <td width="10%" align="left" class="alt1">
    <p>
      <select name="cbo_permite_salir" size="1" id="cbo_permite_salir">
        <option value="0" selected>Seleccione</option>
        <option value="1">SI</option>
        <option value="2">NO</option>
      </select>
    </p>
      </td>
    <td width="16%" align="left" class="alt1">Usuario que solicit&oacute;:</td>
    <td align="left" class="alt1"><? echo $usuario_impide ?></td>
    <td width="7%" align="left" class="alt1">&nbsp;</td>
    <td width="7%" align="left" class="alt1">&nbsp;</td>
    </tr>
    <tr>
    <td align="left" class="alt1"><span class="alt2">   
   <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Actualizar">
  </span></td>
      <td colspan="2" align="left" class="alt1"><span class="alt2">
        <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>">
  </span>
  </td>
  
  <td width="46%" align="left" class="alt1">
  <span class="alt2"> </span><span class="alt2"> </span>
  </td>
  
  </tr>
  
    </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
