<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
?>
<?
		//RECUPERA LOS DATOS DEL REGISTRO		
		$obj=1;		
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			$acceso=permisosdb($vehiculos);					
			if (($acceso==1) || ($acceso==3) || ($acceso==4) || ($acceso==5) || ($acceso==6) || ($acceso==7) || ($acceso==8))
			{							
				if (($acceso==1) || ($acceso==3)) $status='disabled'; else $status='';	
				$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
								c.campo_origen, c.campo_llave as campollave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
								p.condicion, p.campo_llave
								FROM tb_campo c inner join tb_plantilla p
								on c.codigo_campo=p.codigo_campo
								where p.codigo_formulario='$obj' and c.activo=1
								order by orden";																																								
				require('../../connection/helpdesk.php');				
				$res_qry_plantilla=$query($qry_plantilla);			
				$i=1;
				$cnt=1;					
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))				
				{	
					$campo[$cnt]=$row_qry_plantilla["campo"];									
					$tipo_campo2[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];					
					if ($row_qry_plantilla["campo_llave"]==1)  //para saber en que tabla y a traves de que campo se realizara el filtro del reg. seleccionado.
					{
						$tabla_destino=$row_qry_plantilla["tb_destino"];
						$campo_llave_destino=$row_qry_plantilla["campo"];							
					}							
					$cnt++;		
				}					
				$cnt=1;	
				$qry_item_catalogo="select";
				while($cnt<=count($campo))  //para que devuelva el contenido de los campos del registro que se esta editando
				{	
					$campotemp=$campo[$cnt];					
					if (($tipo_campo2[$cnt]==8) || ($tipo_campo2[$cnt]==10)) $campotemp="convert(nvarchar, $campo[$cnt], 126) as $campo[$cnt]"; //para MSSQL					
					$qry_item_catalogo.=" $campotemp, ";
					$cnt++;
				}
				$qry_item_catalogo.="usuario_creo from $tabla_destino where $campo_llave_destino=$id";				
				$res_qry_plantilla=$query($qry_plantilla);	
////////////////SI ES UNA DB DISTINTA AQUI CAMBIA LA CONEXION
				conectardb($vehiculos);															
				$res_qry_item_catalogo=$query($qry_item_catalogo);	//devuelve datos del objeto que se esta editando							
				$cnt=1;				
				while($row_qry_item_catalogo=$fetch_array($res_qry_item_catalogo))
				{
					while ($cnt<=count($campo))  // arreglo que contiene el contenido del registro editado
					{
						$contenido[$cnt]=$row_qry_item_catalogo["$campo[$cnt]"];												
						$cnt++;
					}				
				}
				$item=1;
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{				
						if ($row_qry_plantilla["codigo_tipo_campo"]==2)
						{
							$latabla=$row_qry_plantilla["tb_origen"];
							$campoorigen=$row_qry_plantilla["campo_origen"];
							$campollave=$row_qry_plantilla["campollave"];						
							$condicion=$row_qry_plantilla["condicion"];						
							$nombre_div=$row_qry_plantilla["codigo_campo"];	
							$qry_cbo="SELECT * FROM $latabla where $campollave=$contenido[$item] order by $campoorigen";												 																		
							$res_qry_cbo=$query($qry_cbo);
							while($row_qry_cbo=$fetch_array($res_qry_cbo))
							{
								$contenido[$item]=$row_qry_cbo["$campoorigen"];																						
							}										
						} // fin de cada combo.									
						else
						if ($row_qry_plantilla["codigo_tipo_campo"]==8)
						{	
							$day=substr($contenido[$item],8,2);
							$month = strtolower(substr($contenido[$item],5,2));
							$year = substr($contenido[$item],0,4);
							$contenido[$item]=$day.'-'.$month.'-'.$year;
						}						
						else
						if ($row_qry_plantilla["codigo_tipo_campo"]==10)
						{							
							$day=substr($contenido[$item],8,2);
							$month = strtolower(substr($contenido[$item],5,2));
							$year = substr($contenido[$item],0,4);
							$hour = substr($contenido[$item],11,2);
							$min = substr($contenido[$item],14,2);
							$contenido[$item]=$day.'-'.$month.'-'.$year.' '.$hour.':'.$min;						
						}
						else
						if ($row_qry_plantilla["codigo_tipo_campo"]==11)
						{					
							conectardb($rrhh);
							$id_solicitante_actual=$contenido[$item];
							$qry_empleado= "select (a.nombre+' '+a.apellido+' '+a.apellido2) as empleado, d.nombre from asesor a 
											inner join tb_contratacion_gobierno c on a.idasesor=c.idasesor
											inner join direccion d on d.iddireccion=c.entidad_gobierno											
											where a.idasesor=$id_solicitante_actual";	
							$res_qry_empleado=$query($qry_empleado);
							while($row_qry_empleado=$fetch_array($res_qry_empleado))
							{
								$contenido[$item]=$row_qry_empleado["empleado"];								
								$dependencia=$row_qry_empleado["nombre"];
								$jefe=$row_qry_empleado["jefe"];
							}							
						}					
						$item++;

					}	 //fin de creacion de campos.				
				}		
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
					$status='disabled';
				}			
	} //fin if isset obj
		$free_result($res_qry_plantilla);
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
function imprimir()
{
	window.print();
}


