<?	
$grupo_id=3; // Para agentes de seguridad 
include("../restringir.php");	
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_observacion.value == "")
  { 
  	alert("No ha ingresado ninguna observación"); 
	form.txt_observacion.focus(); 
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
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
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
      <td width="23%"><div align="left"><a href="salida.php">...Volver</a></div></td>
      <td width="77%">&nbsp;</td>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="gobservacion_equipo_sale.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr class="detalletabla1">
      <td width="14%">Equipo:</td>
      <td width="12%">
	  <?
					require_once('../connection/helpdesk.php'); 
					$consulta = "SELECT a.nombre_equipo as equipo, b.numero_serie, b.codigo_equipo_det, b.observacion, c.descripcion, d.nombres, d.apellidos FROM seg_equipo a inner join seg_equipo_det b on a.codigo_equipo=b.codigo_equipo inner join seg_mov_equipo c on b.codigo_mov_equipo=c.codigo_mov_equipo inner join usuario d on b.codigo_usuario_ing=d.codigo_usuario where b.codigo_equipo_det='$id'";
					$result1=$query($consulta);	
					while($row1=$fetch_array($result1))
					{
						$observacion=$row1["observacion"];
						$serie=$row1["numero_serie"];
						$descripcion=$row1["descripcion"];
						$ingresado_por=$row1["nombres"].'&nbsp;'.$row1["apellidos"];
						echo $row1["equipo"];
						
					}
			?>
</td>
      <td width="5%">Serie:</td>
      <td colspan="6"><input name="txt_serie" type="text" id="txt_serie" value="<? echo $serie ?>"></td>
    </tr>
    <tr class="detalletabla2">
      <td height="35" align="left" class="alt1">Movimiento:</td>
      <td align="left" class="alt1"><? echo $descripcion; ?></td>
      <td colspan="3" align="left" class="alt1">Ingresado al sistema por: </td>
      <td width="62%" colspan="4" align="left" class="alt1"><? echo $ingresado_por; ?></td>
    </tr>
    <tr class="detalletabla1">
    
    <td height="45" align="left" class="alt1">Observaciones:</td>
    <td colspan="8" align="left" class="alt1">
    <p>
      <textarea name="txt_observacion" cols="50" id="txt_observacion"><? echo $observacion ?></textarea>
</p>
      </td>
    </tr>
    <tr>
    <td align="left" class="alt1"><span class="alt2">   
   <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Actualizar">
  </span></td>
      <td colspan="6" align="left" class="alt1"><span class="alt2">
        <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>">
  </span>
        <span class="alt2"> </span><span class="alt2"> </span>
  </td>
  
  </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
