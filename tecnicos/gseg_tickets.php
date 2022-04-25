<?	
$grupo_id=5;
include("../restringir.php");	
?>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
<div align="center">
   <form method="post" name="form1" action="seg_tickets.php">
      <div align="left">
</div>
      <?				   			
					require_once('../connection/helpdesk.php'); 
		   			$consulta1="SELECT * FROM soporte where codigo_soporte='$id'";			
					$result1=$query($consulta1);	
					while($row=$fetch_array($result1))
					{						
						$detalle=$row["detalle_solicita"];
					}
			?>
Descripci&oacute;n de la solicitud
<table width="90%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
       <tr valign="baseline">
         <td width="14%" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>No. de ticket : </strong></div></td>
         <td width="86%" bgcolor="#99CCCC">
		 <?		 
		  echo $id; 
		  ?></td>
       </tr>
       <tr valign="baseline">
         <td align="justify"  colspan="2" valign="middle" bordercolor="#FFFFFF" bgcolor="#CCFFCC"><div align="left">
            <p><? echo $detalle; ?></p>
            <p>&nbsp;</p>
         </div>                     </td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap><div align="left">
           <input name="bt_enviar" type="submit" value="Regresar">
         </div></td>
         <td>         <input name="txt_ticket" type="hidden" id="txt_ticket" value="<? echo $id ?>"></td>
       </tr>
     </table>
   </form>
   <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
  <tr align="center" bgcolor="#336699" class="titulomenu">
    <td width="17%" class="thead Estilo3"><strong>Fecha</strong></td>
    <td width="56%" class="Estilo3 thead">Comentarios de seguimiento </td>
    <td width="27%" class="Estilo3 thead"><strong>Ingresado por </strong></td>
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
					echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["detalle"].'</td><td>'.$row["nombres"].'&nbsp;'.$row["apellidos"].'</td></tr>';					
					$i++;
				}
				$close($s);
			 ?>
   </table>
  <p>&nbsp;</p>
</div>
