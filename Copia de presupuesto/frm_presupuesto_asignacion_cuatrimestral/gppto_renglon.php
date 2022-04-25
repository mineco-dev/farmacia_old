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
/*			$cnt=1; 		
			while($cnt<=count($bien))
			{						
				$codigo=trim($bien[$cnt][0]);
				$qry_consulta_codigo="select * from cat_renglon where codigo='$codigo'";
				echo $qry_consulta_codigo;
				$res_qry_consulta_codigo=$query($qry_consulta_codigo);
				while($row_qry_codigo=$fetch_array($res_qry_consulta_codigo))					
				{					
					$codigo_renglon=$row_qry_codigo["codigo_renglon"];
				}*/
				
				
				//$valor_monto_asignado = number_format($monto_asignado, 2, '.', ',');
				

				
				
				$valor_monto_asignado = $monto_asignado;														
				
				$qry_codigo_grupo="select codigo_grupo from cat_grupo where nombre_grupo = '$txt_nombre_grupo'";
				$salida_codigo_grupo = mssql_query($qry_codigo_grupo);
				$out_codigo_grupo = mssql_fetch_row($salida_codigo_grupo);
				$vali = $out_codigo_grupo[0];
				
				
			/*	$qry_validar_duplicidad = 'select codigo_financiamiento_actividad,codigo_periodo,codigo_grupo from tb_asignacion_cuatrimestral where codigo_financiamiento_actividad = $txt_codigo_financiamiento_actividad and codigo_periodo = $txt_codigo_periodo and codigo_grupo = $vali';
				$salida_validar_duplicidad = mssql_query($qry_validar_duplicidad);
				$out_validar_duplicidad = mssql_fetch_row($salida_validar_duplicidad);
				$validacion = $out_validar_duplicidad[0];
				
				print $qry_validar_duplicidad;
				
				
				if(empty($validacion))
				{*/
				
				
				
															
				$qry_presupuesto_asignado_cuatrimestral="insert into tb_asignacion_cuatrimestral(codigo_financiamiento_actividad,codigo_periodo,monto_asignado,monto_solicitado,codigo_grupo,codigo_mes) values ($txt_codigo_financiamiento_actividad,$txt_codigo_periodo,$valor_monto_asignado,$txt_monto_solicitado,$vali,$me)";										
				
				
			
				
				print $qry_presupuesto_asignado_cuatrimestral;
				
				$res_cuatrimestral=$query($qry_presupuesto_asignado_cuatrimestral);				
				$cnt++;
		    
										/////////// fin del detalle
						if ($res_cuatrimestral)
						{		
							echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA GRABADO CORRECTAMENTE<br><br></td></tr>';															
						} // fin del ingreso del encabezado
						else
						{
							echo '<tr><td class="error" colspan="3" align="center">Se XXXX produjo un error al grabar, El registro NO se ha grabado<br><br></td></tr>';
						}
						
						
				/*}else{
	echo '<tr><td class="error" colspan="3" align="center">NO SE PUEDE REALIZAR UNA ASIGNACION SOBRE ESTE GRUPO DEBIDO A QUE YA EXISTE UNA CUOTA VIGENTE</td></tr>'
}*/
					
			}
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL 	ADMINISTRADOR DEL SERVICIO</a></td></tr>';
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
