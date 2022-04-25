<?	
$grupo_id=8;
include("../restringir.php");	
?>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_solicitante.value == "0")
  { 
  	alert("Seleccione el nombre del solicitante"); 
	form.cbo_solicitante.focus(); 
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
	form.cbo_solicitante.focus(); 
}
</script>
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
<div align="center">
   <p><? include("../dependencia.php"); ?></p>
   <form method="post" name="form1" action="geditar_tickets2.php">
      <div align="left">
</div>
     <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
       <tr valign="baseline">
         <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>No. de referencia : </strong></div></td>
         <td bgcolor="#99CCCC">
		 <?
		 if (isset($_SESSION['editar_ticket'])) $id=$_SESSION['editar_ticket'];
		  echo $id; 
		  ?></td>
       </tr>
       <tr valign="baseline">
         <td width="20%" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Solicitante:</b></div></td>
         <td width="80%" bgcolor="#99CCCC">
           <?				   			
					require_once('../connection/helpdesk.php'); 
		   			$consulta1="SELECT * FROM soporte where codigo_soporte='$id'";			
					$result1=$query($consulta1);	
					while($row=$fetch_array($result1))
					{
						$solicitante=$row["codigo_usuario"];
						$descripcion=$row["descripcion"];
						$fecha_seguimiento=$row["fecha_seguimiento"];
						$detalle=$row["detalle_solicita"];
					}
					
					//Para desplegar como primer elemento del combo el nombre del usuario seleccionado previamente
					$consulta3="SELECT * FROM usuario where codigo_usuario='$solicitante'";
					$result3=$query($consulta3);	
					while($row3=$fetch_array($result3))
					{
						$nombre_solicitante=$row3["nombres"].' '.$row3["apellidos"];
					}
					//Para mostrar los elementos siguientes del combo
					$consulta3="SELECT * FROM usuario where codigo_usuario<>'$solicitante' order by nombres";
					$result3=$query($consulta3);	
					echo('<select name="cbo_solicitante">');
					echo'<option value="'.$solicitante.'">'.$nombre_solicitante.'</option>';
					while($row3=$fetch_array($result3))
					{
						echo'<option value="'.$row3["codigo_usuario"].'">'.$row3["nombres"].' '.$row3["apellidos"].'</option>';
					}
					echo('</select>');
				?>
         </td>
       </tr>
       <tr valign="baseline">
         <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>Descripci&oacute;n de actividades:</strong></div></td>
         <td bgcolor="#99CCCC"><input name="txt_descripcion" type="text" id="txt_descripcion" value="<? echo $descripcion ?>" size="54"></td>
       </tr>
       <tr valign="baseline">
         <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>Fecha para seguimiento:</b></div></td>
         <td bgcolor="#99CCCC">
           <input name="txt_fecha_seg" type="text" id="txt_fecha_seg" value="<? echo $fecha_seguimiento ?>">
           <input name="cbo_categoria" type="hidden" id="cbo_categoria" value="73">
</td>
       </tr>
       <tr valign="baseline">
         <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#CCFFCC"><div align="left">
            <p><b>Observaciones: </b><b class="alt2"></b> </p>
         </div></td>
         <td bgcolor="#99CCCC">
         <textarea name="txt_detalle_solicita" cols="50" rows="5" id="txt_detalle_solicita"><? echo $detalle ?></textarea>          </td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap bgcolor="#CCFFCC">&nbsp;</td>
         <td bgcolor="#99CCCC"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Grabar actualizaci&oacute;n">
         <input name="txt_ticket" type="hidden" id="txt_ticket" value="<? echo $id ?>"></td>
       </tr>
     </table>
   </form>
   <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
  <tr align="center" bgcolor="#336699" class="titulomenu">
    <td width="12%" class="thead Estilo3"><strong>Fecha</strong></td>
    <td width="60%" class="Estilo3 thead">Comentarios de seguimiento </td>
    <td width="14%" class="Estilo3 thead"><strong>Ingresado por </strong></td>
    <td width="7%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Editar</strong></span><span class="Estilo3 thead"></span></td>
    <td width="7%" class="thead Estilo3">Borrar</td>
  </tr>
  <?
				$consulta = "SELECT * FROM view_seguimiento where codigo_soporte=$id order by fecha DESC";					
				require_once('../connection/helpdesk.php');							
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}							 
					echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["detalle"].'</td><td>'.$row["nombres"].'</td><td><center><a href="geditar_tickets3.php?id='.$row["codigo_seguimiento"].'"><img src="imagenes/iconos/ico_editar.jpg"></a></center></td><td><center><a href="geditar_tickets4.php?id='.$row["codigo_seguimiento"].'"><img src="imagenes/iconos/ico_borrar.jpg"></a></center></td></tr>';					
					$i++;
				}
				$close($s);
			 ?>
   </table>
  <p>&nbsp;</p>
</div>
