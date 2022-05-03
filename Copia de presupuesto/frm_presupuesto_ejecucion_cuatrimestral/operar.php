<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;

/*function mes($num_mes)
{
	if ($num_mes == 1)
	{
		$cadena = '<select name="me" id="me"><option value="1">Ene</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Abr</option></select>';
	}

	if ($num_mes == 2)
	{
		$cadena = '<select name="me" id="me"><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Ago</option></select>';
	}
	if ($num_mes == 3)
	{
		$cadena = '<select name="me" id="me"><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dic</option></select>';
	}

print $cadena;
}
*/

?>
<?
		//RECUPERA LOS DATOS DEL REGISTRO						
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			$acceso=permisosdb($presupuesto);					
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
					//if ($cnt==count($campo)) $qry_item_catalogo.=" $campotemp "; else
					$qry_item_catalogo.=" $campotemp, ";
					$cnt++;
				}
				$qry_item_catalogo.="usuario_creo from $tabla_destino where $campo_llave_destino=$id";				
				$res_qry_plantilla=$query($qry_plantilla);	
////////////////SI ES UNA DB DISTINTA AQUI CAMBIA LA CONEXION
				conectardb($presupuesto);															
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
    <td colspan="2"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA FINANCIERA </p>
      <p align="center" class="titulocategoria"> MODULO DE PRESUPUESTO </p></td>
    <td width="14%"><div align="right"><img src="../../images/presupuesto.jpg" width="128" height="89"></div></td>
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
    <td rowspan="7">&nbsp;</td>
    <td width="11%" height="25" class="titulomenu">Fuente:</td>
    <td width="59%" class="tituloproducto"><span class="legal"><? echo $contenido[2]; ?></span></td>
    <td rowspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Actividad:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo $contenido[3]; ?></span></td>
  </tr>
  
  <tr>
    <td height="25" class="titulomenu"><div align="left">Programa:</div></td>
    <td height="25" class="tituloproducto"><span class="titulocategoria"><span class="legal"><? echo $contenido[4]; ?></span></span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Departamento:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo $contenido[5]; ?>&nbsp;</span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Subprograma:</td>
    <td height="25" class="tituloproducto"><span class="titulocategoria"><span class="legal"><? echo $contenido[7]; ?></span></span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Subproyecto:</td>
    <td height="25" class="tituloproducto"><span class="titulocategoria"><span class="legal"><? echo $contenido[6]; ?></span></span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Cuatrimestre:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo $c; ?> <span class="titulomenu">A&ntilde;o: </span><? echo $contenido[8]; ?> </span></td>
  </tr>
  
	  <form name="form1" method="post" action="goperar.php" enctype="multipart/form-data">
	  <table width="90%"  border="1" align="center" cellpadding="0" cellspacing="0">
       <?			
		$txt_obj=35;
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{		
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

				require('../../connection/helpdesk.php');			
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
					$campo_detalle=$tb_detalle.'.codigo_financiamiento_actividad';
					$qry_orden="order by ";
					$qry_datos_insertados.="$campo_detalle ";
					$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));	
					$qry_condicion="WHERE $campo_detalle='$id' ";	
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
					  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="center">SALDO COMPROMETIDO POR GRUPO</td></tr>';		  			  					  
					  $res_qry_insertados=$query($qry_detalle);		 
					  $no_campos_detalle--;
					  $i=1;					  
						$cnt=2; //imprime etiquetas
						echo '<tr>'; 			
						//-1
						while ($cnt<=(count($etiqueta)-4)) 
						{	
							echo '<td align="center" class="boxTitleBgLightBlue">';
							echo $etiqueta[$cnt];
							echo '</td>';
							$cnt++;
						}	
						echo '<td class="boxTitleBgLightBlue" align="center">Ppto. Rengl�n</td>';												
						echo '</tr>';
						$no_campos_detalle=$no_campos_detalle-5;						
						
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
								if ($cnt==1)
								echo '<td class='.$clase.'>'.$row_qry_insertados["$cnt"].'</td>';									
								else
								echo '<td class='.$clase.' align="center">'.number_format($row_qry_insertados["$cnt"], 2, '.', ',').'</td>';		
								$cnt++;
							  }	
								echo '<td class='.$clase.'><center><a href="ppto_renglon.php?id='.$row_qry_insertados[0].'&pr='.$id.'&c='.$c.'"><img src="../../../images/iconos/ico_editar.gif" alt="Ingresar presupuesto por rengl�n" border="0"></a></center>'.$c.'</td>';							  					
							
			echo '</tr>';						
			$i++;
		
						 } //while $res_qry_insertados
					$free_result($res_qry_insertados);	
				} // if $res_consulta					
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">NO SE ENCONTRARON REGISTROS QUE COINCIDAN CON LA BUSQUEDA<br><br>Para intentar nuevamente <a href="buscar.php?obj=34">[HAGA CLIC AQUI]</a></td></tr>';
				}
			}  // if acceso
		} // fin del if isset obj			
	?> 	
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $id?>"/> 			</td></tr>  
</table>	  	 		  
</tr> 
<br>
<br>    
   </form>
</table>
</body>
<?
include("../../includes/validaciones.php");
?>
</html>