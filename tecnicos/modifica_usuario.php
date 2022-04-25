<?
	session_start();
	include("validate.php");
	$grupo_id=16;
    if (($_SESSION["group_id"]) != $grupo_id) 
	include("logout.php");		
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
  <form method="post" name="form1" action="gmodifica_usuario.php">
    <div align="center">
      <table width="100%" bgcolor="#CCCCCC" class="tborder" id="table3">
        <tr valign="baseline">
          <td width="182" align="right" nowrap><div align="left"><b>Nombre del usuario:</b></div></td>
          <td width="795">
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
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left"></div></td>
          <td>&nbsp;          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left"></div></td>
          <td><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Buscar datos"></td>
        </tr>
      </table>
    </div>
   </form>
  </div>
