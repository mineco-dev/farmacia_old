<?
require("../../../includes/funciones.php");
require("../../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../../includes/helpdesk.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0">
  <tr>
    <td width="18%" height="25"><div align="center"><img src="../../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORM&Aacute;TICA</p>
    <p align="center" class="titulocategoria"> INVENTARIO DE HARDWARE Y SOFTWARE </p></td>
    <td width="10%"><div align="right"><img src="../../../images/hard_soft.jpg" width="112" height="113"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
</table>   
<table border="1" width="95%" cellpadding="0" cellspacing="0" align="center">
	<?			
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{
			conectardb($inventarioopera);
				///////Devuelve los campos que forman el formulario			
				$qry_plantilla="SELECT o.codigo_objeto, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, 
							  p.campo_origen, p.campo_llave, p.tamano, p.etiqueta, p.orden, p.tb_destino, p.campo_destino, p.combo_destino, p.combo_origen, p.tipo_combo,
							  pl.codigo_objeto, pl.condicion
							  FROM tb_plantilla pl INNER JOIN
							  tb_propiedad p ON pl.codigo_propiedad = p.codigo_propiedad INNER JOIN
							  cat_objeto o ON pl.codigo_objeto = o.codigo_objeto
							  where pl.codigo_objeto='$txt_obj' and pl.codigo_propiedad<>33 order by p.orden"; 					  
				$res_qry_plantilla=$query($qry_plantilla);	
				$cnt=1;
				$no_campos_detalle=1;
				$qry_datos_insertados="SELECT ";
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{					
					$tb_detalle=$row_qry_plantilla["tb_destino"];
					$qry_datos_insertados2="FROM $tb_detalle ";
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==1)
					{					
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
						$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["propiedad"]; //campo para concatenar al qry.				
						$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
						$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
						$qry_orden2.="$campo_detalle, ";
					}
					else
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==2)
					{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];						
						$campo_detalle=$latabla.'.'.$campoorigen;
						$qry_datos_insertados.="$campo_detalle, ";
						$no_campos_detalle++;
						$qry_datos_insertados3.="LEFT JOIN $latabla ON $tb_detalle.$campollave=$latabla.$campollave "; //parte 3 del qry del detalle						
						$qry_orden2.="$campo_detalle, ";
					}
					else
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==6)
					{					
						$latabla=$row_qry_plantilla["tb_destino"];
						$campoorigen=$row_qry_plantilla["campo_destino"];					
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];
						$campo_detalle=$latabla.'.'.$campoorigen;
						$qry_datos_insertados.="$campo_detalle, ";
						$no_campos_detalle++;
					}																			
					$campo[$cnt]=$row_qry_plantilla["propiedad"];
					$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_propiedad"];					
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
					$free_result($res_qry_plantilla);
					$campo_detalle=$tb_detalle.'.activo';
					$qry_orden="ORDER BY ";
					$qry_datos_insertados.="$campo_detalle";
					$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));	
					$qry_condicion="WHERE $tb_detalle.codigo_objeto='$txt_obj' ";				
				//	$qry_insert="insert into tb_inventario(codigo_categoria, codigo_subcategoria, codigo_objeto, ";
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista de campos a grabar
				{
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);					
					if ((!$variable=="") && (!$variable=="0"))
					{						
						if ($tipo_campo[$cnt]==1)
						{	
							$qry_condicion.="AND $tb_detalle.$campo[$cnt] LIKE '%$variable%' ";									
						}
						else
						if ($tipo_campo[$cnt]==2)
						{
							$qry_condicion.="AND $tb_detalle.$campo[$cnt]='$variable' ";									
						}					
					}
					$cnt++;
				}// fin del while que forma el qry_consulta	
				$qry_datos_insertados.=", tb_inventario_etiqueta_det.numero_etiqueta";
				$qry_datos_insertados3.="LEFT JOIN tb_inventario_etiqueta_det ON tb_inventario_etiqueta_det.codigo_inventario_enc=tb_inventario.codigo_inventario_enc and tb_inventario_etiqueta_det.activo=1";
				if (!($_REQUEST["no_etiqueta"]==""))
				{
					
					$variable=$_REQUEST["no_etiqueta"];
					$qry_condicion.="AND tb_inventario_etiqueta_det.numero_etiqueta LIKE '%$variable%' ";
				}	
				$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_condicion.' '.$qry_orden.' '.$qry_orden2;																					
				$res_consulta=$query($qry_detalle);										
				if ($res_consulta)
				{
		  			  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="center">RESULTADOS DE LA B�SQUEDA</td></tr>';
		  			  $res_qry_insertados=$query($qry_detalle);	
					  $hay_registros=false;	 
					  $i=1;					  
						$cnt=2; //imprime etiquetas
						echo '<tr>'; 			
						
						while ($cnt<=count($etiqueta)-7) 
						{	
							echo '<td align="center" class="boxTitleBgLightBlue" width="12%">';
							echo $etiqueta[$cnt];
							echo '</td>';
							$cnt++;
						}	
						echo '<td class="boxTitleBgLightBlue" align="center">Editar</td>';
						echo '<td class="boxTitleBgLightBlue" align="center">Estado</td>';
						echo '</tr>';
						$no_campos_detalle=$no_campos_detalle-9;
						while($row_qry_insertados=$fetch_array($res_qry_insertados))
						{
							  $hay_registros=true;
							  $status=$row_qry_insertados["activo"];
							  $clase = "boxTitleBgMidGrey";
							  if ($i % 2 == 0) 
							  {
								$clase = "boxTitleBgLightGrey";
							  }
							  $cnt=1;
							
							  while ($cnt<=$no_campos_detalle) 
							  {
								echo '<td class='.$clase.'>'.$row_qry_insertados["$cnt"].'</td>';
								$cnt++;
							  }	
								echo '<td class='.$clase.'><center><a href="../ed_objeto_det.php?id='.$row_qry_insertados[0].'&txt_obj='.$txt_obj.'"><img src="../../../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td>';  					
							if ($status==1)
							{				
								//echo '<td class='.$clase.'><center><a href="../status.php?id='.$row_qry_insertados[0].'&st=2&txt_obj='.$txt_obj.'"><img src="../../../images/iconos/ico_activo.gif" alt="Desactivar" border="0"></a></center></td>';					
								echo '<td class='.$clase.'><center><img src="../../../images/iconos/ico_activo.gif" alt="Desactivar" border="0"></center></td>';					
							}
								else
								{
									//echo '<td class='.$clase.'><center><a href="../status.php?id='.$row_qry_insertados[0].'&st=1&txt_obj='.$txt_obj.'"><img src="../../../images/iconos/ico_desactivado.gif" alt="Activar" border="0"></a></center></td>';					
									echo '<td class='.$clase.'><center><img src="../../../images/iconos/ico_desactivado.gif" alt="Activar" border="0"></center></td>';					
								}	
							echo '</tr>';
							$i++;
						 }
						 if (!$hay_registros)
						 {
							 echo '<tr><td class="error" colspan="'.$no_campos_detalle.'" align="center">NO SE ENCONTRARON REGISTROS QUE COINCIDAN CON LA BUSQUEDA<br><br>Para intentar nuevamente <a href="buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
						 }
					$free_result($res_qry_insertados);	
				}
					
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">NO SE ENCONTRARON REGISTROS QUE COINCIDAN CON LA BUSQUEDA<br><br>Para intentar nuevamente <a href="buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
				}	
		} // fin del if isset obj		
	
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">NO HA SELECCIONADO NINGUN OBJETO PARA LA BUSQUEDA, PARA INTENTARLO NUEVAMENTE <a href="buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            	  
</table>
</body>
</html>
