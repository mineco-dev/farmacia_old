<?
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");
	session_register("ingresando_obj");
	$_SESSION["ingresando_obj"]=true;
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<script src="../../../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language='javascript' src="../../../includes/buscar_calendario/popcalendar.js"></script>
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
<script type="text/javascript"> 
var peticion = false; 
var  testPasado = false; 
try { 
  peticion = new XMLHttpRequest(); 
  } catch (trymicrosoft) { 
  try { 
  peticion = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (othermicrosoft) { 
  try { 
  peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
  } catch (failed) { 
  peticion = false; 
  } 
  } 
} 
if (!peticion) 
alert("ERROR AL INICIALIZAR!"); 
  
function cargarCombo (url, comboAnterior, element_id) {
    //Obtenemos el contenido del div
    //donde se cargaran los resultados
    var element =  document.getElementById(element_id);
    //Obtenemos el valor seleccionado del combo anterior
    var valordepende = document.getElementById(comboAnterior)
    var x = valordepende.value
    //construimos la url definitiva
    //pasando como parametro el valor seleccionado
    var fragment_url = url+'&Id='+x;
    element.innerHTML = '<img src="../../../images/loading.gif" />';
    //abrimos la url
    peticion.open("GET", fragment_url);
    peticion.onreadystatechange = function() {
        if (peticion.readyState == 4) {
	//escribimos la respuesta
	element.innerHTML = peticion.responseText;
        }
    }
   peticion.send(null);
}
</script>
<script language="javascript">
function url(uri)
{
	location.href=uri; 
} 
</script>

<style type="text/css">
<!--
.Estilo1 {font-size: medium}
.style6 {font-size: 12px}

-->
</style>

</head>

<body>
<div align="center">
  <table width="90%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th class="legal2" scope="row">CONSULTA DE VISITANTES ACTIVOS</th>
    </tr>
    <tr>
   <th><img src="../../../images/linea.gif" width="100%" height="6"></th>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="gbuscar.php">
<table width="90%"  border="0" align="center">   
	  <table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <?
		$obj=40;
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
		$acceso=permisosdb($visitantes);									
		if (($acceso>=1) && ($acceso<=8))
		{	
			if (($acceso==1) || ($acceso==4) || ($acceso==5)) $status='disabled'; else $status='';					
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda, c.cambio_fila, c.incluir_en_detalle,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$obj' and c.activo=1
							order by orden"; 													
				
			$no_campos_detalle=1;
			$qry_datos_insertados="select ";
			require_once('../../../connection/helpdesk.php');
			$res_qry_plantilla=$query($qry_plantilla);	
			$no_campos=2;							
			echo '<tr><td colspan="'.$no_campos.'" align="left" class="boxTitleBgMidGrey"><img src="../../../images/iconos/buscar2.gif" alt="Para una b�squeda especifica ingrese información en los '.$no_campos.' campos" border="0"></td></tr>';	
			$i=1;		
			conectardb($visitantes);										
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				$tb_detalle=$row_qry_plantilla["tb_destino"];
				$qry_datos_insertados2="FROM $tb_detalle ";
				/*if ($row_qry_plantilla["validar"]==1)
				{					
					$campo_validacion[$i]=$row_qry_plantilla["campo"];
					$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
					$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_campo"];														
					$i++;						
				}	*/					
				if (strlen($row_qry_plantilla["etiqueta"])>3)
				{					
				if (($row_qry_plantilla["cambio_fila"]==1) || ($row_qry_plantilla["cambio_fila"]==3))				
				echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'&nbsp;';
				else
				if ($row_qry_plantilla["cambio_fila"]==2)
				echo '&nbsp;'.$row_qry_plantilla["etiqueta"].'&nbsp;';
				//if ($row_qry_plantilla["validar"]==1) echo '<span class="error">**</span>';
				if (($row_qry_plantilla["cambio_fila"]==1) || ($row_qry_plantilla["cambio_fila"]==3)) 
				{
					echo '</td>';																					
					echo '<td class="boxTitleBgLightGrey">';				
				}
				if (($row_qry_plantilla["codigo_tipo_campo"]==1) || ($row_qry_plantilla["codigo_tipo_campo"]==7))
				{					
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
					$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
					$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
					$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
					$qry_orden2.="$campo_detalle, ";
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="text" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'" '.$status.'>';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==2)
				{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];	
						$condicion=$row_qry_plantilla["condicion"];	
						if ($row_qry_plantilla["incluir_en_detalle"]==1) {													
							$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];						
							$campo_detalle=$latabla.'.'.$campoorigen;												
							$qry_datos_insertados.="$campo_detalle, ";
							$no_campos_detalle++;
							$qry_datos_insertados3.="LEFT JOIN $latabla ON $tb_detalle.$campollave=$latabla.$campollave "; //parte 3 del qry del detalle						
							$qry_orden2.="$campo_detalle, "; }
						$nombre_div=$row_qry_plantilla["codigo_campo"];						
						$qry_cbo="SELECT * FROM $latabla where $condicion order by $campoorigen"; 
						$res_qry_cbo=$query($qry_cbo);							
						if ($row_qry_plantilla["tipo_combo"]==1)							
						{
							echo('<select name="'.$row_qry_plantilla["campo"].'" '.$status.'>');
							echo'<option value="0">--Seleccione--</option>';				
							while($row_qry_cbo=$fetch_array($res_qry_cbo))
							{
								echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
							}
								echo('</select>');																	
						}	
						else
						if ($row_qry_plantilla["tipo_combo"]==3)
						{							
							$nombre_div=$row_qry_plantilla["combo_destino"];															
							echo('<select name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["campo"].'\', \''.$nombre_div.'\' '.$status.')">');
							echo'<option value="0">--Seleccione--</option>';				
							while($row_qry_cbo=$fetch_array($res_qry_cbo))
							{
								echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
							}
								echo('</select>');																	
						}
						else	
						if (($row_qry_plantilla["tipo_combo"]==2) || ($row_qry_plantilla["tipo_combo"]==4))
						{								
							echo '<div id="'.$nombre_div.'">';
							echo '<select name="'.$row_qry_plantilla["campo"].'"  id="'.$row_qry_plantilla["campo"].'" disabled>';
							echo '</select>';
							echo '</div>';
						}
						$free_result($res_qry_cbo);					
				} // fin de cada combo.				
				/*else				
				if ($row_qry_plantilla["codigo_tipo_campo"]==5)
				{					
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="file" id="'.$row_qry_plantilla["campo"].'" '.$status.'>';
        			echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';
				}*/
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==6)
				{					
					$latabla=$row_qry_plantilla["tb_destino"];
					$campoorigen=$row_qry_plantilla["campo_destino"];					
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];
					$campo_detalle=$latabla.'.'.$campoorigen;
					$qry_datos_insertados.="$campo_detalle, ";
					$no_campos_detalle++;
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="hidden" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'" '.$status.'>';
				}	
				else
				if (($row_qry_plantilla["codigo_tipo_campo"]==8) && ($status==''))
				{							
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
					$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
					$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
					$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
					$qry_orden2.="$campo_detalle, ";
					echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value =""/>';
					echo '<img src="../../../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';								
				}	
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==9)
				{					
					echo '<textarea name="'.$row_qry_plantilla["campo"].'" cols="'.$row_qry_plantilla["tamano"].'" rows="4" '.$status.'></textarea>';
				}
				else
				if (($row_qry_plantilla["codigo_tipo_campo"]==10) && ($status==''))
				{							
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
					$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
					$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
					$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
					$qry_orden2.="$campo_detalle, ";
					echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value =""/>';
					echo '<img src="../../../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';								
					echo '&nbsp;&nbsp;&nbsp;<select name="'.$row_qry_plantilla["campo"].'_hora"  id="'.$row_qry_plantilla["campo"].'_hora">';
					echo '<option value="0">HRS</option>';
					$j=8;						
					while ($j<=17)
					{
						print ' <option value="'.$j.'" >'.$j.'</option>';							  
					   $j++;
					}
					echo '</select>';
					echo '<select name="'.$row_qry_plantilla["campo"].'_minutos"  id="'.$row_qry_plantilla["campo"].'_minutos">';
					echo '<option value="0.5">MIN</option>';
					$j=00;						
					while ($j<60)
					{
						print ' <option value="'.$j.'" >'.$j.'</option>';							  
					   $j=$j+10;
					}
					echo '</select>';
				}/*
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==11)
				{					
					echo '<a href="javascript:void(0)" onclick="buscar=window.open(\'../../frm_buscar_empleado/buscar.php?tipo='.$row_qry_plantilla["campo"].'&posi=0\',\'Buscar\',\'width=650,height=425,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;"><input name="'.$row_qry_plantilla["campo"].'_name" type="text" id="'.$row_qry_plantilla["campo"].'_name" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55" disabled /></a>';
  					echo '<input type="hidden" name="'.$row_qry_plantilla["campo"].'_id" id="hiddenField"/>';					
				}
				if (strlen($row_qry_plantilla["ayuda"])>=5)
				{
					echo '&nbsp;&nbsp;';
					echo '<img src="../images/iconos/ico_help.gif" alt="'.$row_qry_plantilla["ayuda"].'" border="0">';
				}*/
				if (($row_qry_plantilla["cambio_fila"]==1) || ($row_qry_plantilla["cambio_fila"]==2)) echo '</td></tr>';						
			}	 //fin de creacion de campos.
			}		
			echo '<tr><td colspan="3" class="error"><img src="../../../images/e05.gif" alt="Idea" border="0">&nbsp;&nbsp; Si escribe nombre y apellido sep�relos con el signo de porcentaje (%)</td></tr>';						
			/*$campo_detalle=$tb_detalle.'.activo';
			$condicion_detalle="where $campo_detalle=1";
			$qry_orden="order by ";
			$qry_datos_insertados.="$campo_detalle ";
			$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));						
			$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$condicion_detalle.' '.$qry_orden.' '.$qry_orden2;	*/												
			$free_result($res_qry_plantilla);
			$qry_detalle="select seg_visita_det.codigo_visita_det, seg_visitante.nombre_visitante, seg_visita.gafete_asignado, seg_visita_det.codigo_estado, seg_visitante.codigo_visitante, seg_visita.codigo_visita
