<?
	$grupo_id=5;	
	include("../restringir.php");		
?>
<?
	$gisett=(int)date("w");
	$mesnum=(int)date("m");
	$hora = date(" H:i",time());	
?>
<head>
<link href="../tecnicos/estilo.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_usuario.value == "0")
  { 
  	alert("A quien le desea enviar el mensaje?"); 
	form.cbo_usuario.focus(); 
	return;
  }
  if (form.txt_asunto.value == "")
  { 
  	alert("Describa el asunto del mensaje"); 
	form.txt_asunto.focus(); 
	return;
  }
  if (form.txt_mensaje.value == "")
  { 
  	alert("Describa en forma concisa su solicitud"); 
	form.txt_mensaje.focus(); 
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
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
	font-style: italic;
	font-weight: bold;
}
-->
</style>
</head>
<body background="../tecnicos/fondos/fondo.gif" style="background-attachment: fixed">
 <p align="center">Envio de mensajes de texto</p>
 <div align="center">
  <form method="post" name="form1" action="gmensajes.php">
    <div align="center">
      <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
        <tr valign="baseline">
          <td width="12%" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Para :</b></div></td>
          <td width="88%" bgcolor="#99CCCC">
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
				?>
          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Fecha y hora:</b></div></td>
          <td bgcolor="#99CCCC"><?
			  echo (date("d")."/".$mesnum."/".date("Y")." ".$hora); 
//		 	  echo (date("Y")."/".$mesnum."/".date("d")." ".$hora); 
			?>
          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Asunto: </b></div></td>
          <td bgcolor="#99CCCC"><input name="txt_asunto" type="text" id="txt_asunto" size="54">
          </td>
        </tr>
        <tr valign="baseline">
          <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#CCFFCC"><div align="left">
              <p><b>Mensaje corto: </b><b class="alt2"></b> </p>
          </div></td>
          <td bgcolor="#99CCCC">
          <textarea name="txt_mensaje" cols="50" rows="5" id="txt_mensaje"></textarea>          </td>
        </tr>
        <tr valign="baseline">
          <td height="27" align="right" nowrap bgcolor="#CCFFCC">&nbsp;</td>
          <td bgcolor="#99CCCC"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Enviar mensaje">
          </td>
        </tr>
      </table>
    </div>
   </form>
</div>
