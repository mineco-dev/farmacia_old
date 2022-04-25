<?
	session_start();
	if (!isset($_SESSION["subgerencia"])) $dependencia=33;
	else $dependencia=($_SESSION["subgerencia"]);		
	if (!isset($_SESSION["this_cookie"]))
	{
		$user=3;
	}
	else
		{
			$user=($_SESSION["user_id"]);		
		}
?>
<?
	$gisett=(int)date("w");
	$mesnum=(int)date("m");
	$hora = date(" H:i",time());	
?>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_usuario.value == "0")
  { 
  	alert("Seleccione su nombre"); 
	form.cbo_usuario.focus(); 
	return;
  }
  if (form.txt_descripcion.value == "")
  { 
  	alert("Escriba una breve descripción"); 
	form.txt_descripcion.focus(); 
	return;
  }
    if (form.txt_fecha_seg.value == "")
  { 
  	alert("Escriba la fecha para seguimiento"); 
	form.txt_fecha_seg.focus(); 
	return;
  }
  if (form.txt_detalle_solicita.value == "")
  { 
  	alert("Describa en forma concisa su solicitud"); 
	form.txt_detalle_solicita.focus(); 
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
   <p><? include("../dependencia.php"); ?></p>
   <form method="post" name="form1" action="gpunto_nuevo.php">
      <div align="left">
</div>
     <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
       <tr valign="baseline">
         <td width="20%" align="right" nowrap bgcolor="#C9CDED"><div align="left"><b>Solicitante:</b></div></td>
         <td width="80%" bgcolor="#99CCFF">
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
          <td align="right" nowrap bgcolor="#C9CDED"><div align="left"><strong>Descripci&oacute;n de actividades:</strong></div></td>
         <td bgcolor="#99CCFF"><input name="txt_descripcion" type="text" id="txt_descripcion" size="54"></td>
       </tr>
       <tr valign="baseline">
         <td align="right" nowrap bgcolor="#C9CDED"><div align="left"><b>Fecha para seguimiento:</b></div></td>
         <td bgcolor="#99CCFF">
           <input name="txt_fecha_seg" type="text" id="txt_fecha_seg">
</td>
       </tr>
       <tr valign="baseline">
         <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#C9CDED"><div align="left">
            <p><b>Observaciones: </b><b class="alt2"></b> </p>
         </div></td>
         <td bgcolor="#99CCFF">
         <textarea name="txt_detalle_solicita" cols="50" rows="5" id="txt_detalle_solicita"></textarea>          </td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap bgcolor="#C9CDED">&nbsp;</td>
         <td bgcolor="#99CCFF"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Grabar">
         <input name="txt_codigo_dependencia" type="hidden" id="txt_codigo_dependencia" value="<? echo $dependencia ?>"></td>
       </tr>
     </table>
   </form>
</div>
