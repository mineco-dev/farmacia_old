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
      <div align="center"><span class="legal2"><? echo $txt_nombre_obj; ?><br>RESULTADO DE LA BUSQUEDA</span></div></td>   
  </tr>
</table>   
<table border="1" width="95%" cellpadding="0" cellspacing="0" align="center">
	<?			
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{
		$obj=$txt_obj;
		$acceso=permisosdb($presupuesto);					
		if (($acceso>=1) && ($acceso<=8))
		{			
			if (($acceso==1) || ($acceso==4) || ($acceso==5)) $status='disabled'; else $status='';				
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
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
				conectardb($presupuesto);
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
					$qry_condicion="WHERE $campo_detalle>0 ";	
				$cnt=1;
				while ($cnt<=count($campo)) //si los campos traen algun contenido, los compara para filtrarlos
				{
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);					
					if ((!$variable=="") && (!$variable=="0"))
					{						
						if ($tipo_campo[$cnt]==1)
						{	
							$qry_condicion.=" and $tb_detalle.$campo[$cnt] like '%$variable%' ";									
						}
						else
						if ($tipo_campo[$cnt]==2)
						{
							$qry_condicion.=" and $tb_detalle.$campo[$cnt]='$variable' ";									
						}			
						else
						if ($tipo_campo[$cnt]==7)
						{
							$qry_condicion.=" and $tb_detalle.$campo[$cnt]='$variable' ";									
						}
						else
						if (($tipo_campo[$cnt]==8) || ($tipo_campo[$cnt]==10))
						{
							$dia=substr($_REQUEST["$campo[$cnt]"],0,2);
							$mes=substr($_REQUEST["$campo[$cnt]"],3,2);								
							$anio=substr($_REQUEST["$campo[$cnt]"],6,4);							
							$variable=$anio.'-'.$mes.'-'.$dia;							
							$qry_condicion.=" and $tb_detalle.$campo[$cnt]>='$variable' ";									
						}
						else
						if ($tipo_campo[$cnt]==9)
						{	
							$qry_condicion.=" and $tb_detalle.$campo[$cnt] like '%$variable%' ";									
						}												
					}
					$cnt++;					
				}// fin del while que forma el qry_consulta																														
				$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_condicion.' '.$qry_orden.' '.$qry_orden2;																													
				$res_consulta=$query($qry_detalle);
				if ($res_consulta)
				{	   	  			
					 // echo '<tr><td align="right" colspan="'.$no_campos_detalle.'"><a href="../agregar.php"><img src="../../images/iconos/ico_agregar.gif" alt="Agregar registro" border="0"></a></td></tr>';
					  $no_campos_detalle++;
					  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="right"><a href="../agregar.php?obj='.$obj.'"><img src="../../../images/agregar.gif" alt="AGREGAR '.$nombre_objeto.'" border="0"></a></td></tr>';
					  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="center">RESULTADOS DE LA B�SQUEDA</td></tr>';		  			  					  
					  $res_qry_insertados=$query($qry_detalle);		 
					  $no_campos_detalle--;
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
						echo '<td class="boxTitleBgLightBlue" align="center">Editar</td>';						
						echo '<td class="boxTitleBgLightBlue" align="center">Estado</td>';
						echo '</tr>';
						$no_campos_detalle=$no_campos_detalle-2;						
						while($row_qry_insertados=$fetch_array($res_qry_insertados))
						{
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
								echo '<td class='.$clase.'><center><a href="../editar.php?id='.$row_qry_insertados[0].'&obj='.$obj.'"><img src="../../../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td>';  					
			if ($status==1)				
		    echo '<td class='.$clase.'><center><a href="../status.php?id='.$row_qry_insertados[0].'&st=2&txt_obj='.$obj.'"><img src="../../../images/iconos/ico_activo.gif" alt="Desactivar" border="0"></a></center></td>';					
				else
				echo '<td class='.$clase.'><center><a href="../status.php?id='.$row_qry_insertados[0].'&st=1&txt_obj='.$obj.'"><img src="../../../images/iconos/ico_desactivado.gif" alt="Activar" border="0"></a></center></td>';					
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
