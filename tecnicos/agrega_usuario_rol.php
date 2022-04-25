<?php
include("../restringir.php"); 
$grupo_id=17;
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
   <p>Agregar roles de P&aacute;gina de inicio </p>
   <p></p>
   <form method="post" name="form1" action="gagrega_usuario_rol.php">
    <div align="center">
      <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
        <tr valign="baseline">
          <td width="20%" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Nombre de usuario:</b></div></td>
          <td width="80%" bgcolor="#99CCCC">
            <?php
					require_once('../connection/helpdesk.php');
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
          <td height="27" align="right" nowrap bgcolor="#CCFFCC">&nbsp;</td>
          <td bgcolor="#99CCCC"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Agregar usuario">
          <input name="txt_codigo_dependencia"   id="txt_codigo_dependencia" value="<?php echo $dependencia ?>"></td>
        </tr>
      </table>
    </div>
   </form>
</div>
