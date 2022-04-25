<html>
<head>
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
      <tr> 
        <td colspan="2"><center>
            <table width="93%" border="2">
              <tr> 
                <td width="27%"><div align="center"></div>                  <div align="center"><strong>Fecha/hora</strong></div></td>
                <td width="19%"><div align="center"><strong>T&eacute;cnico</strong></div></td>
                <td width="54%"><div align="center"><strong>Comentarios</strong></div></td>
              </tr>
              <?			  		 	
			     	require_once('../connection/helpdesk.php');
					$consulta = "SELECT * FROM view_seguimiento where codigo_soporte=$txt_ticket order by fecha DESC";
					$result=mssql_query($consulta);
						while($row=mssql_fetch_array($result))
						{
							// if ($row ==1) echo '<tr><td>En un momento estaremos operando su solicitud. Gracias por su comprensión</td></tr>';
               				echo '<tr><td><center>'.$row["fecha"].'</center></td><td><center>'.$row["nombres"].'</center></td><td><center>'.$row["detalle"].'</center></td></tr>';
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
