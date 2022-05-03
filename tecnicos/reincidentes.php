<?
	$grupo_id=5;
	include("../restringir.php");	
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <table width="100%" border="0" bordercolor="#0000FF">
    <tr>
      <td><div align="center"><strong>Usuarios reincidentes </strong></div></td>
    </tr>
    <tr>
      <td><center>
          <table width="99%" border="1" class="tablaazul">
            <tr>
              <td width="8%"><div align="center"><strong># Veces </strong></div></td>
              <td width="41%"><div align="center"><strong>Nombre</strong></div></td>
              <td width="51%"><div align="center"></div>                
                <div align="center"><strong>Dependencia</strong></div>                <div align="center"></div>                <div align="center"></div>                <div align="center"></div>                <div align="center"></div></td>
            </tr>
            <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM view_reincidentes where codigo_dependencia='$dependencia'";
				$result=mssql_query($consulta);
				$i = 0;
				while($row=mssql_fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
                	echo '<tr class='.$clase.'><td><center>'.$row["reincidencias"].'</center></td><td><center><a href="detalle_reincidentes.php?id='.$row["codigo_usuario"].'">'.$row["nombres"].'&nbsp;'.$row["apellidos"].'</a></center></td><td><center>'.$row["nombre_dependencia"].'</center></td></tr>';
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
