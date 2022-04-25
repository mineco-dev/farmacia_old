<?	
$grupo_id=7;
include("../restringir.php");	
?>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_usuario.value == "0")
  { 
  	alert("Seleccione nombre del usuario"); 
	form.cbo_usuario.focus(); 
	return;
  } 
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_usuario.focus(); 
}
</script>

</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
  <form method="post" name="form1" action="reporte_usuario.php">
    <div align="center">
      <table width="100%" bgcolor="#CCCCCC" class="tborder" id="table3">
        <tr valign="baseline">
          <td width="73" align="right" nowrap><div align="left"><b>Usuario:</b></div></td>
          <td width="127">
            <?
					require_once('../Connection/helpdesk.php'); 
					$query="SELECT * FROM usuario WHERE activo=1 ORDER BY nombres";
					$result=mssql_query($query);	
					echo('<select name="cbo_usuario">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_usuario"].'">'.$row["nombres"].' '.$row["apellidos"].'</option>';
					}
					echo('</select>');	
					mssql_close($s);					 								
				?>
</td>
          <td width="158"><strong>Incluir seguimiento? </strong></td>
          <td width="282"><select name="cbo_seguimiento" size="1" id="cbo_seguimiento">
            <option value="2">No</option>
            <option value="1">Si</option>
          </select></td>
          <td width="325">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left"></div></td>
          <td colspan="4"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Generar Reporte"></td>
        </tr>
      </table>
    </div>
   </form>
</div>
