<?	
$grupo_id=8;
include("../restringir.php");	
?>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
<div align="center">
<? include("../dependencia.php"); ?>
<?		
					require_once('../connection/helpdesk.php'); 
		   			$consulta1="SELECT * FROM seguimiento where codigo_seguimiento='$id'";			
					$result1=$query($consulta1);	
					while($row=$fetch_array($result1))
					{
						$descripcion=$row["detalle"];
						$ticket=$row["codigo_soporte"];
					}	
					$consulta2="SELECT * FROM soporte where codigo_soporte='$ticket'";			
					$result2=$query($consulta2);	
					while($row=$fetch_array($result2))
					{
						$descripcion_ticket=$row["descripcion"];
					}				
					$close($s);			
					session_register('editar_ticket');
					$_SESSION['editar_ticket'] = $ticket;							
?>
<p align="left">Eliminaci&oacute;n de comentarios de seguimiento: </p>
<form method="post" name="form1" action="geditar_tickets41.php">
    <div align="left"></div>
     <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
       <tr valign="baseline">
         <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>No. de referencia : </strong></div></td>
         <td bgcolor="#99CCCC"><? echo $ticket; ?></td>
       </tr>
       <tr valign="baseline">
         <td width="20%" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>Descripci&oacute;n de actividades:</strong></div></td>
         <td width="80%" bgcolor="#99CCCC"><? echo $descripcion_ticket;?></td>
       </tr>
       <tr valign="baseline">
         <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#CCFFCC"><div align="left">
            <p>Comentario:           </p>
         </div>
           </td>
         <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#CCFFCC"><div align="left"><? echo $descripcion; ?></div></td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap bgcolor="#CCFFCC"><div align="left">
           <input name="bt_enviar" type="submit" value="Eliminar comentario">
         </div></td>
         <td bgcolor="#99CCCC">         <input name="txt_codigo_seguimiento" type="hidden" id="txt_codigo_seguimiento" value="<? echo $id ?>">         </td>
       </tr>
     </table>
  </form>
   <p>&nbsp;</p>
</div>
