<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
	require_once('../../connection/helpdesk.php');
	session_register("ingresando_obj");
	$_SESSION["ingresando_obj"]=true;
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<script src="../../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language='javascript' src="../../includes/calendario/popcalendar.js"></script>
<script language="javascript">
function url(uri)
{
	location.href=uri; 
} 
</script>
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
    element.innerHTML = '<img src="../../images/loading.gif" />';
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

<style type="text/css">
<!--
.style3 {font-size: small}
.style4 {color: #FFFFFF}
.style5 {
	font-size: 16px;
	font-weight: bold;
}

-->
</style>
<style type="text/css">
body {
	background-image: url(../../imagen/Theme_Marcos/marco11.gif);
	margin-left: 20px;
	margin-top: 20px;
	margin-right: 20px;
	margin-bottom: 20px;
}
.Estilo2 {color: #0000FF}
</style>
</head>
<!-- se agrego style="background:#CEECF5"-->
<body style="background:#CCCCCC" >	
        <?
		$obj=22;
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			$acceso=permisosdb($inventarioadmin);					
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
				$res_qry_plantilla=$query($qry_plantilla);								
				//conectardb($inventarioadmin);	
				$i=1;
				$cnt=1;					
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))				
				{	
					$campo[$cnt]=$row_qry_plantilla["campo"];									
					$tipo_campo2[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];
					if ($row_qry_plantilla["validar"]==1)
					{
						$campo_validacion[$i]=$row_qry_plantilla["campo"];
						$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
						$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_campo"];			
						$i++;							
					}			
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
					//if ($cnt==count($campo)) $qry_item_catalogo.=" $campotemp "; else
					$qry_item_catalogo.=" $campotemp, ";
					$cnt++;
				}
				$qry_item_catalogo.="usuario_creo from $tabla_destino where $campo_llave_destino=$id";				
				$res_qry_plantilla=$query($qry_plantilla);	
