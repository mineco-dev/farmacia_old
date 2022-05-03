<?	
$grupo_id=5;
include("../restringir.php");	
?>
<?
	$gisett=(int)date("w");
	$mesnum=(int)date("m");
	$hora = date(" H:i",time());	
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <p><strong> Subgerencia de Inform&aacute;tica<br></strong><strong>Detalle de actividades del mes </strong></p>
  <table width="92%" border="0" bordercolor="#0000FF">
    <tr>
      <td width="21%"><div align="center"><strong>Fecha de impresi&oacute;n :
      </strong> </div>        
        <div align="center"></div></td>
      <td width="22%"><? echo (date("d")."/".$mesnum."/".date("Y")." ".$hora); ?></td>
      <td width="57%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><center>
          <table width="99%" border="1" class="tablaazul">
            <tr bgcolor="#FFFFFF">
              <td width="8%"><div align="center"><strong># Ticket </strong></div></td>
              <td width="11%"><div align="center"><strong>Solicitado el </strong></div></td>
              <td width="14%"><div align="center"><strong>Iniciado el:</strong></div>                
              <div align="center"></div></td>
              <td width="11%"><div align="center"><strong>Finalizado el: </strong></div></td>
              <td width="23%"><div align="center"><strong>Detalle de la solicitud:</strong></div></td>
              <td width="19%"><div align="center"><strong>T&eacute;cnico:</strong></div></td>
              <td width="14%"><div align="center"></div>                
              <div align="center"><strong>Supervisado por : </strong></div></td>
            </tr>
            <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "Select * from view_reporte_pend_completado where codigo_dependencia='$departament_id'";
				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{					
                	echo '<tr class="detalletabla4"><td><center>'.$row["ticket"].'</center></td><td><center>'.$row["solicitado"].'</center></td><td><center>'.$row["inicio"].'</center></td><td><center>'.$row["finalizado"].'</center></td><td><center>'.$row["detalle"].'</center></td><td><center>'.$row["tecnico"].'</center></td><td><center>'.$row["supervisor"].'</center></td></tr>';
					$ticket=$row["ticket"];					
						$consulta2= "Select * from view_seguimiento where codigo_soporte='$ticket'";
						$result2=mssql_query($consulta2);
						while($row2=mssql_fetch_array($result2))
						{						
                			echo '<tr class="detalletabla3"><td colspan="3" align=right>'.$row2["fecha"].'</td><td colspan="4">'.$row2["detalle"].'</td></tr>';
						}					
				}
				mssql_close($s);
			  ?>
          </table>
      </center></td>
    </tr>
    <tr>
      <td colspan="3">
      </td>
    </tr>
  </table>
</center>
</body>
</html>
