<?
	$grupo_id=5;
	include("../restringir.php");		
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo1 {font-size: xx-small}
-->
</style>
</head>
<body>
<?				
				require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM usuario where codigo_usuario='$cbo_usuario'";
				$result=mssql_query($consulta);
				while($row=mssql_fetch_array($result))
				{
					$tecnico=$row["nombres"].'&nbsp;'.$row["apellidos"];					
				}
?>				
<center class="Estilo1">
  <p><strong> <? include("../dependencia.php");	?><br>Detalle de actividades del mes
  <?  
  $r029=$_REQUEST["r029"];  
  if ($r029==1)
  {
	switch ($cbo_mes_finaliza) {
		case 1:
			$mes="ENERO, $cbo_anio_finaliza";
			break;
		case 2:
			$mes="FEBRERO, $cbo_anio_finaliza";	
			break;
		case 3:
			$mes="MARZO, $cbo_anio_finaliza";	
			break;
		case 4:
			$mes="ABRIL, $cbo_anio_finaliza";	
			break;
		case 5:
			$mes="MAYO, $cbo_anio_finaliza";	
			break;
		case 6:
			$mes="JUNIO, $cbo_anio_finaliza";	
			break;
		case 7:
			$mes="JULIO, $cbo_anio_finaliza";	
			break;
		case 8:
			$mes="AGOSTO, $cbo_anio_finaliza";	
			break;
		case 9:
			$mes="SEPTIEMBRE, $cbo_anio_finaliza";	
			break;
		case 10:
			$mes="OCTUBRE, $cbo_anio_finaliza";	
			break;
		case 11:
			$mes="NOVIEMBRE, $cbo_anio_finaliza";	
			break;
		case 12:
			$mes="DICIEMBRE, $cbo_anio_finaliza";	
			break;		
		default:
			$mes="";
	}
	echo '<br>';
	echo "Al $cbo_dia_finaliza de $mes";	
}  	
?>
  </strong></p>
  <table width="92%" border="0" bordercolor="#0000FF">
    <tr class="Estilo1">
      <td width="21%"><div align="center"><strong>Actividades atendidas por:</strong> </div>        <div align="center"></div></td>
      <td><? echo $tecnico; ?></td>
    </tr>
    <tr class="Estilo1">
      <td colspan="2"><center>
          <table width="99%" border="1" cellpadding="0" cellspacing="0" class="tablaazul">
            <tr bgcolor="#FFFFFF">
			<?
			if ($r029==1)
			{
				 echo '<td width="6%"><div align="center"><strong> Ticket </strong></div></td>';
				 echo '<td width="73%"><div align="center"><strong>Detalle de la solicitud</strong></div></td>';
				 echo '<td width="11%"><div align="center"><strong>Solicitante</strong></div></td>';
				 echo '<td width="10%"><div align="center"></div>';                
				 echo '<div align="center"><strong>Supervisor</strong></div></td>';
				 echo '</tr>';
			}
			else
			{
				echo '<td width="6%"><div align="center"><strong> Ticket </strong></div></td>';
				echo '<td width="9%"><div align="center"><strong>Solicitado</strong></div></td>';
				echo '<td width="9%"><div align="center"><strong>Inicio</strong></div>';
				echo '<div align="center"></div></td>';
				echo '<td width="9%"><div align="center"><strong>Finalizado</strong></div></td>';
				echo '<td width="46%"><div align="center"><strong>Detalle de la solicitud</strong></div></td>';
				echo '<td width="11%"><div align="center"><strong>Solicitante</strong></div></td>';
				echo '<td width="10%"><div align="center"></div>';                
				echo '<div align="center"><strong>Supervisor</strong></div></td>';
				echo '</tr>';
			}
              	require_once('../connection/helpdesk.php');
				if ($dependencia==10)
				{
					if ($cbo_estado==2)	$consulta = "Select * from view_reporte  where codigotecnico='$cbo_usuario' and estatus=2 and codigo_categoria=73";
					else
				  		$consulta = "Select * from view_reporte  where estatus='$cbo_estado' and codigotecnico='$cbo_usuario' and codigo_dependencia='$dependencia' and codigo_categoria=73 and cast(inicio as datetime)>='$cbo_mes_inicia/$cbo_dia_inicia/$cbo_anio_inicia' and cast(inicio as datetime) <='$cbo_mes_finaliza/$cbo_dia_finaliza/$cbo_anio_finaliza'";
				}
				else
				if ($dependencia==46)
				{
					if ($cbo_estado==2)	$consulta = "Select * from view_reporte  where codigotecnico='$cbo_usuario' and estatus=2 and codigo_categoria=87";
					else
				  		$consulta = "Select * from view_reporte  where estatus='$cbo_estado' and codigotecnico='$cbo_usuario' and codigo_dependencia='$dependencia' and codigo_categoria=87 and cast(inicio as datetime)>='$cbo_mes_inicia/$cbo_dia_inicia/$cbo_anio_inicia' and cast(inicio as datetime) <='$cbo_mes_finaliza/$cbo_dia_finaliza/$cbo_anio_finaliza'";
				}
				else							
				if ($cbo_estado==2)	$consulta = "Select * from view_reporte  where codigotecnico='$cbo_usuario' and estatus=2";
				else { 
//				   $consulta = mssql_query('set dateformat dmy');
//				    SET DATE_FORMAT('dmy');
//					date_default_timezone_set('UTC');
//				      $consulta = "Select * from view_reporte  where estatus='$cbo_estado' and codigotecnico='$cbo_usuario' and codigo_dependencia='$dependencia' and inicio >='$cbo_dia_inicia/$cbo_mes_inicia/$cbo_anio_inicia' and inicio<='$cbo_dia_finaliza/$cbo_mes_finaliza/$cbo_anio_finaliza')";
           			  $consulta = "Select * from view_reporte  where estatus='$cbo_estado' and codigotecnico='$cbo_usuario' and codigo_dependencia='$dependencia' and cast(inicio as datetime)>='$cbo_mes_inicia/$cbo_dia_inicia/$cbo_anio_inicia' and cast(inicio as datetime) <='$cbo_mes_finaliza/$cbo_dia_finaliza/$cbo_anio_finaliza'";
					}