FROM seg_visitante INNER JOIN seg_visita ON seg_visitante.codigo_visitante=seg_visita.codigo_visitante 
INNER JOIN seg_visita_det ON seg_visita.codigo_visita=seg_visita_det.codigo_visita WHERE seg_visita_det.codigo_estado<5
order by seg_visitante.nombre_visitante, seg_visita.gafete_asignado";
		}	
	?>
	<tr>   	          
	</td>
  	<tr>   
	<input type="hidden" name="nombre[0][1]" id="hiddenField"/>
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 			 		
	</tr>  
	
</table>	  	 
	 
 <?
  } // fin si esta seteado el objeto
  ?>
	  
	
		
	</td>   
	</tr>	 
</table> 
  <td width="17%"><div align="center"><span class="error">
      </tr> </span>
  <input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Iniciar b�squeda" >
  </div>  
  </form>
</table>
<table width="90%"  border="1" align="center" cellpadding="0" cellspacing="0"> 
  <?  	
  $mostrar_detalle=1;	
  if ($mostrar_detalle=="1")	  
  {	 
   		if (($acceso==1) || ($acceso==3) || ($acceso==4) || ($acceso==5) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{		 
		 // echo '<tr><td align="right" colspan="'.$no_campos_detalle.'"><a href="../agregar.php"><img src="../../../images/iconos/ico_agregar.gif" alt="Agregar registro" border="0"></a></td></tr>';		 
		  $res_qry_insertados=$query($qry_detalle);		  	 		
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
				echo '<td class='.$clase.'><center><a href="../confirmar.php?id='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_trasladado.gif" alt="Visita trasladada de otra dependencia" border="0">Aceptar</a></center></td>';  
				
			  }			  						 
				echo '<td class='.$clase.'><center><a href="../../frm_ingreso/trasladar.php?id='.$row_qry_insertados[4].'&idv='.$row_qry_insertados[5].'&idvd='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_trasladar.gif" alt="Trasladar visita a otra dependencia" border="0"></a></center></td>';  
				echo '<td class='.$clase.'><center><a href="../../frm_ingreso/detener.php?id='.$row_qry_insertados[4].'&idv='.$row_qry_insertados[5].'&idvd='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_detener.gif" alt="Impedir salida" border="0"></a></center></td>'; 
				echo '<td class='.$clase.'><center><a href="../../frm_ingreso/perfil_visitante.php?id='.$row_qry_insertados[4].'&ids='.$row_qry_insertados[0].'"><img src="../../../images/iconos/ico_expediente.gif" alt="Información del visitante" border="0"></a></center></td>';  		  				 				  				 		
			  echo '</tr>';
			  $i++;
		 }
		$free_result($res_qry_insertados);		
	}	
}		
  ?>
</table> 
</body>
</html>
<?	
	$i=1;
	echo '<script type="text/javascript">';
	echo 'function validar(form)';
	echo '{';							
			/*while($i<=count($campo_validacion))
			{				
				if ($tipo_campo[$i]=="1" || $tipo_campo[$i]=="5")
				{					
						echo 'if (form.'.$campo_validacion[$i].'.value == "")';
						echo '{ ';
								echo 'alert("'.$mensaje_validacion[$i].'");'; 
								echo 'form.'.$campo_validacion[$i].'.focus();'; 
								echo 'return;';
						echo '}';
				}
				else
				if ($tipo_campo[$i]=="2")
				{
						echo 'if (form.'.$campo_validacion[$i].'.value == "0")';
						echo '{ ';
							echo 'alert("'.$mensaje_validacion[$i].'");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}	
			$i++;
			}	*/
		echo '	if (confirm("�Iniciar� la b�squeda con los par�metros establecidos, desea continuar?")) form.submit();';
		//echo 'validar_subformularios(form);';
	echo '}';		
	echo '</script>';	
?>