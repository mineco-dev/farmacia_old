<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;
?>
<?
		//RECUPERA LOS DATOS DEL REGISTRO		
		$obj=36;		
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			$acceso=permisosdb($visitantes);					
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
					/*if ($row_qry_plantilla["validar"]==1)
					{
						$campo_validacion[$i]=$row_qry_plantilla["campo"];
						$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
						$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_campo"];			
						$i++;							
					}			*/
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
				conectardb($visitantes);															
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
							$qry_empleado= "select (a.nombre+' '+a.apellido+' '+a.apellido2) as empleado, d.nombre, d.id_jefe, (j.nombre+' '+j.apellido) as jefe  from asesor a 
											inner join tb_contratacion_gobierno c on a.idasesor=c.idasesor
											inner join direccion d on d.iddireccion=c.entidad_gobierno
											inner join asesor j on j.idasesor=d.id_jefe
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
.Estilo1 {font-size: medium}

-->
</style>

</head>

<body>
<table width="100%"  border="0">
  <tr>
    <td width="16%" height="25"><div align="left"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td colspan="2"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA ADMINISTRATIVA </p>
      <p align="center" class="titulocategoria">M&Oacute;DULO: VISITANTES</p></td>
    <td width="14%"><div align="right"><img src="../../images/visitantes.gif" width="124" height="96"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="4">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="4"><div align="right" class="tituloproducto">     
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="25" colspan="2" class="legal1"><div align="center">AGREGAR A LA  LISTA NEGRA</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="11%" height="25" class="titulocategoria">VISITANTE:</td>
    <td width="59%"><? echo $contenido[2]; ?></td>
    <td>&nbsp;</td>
  </tr>
  
	  <form name="form1" method="post" action="buscar/buscar.php" enctype="multipart/form-data">
	  <table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0">
       <?
		$obj=37;
		if (isset($obj)) //verifico si hay objeto seleccionado
		{			
			$acceso=permisosdb($visitantes);					
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
					if (($tipo_campo2[$cnt]==8) || ($tipo_campo2[$cnt]==10)) $campotemp="convert(nvarchar, $campo[$cnt], 126) as $campo[$cnt]";
					if ($cnt==count($campo)) $qry_item_catalogo.=" $campotemp ";
					else $qry_item_catalogo.=" $campotemp, ";
					$cnt++;
				}
				$qry_item_catalogo.="from $tabla_destino where $campo_llave_destino=$id";							
				$res_qry_plantilla=$query($qry_plantilla);	
				conectardb($visitantes);															
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
					echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'&nbsp;';
					if ($row_qry_plantilla["validar"]==1) echo '<span class="error">**</span>';
					echo '</td>';
					echo '<td class="boxTitleBgLightGrey">';													
						if (($row_qry_plantilla["codigo_tipo_campo"]==1) || ($row_qry_plantilla["codigo_tipo_campo"]==7))
						{
							echo '<input name="'.$row_qry_plantilla["campo"].'" type="text" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'" value="'.$contenido[$item].'" '.$status.'>';
						}
						else
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
								$valoractual=$row_qry_cbo["$campoorigen"];
								$codigo_valoractual=$row_qry_cbo["$campollave"];							
							}
							$qry_cbo="SELECT * FROM $latabla where $campollave<>$contenido[$item] and $condicion order by $campoorigen"; 	
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
							$free_result($res_qry_cbo);							
						} // fin de cada combo.		
						else				
						if ($row_qry_plantilla["codigo_tipo_campo"]==5)
						{																	
							echo '<input name="'.$row_qry_plantilla["campo"].'" type="file" id="'.$row_qry_plantilla["campo"].'" '.$status.'>';
							echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';
							if ($contenido[$item]!="NA")						
							{
								echo '<a href="archivos/'.$contenido[$item].'"><img src="../../../images/iconos/ico_ver.jpg" alt="Para ver el archivo que contiene el detalle de este equipo, pulse aqu???" border="0"></a>';
								echo('<input name="'.$row_qry_plantilla["campo"].'_temp" type="hidden" id="'.$row_qry_plantilla["campo"].'_temp"  value="'.$contenido[$item].'"/>');
							}	
						}				
						else
					if ($row_qry_plantilla["codigo_tipo_campo"]==8)
					{	
						$day=substr($contenido[$item],8,2);
						$month = strtolower(substr($contenido[$item],5,2));
						$year = substr($contenido[$item],0,4);
						if ($status=='disabled')
						{
							echo $day.'-'.$month.'-'.$year;
						}	
						else
						{								
							echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value ="'.$day."-".$month."-".$year.'"/>';
							echo '<img src="../../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';																																	
						}
					}	
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==9)
					{					
						echo '<textarea name="'.$row_qry_plantilla["campo"].'" cols="'.$row_qry_plantilla["tamano"].'" rows="4" disabled>'.$contenido[$item].'</textarea>';
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==10)
					{							
						$day=substr($contenido[$item],8,2);
						$month = strtolower(substr($contenido[$item],5,2));
						$year = substr($contenido[$item],0,4);
						$hour = substr($contenido[$item],11,2);
						$min = substr($contenido[$item],14,2);
						if ($status=='disabled')
						{
							echo $day.'-'.$month.'-'.$year.' '.$hour.':'.$min;
						}	
						else
						{								
							echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value ="'.$day."-".$month."-".$year.'"/>';
							echo '<img src="../../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';																																	
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
						}
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==11)
					{					
						conectardb($rrhh);
						$id_solicitante_actual=$contenido[$item];
						$qry_empleado="select * from asesor where idasesor=$id_solicitante_actual";						
						$res_qry_empleado=$query($qry_empleado);												
						while($row_qry_empleado=$fetch_array($res_qry_empleado))
						{
							$solicitante_actual=$row_qry_empleado["nombre"].' '.$row_qry_empleado["nombre2"].' '.$row_qry_empleado["apellido"].' '.$row_qry_empleado["apellido2"];
							
						}	
						if ($id_solicitante_actual=="") $solicitante_actual="CLIC AQUI PARA SELECCIONAR EL PILOTO";
						echo '<a href="javascript:void(0)" onclick="buscar=window.open(\'../../frm_buscar_empleado/buscar.php?tipo='.$row_qry_plantilla["campo"].'&posi=0\',\'Buscar\',\'width=650,height=425,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;"><input name="'.$row_qry_plantilla["campo"].'_name" type="text" id="'.$row_qry_plantilla["campo"].'_name" value="'.$solicitante_actual.'" size="55" disabled /></a>';
						echo '<input type="hidden" name="'.$row_qry_plantilla["campo"].'_id" id="hiddenField" value="'.$id_solicitante_actual.'"/>';					
					}					
					if (strlen($row_qry_plantilla["ayuda"])>=5)
					{
						echo '&nbsp;&nbsp;';
						echo '<img src="../../images/iconos/ico_help.gif" alt="'.$row_qry_plantilla["ayuda"].'" border="0">';
					}
					$item++;
					echo '</td></tr>';
				}	 //fin de creacion de campos.
			}		
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
				$status='disabled';
			}			
		$free_result($res_qry_plantilla);
	?>
	<tr>   	          
	</td>
  	<tr>   	
	<td>
	<span class="error">**Campos requeridos</span>	</td>
	<td>
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $id?>"/> 		
	<input name="cmd_guardar" type="submit" id="cmd_guardar" value="Regresar" <? echo $status?>></td></tr>  
   </table>	  	 		   
</tr> 
<br>
<br>  
 <?
 }
 ?>  
   </form>
</table>
</body>
<?
include("../../includes/validaciones.php");
?>
</html>