<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0">
  <tr>
    <td width="11%" height="25"><div align="center"><img src="../../images/logo_rpt_mineco.gif" width="82" height="95"></div></td>
    <td width="77%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA FINANCIERA</p>
    <p align="center" class="titulocategoria">M&Oacute;DULO DE PRESUPUESTOS </p></td>
    <td width="12%"><div align="right"><img src="../../images/presupuesto.jpg" width="128" height="89"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25"><div align="right" class="tituloproducto">
      <div align="center"></div>
    </div></td>
    <td height="25">
	<?
	
	
	
	
	
	
	
	
	
	
	if (isset($_SESSION["ingresando_obj"]))
	{		
		$acceso=permisosdb($presupuesto);							
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{
			conectardb($presupuesto);
			$nombre_usuario=$_SESSION["user_name"];																		
			session_unregister("ingresando_obj");																																						
			// Grabar el detalle del presupuesto cuatrimestral			
			$cnt=1; 		
			while($cnt<=count($mes1))
			{						
				
				$qry_presupuesto_ejecucion_cuatrimestral="insert into tb_ejecucion_presupuesto(proveedor,no_orden,fecha,devengado,activo,codigo_financiamiento_actividad,codigo_presupuesto_anual,codigo_periodo,codigo_mes) values ('".$mes1[$cnt][0]."', '".$mes1[$cnt][1]."', '".$mes1[$cnt][2]."', '".$mes1[$cnt][3]."','1','$txt_codigo_financiamiento_actividad','$txt_codigo_presupuesto_anual','$txt_codigo_periodo','$txt_codigo_mes')";
				
				
				print $qry_presupuesto_ejecucion_cuatrimestral;									
				$res_ejecucion_cuatrimestral=$query($qry_presupuesto_ejecucion_cuatrimestral);				
				$cnt++;
		    }
							/////////// fin del detalle
						if ($res_ejecucion_cuatrimestral)
						{		
							echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA GRABADO CORRECTAMENTE<br><br>Para ingresar otro registro </td></tr>';															
						} // fin del ingreso del encabezado
						else
						{
							echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, El registro NO se ha grabado<br><br></td></tr>';
						}
					
			}
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
			}							
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Utilice el menu de la izquierda para continuar</td></tr>';
	}
	
	
	echo '<tr><td class="error" colspan="3" align="center">Utilice el menu de la izquierda para continuar</td></tr>';
	?>            
	</td>
  </tr>
</table>
</body>
</html>
