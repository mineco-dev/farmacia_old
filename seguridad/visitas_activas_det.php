<?		
$grupo_id=2; // Para agentes de seguridad 
include("../restringir.php");	
?>
<?
	$id=$_REQUEST["id"];
	require_once('../connection/helpdesk.php');
	$consulta = "SELECT * FROM seg_visita where codigo_visita='$id'";
	$result=$query($consulta);	
	while($row=$fetch_array($result))
	{	
		$codigo=$row["codigo_visitante"];	
	}	
	$consulta = "SELECT * FROM seg_visitante where codigo_visitante='$codigo'";
	$result=$query($consulta);	
	while($row=$fetch_array($result))
	{	
		$visitante=$row["nombre_visitante"];	
	}	
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=visitas.php">
</head>
<body>
<center>
  <form name="form1" method="post" action="visitas.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr>
        <td><div align="center"></div>          
        <div align="left"><strong>Seguimiento de la visita realizada por: <? echo $visitante; ?></strong></div>          <div align="center"></div>        <div align="right">
        </div></td>
        <td width="25%"><div align="right">
          <input type="submit" name="Submit" value="Regresar">
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><center>
            <table width="99%" border="1" class="tablaazul">
              <tr bordercolor="#333333">
                <td width="14%"><div align="center"><strong>Estado</strong></div></td>
                <td width="21%"><div align="center"><strong>Dependencia</strong></div></td>
                <td width="18%"><div align="center"><strong>Usuario visitado </strong></div></td>
                <td width="29%"><div align="center"><strong>Confirmado por:</strong></div></td>
                <td><div align="center"><strong>Confirmado el: </strong></div></td>
              </tr>
              <?	
			  	$consulta = "SELECT * FROM seg_visitas_det where codigo_estado<3 and codigo_visita='$id'";			
				$result3=mssql_query($consulta);
				$i = 0;
				while($row3=mssql_fetch_array($result3))
				{
					$estado=$row3["codigo_estado"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					if ($estado<2) echo '<tr class='.$clase.'><td><center><a href="up_visitas.php?id='.$row3["codigo_visita_det"].'">'.$row3["estado"].'</center></a></td><td><center>'.$row3["nombre_dependencia"].'</center></td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td><td><center>'.$row3["nombre_confirma"].'&nbsp;'.$row3["apellido_confirma"].'</center></td><td><center>'.$row3["fecha_aceptado"].'</center></td></tr>';
					else echo '<tr class='.$clase.'><td><center>'.$row3["estado"].'</center></td><td><center>'.$row3["nombre_dependencia"].'</center></td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td><td><center>'.$row3["nombre_confirma"].'&nbsp;'.$row3["apellido_confirma"].'</center></td><td><center>'.$row3["fecha_aceptado"].'</center></td></tr>';                	
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
  </form>
</center>
</body>
</html>
