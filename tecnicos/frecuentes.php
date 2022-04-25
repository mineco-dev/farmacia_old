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
      <td><div align="center"><strong>Problemas frecuentes </strong></div></td>
    </tr>
    <tr>
      <td><center>
          <table width="99%" border="1" class="tablaazul">
            <tr>
              <td width="10%"><div align="center"><strong># Veces </strong></div></td>
              <td width="90%"><div align="center"><strong>Categor&iacute;a</strong></div>                <div align="center"></div></td>
            </tr>
            <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM view_problemas_frecuentes where codigo_dependencia='$dependencia'";
				$result=mssql_query($consulta);
				$i = 0;
				while($row=mssql_fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
                	echo '<tr class='.$clase.'><td><center>'.$row["frecuentes"].'</center></td><td><center><a href="detalle_frecuentes.php?id='.$row["codigo_categoria"].'">'.$row["categoria"].'</a></center></td></tr>';
					$i++;
				}
				mssql_close($s);
			  ?>
          </table>
      </center></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</center>
</body>
</html>