//COMENTADO EL 07/05/2008
//				Select * from view_reporte  where estatus='$cbo_estado' and codigotecnico='$cbo_usuario' and codigo_dependencia='$dependencia' and (convert(varchar,inicio,101)>='$cbo_mes_inicia/$cbo_dia_inicia/$cbo_anio_inicia' and convert(varchar,inicio,101)<='$cbo_mes_finaliza/$cbo_dia_finaliza/$cbo_anio_finaliza')";
				
// comentado el 2/5/08
//  				else $consulta = "Select * from view_reporte  where estatus='$cbo_estado' and codigotecnico='$cbo_usuario' and codigo_dependencia='$dependencia' and (day(inicio)>='$cbo_dia_inicia' and day(inicio)<='$cbo_dia_finaliza') and (month(inicio)>='$cbo_mes_inicia' and month(inicio)<='$cbo_mes_finaliza') and (year(inicio)>='$cbo_anio_inicia' and year(inicio)<='$cbo_anio_finaliza')";
				//$consulta = "Select * from view_reporte  where codigotecnico='$cbo_usuario' and month(inicio)='$cbo_mes' and year(inicio)='$cbo_anio'";
				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{					
//				    $fini = convert(varchar,$row[inicio],101);
					if ($r029==1)
					{	
						echo '<tr class="detalletabla6" cellpadding="0" cellspacing="0"><td><center>'.$row["ticket"].'</center></td><td><center>'.$row["detalle"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td><td><center>'.$row["supervisor"].'</center></td></tr>';
					}
					else
					{
						echo '<tr class="detalletabla6" cellpadding="0" cellspacing="0"><td><center>'.$row["ticket"].'</center></td><td><center>'.$row["solicitado"].'</center></td><td><center>'.$row["inicio"].'</center></td><td><center>'.$row["finalizado"].'</center></td><td><center>'.$row["detalle"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td><td><center>'.$row["supervisor"].'</center></td></tr>';
					}
					$ticket=$row["ticket"];
					if ($cbo_seguimiento==1)
					{
						$consulta2= "Select * from view_seguimiento where codigo_soporte='$ticket' and codigo_tecnico='$cbo_usuario'";
					}
					else
					{
						$consulta2= "Select top 1 * from view_seguimiento where codigo_soporte='$ticket' and codigo_tecnico='$cbo_usuario' order by codigo_seguimiento desc";
					}
						$result2=mssql_query($consulta2);
						while($row2=mssql_fetch_array($result2))
						{						
							if ($r029==1)
							{						
                				echo '<tr cellpadding="0" cellspacing="0"><td>&nbsp;</td><td colspan="3" class="detalletabla5" >'.$row2["detalle"].'</td></tr>';
							}
							else
							{						
                				echo '<tr class="detalletabla5" cellpadding="0" cellspacing="0"><td colspan="2" align=right>'.$row2["fecha"].'</td><td colspan="5">'.$row2["detalle"].'</td></tr>';
							}
						}					
				}
				mssql_close($s);
			  ?>
          </table>
      </center></td>
    </tr>
    <tr>
      <td colspan="2">
      </td>
    </tr>
  </table>
  <table width="92%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="290" class="xl66 Estilo2">&nbsp;</td>
      <td width="65" class="xl70 Estilo2"></td>
      <td width="228" class="xl70 Estilo2"></td>
      <td class="xl68 Estilo2">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="xl66 Estilo2">&nbsp;</td>
      <td class="xl70"><div align="center"></div></td>
      <td class="xl70"><div align="center"></div></td>
      <td width="309" valign="top" class="xl65"><div align="center"></div></td>
    </tr>
    <tr>
      <td class="xl66"><div align="center" class="Estilo1">
          <div align="center">F:___________________________________</div>
      </div></td>
      <td colspan="2" class="xl66"><div align="center"></div>
          <div align="center">
            <div align="center" class="Estilo1">F:_____________________________________ </div>
        </div></td>
      <td class="xl68"><div align="center" class="Estilo1">F:_____________________________________ </div></td>
    </tr>
    <tr>
      <td valign="top" class="xl66"><div align="center" class="Estilo1">
          <div align="center"><? echo $tecnico; ?></div>
      </div></td>
      <td colspan="2" class="xl70"><div align="center"></div>
          <div align="center" class="Estilo1">Vo. Bo. Jefe inmediato </div></td>
      <td valign="top" class="xl65"><div align="center" class="Estilo1">VO. Bo. Jefe Superior </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</center>
</body>
</html>
