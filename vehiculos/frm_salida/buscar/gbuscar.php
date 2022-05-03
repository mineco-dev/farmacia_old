<?
require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo2 {color: #000066}
.titulo

{
font-size:24px;
font-family:Arial, Helvetica, sans-serif, Courier, monospace, sans-serif, sans-serif;
color:#0000FF;
}
-->
</style>
</head>
<!-- se agrego style="background:#CEECF5"-->
<body style="background:#CEECF5">
<table width="100%"  border="0">  
  <tr>
    <td height="8" colspan="3">
	    
      <div align="center"><span class="titulocategoria titulo">APROBACI&Oacute;N DE SOLICITUDES DE VEHICULOS</span></div></td> 
  </tr>
</table>   
<table border="10" width="95%" cellpadding="0" cellspacing="0" align="center" >
	<?			
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{
		$acceso=permisosdb($vehiculos);					
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
				conectardb($vehiculos);
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
					$qry_datos_insertados.="$campo_detalle, tb_salida_vehiculo.codigo_estado_salida_vehiculo as color  ";
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
				if (strlen($qry_condicion)>=1) $qry_condicion.="and codigo_estado_salida_vehiculo in(2, 3, 4) and tb_salida_vehiculo.activo=1";
				else $qry_condicion="tb_salida_vehiculo.activo=1";
				
				$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_condicion.' '.$qry_orden.' '.$qry_orden2;																									
				$res_consulta=$query($qry_detalle);
				if ($res_consulta)
				{	   	  			
					 // echo '<tr><td align="right" colspan="'.$no_campos_detalle.'"><a href="../agregar.php"><img src="../../images/iconos/ico_agregar.gif" alt="Agregar registro" border="0"></a></td></tr>';
					  $no_campos_detalle++;
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
						echo '<td class="boxTitleBgLightBlue" align="center">Estado</td>';						
						echo '<td class="boxTitleBgLightBlue" align="center">Operar</td>';
						echo '<td class="boxTitleBgLightBlue" align="center">Rechazar</td>';
						echo '</tr>';
						$no_campos_detalle=$no_campos_detalle-2;						
						while($row_qry_insertados=$fetch_array($res_qry_insertados))
						{
							  $status=$row_qry_insertados["activo"];
							  $color=$row_qry_insertados["color"];	
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
								 if ($color==2)
								echo '<td class='.$clase.'><center><img src="../../../images/punto_rojo.jpg" alt="Solicitud nueva" border="0"></center></td>';  					
								else
								if ($color==3)
									echo '<td class='.$clase.'><center><img src="../../../images/punto_amarillo.jpg" alt="Solicitud autorizada" border="0"></center></td>';  					
									else
									if ($color==4)
										echo '<td class='.$clase.'><center><img src="../../../images/punto_verde.jpg" alt="Solicitud en transito" border="0"></center></td>';  					
										if (($color==2) || ($color==3))
										{
											echo '<td class='.$clase.'><center><a href="../operar.php?id='.$row_qry_insertados[0].'&obj='.$obj.'"><img src="../../../images/iconos/transferencia.gif" alt="Operar solicitud" border="0"></a></center></td>';  									
											if ($status==1)				
												echo '<td class='.$clase.'><center><a href="../status.php?id='.$row_qry_insertados[0].'&st=3&txt_obj='.$obj.'"><img src="../../../images/iconos/ico_esperar.jpg" alt="Eliminar esta solicitud" border="0"></a></center></td>';											
										}				
										else
										{
											echo '<td class='.$clase.'><center>&nbsp;</center></td>'; 
											echo '<td class='.$clase.'><center>&nbsp;</center></td>';  									 									
										}			
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
<!--<p><img src="../../../images/pc.gif" width="10%" height="75"> </p>-->
<p><img src="../../../images/pc.gif" width="10%" height="75"> </p>
</body>
</html>
