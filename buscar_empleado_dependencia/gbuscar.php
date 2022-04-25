<?
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../includes/helpdesk.css" rel="stylesheet" type="text/css">
</head>
<!-- se agrego style="background:#CEECF5" -->
<body style="background:#CEECF5">
<table width="100%"  border="0">
  <tr>
    <td width="18%" height="25"><div align="center"><img src="../images/camaro.jpg" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE RECURSOS HUMANOS</p>
    <p align="center" class="titulocategoria"> RESULTADO DE LA BUSQUEDA </p></td>
    <td width="10%"><div align="right"></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../images/linea.gif" width="100%" height="6"></td>   
  </tr>
</table>   
<table border="1" width="95%" cellpadding="0" cellspacing="0" align="center">
	<?				
	if (isset($txt_obj)) //verifico si hay objeto seleccionado
	{
		$acceso=permisosdb($rrhh);											
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj' and c.activo=1
							order by orden"; 			
			require_once('../connection/helpdesk.php');				
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($rrhh);
				$cnt=1;
				$no_campos_detalle=1;
				$qry_datos_insertados="SELECT ";
				$qry_datos_insertados3.="LEFT JOIN tb_contratacion_gobierno on tb_contratacion_gobierno.idasesor=asesor.idasesor ";
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
						$qry_datos_insertados3.="LEFT JOIN $latabla ON $tb_detalle.entidad_gobierno=$latabla.$campollave "; //parte 3 del qry del detalle						
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
					$qry_datos_insertados.="$campo_detalle";
					$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));	
					$qry_condicion="WHERE $tb_detalle.activo=1 ";								
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
							$qry_condicion.="AND tb_contratacion_gobierno.$campo[$cnt]='$variable' ";									
						}					
					}
					$cnt++;
				}// fin del while que forma el qry_consulta										
				$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_condicion.' '.$qry_orden.' '.$qry_orden2;																													
				$res_consulta=$query($qry_detalle);														
				if ($res_consulta)
				{
					  echo '<tr><td colspan="'.$no_campos_detalle.'" align="right"><a href="buscar.php" target="_parent">[VOLVER A FILTRAR]</a></td></tr>';
		  			  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="center">RESULTADOS DE LA B�SQUEDA</td></tr>';		  			
					  $res_qry_insertados=$query($qry_detalle);	
					  $hay_registros=false;	 
					  $i=1;					  
					  $cnt=2; //imprime etiquetas
					  echo '<tr>';  			
			
						while ($cnt<=count($etiqueta)) 
						{	
							echo '<td align="center" class="boxTitleBgLightBlue">';
							echo $etiqueta[$cnt];
							echo '</td>';
							$cnt++;
						}	
						echo '<td class="boxTitleBgLightBlue" align="center">Seleccionar</td>';
						echo '</tr>';
						$no_campos_detalle=$no_campos_detalle-2;
						while($row_qry_insertados=$fetch_array($res_qry_insertados))
						{
							  $completo=$row_qry_insertados["nombre"].' '.$row_qry_insertados["nombre2"].' '.$row_qry_insertados["apellido"].' '.$row_qry_insertados["apellido2"].' EN **'.$row_qry_insertados["1"].'**';
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
								echo "<td class=".$clase."><a href=\"javascript:void(0)\" onClick=\"window.opener.document.getElementById('$tipo"."[".$posi."][0]').value = '$completo'; 
									window.opener.document.getElementById('$tipo"."[".$posi."][1]').value = '".$row_qry_insertados[0]."';
									window.close();
									window.opener.focus(); 
									return false;\"><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar este empleado\"></a></center></td></a></center></td>";	
							   echo '</tr>';
							$i++;
						}
						$free_result($res_qry_insertados);
				  }					
					else
					{
						echo '<tr><td class="error" colspan="3" align="center">NO SE ENCONTRARON REGISTROS QUE COINCIDAN CON LA BUSQUEDA<br><br>Para intentar nuevamente <a href="buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
					}	
			}
		} // fin del if isset obj		
	?>            	  
</table>
</body>
</html>
