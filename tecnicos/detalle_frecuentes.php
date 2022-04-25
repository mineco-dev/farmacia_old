<?
	$grupo_id=5;
	include("../restringir.php");		
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <table width="100%" border="0" bordercolor="#0000FF">
    <tr>
	 <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM categoria where codigo_categoria='$id'";
				$result=mssql_query($consulta);
				while($row=mssql_fetch_array($result))
				{
					$nombre_categoria=$row["categoria"];
				}				
			  ?>
      <td width="63%"><div align="right"><strong>Solicitudes realizadas de:</strong></div></td>
      <td width="37%"><? echo $nombre_categoria ?></td>
    </tr>
    <tr>
      <td colspan="2"><center>
          <table width="100%" border="1" class="tablaazul">
            <tr>
              <td width="13%"><div align="center"><strong>Fecha</strong></div></td>
              <td width="12%"><div align="center"><strong>Nombre</strong></div></td>
              <td width="11%"><strong>Estado</strong></td>
              <td width="11%"><strong>T&eacute;cnico</strong></td>
              <td width="53%"><div align="center"></div>                
                <strong>Supervisor</strong></td>
            </tr>
            <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM view_detalle_frecuentes where codigo_categoria='$id' and codigo_dependencia='$dependencia'";
				$result=mssql_query($consulta);
				$i = 0;
				while($row=mssql_fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
                	echo '<tr class='.$clase.'><td><center>'.$row["fecha"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td><td><center>'.$row["estado"].'</center></td><td><center>'.$row["tecnico"].'</center></td><td><center>'.$row["supervisor"].'</center></td></tr>';
					$i++;
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
</center>
</body>
</html>
