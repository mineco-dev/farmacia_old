<?
	$grupo_id=9;
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
  if (form.cbo_perfil.value == "0")
  { 
  	alert("Seleccione el nuevo perfil para el usuario"); 
	form.cbo_perfil.focus(); 
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
 <p>MODIFICAR PERFIL DE USUARIO</p>
  <form method="post" name="form1" action="gmodifica_permisos.php">
    <div align="center">
      <table width="100%" bgcolor="#CCCCCC" class="tborder" id="table3">
        <tr valign="baseline">
          <td width="182" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Nombre del usuario:</b></div></td>
          <td width="795" bgcolor="#99CCCC">
            <?
					require_once('../Connection/helpdesk.php'); 
					$query="SELECT * FROM usuario WHERE activo=1 and codigo_dependencia='$dependencia' ORDER BY nombres";
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
          <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"></div></td>
          <td bgcolor="#99CCCC">&nbsp;          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>Nuevo perfil:</strong></div></td>
          <td bgcolor="#99CCCC"><?
					require_once('../connection/helpdesk.php'); 
					$query2="SELECT * FROM grupo_enc WHERE activo=1 ORDER BY nombre_grupo";
					$result=mssql_query($query2);	
					echo('<select name="cbo_perfil">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=mssql_fetch_array($result))
					{
						echo'<option value="'.$row2["codigo_grupo_enc"].'">'.$row2["nombre_grupo"].'</option>';
					}
					echo('</select>');	
					mssql_close($s);					 								
				?>
          </td>
        </tr>
        <tr valign="baseline">
          <td align="center" valign="middle" nowrap bgcolor="#CCFFCC"><div align="left">
              <p>&nbsp; </p>
          </div></td>
          <td bgcolor="#99CCCC">&nbsp;
          </td>
        </tr>
        <tr valign="baseline">
          <td height="57" align="right" nowrap bgcolor="#CCFFCC">&nbsp;</td>
          <td bgcolor="#99CCCC"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Actualizar perfil"></td>
        </tr>
      </table>
    </div>
   </form>
  </div>
