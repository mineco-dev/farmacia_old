<?
	$grupo_id=9;
	include("../restringir.php");
?>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.cbo_tecnico.value == "0")
  { 
  	alert("Indique a quien le reasigna el ticket"); 
	form.cbo_tecnico.focus(); 
	return;
  }
form.submit();
}
function Refrescar(form1)
{
	form.reset();
	form.cbo_tecnico.focus(); 
}
</script>

</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
  <form method="GET" name="form1" action="greasignar_ticket2.php">
  			<?
			  	require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM view_soporte where ticket=$txt_ticket and codigo_dependencia='$dependencia'";
				$result=mssql_query($consulta);		
				$entro=2;
				while($row=mssql_fetch_array($result))
				{
					if ($vticket=$row["ticket"] == $txt_ticket) $entro=1;
                	$vticket=$row["ticket"];
					$vfecha=$row["fecha"];
					$vusuario=$row["nombre"].'&nbsp;'.$row["apellido"];
					$vdetalle=$row["detalle"];
					$vnivel=$row["nivel"];
					$vtecnico=$row["tecnico"];
				}
				if ($entro == 2)
				{
				  echo "No existe el número de ticket o NO pertenece a esta subgerencia";
				  exit;
				}				
			  ?>
    <div align="center">
      <p>REASIGNAR TAREA: </p>
      <table width="100%" border="1" bgcolor="#CCCCCC" id="table3">
        <tr valign="baseline">
          <td width="153" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>No. de ticket:</b></div></td>
          <td width="248" align="left" bgcolor="#99CCCC">
            <input name="txt_ticket" type="text" id="txt_ticket" value="<? echo $txt_ticket ?>"></td>
          <td width="121" align="left" bgcolor="#CCFFCC"><b>Usuario:</b></td>
          <td colspan="3" align="left" bgcolor="#99CCCC">
		  <?
		  	 echo $vusuario; 
		  ?>
		  </td>
        </tr>
        <tr valign="baseline">
          <td height="32" align="right" valign="middle" nowrap bgcolor="#CCFFCC">            <p align="left"><strong>Detalle de la </strong><strong>solicitud</strong><strong>: </strong> </p></td>
          <td colspan="5" bgcolor="#99CCCC">
		  	<?
				echo $vdetalle; 
			?>	 
		  </td>
        </tr>
        <tr valign="baseline">
          <td height="31" align="right" nowrap bgcolor="#CCFFCC"><p align="left"><strong> Solicitado el: </strong></p>          </td>
          <td align="left" bgcolor="#99CCCC">
		  	<?
				echo $vfecha; 
			?>
		  </td>
          <td align="left" bgcolor="#CCFFCC"><strong>T&eacute;cnico asignado:</strong></td>
          <td width="311" align="left" bgcolor="#99CCCC">
		  <?
				echo $vtecnico; 
			?>
		  </td>
          <td width="87" align="left" bgcolor="#CCFFCC"><strong>Nivel:</strong></td>
          <td width="29" align="left" bgcolor="#99CCCC">
		  <?
		  	    echo $vnivel;
		  ?>
		  </td>
        </tr>
        <tr valign="baseline">
          <td height="35" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>Reasignar a: </strong></div></td>
          <td bgcolor="#99CCCC">
		  <?
		  			if ($dependencia==46) $query="SELECT * FROM usuario WHERE activo=1 and codigo_usuario IN (20, 95, 96, 328, 384, 422) ORDER BY nombres";
					else						
					if($dependencia==10) $query="SELECT * FROM usuario where activo = 1 ORDER BY nombres ";
					else $query="SELECT * FROM usuario WHERE codigo_dependencia='$dependencia' and activo = 1 ORDER BY nombre_usuario";
					require_once('../connection/helpdesk.php'); 				
					$result=mssql_query($query);	
					echo('<select name="cbo_tecnico">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_usuario"].'">'.$row["nombres"].' '.$row["apellidos"].'</option>';
					}
					echo('</select>');
					mssql_close($s);
				?></td>
          <td bgcolor="#CCFFCC"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Reasignar"></td>
          <td colspan="3" bgcolor="#99CCCC">&nbsp;</td>
        </tr>
      </table>
    </div>
   </form>
  </div>
