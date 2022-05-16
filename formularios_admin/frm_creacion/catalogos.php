<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
	session_register("ingresando_obj");
	$_SESSION["ingresando_obj"]=true;
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<script src="../../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../includes/calendar.js"></script>

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
    <td width="18%" height="25"><div align="left"><img src="../../images/logo_rpt_mineco.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORMATICA </p>
      <p align="center" class="titulocategoria"> CREACION DE FORMULARIOS </p></td>
    <td width="10%"><div align="right"><img src="../../images/vehiculos.jpg" width="129" height="126"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <?   
	$obj=6;
	require_once('../../connection/helpdesk.php');
	if (isset($obj)) //filtro objeto seleccionado
	{	
		$qry_objeto="SELECT * FROM tb_formulario where codigo_formulario='$obj'"; 
		$res_qry_objeto=$query($qry_objeto);	
		while($row_qry_objeto=$fetch_array($res_qry_objeto))
		{
			$nombre_objeto=$row_qry_objeto["descripcion"];
			$mostrar_detalle=$row_qry_objeto["mostrar_detalle"];
		}
		$free_result($res_qry_objeto);	
	}

	?><tr>
    <td height="25" colspan="3"><div align="right" class="tituloproducto">
      <div align="center"><? echo $nombre_objeto; ?>        
      </div>
    </div></td>
    </tr>  
	  <form name="form1" method="post" action="gcatalogos.php" enctype="multipart/form-data">
	  <table width="90%" align="center" cellpadding="0" cellspacing="0">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$obj'
							order by orden"; 													
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($formularioadmin);		
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
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="text" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'">';
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
							echo('<select name="'.$row_qry_plantilla["campo"].'">');
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
							echo('<select name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["campo"].'\', \''.$nombre_div.'\')">');
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
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="file" id="'.$row_qry_plantilla["campo"].'">';
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
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="hidden" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'">';
				}	
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==8)
				{					
					$day = date("d");
					$month = date("m");
					$year = date("Y");
					require_once('../../includes/classes/tc_calendar.php');
					$myCalendar = new tc_calendar($row_qry_plantilla["campo"], true);
					$myCalendar->setIcon("../../images/iconCalendar.gif");
					$myCalendar->setDate($day, $month, $year);
					$myCalendar->writeScript();
				}	
				if ($row_qry_plantilla["ayuda"]!="")
				{
					echo '&nbsp;&nbsp;';
					echo '<img src="../../images/iconos/ico_help.gif" alt="'.$row_qry_plantilla["ayuda"].'" border="0">';
				}
				echo '</td></tr>';				
			}	 //fin de creacion de campos.
			echo '<tr><td class="boxTitleBgMidGrey">&nbsp;</td><td class="boxTitleBgLightGrey">&nbsp;</td></tr>';						
			$campo_detalle=$tb_detalle.'.activo';
			$qry_orden="order by ";
			$qry_datos_insertados.="$campo_detalle ";
			$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));
			$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_orden.' '.$qry_orden2;										
		$free_result($res_qry_plantilla);
	?>
		<table width="90%"  border="0" align="center">		  
		<tr><td height="25" colspan="3">    
    	<img src="../../images/linea.gif" width="100%" height="6"></td></tr>
	   <tr>
	   <td>
			
			<div id="TabbedPanels1" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">							
				<li class="TabbedPanelsTab style3" tabindex="0">Campos del formulario<span class="error">**</span></li>				
				</ul>
				<div class="TabbedPanelsContentGroup">										
					<div class="TabbedPanelsContent">
						<? include("campos_det.php"); ?>
						<br>
					</div>							
				</div>
			</div>
			<script type="text/javascript">
				<!--
					var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
				//-->
			</script>	  	          
	</td>
  	<tr>   	
	<td colspan="2">
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 			 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar" ></td></tr>  	
</table>	  	 		  
</tr> 

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
				if ($tipo_campo[$i]=="1" || $tipo_campo[$i]=="5" || $tipo_campo[$i]=="7")
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
			$i++;
			}
		echo 'validar_subformularios(form);';
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
	if ((form['txt_obj'].value) == 6)
	{		
		ban = 0; for (i=1;i<8;i++) { if (valor(form['txt_campo['+i+']'])) ban = 1; } if (ban == 0) {alert('Especifique los campos que corresponden al formulario'); return};
		//else
		//{
		//	ban = 0; for (i=1;i<8;i++) { if (valor(form['campo['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba el nombre del campo'); return};
		//	ban = 0; for (i=1;i<8;i++) { if (valor(form['tipocampo['+i+']'])) ban = 1; } if (ban == 0) {alert('Seleccione el tipo de campo'); return};
		//	ban = 0; for (i=1;i<8;i++) { if (valor(form['tamano['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba el TAMAÑO del campo'); return};			
		//	ban = 0; for (i=1;i<8;i++) { if (valor(form['etiqueta['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba la etiqueta del campo'); return};			
		//	ban = 0; for (i=1;i<8;i++) { if (valor(form['orden['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba el numero de orden del campo'); return};			
		//	ban = 0; for (i=1;i<8;i++) { if (form['tipocampo['+i+']']=='2') && (valor(form['tborigen['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba la tabla origen de los datos del combo'); return};			
		//}		
		
	};	
	if (confirm('�Esta acción guarda y finaliza el ingreso de datos para este objeto, desea continuar?')) form.submit();
}
</script>

</html>
