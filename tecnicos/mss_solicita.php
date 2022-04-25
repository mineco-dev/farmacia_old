<?
	session_start();
	$dependencia=1;
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
  if (form.cbo_categoria.value == "0")
  { 
  	alert("Seleccione el tipo de asistencia que desea"); 
	form.cbo_soporte.focus(); 
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
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
   <form method="post" name="form1" action="gsolicita.php">
    <div align="center">
      <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
        <tr valign="baseline">
          <td width="20%" align="right" nowrap bgcolor="#C9CDED"><div align="left"><b>Nombre del solicitante :</b></div></td>
          <td width="80%" bgcolor="#99CCFF">
            <?
					require_once('../Connection/helpdesk.php'); 
					//Para desplegar como primer elemento del combo el nombre del usuario que inicio sesion
					if ($user!=3)
					{
						$qry_usuario="SELECT codigo_usuario, nombres, apellidos FROM usuario WHERE codigo_usuario='$user'" ;
						$resp_usuario=mssql_query($qry_usuario);	
						while($filausuario=mssql_fetch_array($resp_usuario))
						{
							$usuarioactual=$filausuario["nombres"].' '.$filausuario["apellidos"];
						}
					//Para mostrar los elementos siguientes del combo
						$qry_usuario="SELECT codigo_usuario, nombres, apellidos FROM usuario WHERE activo=1 and codigo_usuario<>'$user' ORDER BY nombres";
						$comboinicial='<option value="'.$user.'">'.$usuarioactual.'</option>';		
					}
					else
					{					
						$qry_usuario="SELECT codigo_usuario, nombres, apellidos FROM usuario WHERE activo=1 ORDER BY nombres";
						$comboinicial='<option value="0">:: Seleccione su nombre ::</option>';
					}	
						$resp_usuario=mssql_query($qry_usuario);	
						echo('<select name="cbo_usuario">');						
						echo $comboinicial;
						while($filausuario=mssql_fetch_array($resp_usuario))
						{
							echo'<option value="'.$filausuario["codigo_usuario"].'">'.$filausuario["nombres"].' '.$filausuario["apellidos"].'</option>';
						}
						echo('</select>');											
			?>
          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#C9CDED"><div align="left"><b>Fecha y hora de solicitud:</b></div></td>
          <td bgcolor="#99CCFF"><?
			  echo (date("d")."/".$mesnum."/".date("Y")." ".$hora); 
			?>
          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#C9CDED"><div align="left"><b>Asistencia para: </b></div></td>
          <td bgcolor="#99CCFF">
            <?
					if ($departament_id!=$dependencia) $query2="SELECT * FROM categoria WHERE codigo_dependencia='$dependencia' and activo=1 and privada=2 ORDER BY categoria";
					else $query2="SELECT * FROM categoria WHERE codigo_dependencia='$dependencia' and activo=1 ORDER BY categoria";										
					$result2=mssql_query($query2);	
					echo('<select name="cbo_categoria">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_categoria"].'">'.$row2["categoria"].'</option>';
					}
					echo('</select>');				
					mssql_close($s);					
				?>
          </td>
        </tr>
        <tr valign="baseline">
          <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#C9CDED"><div align="left">
              <p><b>Detalle de la solicitud: </b><b class="alt2"></b> </p>
          </div></td>
          <td bgcolor="#99CCFF">
          <textarea name="txt_detalle_solicita" cols="40" rows="5" id="txt_detalle_solicita"></textarea>          </td>
        </tr>
        <tr valign="baseline">
          <td height="27" align="right" nowrap bgcolor="#C9CDED">&nbsp;</td>
          <td bgcolor="#99CCFF"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Enviar solicitud">
          <input name="txt_codigo_dependencia" type="hidden" id="txt_codigo_dependencia" value="<? echo $dependencia ?>"></td>
        </tr>
      </table>
    </div>
   </form>
</div>