////////////////SI ES UNA DB DISTINTA AQUI CAMBIA LA CONEXION
				conectardb($inventarioadmin);															
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
					/*echo '<tr><td class="boxTitleBgLightBlue" width="20%">'.$row_qry_plantilla["etiqueta"].'&nbsp;';					
					echo '</td>';
					echo '<td class="boxTitleBgStone">';													
						if (($row_qry_plantilla["codigo_tipo_campo"]==1) || ($row_qry_plantilla["codigo_tipo_campo"]==7))
						{
							echo '<input name="'.$row_qry_plantilla["campo"].'" type="text" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'" value="'.$contenido[$item].'" '.$status.'>';
						}
						else*/						
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
								//$codigo_valoractual=$row_qry_cbo["$campollave"];							
							}
							/*$qry_cbo="SELECT * FROM $latabla where $campollave<>$contenido[$item] and $condicion order by $campoorigen"; 	
							$res_qry_cbo=$query($qry_cbo);						
							echo('<input  name="'.$row_qry_plantilla["campo"].'_temp" type="hidden" id="'.$row_qry_plantilla["campo"].'_temp"  value="'.$codigo_valoractual.'"/>');
							if ($row_qry_plantilla["tipo_combo"]==1)							
							{
								echo('<select name="'.$row_qry_plantilla["campo"].'" '.$status.'>');
								echo'<option value="'.$codigo_valoractual.'">'.$valoractual.'</option>';				
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
								echo('<select name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["campo"].'\', \''.$nombre_div.'\')" '.$status.'>');
								echo'<option value="'.$codigo_valoractual.'">'.$valoractual.'</option>';				
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
								echo'<option value="'.$codigo_valoractual.'">'.$valoractual.'</option>';				
								echo '</select>';
								echo '</div>';
							}
							$free_result($res_qry_cbo);			*/				
						} // fin de cada combo.		
						/*else				
						if ($row_qry_plantilla["codigo_tipo_campo"]==5)
						{																	
							echo '<input name="'.$row_qry_plantilla["campo"].'" type="file" id="'.$row_qry_plantilla["campo"].'" '.$status.'>';
							echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';							
							if (strlen($contenido[$item])>5)						
							{
								echo '<a href="archivos/'.$contenido[$item].'"><img src="../images/iconos/ico_clip.gif" alt="Para ver el archivo que contiene el detalle de este equipo, pulse aqu�" border="0"></a>';
								echo('<input name="'.$row_qry_plantilla["campo"].'_temp" type="hidden" id="'.$row_qry_plantilla["campo"].'_temp"  value="'.$contenido[$item].'"/>');
							}	
						}		*/		
						else
					if ($row_qry_plantilla["codigo_tipo_campo"]==8)
					{	
						$day=substr($contenido[$item],8,2);
						$month = strtolower(substr($contenido[$item],5,2));
						$year = substr($contenido[$item],0,4);
						$contenido[$item]=$day.'-'.$month.'-'.$year;
						
						/*if ($status=='disabled')
						{
							echo $day.'-'.$month.'-'.$year;
						}	
						else
						{								
							echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value ="'.$day."-".$month."-".$year.'"/>';
							echo '<img src="../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';																																	
						}*/
					}	
					/*else
					if ($row_qry_plantilla["codigo_tipo_campo"]==9)
					{					
						echo '<textarea name="'.$row_qry_plantilla["campo"].'" cols="'.$row_qry_plantilla["tamano"].'" rows="4" '.$status.'>'.$contenido[$item].'</textarea>';
					}*/
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==10)
					{							
						$day=substr($contenido[$item],8,2);
						$month = strtolower(substr($contenido[$item],5,2));
						$year = substr($contenido[$item],0,4);
						$hour = substr($contenido[$item],11,2);
						$min = substr($contenido[$item],14,2);
						$contenido[$item]=$day.'-'.$month.'-'.$year.' '.$hour.':'.$min;
						/*if ($status=='disabled')
						{
							echo $day.'-'.$month.'-'.$year.' '.$hour.':'.$min;
						}	
						else
						{								
							echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value ="'.$day."-".$month."-".$year.'"/>';
							echo '<img src="../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';																																	
							echo '&nbsp;&nbsp;&nbsp;<select name="'.$row_qry_plantilla["campo"].'_hora"  id="'.$row_qry_plantilla["campo"].'_hora">';
							echo '<option value="'.$hour.'">'.$hour.'</option>';
							$j=8;						
							while ($j<=17)
							{
								print ' <option value="'.$j.'" >'.$j.'</option>';							  
							   $j++;
							}
							echo '</select>';
							echo '<select name="'.$row_qry_plantilla["campo"].'_minutos"  id="'.$row_qry_plantilla["campo"].'_minutos">';
							echo '<option value="'.$min.'">'.$min.'</option>';
							$j=00;						
							while ($j<60)
							{
								print ' <option value="'.$j.'" >'.$j.'</option>';							  
							   $j=$j+10;
							}
							echo '</select>';
						}*/
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==11)
					{					
						conectardb($rrhh);
						$id_solicitante_actual=$contenido[$item];
						$qry_empleado= "select (a.nombre+' '+a.apellido+' '+a.apellido2) as empleado, d.nombre, d.id_jefe, (j.nombre+' '+j.apellido) as jefe  from asesor a 
										inner join tb_contratacion_gobierno c on a.idasesor=c.idasesor
										inner join direccion d on d.iddireccion=c.entidad_gobierno
										inner join asesor j on j.idasesor=d.id_jefe
										where a.idasesor=$id_solicitante_actual";						
						$res_qry_empleado=$query($qry_empleado);
						while($row_qry_empleado=$fetch_array($res_qry_empleado))
						{
							$contenido[$item]=$row_qry_empleado["empleado"];
							$dependencia[$item]=$row_qry_empleado["nombre"];
							$jefe[$item]=$row_qry_empleado["jefe"];
						}							
						/*echo '<a href="javascript:void(0)" onclick="buscar=window.open(\'../frm_buscar_empleado/buscar.php?tipo='.$row_qry_plantilla["campo"].'&posi=0\',\'Buscar\',\'width=650,height=425,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;"><input name="'.$row_qry_plantilla["campo"].'_name" type="text" id="'.$row_qry_plantilla["campo"].'_name" value="'.$solicitante_actual.'" size="55" disabled /></a>';
						echo '<input type="hidden" name="'.$row_qry_plantilla["campo"].'_id" id="hiddenField" value="'.$id_solicitante_actual.'"/>';					*/
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==12)
					{					
						conectardb($vehiculos);
						$id_vehiculo_actual=$contenido[$item];
						$qry_vehiculo="SELECT tb_inventario.codigo_inventario_enc, cat_marca.marca, cat_linea_estilo_vehiculo.linea_estilo_vehiculo, 
						tb_inventario.numero_placa_vehiculo as placa, cat_objeto.objeto
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
							$numero_placa=$row_qry_vehiculo["placa"];
						}
					}							
					/*if (strlen($row_qry_plantilla["ayuda"])>=5)
					{
						echo '&nbsp;&nbsp;';
						echo '<img src="../images/iconos/ico_help.gif" alt="'.$row_qry_plantilla["ayuda"].'" border="0">';
					}*/
					$item++;
					//echo '</td></tr>';											
				}	 //fin de creacion de campos.
				//echo '<tr><td class="boxTitleBgLightBlue">&nbsp;</td><td class="boxTitleBgStone">&nbsp;</td></tr>';
			}		
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
				$status='disabled';
			}			
		$free_result($res_qry_plantilla);
	?>	
	<table width="612"  border="0" align="center">  
  <tr>
    <td width="15%" height="25">&nbsp;</td>
    <td width="78%" height="25"><div align="right" class="tituloproducto">
      <div align="center">
        <p class="Estilo2">CONSTANCIA DE DEVOLUCION DE VEHICULO <br>
          MINISTERIO DE ECONOMIA          </p>
        </div>
    </div></td>
    <td width="7%" height="25"><img src="../../images/solicitud.jpg" width="79" height="79"></td><!--se agrego <img src="../../images/solicitud.jpg" width="79" height="79"> -->
  </tr>
