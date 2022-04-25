<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
</center>
<table width="100%" border="0" bordercolor="#0000FF">
  <tr>
    <td><div align="center"><strong>Consulta de extensiones telef&oacute;nicas </strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?
					if ($txt_buscar<>"")
					{
					    $consulta1 = "SELECT * FROM view_extension where nombre like '%$txt_buscar%' or apellido like '%$txt_buscar%'";
					}
						else
				        {	
							if ($cbo_dependencia>0)
							{
							$consulta1 = "SELECT * FROM view_extension where codigo_dependencia='$cbo_dependencia'";
							}
							else
							{
								$consulta1 = "SELECT * FROM view_extension ORDER BY nombre";
							}
						}	
						require_once('../connection/helpdesk.php');
						$result1=mssql_query($consulta1);
						$i = 0;
						echo '<table width="100%" border="2" bordercolor="">';
						while($row=mssql_fetch_array($result1))
						{							
						$clase = "detalletabla2";
						if ($i % 2 == 0) 
						{
							$clase = "detalletabla1";
						}					
							if ($txt_buscar<>"")
							{
							 echo '<tr class='.$clase.'><td><center>'.$row["nivel"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td><td><center>'.$row["extension"].'</center></td><td><center>'.$row["dependencia"].'</center></td></tr>';
							}
							else
							if ($cbo_dependencia>0)
							{
							 echo '<tr class='.$clase.'><td><center>'.$row["nivel"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td><td><center>'.$row["extension"].'</center></td></tr>';							 
							}							 
							else
								echo '<tr  class='.$clase.'><td><center>'.$row["nivel"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td><td><center>'.$row["extension"].'</center></td><td><center>'.$row["dependencia"].'</center></td></tr>';
						$i++;		
						}
						mssql_close($s);					
			  ?>
			  </table>
</body>
</html>
