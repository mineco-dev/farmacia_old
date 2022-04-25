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
			
	
				
	/*$query_grupo = "select codigo_grupo from tb_presupuesto_anual  where codigo_financiamiento_actividad =".		    $txt_codigo_financiamiento_actividad;
	$salida_grupo = mssql_query($query_grupo);
	$vector_grupo = mssql_fetch_row($salida_grupo);
	$v = $vector_grupo[0];*/

	$criterio_grupo = trim($txt_nombre_grupo);

	$query_grupo = "select codigo_grupo from cat_grupo where nombre_grupo = '$criterio_grupo'";	
	$salida_grupo = mssql_query($query_grupo);
	$vector_grupo = mssql_fetch_row($salida_grupo);
	$v = $vector_grupo[0];
	
/*	print $query_grupo;	
	print "----------------";		
	print $sw;		
	$va = count($asignado);
	print 'atras variable sw ahora variable va  ';
	print $va;*/

	
	
		$cnt = 1;	
	
	
	

if($sw==0)
{
	while ($cnt <= count($asignado))
	{	
		$txt_asignado_mes1 = $asignado[$cnt][0];
		$txt_asignado_mes2 = $asignado[$cnt][1];
		$txt_asignado_mes3 = $asignado[$cnt][2];
		$txt_asignado_mes4 = $asignado[$cnt][3];
		$codigo_renglon = $code[$cnt][4];
	
		$valor_unico = $txt_asignado_mes1+$txt_asignado_mes2+$txt_asignado_mes3+$txt_asignado_mes4;
	
		$qry_presupuesto_asignado_cuatrimestral="insert into tb_asignacion_cuatrimestral
		(codigo_financiamiento_actividad, codigo_periodo, asignado_mes1, asignado_mes2, asignado_mes3, asignado_mes4,codigo_renglon,codigo_grupo,monto_asignado) 
		values 
		('$txt_codigo_financiamiento_actividad', '$txt_codigo_periodo', '$txt_asignado_mes1', '$txt_asignado_mes2', '$txt_asignado_mes3', '$txt_asignado_mes4','$codigo_renglon','$v','$valor_unico')";
		
				//print $qry_presupuesto_asignado_cuatrimestral;	 		
				$res_cuatrimestral=$query($qry_presupuesto_asignado_cuatrimestral);							
				$cnt++;						
	}
}

if($sw>0)
{
	while ($cnt <= count($sasignado))
	{	
		$txt_asignado_mes1 = $sasignado[$cnt][0];
		$txt_asignado_mes2 = $sasignado[$cnt][1];
		$txt_asignado_mes3 = $sasignado[$cnt][2];
		$txt_asignado_mes4 = $sasignado[$cnt][3];
		$codigo = $sasignado[$cnt][5];		
	
		$qry_presupuesto_asignado_cuatrimestral="update tb_asignacion_cuatrimestral 
		set asignado_mes1 = '$txt_asignado_mes1', 
		asignado_mes2 = '$txt_asignado_mes2', 
		asignado_mes3 = '$txt_asignado_mes3', 
		asignado_mes4 = '$txt_asignado_mes4'
		where codigo_asignacion_cuatrimestral = $codigo ";
		
		print $qry_presupuesto_asignado_cuatrimestral;
		
				//print $qry_presupuesto_asignado_cuatrimestral;	 		
				$res_cuatrimestral=$query($qry_presupuesto_asignado_cuatrimestral);							
				$cnt++;						
	}
}				
				
						if ($res_cuatrimestral)
						{		
							echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA GRABADO CORRECTAMENTE<br><br></td></tr>';															
						} 
						else
						{
							echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, El registro NO se ha grabado<br><br></td></tr>';
						}

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