</table>
        <table width="612" height="547"  border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <th width="20%" scope="row"  class="boxTitleBgStone"><div align="left">Fecha solicitud: </div>              </th>
            <th width="22%" scope="row"><span class="legal"><? echo $contenido[2]; ?></span></th>
            <th width="15%" scope="row" class="boxTitleBgStone"><div align="left">Hasta: </div>              </th>
            <th width="43%" scope="row"><? echo $contenido[3]; ?></th>
          </tr>
          <tr>
            <th scope="row" class="boxTitleBgStone"><div align="left">Solicitante: </div>            </th>
            <th scope="row"><span class="legal"><? echo $contenido[9]; ?></span></th>
            <th scope="row" class="boxTitleBgStone"><div align="left">Dependencia:</div>              </th>
            <th scope="row"><span class="legal"><? echo $dependencia[9]; ?></span></th>
          </tr>
          <tr>
            <th height="29" colspan="4" scope="row"><div align="left" class="legal">Jefe de dependencia: <span class="legal"><? echo $jefe[9]; ?></span></div>              </th>
          </tr>
          <tr>
            <th colspan="4" scope="row"><div align="left">Lugar de comisi&oacute;n: <? echo $contenido[7].', ZONA '.$contenido[6].' '.$contenido[5].', '.$contenido[4]; ?></div>              </th>
          </tr>          
          <tr>
            <th height="36" colspan="4" scope="row"><div align="left">Nombre Piloto:<span class="legal">&nbsp;<? echo $contenido[10]; ?></span></div>              <div align="left"></div></th>
          </tr>
          <tr>
            <th height="39" scope="row" class="boxTitleBgStone"><div align="left">Veh&iacute;culo: </div>              </th>
            <th height="39" scope="row"><span class="legal"><? echo $contenido[11]; ?></span></th>
            <th height="39" scope="row" class="boxTitleBgStone"><div align="left">Placa:</div></th>
            <th height="39" scope="row"><div align="left"><span class="legal"><? echo $numero_placa; ?></span></div></th>
          </tr>
          <tr>
            <th height="39" scope="row" class="boxTitleBgStone"><div align="left">Salida: </div></th>
            <th height="39" scope="row"><span class="legal"><? echo $contenido[12]; ?></span></th>
            <th scope="row" class="boxTitleBgStone"><div align="left">Entrada<span class="legal">: </span></div></th>
            <th scope="row"><div align="left"><span class="legal"><? echo $contenido[13]; ?></span></div></th>
          </tr>
          <tr>
            <th height="42" scope="row" class="boxTitleBgStone"><div align="left">Kilometraje</div>              </th>
            <th height="42" colspan="3" scope="row"><div align="center"><span class="legal"> Salida: <? echo $contenido[14]; ?> </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entrada: <span class="legal"><? echo $contenido[15]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total: <span class="legal"><? echo $contenido[15]-$contenido[14]; ?></span></div></th>
          </tr>
          <tr>
            <th colspan="4" scope="row"><table width="90%"  border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="34%" class="smallList">Llanta de repuesto </td>
                <td width="6%"><table width="100%"  border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
                <td width="7%">&nbsp;</td>
                <td width="48%" class="smallList">Tarjeta de circulaci&oacute;n</td>
                <td width="5%"><table width="100%"  border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="smallList">Tricket y barilla </td>
                <td><table width="100%"  border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
                <td class="smallList">Extinguidor </td>
                <td><table width="100%"  border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="smallList">Llave de chuchos </td>
                <td><table width="100%"  border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
                <td class="smallList">Tri&aacute;ngulos de emergencia </td>
                <td><table width="100%"  border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></th>
          </tr>
          <tr>
            <th height="39" colspan="2" scope="row" class="boxTitleBgLightGrey"><div align="center"><span>Gasolina proporcionada:<br> 
            <? echo $contenido[16]; ?> &nbsp;&nbsp;</span></div></th>
            <th colspan="2" scope="row" class="boxTitleBgLightGrey"><div align="center"><span>&nbsp;</span><span class="legal">Gasolina actual:<br> 
            <? echo $contenido[17]; ?></span></div></th>
          </tr>
          <tr>
            <th height="91" colspan="4" scope="row"><div align="left">Observaciones: <span class="legal"><? echo $contenido[19]; ?></span></div></th>
          </tr>
          <tr>
            <th colspan="2" scope="row" class="boxTitleBgStone"><div align="left">Usuario recibi&oacute;: <span class="legal"><? echo $contenido[20]; ?></span></div></th>
            <th colspan="2" scope="row" class="boxTitleBgStone">Firma:_________________________________</th>
          </tr>
</table>
        <?
 }
 ?>
</body>
</html>