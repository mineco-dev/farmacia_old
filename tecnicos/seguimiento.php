<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
if (form.txt_detalle_seguimiento.value == "")
  { 
  	alert("Escriba comentarios de seguimiento"); 
	form.txt_detalle_seguimiento.focus(); 
	return;
  }
  if (form.cbo_concluido.value == "s")
  { 
  	alert("¿Esta actividad ha concluido?"); 
	form.cbo_concluido.focus(); 
	return;
  }
form.submit();
}
function Refrescar(form1)
{
	form.reset();
	form.txt_detalle_seguimiento.focus(); 
}
</script>
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
  <form method="post" name="form1" action="gseguimiento.php">
    <div align="center">
      <p>COMENTARIOS DE SEGUIMIENTO </p>
      <table id="table3" bgcolor="#CCCCCC">
        <tr valign="baseline">
          <td width="94" align="right" nowrap><div align="left"><b>No. de ticket:</b></div></td>
          <td width="362" align="left">
            <input name="txt_id" type="text" id="txt_id" value="<? echo $id ?>">
</td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap><div align="left">
              <p align="center"><strong>Actividades<br></strong><strong>realizadas: </strong> </p>
              </div></td>
          <td>
            <textarea name="txt_detalle_seguimiento" cols="60" rows="5" id="txt_detalle_seguimiento"></textarea>
          </td>
        </tr>
        <tr valign="baseline">
          <td height="31" align="right" nowrap><p><strong>&iquest;Concluido?</strong></p>
            </td>
          <td align="left"><select name="cbo_concluido" id="cbo_concluido">
            <option value="s">-- Seleccione --</option>
            <option value="1">SI</option>
            <option value="2">NO</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td height="35" align="right" nowrap>&nbsp;</td>
          <td><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Guardar Comentarios"></td>
        </tr>
      </table>
      </div>
   </form>
  </div>
