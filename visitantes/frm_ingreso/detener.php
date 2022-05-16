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
				$qry_item_catalogo.="usuario_creo from $tabla_destino where $campo_llave_destino=$idv";								
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
    <td><p align="center" class="titulocategoria Estilo1">SUBGERENCIA ADMINISTRATIVA </p>
      <p align="center" class="titulocategoria">M&Oacute;DULO: VISITANTES</p></td>
    <td width="14%"><div align="right"><img src="../../images/visitantes.gif" width="124" height="96"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="3"><div align="right" class="tituloproducto">
      <div align="center"><span class="legal2">IMPEDIR SALIDA AL VISITANTE</span>        </div>
    </div></td>
  </tr>
  
  
  
	  <form name="form1" method="post" action="gdetener.php" enctype="multipart/form-data">
	  <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>    
    <td class="titulotabla" colspan="2">VISITANTE: <? echo $contenido[2]; ?></td>    
  </tr>
	   <?		
		$obj=43;
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
		$acceso=permisosdb($visitantes);					
		if (($acceso>=1) && ($acceso<=8))
		{			
			if (($acceso==1) || ($acceso==4) || ($acceso==5)) $status='disabled'; else $status='';					
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$obj' and c.activo=1
							order by orden"; 													
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($visitantes);		
			$i=1;
			$no_campos_detalle=1;
			$qry_datos_insertados="select ";						
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				$tb_detalle=$row_qry_plantilla["tb_destino"];
				$qry_datos_insertados2="FROM $tb_detalle ";
				if ($row_qry_plantilla["validar"]==1)
				{					
					$campo_validacion[$i]=$row_qry_plantilla["campo"];
					$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
					$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_campo"];														
					$i++;						
				}						
				if (strlen($row_qry_plantilla["etiqueta"])>2)
				{
				echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'&nbsp;';
				if ($row_qry_plantilla["validar"]==1) echo '<span class="error">**</span>';
				echo '</td>';
				echo '<td class="boxTitleBgLightGrey">';
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
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];						
						$campo_detalle=$latabla.'.'.$campoorigen;
						$qry_datos_insertados.="$campo_detalle, ";
						$no_campos_detalle++;
						$qry_datos_insertados3.="INNER JOIN $latabla ON $tb_detalle.$campollave=$latabla.$campollave "; //parte 3 del qry del detalle						
						$qry_orden2.="$campo_detalle, ";
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
				else				
				if ($row_qry_plantilla["codigo_tipo_campo"]==5)
				{					
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="file" id="'.$row_qry_plantilla["campo"].'" '.$status.'>';
        			echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';
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
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="hidden" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'" '.$status.'>';
				}	
				else
				if (($row_qry_plantilla["codigo_tipo_campo"]==8) && ($status==''))
				{							
					echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value ="'.date("d")."-".date("m")."-".date("Y").'"/>';
					echo '<img src="../../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';								
				}	
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==9)
				{					
					echo '<textarea name="'.$row_qry_plantilla["campo"].'" cols="'.$row_qry_plantilla["tamano"].'" rows="2" '.$status.'></textarea>';
				}
				else
				if (($row_qry_plantilla["codigo_tipo_campo"]==10) && ($status==''))
				{							
					echo '<input  name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" type="text"   onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');" size="10" value ="'.date("d")."-".date("m")."-".date("Y").'"/>';
					echo '<img src="../../includes/calendario/images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.'.$row_qry_plantilla["campo"].', \'dd-mm-yyyy\');"/>';								
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
				}
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==11)
				{					
					echo '<a href="javascript:void(0)" onclick="buscar=window.open(\'../../frm_buscar_empleado/buscar.php?tipo='.$row_qry_plantilla["campo"].'&posi=0\',\'Buscar\',\'width=650,height=425,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;"><input name="'.$row_qry_plantilla["campo"].'_name" type="text" id="'.$row_qry_plantilla["campo"].'_name" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55" disabled /></a>';
  					echo '<input type="hidden" name="'.$row_qry_plantilla["campo"].'_id" id="hiddenField"/>';					
				}
				if (strlen($row_qry_plantilla["ayuda"])>=5)
				{
					echo '&nbsp;&nbsp;';
					echo '<img src="../../images/iconos/ico_help.gif" alt="'.$row_qry_plantilla["ayuda"].'" border="0">';
				}
				echo '</td></tr>';				
			}	 //fin de creacion de campos.	
			}	
			echo '<tr><td class="titulotabla">&nbsp;</td><td class="titulotabla">&nbsp;</td></tr>';						
			$campo_detalle=$tb_detalle.'.activo';
			$condicion_detalle="where $campo_detalle=1";
			$qry_orden="order by ";
			$qry_datos_insertados.="$campo_detalle ";
			$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));
			$condicion_detalle.="and codigo_estado_salida_vehiculo=1";
			$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$condicion_detalle.' '.$qry_orden.' '.$qry_orden2;										
			$free_result($res_qry_plantilla);
		}		
	?>	   
    <tr><td colspan="2"> 
	<span class="error">**Campos requeridos</span>	</td></tr>
    <tr><td colspan="2" align="center">
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $idv?>"/>
    <input  name="txt_visitante" type="hidden" id="txt_visitante"  value="<? echo $contenido[2]?>"/> 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar" <? echo $status?>></td></tr>  
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
	$i=1;
	echo '<script type="text/javascript">'; //funcion para las validaciones 
	echo 'function validar(form)';
	echo '{';							
			while($i<=count($campo_validacion))
			{				
				if ($tipo_campo[$i]=="1" || $tipo_campo[$i]=="5" || $tipo_campo[$i]=="7" || $tipo_campo[$i]=="9")
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
				if ($tipo_campo[$i]=="7")
				{						
						echo 'if (!isNumber(form.'.$campo_validacion[$i].'.value))';
						echo '{ ';
							echo 'alert("En este campo solo puede ingresar números");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}
				if ($tipo_campo[$i]=="10")
				{
						echo 'if (form.'.$campo_validacion[$i].'_hora.value == "0")';
						echo '{ ';
							echo 'alert("Seleccione la hora");'; 
							echo 'form.'.$campo_validacion[$i].'_hora.focus();'; 
							echo 'return;';
						echo '}';
				}
				if ($tipo_campo[$i]=="10")
				{
						echo 'if (form.'.$campo_validacion[$i].'_minutos.value == "0.5")';
						echo '{ ';
							echo 'alert("Seleccione los minutos");'; 
							echo 'form.'.$campo_validacion[$i].'_minutos.focus();'; 
							echo 'return;';
						echo '}';
				}	
			$i++;
			}
				echo 'if (confirm("�Esta acción guarda y finaliza el ingreso de datos para esta visita, desea continuar?")) form.submit();';			
	echo '}';		
	echo '</script>';	
?>
<script LANGUAGE="JavaScript">
var defaultEmptyOK = false

function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}

function isNumber (s)
{   var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s)) 
       if (isNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isNumber.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c)) return false;
        } else { 
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
</script>
<script type="text/javascript">
function valor(objeto)
{
	try {
		if ((objeto.value+0) == 0)
			return false;
		else
			return true;
	} catch(e) 
	{
		return false;
	}
}
function validar_subformularios(form)
{	
		if (contLin4>1)
		{
			var i = 1;			
			while (i<contLin4) 
			{ 	
						setValue = 0;
						if (valor(form['bien['+i+'][1]'])) setValue = 1; 	 	
							if (setValue == 0) {
								alert('Dar clic en el cuadro de texto para seleccionar el empleado a quien visitan'); 
							//	form['bien['+i+'][0]'].focus();
								return;
						}						
						i++;			
			}
		}	
		else
		{
			alert('Por favor seleccione a que empleado visitan'); 
			return;
		}
	
}
</script>
</html>