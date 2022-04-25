<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
			
	$query_grupo = "select codigo_grupo from tb_presupuesto_anual  where codigo_financiamiento_actividad =".		    $txt_codigo_financiamiento_actividad;
	$salida_grupo = mssql_query($query_grupo);
	$vector_grupo = mssql_fetch_row($salida_grupo);
	$v = $vector_grupo[0];
			
			
			$cnt=1; 		
			
			//print $txt_codigo_mes;
			
			
			if ($txt_codigo_mes == 1)
			{
			
				while($cnt<=count($mes1))
				{						
					$qry_presupuesto_ejecucion_cuatrimestral="insert into tb_ejecucion_presupuesto(proveedor,no_orden,fecha,devengado,activo,codigo_financiamiento_actividad,codigo_presupuesto_anual,codigo_periodo,codigo_mes,dev_mes1,codigo_renglon,codigo_grupo) values ('".$mes1[$cnt][0]."', '".$mes1[$cnt][1]."', '".$mes1[$cnt][2]."', '".$mes1[$cnt][3]."','1','$txt_codigo_financiamiento_actividad','$txt_codigo_presupuesto_anual','$txt_codigo_periodo','$txt_codigo_mes','".$mes1[$cnt][3]."','".$mes1[$cnt][4]."','$v')";															
					//print $qry_presupuesto_ejecucion_cuatrimestral;									
					$res_ejecucion_cuatrimestral=$query($qry_presupuesto_ejecucion_cuatrimestral);				
					$cnt++;																				
				}
			
			}
			
			if ($txt_codigo_mes == 2)
			{
			
				while($cnt<=count($mes1))
				{						
					$qry_presupuesto_ejecucion_cuatrimestral="insert into tb_ejecucion_presupuesto(proveedor,no_orden,fecha,devengado,activo,codigo_financiamiento_actividad,codigo_presupuesto_anual,codigo_periodo,codigo_mes,dev_mes2,codigo_renglon,codigo_grupo) values ('".$mes1[$cnt][0]."', '".$mes1[$cnt][1]."', '".$mes1[$cnt][2]."', '".$mes1[$cnt][3]."','1','$txt_codigo_financiamiento_actividad','$txt_codigo_presupuesto_anual','$txt_codigo_periodo','$txt_codigo_mes','".$mes1[$cnt][3]."','".$mes1[$cnt][4]."','$v')";															
					//print $qry_presupuesto_ejecucion_cuatrimestral;									
					$res_ejecucion_cuatrimestral=$query($qry_presupuesto_ejecucion_cuatrimestral);				
					$cnt++;
				}
			
			}

			if ($txt_codigo_mes == 3)
			{
			
				while($cnt<=count($mes1))
				{						
					$qry_presupuesto_ejecucion_cuatrimestral="insert into tb_ejecucion_presupuesto(proveedor,no_orden,fecha,devengado,activo,codigo_financiamiento_actividad,codigo_presupuesto_anual,codigo_periodo,codigo_mes,dev_mes3,codigo_renglon,codigo_grupo) values ('".$mes1[$cnt][0]."', '".$mes1[$cnt][1]."', '".$mes1[$cnt][2]."', '".$mes1[$cnt][3]."','1','$txt_codigo_financiamiento_actividad','$txt_codigo_presupuesto_anual','$txt_codigo_periodo','$txt_codigo_mes','".$mes1[$cnt][3]."','".$mes1[$cnt][4]."','$v')";															
					//print $qry_presupuesto_ejecucion_cuatrimestral;									
					$res_ejecucion_cuatrimestral=$query($qry_presupuesto_ejecucion_cuatrimestral);				
					$cnt++;
				}
			
			}


			if ($txt_codigo_mes == 4)
			{
			
				while($cnt<=count($mes1))
				{						
					$qry_presupuesto_ejecucion_cuatrimestral="insert into tb_ejecucion_presupuesto(proveedor,no_orden,fecha,devengado,activo,codigo_financiamiento_actividad,codigo_presupuesto_anual,codigo_periodo,codigo_mes,dev_mes4,codigo_renglon,codigo_grupo) values ('".$mes1[$cnt][0]."', '".$mes1[$cnt][1]."', '".$mes1[$cnt][2]."', '".$mes1[$cnt][3]."','1','$txt_codigo_financiamiento_actividad','$txt_codigo_presupuesto_anual','$txt_codigo_periodo','$txt_codigo_mes','".$mes1[$cnt][3]."','".$mes1[$cnt][4]."','$v')";															
					//print $qry_presupuesto_ejecucion_cuatrimestral;									
					$res_ejecucion_cuatrimestral=$query($qry_presupuesto_ejecucion_cuatrimestral);				
					$cnt++;										
				}
			
			}


//query para extraer los datos del cuatrimestre y sus totales
			
		/*	$query_suma_pagado = "select  	
										e.codigo_renglon,
										sum(e.dev_mes1) as pagado_mes1,
										sum(e.dev_mes2) as pagado_mes2,
										sum(e.dev_mes3) as pagado_mes3,
										sum(e.dev_mes4) as pagado_mes4									
									from 
										tb_ejecucion_presupuesto e
									where   									
										e.codigo_financiamiento_actividad = '$txt_codigo_financiamiento_actividad'
										and e.codigo_presupuesto_anual = '$txt_codigo_presupuesto_anual'
										and e.codigo_periodo = '$txt_codigo_periodo'
									group by e.codigo_renglon"

			$consulta_suma_pagado = mssql_query($query_suma_pagado);
			
			
			if ($consulta_suma_pagado)
			{
				
				$query_comprobacion = "select
									   codigo_financiamiento_actividad,codigo_presupuesto_anual,codigo_periodo
									   from tb_presupuesto_pagado
									   where 
									   codigo_financiamiento_actividad = '$txt_codigo_financiamiento_actividad'
									   and codigo_presupuesto_anual = '$txt_codigo_presupuesto_anual' 
									   and codigo_periodo = '$txt_codigo_periodo' "
									   
				$consulta_comprobacion = mssql_query($query_comprobacion);				
				
				if(mssql_num_rows($consulta_comprobacion)>0)
				{
					while($rows_suma_pagado = mssql_fetch_row($consulta_suma_pagado))
					{
						$m1 = $rows_suma_pagado[1];
						$m2 = $rows_suma_pagado[2];
						$m3 = $rows_suma_pagado[3];
						$m4 = $rows_suma_pagado[4];
					
						$query_update_pagado = "update tb_presupuesto_pagado 
												set
													suma_devengado_mes1 = $m1,
													suma_devengado_mes2 = $m2,
													suma_devengado_mes3 = $m3,
													suma_devengado_mes4 = $m4 
 												where																						                         			   codigo_financiamiento_actividad = '$txt_codigo_financiamiento_actividad'
									   and codigo_presupuesto_anual = '$txt_codigo_presupuesto_anual' 
									   and codigo_periodo = '$txt_codigo_periodo' "						
									   
						mssql_query($query_update_pagado);
					}//fin while
				}else{
						$query_inserta_pagado = "insert into tb_presupuesto_pagado 
						(codigo_financiamiento_actividad,
						 codigo_presupuesto_anual,
						 codigo_periodo,
						 suma_devengado_mes1,
						 suma_devengado_mes2,
						 suma_devengado_mes3,
						 suma_devengado_mes4,
						 codigo_renglon,
						 codigo_grupo)values(
						 '$txt_codigo_financiamiento_actividad',
						 '$txt_codigo_presupuesto_anula',
						 '$txt_codigo_periodo',"
								
				}
									   
									   
									   
				
				
			}
									
									
			
		*/	
			
			
			
			
			

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
