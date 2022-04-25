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
<table width="80%"  border="0" align="center">
  <tr>
    <td width="18%" height="25"><div align="center"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA ADMINISTRATIVA</p>
      
	  <p align="center" class="titulocategoria"> REPORTE DE MANTENIMIENTO DE VEHICULOS </p></td>
    <td width="10%"><div align="right"></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>  
</table>   
<table border="1" width="90%" cellpadding="0" cellspacing="0" align="center">
	<?				
	if (isset($txt_obj)) //verifico si hay objeto seleccionado
	{				
		$acceso=permisosdb($vehiculos);													
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{			
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj' and c.activo=1
							order by orden"; 						
			require('../../connection/helpdesk.php');							
			$res_qry_plantilla=$query($qry_plantilla);				
			conectardb($vehiculos);
				$cnt=1;
				$no_campos_detalle=1;
				$qry_datos_insertados="SELECT ";
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{			
					
					$tb_detalle=$row_qry_plantilla["tb_destino"];
					$qry_datos_insertados2="FROM $tb_detalle ";
					if ($row_qry_plantilla["codigo_tipo_campo"]==1)
					{					
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
						$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
						$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
						$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
						$qry_orden2.="$campo_detalle, ";
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==2)
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
					if ($row_qry_plantilla["codigo_tipo_campo"]==6)
					{					
						$latabla=$row_qry_plantilla["tb_destino"];
						$campoorigen=$row_qry_plantilla["campo_destino"];					
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];
						$campo_detalle=$latabla.'.'.$campoorigen;
						$qry_datos_insertados.="$campo_detalle, ";
						$no_campos_detalle++;
					}																			
					$campo[$cnt]=$row_qry_plantilla["campo"];
					$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];					
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
					$free_result($res_qry_plantilla);
					$campo_detalle=$tb_detalle.'.activo';
					$qry_orden="ORDER BY ";
					$qry_datos_insertados.="$campo_detalle, tb_salida_vehiculo.codigo_estado_salida_vehiculo as color";
					$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));	
					$qry_condicion="WHERE $tb_detalle.activo=1 and $tb_detalle.codigo_categoria=5  and $tb_detalle.codigo_estado in (1,2) ";								
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista segun los criterios de busqueda
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
				$qry_datos_insertados3.="LEFT JOIN tb_salida_vehiculo ON tb_inventario.codigo_inventario_enc=tb_salida_vehiculo.codigo_inventario_enc and tb_salida_vehiculo.codigo_estado_salida_vehiculo=3";
				$qry_condicion.=" and not exists 
									(select * from tb_salida_vehiculo 
									where tb_inventario.codigo_inventario_enc=tb_salida_vehiculo.codigo_inventario_enc 
									and tb_salida_vehiculo.codigo_estado_salida_vehiculo IN (9))";
				$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_condicion.' '.$qry_orden.' '.$qry_orden2;																																																					
				$res_qry_insertados=$query($qry_detalle);
			    $hay_registros=false;	 					  			  					  								
				while($row_qry_insertados=$fetch_array($res_qry_insertados))
				{					 
					  		    $hay_registros=true;													  	  			  												
							    $id=$row_qry_insertados["codigo_inventario_enc"];
							    $completo=$row_qry_insertados["objeto"].' '.$row_qry_insertados["marca"].' '.$row_qry_insertados["linea_estilo_vehiculo"].' '.$row_qry_insertados["numero_placa_vehiculo"];							    
								/////////////////////////////////
							    $qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
								c.campo_origen, c.campo_llave as campollave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
								p.condicion, p.campo_llave
								FROM tb_campo c inner join tb_plantilla p
								on c.codigo_campo=p.codigo_campo
								where p.codigo_formulario='11' and c.activo=1
								order by orden";
								require('../../connection/helpdesk.php');				
								$res_qry_plantilla2=$query($qry_plantilla);																							
								$i=1;
								$cnt=1;					
								while($row_qry_plantilla2=$fetch_array($res_qry_plantilla2))
								{										
									$campo[$cnt]=$row_qry_plantilla2["campo"];											
									$tipo_campo2[$cnt]=$row_qry_plantilla2["codigo_tipo_campo"];
									if ($row_qry_plantilla2["validar"]==1)
									{
										$campo_validacion[$i]=$row_qry_plantilla2["campo"];
										$mensaje_validacion[$i]=$row_qry_plantilla2["texto_validacion"];
										$tipo_campo[$i]=$row_qry_plantilla2["codigo_tipo_campo"];			
										$i++;							
									}			
									if ($row_qry_plantilla2["campo_llave"]==1)  //para saber en que tabla y a traves de que campo se realizara el filtro del reg. seleccionado.
									{
										$tabla_destino=$row_qry_plantilla2["tb_destino"];
										$campo_llave_destino=codigo_inventario_enc;																
									}		
									$cnt++;		
								}					
								$cnt=1;	
								$qry_item_catalogo="select";
								while($cnt<=count($campo))  //para que devuelva el contenido de los campos del registro que se esta editando
								{	
									$campotemp=$campo[$cnt];					
									if (($tipo_campo2[$cnt]==8) || ($tipo_campo2[$cnt]==10)) $campotemp="convert(nvarchar, $campo[$cnt], 126) as $campo[$cnt]";
									if ($cnt==count($campo)) $qry_item_catalogo.=" $campotemp ";
									else $qry_item_catalogo.=" $campotemp, ";
									$cnt++;									
								}
								$qry_item_catalogo.="from $tabla_destino where $campo_llave_destino=$id";
								conectardb($inventarioadmin);											
								$res_qry_item_catalogo=$query($qry_item_catalogo);	//devuelve datos del objeto que se esta editando			
								$hay_detalle=false;									
								while($row_qry_item_catalogo=$fetch_array($res_qry_item_catalogo))
								{										
									$item=1;	
									$hay_detalle=true;
									$cnt=1;
									while ($cnt<=count($campo))  // arreglo que contiene el contenido del registro editado
									{	
										$contenido[$cnt]=$row_qry_item_catalogo["$campo[$cnt]"];
										$cnt++;										
									}	 
									   //conectardb($formularioadmin);
									   //require('../../connection/helpdesk.php');									   									  
									  // $res_qry_plantilla2=$query($qry_plantilla);		
									   echo '<tr>';										   								 									  									  
									  /* while($row_qry_plantilla2=$fetch_array($res_qry_plantilla2))
									   {												
											if ($row_qry_plantilla2["codigo_tipo_campo"]==2)
											{
												$latabla=$row_qry_plantilla2["tb_origen"];
												$campoorigen=$row_qry_plantilla2["campo_origen"];
												$campollave=$row_qry_plantilla2["campollave"];						
												$condicion=$row_qry_plantilla2["condicion"];						
												$nombre_div=$row_qry_plantilla2["codigo_campo"];	
												$qry_cbo="SELECT * FROM $latabla where $campollave=$contenido[$item] order by $campoorigen";						 																		
												conectardb($vehiculos);
												$res_qry_cbo=$query($qry_cbo);
												while($row_qry_cbo=$fetch_array($res_qry_cbo))
												{
													$contenido[$item]=$row_qry_cbo["$campoorigen"];																			
												}											
												$free_result($res_qry_cbo);							
											} // fin de cada combo.																
											else
											if ($row_qry_plantilla2["codigo_tipo_campo"]==8)
											{	
												$day=substr($contenido[$item],8,2);
												$month = strtolower(substr($contenido[$item],5,2));
												$year = substr($contenido[$item],0,4);											
												$contenido[$item]=$day.'-'.$month.'-'.$year;											
											}											
											else
											if ($row_qry_plantilla2["codigo_tipo_campo"]==10)
											{							
												$day=substr($contenido[$item],8,2);
												$month = strtolower(substr($contenido[$item],5,2));
												$year = substr($contenido[$item],0,4);
												$hour = substr($contenido[$item],11,2);
												$min = substr($contenido[$item],14,2);											
												$contenido[$item]=$day.'-'.$month.'-'.$year.' '.$hour.':'.$min;
											}										
											else
											if ($row_qry_plantilla2["codigo_tipo_campo"]==11)
											{					
												conectardb($rrhh);
												$id_solicitante_actual=$contenido[$item];
												$qry_empleado="select * from asesor where idasesor=$id_solicitante_actual";						
												$res_qry_empleado=$query($qry_empleado);
												while($row_qry_empleado=$fetch_array($res_qry_empleado))
												{
													$contenido[$item]=$row_qry_empleado["nombre"].' '.$row_qry_empleado["nombre2"].' '.$row_qry_empleado["apellido"].' '.$row_qry_empleado["apellido2"];
												}												
											}
											else
											if ($row_qry_plantilla2["codigo_tipo_campo"]==12)
											{					
												conectardb($vehiculos);
												$id_vehiculo_actual=$contenido[$item];
												$qry_vehiculo="SELECT tb_inventario.codigo_inventario_enc, cat_marca.marca, cat_linea_estilo_vehiculo.linea_estilo_vehiculo, 
												tb_inventario.numero_placa_vehiculo, cat_objeto.objeto
												FROM tb_inventario 
												LEFT JOIN cat_marca ON tb_inventario.codigo_marca=cat_marca.codigo_marca 
												LEFT JOIN cat_linea_estilo_vehiculo ON tb_inventario.codigo_linea_estilo_vehiculo=cat_linea_estilo_vehiculo.codigo_linea_estilo_vehiculo 
												LEFT JOIN cat_objeto ON tb_inventario.codigo_objeto=cat_objeto.codigo_objeto 
												WHERE tb_inventario.codigo_inventario_enc='$id_vehiculo_actual' 
												ORDER BY cat_marca.marca, cat_linea_estilo_vehiculo.linea_estilo_vehiculo, tb_inventario.numero_placa_vehiculo, 
												cat_objeto.objeto";						
												$res_qry_vehiculo=$query($qry_vehiculo);
												while($row_qry_vehiculo=$fetch_array($res_qry_vehiculo))
												{
													$contenido[$item]=$row_qry_vehiculo["objeto"].' '.$row_qry_vehiculo["marca"].' '.$row_qry_vehiculo["linea_estilo_vehiculo"].' '.$row_qry_vehiculo["numero_placa_vehiculo"];
												}											
											 }	
											 }			*/																																						 
											$clase = "boxTitleBgMidGrey";
											if ($i % 2 == 0) 
											{
											  $clase = "boxTitleBgLightGrey";
											}
											echo '<td class='.$clase.'>'.$contenido[$item].'</td>';																				
											$item++;																										
										//}  // fin del while	res_qry_plantilla			
										echo '</tr>';																											
								}//fin while res_qry_item_catalogo	
								$free_result($res_qry_item_catalogo);	
								if (!$hay_detalle)
								{
									echo '<tr><td class="error" colspan="3" align="center">NO SE ENCONTRARON REGISTROS<br>DE MANTENIMIENTO DE ESTE VEHICULO</td></tr>';
								}
							 /////////////////////////////////////
							 } // fin while res_qry_insertados
							 $free_result($res_qry_insertados);								 											 
				  if (!$hay_registros)
				  {
					echo '<tr><td class="error" colspan="3" align="center">NO SE ENCONTRARON REGISTROS QUE COINCIDAN CON LA BUSQUEDA<br><br>Para intentar nuevamente <a href="buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
				  }	
			} // fin if acceso
		} // fin del if isset obj		
	?>            	  
</table>
</body>
</html>
