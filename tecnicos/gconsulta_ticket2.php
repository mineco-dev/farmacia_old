<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="GET" action="consulta_ticket.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td width="59%"><div align="right"><strong>Consulta de estado de solicitud n&uacute;mero:&nbsp;&nbsp;</strong></div></td>
        <td width="41%"><? echo $txt_ticket; ?>		</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
	</table>
              <?	
			  		$existe=0;
			     	require_once('../connection/helpdesk.php');
					$consulta1 = "SELECT * FROM soporte where codigo_soporte=$txt_ticket";
					$result1=mssql_query($consulta1);
					$i = 0;
					while($row1=mssql_fetch_array($result1))
					{
						if($row1["codigo_soporte"] == $txt_ticket)
						$existe=1;
					}
					if ($existe ==1)
					{		
							echo '<table width="100%" border="1">';
							echo '<tr><td><center><strong>Fecha/hora</strong></center></td><td><center><strong>T&eacute;cnico</strong></center></td><td><center><strong>Comentarios</strong></center></td></tr>';			
							$consulta = "SELECT * FROM view_seguimiento where codigo_soporte=$txt_ticket order by fecha DESC";
							$result=mssql_query($consulta);							
							while($row=mssql_fetch_array($result))							
							{
								$clase = "detalletabla2";
								if ($i % 2 == 0) 
								{
									$clase = "detalletabla1";
								}	
								 echo '<tr class='.$clase.'><td><center>'.$row["fecha"].'</center></td><td><center>'.$row["nombres"].'</center></td><td><center>'.$row["detalle"].'</center></td></tr>';									 
							$i++;
							}							
					}
					else
					{
						echo 'El N�mero de ticket ingresado no existe';
					}
					mssql_close($s);
			  ?>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
