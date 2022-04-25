<?php	
$grupo_id=17; // 
include("../restringir.php");	
require_once('../connection/helpdesk.php');

?>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_usuario_origen.value == "0")
  { 
  	alert("De quien desea copiar sus roles"); 
	form.cbo_usuario_origen.focus(); 
	return;
  }
 if (form.cbo_usuario_destino.value == "0")
  { 
  	alert("A quien le transfiere los roles"); 
	form.cbo_usuario_destino.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_usuario_origen.focus(); 
}
</script>
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
   <p>Agregar roles de P&aacute;gina de inicio </p>
   <p></p>
   <form method="post" name="form1" action="gcp_perfil.php">
    <div align="center">
      <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
        <tr valign="baseline">
          <td width="20%" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Nombre de usuario origen:</b></div></td>
		  <td width="80%" bgcolor="#99CCCC">
			  <?php
			  	$query="SELECT distinct(a.codigo_usuario), a.nombres, a.apellidos FROM usuario a inner join rol b on a.codigo_usuario=b.codigo_usuario  ORDER BY nombres";
				$result=mssql_query($query);
				echo('<select name="cbo_usuario_origen">');
				$nombre=":: Seleccione ::";
				echo'<option value="0">'.$nombre.'</option>';
				while($row=mssql_fetch_array($result))
				{
					echo'<option value="'.$row["codigo_usuario"].'">'.utf8_encode($row["nombres"]).' '.utf8_encode($row["apellidos"]).'</option>';
				}
				echo('</select>');
			 ?>
		  </td>
        </tr>
		<tr valign="baseline">
          <td height="27" align="right" nowrap bgcolor="#CCFFCC"><strong>Nombre usuario destino</strong>:  </td>
          <td bgcolor="#99CCCC">
			  <?php
					$query="SELECT * FROM usuario WHERE activo=1 ORDER BY nombres";
					$result=mssql_query($query);	
					echo('<select name="cbo_usuario_destino">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_usuario"].'">'.$row["nombres"].' '.$row["apellidos"].'</option>';
					}
					echo('</select>');						
				?></td>
        </tr>
        <tr valign="baseline">
          <td height="27" align="right" nowrap bgcolor="#CCFFCC">&nbsp;</td>
          <td bgcolor="#99CCCC"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Copiar perfil">
          <input name="txt_codigo_dependencia" type="hidden" id="txt_codigo_dependencia" value="<?php echo $dependencia ?>"></td>
        </tr>
        
      </table>
    </div>
   </form>
</div>
