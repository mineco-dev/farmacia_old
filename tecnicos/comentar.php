<?	
	session_start();
	$user=($_SESSION["user_id"]);   //codigo del usuario que inicio sesion
	require_once('../connection/helpdesk.php'); 
	$query="SELECT codigo_tecnico FROM soporte WHERE codigo_soporte='$id'";	
	$result=mssql_query($query);
	while($fila=mssql_fetch_array($result))
	{
		$codigo_tecnico=$fila["codigo_tecnico"];		
	}
	require_once('../connection/helpdesk.php');
	$qry_usuario="SELECT u.nombres, u.apellidos FROM usuario u INNER JOIN soporte s";
	$qry_usuario.=" ON s.codigo_usuario=u.codigo_usuario WHERE codigo_soporte='$id'";
	$resp_usuario=mssql_query($qry_usuario);	
	while ($fila=mssql_fetch_array($resp_usuario))
	{
		$solicitante=$fila["nombres"]." ".$fila["apellidos"];
	}	
?>
<head>
<script>
function habilita(form)
{
form.cbo_categoria.disabled = false;
}
</script>

<script LANGUAGE="JavaScript">
function Validar(form)
{
if (form.txt_detalle_seguimiento.value == "")
  { 
  	alert("Escriba comentarios de seguimiento"); 
	form.txt_detalle_seguimiento.focus(); 
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
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
  <form method="post" name="form1" action="gcomentar.php">
    <div align="center">
      <p>COMENTARIOS DE SEGUIMIENTO </p>
      <table bordercolor="#FFFFFF" bgcolor="#CCCCCC" id="table3">
        <tr valign="baseline">
          <td width="90" align="right" nowrap class="detalletabla2"><div align="left"><b>Ticket:</b></div></td>
          <td colspan="5" align="left" class="detalletabla1">
		  <?
		  echo $id." solicitado por ".$solicitante;
		  ?>
            <input name="txt_id" type="hidden" id="txt_id" value="<? echo $id ?>">
            <input name="txt_categoria" type="hidden" id="txt_categoria" value="<? echo $idcatactual ?>"></td>
        </tr>        
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap class="detalletabla2"><div align="left"><strong>Categor&iacute;a:</strong></div></td>
          <td colspan="1" class="detalletabla1"><?
					//Para desplegar como primer elemento del combo la categoria actual					
					$qry_categoria="SELECT s.codigo_categoria, c.categoria FROM soporte s INNER JOIN categoria c ON s.codigo_categoria=c.codigo_categoria";
					$qry_categoria.=" WHERE codigo_soporte='$id'";
					
					$resp_categoria=mssql_query($qry_categoria);	
					while($filacat=mssql_fetch_array($resp_categoria))
					{
						$categoriaactual=$filacat["categoria"];
						$idcatactual=$filacat["s.codigo_categoria"];
					}
					//Para mostrar los elementos siguientes del combo
					$qry_categoria="SELECT * FROM categoria where codigo_categoria<>'$idcatactual' order by categoria";
					$resp_categoria=mssql_query($qry_categoria);	
					echo('<select name="cbo_categoria" disabled>');
					echo'<option value="0">'.$categoriaactual.'</option>';
					while($filacat=mssql_fetch_array($resp_categoria))
					{
						echo'<option value="'.$filacat["codigo_categoria"].'">'.$filacat["categoria"].'</option>';
					}
					echo('</select>');
				?>
          <input name="bt_activar" onClick="habilita(this.form)" type="button" id="bt_activar" value="..."></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap class="detalletabla2"><div align="left"><strong>Comentario</strong><strong>:</strong></div></td>
          <td width="467" colspan="1" class="detalletabla1"><textarea name="txt_detalle_seguimiento" cols="60" id="textarea"></textarea></td>
        </tr>
        <tr valign="baseline">
          <td colspan="2" align="right" valign="middle" nowrap class="detalletabla2"><div align="left">
              <p align="left">
			  <?
		  if ($codigo_tecnico==$user)
		  {		    
		  	echo '<strong>&iquest;Concluido?</strong>';
          	echo '&nbsp;';
			echo '&nbsp;';
			echo '<select name="cbo_concluido" id="cbo_concluido">';
            echo '<option value="s">--Seleccione--</option>';
            echo '<option value="1">SI</option>';
            echo '<option value="2">NO</option>';
            echo '<option value="8">EN ESPERA</option>';
		    echo '</select>';
		//	echo '<strong>&nbsp;&nbsp;Informar al solicitante por correo?</strong>';
        // 	echo '<input name="correo" type="checkbox" id="correo" value="1">';
		  }
		  else
		  {
          	echo '<strong>Alertar?</strong>';
          	echo '<input name="alerta" type="checkbox" id="alerta2" value="1">';
		  }
		  ?>
			  </p>
              </div>          </td>
        </tr>
      </table>      
        <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Agregar comentario">
    </div>
   </form>
<?
   	mssql_close($s);
	include("ver_seguimiento.php");
?>
</div>