</script>
</head>

<body>
<table width="90%"  border="0" align="center">
  <tr>
    <td width="18%" height="25"><div align="center"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA ADMINISTRATIVA</p>
      
	  <p align="center" class="titulocategoria"> HISTORIAL DE MANTENIMIENTO DE VEHICULOS </p></td>
    <td width="10%" align="center"><? echo '<img src="../frm_inventario/archivos/'.$contenido[23].'" width="100%">'; ?></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>  
</table> 
  
<table width="90%"  border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="11%" class="boxTitleBgStone">No. Placa :</td>
    <td width="25%" class="boxTitleBgLightBlue"><? echo $contenido[2]; ?></td>
    <td width="6%" class="boxTitleBgStone">Marca:</td>
    <td width="20%" class="boxTitleBgLightBlue"><? echo $contenido[3]; ?></td>
    <td width="10%" class="boxTitleBgStone">Responsable:</td>
    <td width="28%" class="boxTitleBgLightBlue"><? echo $contenido[25]; ?></td>
  </tr>
  <tr>
    <td class="boxTitleBgStone">Modelo:</td>
    <td class="boxTitleBgLightBlue"><? echo $contenido[5]; ?></td>
    <td class="boxTitleBgStone">L&iacute;nea:</td>
    <td class="boxTitleBgLightBlue"><? echo $contenido[4]; ?></td>
    <td class="boxTitleBgStone">Propiedad de: </td>
    <td class="boxTitleBgLightBlue"><? echo $contenido[21]; ?></td>
  </tr>
  <tr>
    <td class="boxTitleBgStone">Color:</td>
    <td class="boxTitleBgLightBlue"><? echo $contenido[6]; ?></td>
    <td class="boxTitleBgStone">Tipo:</td>
    <td class="boxTitleBgLightBlue"><? echo $tipo; ?></td>
    <td class="boxTitleBgStone">SICOIN:</td>
    <td class="boxTitleBgLightBlue"><? echo $contenido[20]; ?></td>
  </tr>
</table>
<table border="1" width="90%" cellpadding="0" cellspacing="0" align="center">
	<?				
	$obj=11;
	if (isset($obj)) //verifico si hay objeto seleccionado
	{				
		$acceso=permisosdb($vehiculos);											
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{			
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$obj' and c.activo=1
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
						$temp2=$row_qry_plantilla["campo"];
						$temp="convert(nvarchar, $campo_detalle, 103) as $temp2";
						$campo_detalle=$temp; //campo para concatenar al qry.									
						$campo_detalle2=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
						$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
						$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
						$qry_orden2.="$campo_detalle2, ";						
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
					$qry_condicion="WHERE $tb_detalle.codigo_inventario_enc='$id'";								
				$cnt=1;				
				$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_condicion.' '.$qry_orden.' '.$qry_orden2;																																																													
				$res_consulta=$query($qry_detalle);										
				if ($res_consulta)
				{		 			 					 					 
					  echo '<br>';
					  echo '<tr><td colspan="'.$no_campos_detalle.'" align="center"></td></tr>';
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
						echo '</tr>';						
						$no_campos_detalle=$no_campos_detalle-2;
						$hay_detalle=false;
						while($row_qry_insertados=$fetch_array($res_qry_insertados))
						{
							  $hay_detalle=true;
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
							   echo '</tr>';
							$i++;
						}
						$free_result($res_qry_insertados);
				  }					
					if (!$hay_detalle)
					{
						echo '<tr><td class="error" colspan="'.$no_campos_detalle.'" align="center">NO SE ENCONTRARON REGISTROS DE MANTENIMIENTO<br>PARA ESTE VEH�CULO</td></tr>';
					}	
			}
		} // fin del if isset obj		
	?>            	  
</table>
<table width="90%"  border="0" align="center">
  <tr>
    <td width="53%"><a href="buscar.php"><img src="../../images/iconos/ico_transferir.jpg" alt="Volver a filtrar" width="29" height="18" border="0"></a></td>
    <td width="47%"><div align="right"><? print date("d/m/Y H:i:s         ");?><img src="../../images/iconos/ico_print.gif" onclick="imprimir();" width="30" height="30"></div></td>
  </tr>
</table>
</body>
</html>
