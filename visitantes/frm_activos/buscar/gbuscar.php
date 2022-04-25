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
    <td height="8" colspan="3">    
      <div align="center"><span class="legal2">VISITANTES QUE COINCIDEN CON LA B�SQUEDA</span></div></td>   
  </tr>
</table>   
<table border="1" width="95%" cellpadding="0" cellspacing="0" align="center">
	<?			
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{
		$acceso=permisosdb($visitantes);					
		if (($acceso>=1) && ($acceso<=8))
		{			
			if (($acceso==1) || ($acceso==4) || ($acceso==5)) $status='disabled'; else $status='';				
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda, c.incluir_en_detalle,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj'
							order by orden";					  
				require_once('../../../connection/helpdesk.php');			
				$res_qry_plantilla=$query($qry_plantilla);					
				$cnt=1;
				$no_campos_detalle=1;
				$qry_datos_insertados="select ";
				conectardb($visitantes);
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{	
					$tb_detalle=$row_qry_plantilla["tb_destino"];
					$qry_datos_insertados2="FROM $tb_detalle ";
					if (($row_qry_plantilla["codigo_tipo_campo"]==1) || ($row_qry_plantilla["codigo_tipo_campo"]==7))
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
						if ($row_qry_plantilla["incluir_en_detalle"]==1) {													
							$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];						
							$campo_detalle=$latabla.'.'.$campoorigen;												
							$qry_datos_insertados.="$campo_detalle, ";
							$no_campos_detalle++;
							$qry_datos_insertados3.="LEFT JOIN $latabla ON $tb_detalle.$campollave=$latabla.$campollave "; //parte 3 del qry del detalle						
							$qry_orden2.="$campo_detalle, "; }
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
					else
					if (($row_qry_plantilla["codigo_tipo_campo"]==8) && ($status==''))
					{							
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
						$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
						$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
						$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
						$qry_orden2.="$campo_detalle, ";							
					}
					else
					if (($row_qry_plantilla["codigo_tipo_campo"]==10) && ($status==''))
					{							
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
						$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
						$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
						$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
						$qry_orden2.="$campo_detalle, ";
					}																							
					$campo[$cnt]=$row_qry_plantilla["campo"];
					$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];								
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
					$free_result($res_qry_plantilla);
					$campo_detalle=$tb_detalle.'.activo';
					$qry_orden="order by ";
					$qry_datos_insertados.="$campo_detalle ";
					$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));	
					$qry_condicion="WHERE seg_visita_det.codigo_estado<5 ";	
				$cnt=1;
				while ($cnt<=count($campo)) //si los campos traen algun contenido, los compara para filtrarlos
				{
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);					
					if ((!$variable=="") && (!$variable=="0"))
					{						
						if ($codigo_visitante!="")
						{	
							$qry_condicion.=" and seg_visitante.nombre_visitante like '%$variable%' ";									
						}
						else
						if (gafete_asignado!="")
						{
							$qry_condicion.=" and seg_visita.gafete_asignado='$variable' ";									
						}																				
					}
					$cnt++;					
				}// fin del while que forma el qry_consulta																									
				
				$qry_detalle='select seg_visita_det.codigo_visita_det, seg_visitante.nombre_visitante, seg_visita.gafete_asignado, seg_visita_det.codigo_estado, seg_visitante.codigo_visitante, seg_visita.codigo_visita
FROM seg_visitante INNER JOIN seg_visita ON seg_visitante.codigo_visitante=seg_visita.codigo_visitante 
INNER JOIN seg_visita_det ON seg_visita.codigo_visita=seg_visita_det.codigo_visita '.$qry_condicion .' 
order by seg_visitante.nombre_visitante, seg_visita.gafete_asignado';																													
				
				$res_consulta=$query($qry_detalle);		
				
				if ($res_consulta)
				{	   	  			
					 // echo '<tr><td align="right" colspan="'.$no_campos_detalle.'"><a href="../agregar.php"><img src="../../images/iconos/ico_agregar.gif" alt="Agregar registro" border="0"></a></td></tr>';
					  $no_campos_detalle++;	
					  $no_campos_detalle++;					
					  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="center">RESULTADOS DE LA B�SQUEDA</td></tr>';		  			  					  
					  $res_qry_insertados=$query($qry_detalle);		 
					  $no_campos_detalle--;
					  $i=1;					  
						 $cnt=2; //imprime etiquetas
			echo '<tr>';  			
			$etiqueta[2]='NOMBRE DEL VISITANTE';
			$etiqueta[3]='GAFETE';
			
			while ($cnt<=count($etiqueta)) 
			{	
				echo '<td align="center" class="boxTitleBgLightBlue">';
				echo $etiqueta[$cnt];
				echo '</td>';
				$cnt++;
			}	
			echo '<td class="boxTitleBgLightBlue" align="center">VER</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">ESTADO</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">TRASLADAR</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">DETENER</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">ACERCA DE</td>';
			echo '</tr>';
		  $no_campos_detalle=5-3;
		  while($row_qry_insertados=$fetch_array($res_qry_insertados))
		  {
			  $status=$row_qry_insertados["codigo_estado"];			 
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
			  echo '<td class='.$clase.'><center><a href="../../frm_salida/consulta_visitas.php?id='.$row_qry_insertados[4].'&idv='.$row_qry_insertados[5].'&idvd='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_arrow_down.gif" alt="Ver detalles de esta visita" border="0"></a></center></td>';  
				if ($status==1)		
				{						 
				echo '<td class='.$clase.'><center><a href="../confirmar.php?id='.$row_qry_insertados[0].'&obj='.$txt_obj.'"><img src="../../../images/iconos/ico_pend_confirmar.gif" alt="Aceptar esta visita" border="0">&nbsp;Aceptar</a></center></td>';  
				}
				else
				if ($status==2)		
				{						 
				echo '<td class='.$clase.'><center><img src="../../../images/iconos/ico_aceptada.gif" alt="Visita confirmada" border="0">Aceptada</center></td>';  
				
			  }	
			  else
				if ($status==3)		
				{						 
				echo '<td class='.$clase.'><center><a href="../confirmar.php?id='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_trasladado.gif" alt="Visita trasladada de otra dependencia" border="0">Aceptar</a></center></td>';  			  }			  						 
				echo '<td class='.$clase.'><center><a href="../../frm_ingreso/trasladar.php?id='.$row_qry_insertados[4].'&idv='.$row_qry_insertados[5].'&idvd='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_trasladar.gif" alt="Trasladar visita a otra dependencia" border="0"></a></center></td>';  
				echo '<td class='.$clase.'><center><a href="../../frm_ingreso/detener.php?id='.$row_qry_insertados[4].'&idv='.$row_qry_insertados[5].'&idvd='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_detener.gif" alt="Impedir salida" border="0"></a></center></td>'; 
				echo '<td class='.$clase.'><center><a href="../../frm_ingreso/perfil_visitante.php?id='.$row_qry_insertados[4].'&ids='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_expediente.gif" alt="Información del visitante" border="0"></a></center></td>';  		  				 				  				 		
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
		else
		{
			echo '<tr><td class="error" colspan="3" align="center">NO HA SELECCIONADO NINGUN OBJETO PARA LA BUSQUEDA, PARA INTENTARLO NUEVAMENTE <a href="buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
		}
	?>            	  
</table>
</body>
</html>
