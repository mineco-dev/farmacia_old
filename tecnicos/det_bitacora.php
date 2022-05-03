<?
	session_start();
	include("validate.php");
	$grupo_id=2;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("logout.php");		
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo1 {font-size: large}
-->
</style>
</head>

<body>
<center>
  <p class="Estilo1">MINISTERIO DE ECONOM&Iacute;A</p>
  <p><strong>Subgerencia de Inform&aacute;tica<br>
  </strong><strong>Reporte de eventos irregulares </strong></p>
  <p>
  <?
	  echo "DEL ".$cbo_dia_del."/".$cbo_mes."/".$cbo_anio." AL ".$cbo_dia_al."/".$cbo_mes."/".$cbo_anio;
  ?>
  &nbsp;</p>
  <table width="92%" border="0" bordercolor="#0000FF">
    <tr>
      <td width="100%"><center>
          <table width="99%" border="1" class="tablaazul">
            <tr bgcolor="#CCCCCC">
              <td width="14%"><div align="center"></div>                <div align="center"><strong>Ingresado el: </strong></div></td>
              <td width="63%"><div align="center"><strong>Detalle de la solicitud:</strong></div></td>
              <td width="23%"><div align="center"><strong>Registrado por:</strong></div>                <div align="center"></div>                <div align="center"></div></td>
            </tr>
            <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "Select * from view_bitacora where day(inicio)>='$cbo_dia_del' and day(inicio)<='$cbo_dia_al' and month(inicio)='$cbo_mes' and year(inicio)='$cbo_anio'";
				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{					
                	echo '<tr class="detalletabla4"><td><center>'.$row["inicio"].'</center></td><td><center>'.$row["detalle"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td></tr>';										
				}
				mssql_close($s);
			  ?>
          </table>
      </center></td>
    </tr>
    <tr>
      <td>
      </td>
    </tr>
  </table>
</center>
</body>
</html>
