<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="GET" action="consulta_ticket.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr>
        <td>&nbsp;</td>
      </tr>
	</table>
              <?	
			  		$existe=0;
			     	require_once('../connection/helpdesk.php');
					$consulta1 = "SELECT * FROM soporte where codigo_soporte=$id";
					$result1=mssql_query($consulta1);
					$i = 0;
					while($row1=mssql_fetch_array($result1))
					{
						if($row1["codigo_soporte"] == $id)
						$existe=1;
					}
					if ($existe ==1)
					{		
							echo '<table width="100%" border="1">';
							echo '<tr><td width="20%"><center><strong>Fecha/hora</strong></center></td><td width="20%"><center><strong>Ingresado por</strong></center></td><td width="60%"><center><strong>Comentarios</strong></center></td></tr>';			
							$consulta = "SELECT * FROM view_seguimiento where codigo_soporte=$id order by fecha DESC";
							$result=mssql_query($consulta);							
							while($row=mssql_fetch_array($result))							
							{
								$clase = "detalletabla2";
								if ($i % 2 == 0) 
								{
									$clase = "detalletabla1";
								}	
								 echo '<tr class='.$clase.'><td><center>'.$row["fecha"].'</center></td><td><center>'.$row["nombres"].'</center></td><td>'.$row["detalle"].'</td></tr>';									 
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
