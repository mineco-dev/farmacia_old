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
.style3 {font-size: x-small}
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
    <td width="18%" height="25"><div align="center"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORM&Aacute;TICA</p>
    <p align="center" class="titulocategoria"> INVENTARIO DE HARDWARE Y SOFTWARE </p></td>
    <td width="10%"><div align="right"><img src="../../images/hard_soft.jpg" width="112" height="113"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="3">
    </div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td height="25"><div align="right" class="tituloproducto">
      <div align="center" class="defaultfieldname">FORMULARIO PARA MODIFICACION DE DATOS        
      </div></td>
    <td height="25">&nbsp;</td>
  </tr> 
	  <form name="form1" method="post" action="ged_objeto_det.php" enctype="multipart/form-data">
	  <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <?
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{
				$qry_plantilla="SELECT p.codigo_propiedad, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, p.validar, p.texto_validacion, 
							p.campo_origen, p.campo_llave as campollave, p.tamano, p.etiqueta, p.orden, p.tb_destino, p.campo_destino, p.combo_destino, p.combo_origen, p.tipo_combo,
							pl.codigo_objeto, pl.condicion, pl.campo_llave
						    FROM tb_plantilla pl INNER JOIN
						    tb_propiedad p ON pl.codigo_propiedad = p.codigo_propiedad INNER JOIN
						    cat_objeto o ON pl.codigo_objeto = o.codigo_objeto
						    where pl.codigo_objeto='$txt_obj'
						    order by orden"; 							
				conectardb($inventarioadmin);		  
				$res_qry_plantilla=$query($qry_plantilla);	// devuelve los campos que corresponden al objeto seleccionado
				$cnt=1;
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{
					$campo[$cnt]=$row_qry_plantilla["propiedad"];					
					if ($row_qry_plantilla["validar"]==1)
					{
						$campo_validacion[$i]=$row_qry_plantilla["propiedad"];
						$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
						$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_propiedad"];									
						$i++;							
					}					
					if ($row_qry_plantilla["campo_llave"]==1)  //para saber en que tabla y a traves de que campo se realizara el filtro del reg. seleccionado.
					{
						$tabla_destino=$row_qry_plantilla["tb_destino"];
						$campo_llave_destino=$row_qry_plantilla["propiedad"];							
					}		
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
				$cnt=1;	
			$qry_item_catalogo="select";
			while($cnt<=count($campo))  //para que devuelva el contenido de los campos del registro que se esta editando
			{	
				if ($cnt==count($campo)) $qry_item_catalogo.=" $campo[$cnt] ";
				else $qry_item_catalogo.=" $campo[$cnt], ";
				$cnt++;
			}
			$qry_item_catalogo.="from $tabla_destino where $campo_llave_destino=$id";
			$res_qry_plantilla=$query($qry_plantilla);	
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
				echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'&nbsp;';
				if (($row_qry_plantilla["validar"]==1)&&($row_qry_plantilla["codigo_tipo_propiedad"]!=5)) echo '<span class="error">**</span>';
				echo '</td>';
				echo '<td class="boxTitleBgLightGrey">';
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==1)
					{
						echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="text" id="'.$row_qry_plantilla["propiedad"].'" size="'.$row_qry_plantilla["tamano"].'" value="'.$contenido[$item].'">';
					}
					else
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==2)
					{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$condicion=$row_qry_plantilla["condicion"];		
						$campollave=$row_qry_plantilla["campollave"];						
						$nombre_div=$row_qry_plantilla["codigo_propiedad"];							
						$qry_cbo="SELECT * FROM $latabla where $campollave=$contenido[$item] order by $campoorigen";						 																		
						$res_qry_cbo=$query($qry_cbo);
						while($row_qry_cbo=$fetch_array($res_qry_cbo))
						{
							$valoractual=$row_qry_cbo["$campoorigen"];
							$codigo_valoractual=$row_qry_cbo["$campollave"];							
						}
						$qry_cbo="SELECT * FROM $latabla where $campollave<>$contenido[$item] and $condicion order by $campoorigen"; 							
						$res_qry_cbo=$query($qry_cbo);						
						echo('<input  name="'.$row_qry_plantilla["propiedad"].'_temp" type="hidden" id="'.$row_qry_plantilla["propiedad"].'_temp"  value="'.$codigo_valoractual.'"/>');
						if ($row_qry_plantilla["tipo_combo"]==1)							
						{
							echo('<select name="'.$row_qry_plantilla["propiedad"].'">');
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
							echo('<select name="'.$row_qry_plantilla["propiedad"].'" id="'.$row_qry_plantilla["propiedad"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["propiedad"].'\', \''.$nombre_div.'\')">');
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
							echo '<select name="'.$row_qry_plantilla["propiedad"].'"  id="'.$row_qry_plantilla["propiedad"].'" disabled>';							
							echo'<option value="'.$codigo_valoractual.'">'.$valoractual.'</option>';				
							echo '</select>';
							echo '</div>';
						}
						$free_result($res_qry_cbo);							
					} // fin de campo tipo 2.			
					else				
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==5)
					{																	
						echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="file" id="'.$row_qry_plantilla["propiedad"].'">';
						echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';
						if ($contenido[$item]!=" ")
						{							
							echo '<a href="detallepc/'.$contenido[$item].'"><img src="../../../images/iconos/ico_ver.jpg" alt="Para ver el archivo que contiene el detalle de este equipo, pulse aqu�" border="0"></a>';
							echo('<input name="'.$row_qry_plantilla["propiedad"].'_temp" type="hidden" id="'.$row_qry_plantilla["propiedad"].'_temp"  value="'.$contenido[$item].'"/>');
						}	
					}					
					$item++;
				echo '</td></tr>';
			}	 //fin de creacion de campos.	
		}  // fin si esta seteado txt_obj
		$free_result($res_qry_plantilla);
	?>
	<?
	if (isset($txt_obj))
	{
		if ($txt_obj==2)  // si es cpu, pide datos de memoria, cpu, discos, lectores y software.
		{
		?>	
		  <table width="90%"  border="0" align="center">		  
		  <tr><td align="center">COMPONENTES GENERALES DEL CPU<br></td></tr>
			<tr><td height="25" colspan="3">    
    	<img src="../../images/linea.gif" width="100%" height="6"></td></tr>
		   <tr>
		   <td>
			
			<div id="TabbedPanels1" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">
			<!--<li class="TabbedPanelsTab style3" tabindex="0">Memoria</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Procesador</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Disco Duro</li> -->
				<li class="TabbedPanelsTab style3" tabindex="0">Lectores</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software OEM</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software Instalado</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Etiqueta</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Asignado a</li>
				
				</ul>
				<div class="TabbedPanelsContentGroup">					
					<div class="TabbedPanelsContent">
						<?  include("ed_lector_det.php"); ?>
						<input  name="txt_lector_reg" type="hidden" id="txt_lector_reg"  value="<? echo $registros_lector?>"/> 
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<? include("ed_softwareoem_det.php"); ?>			
						<input  name="txt_softwareoem_reg" type="hidden" id="txt_softwareoem_reg"  value="<? echo $registros_software?>"/>			
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("ed_softwareinstall_det.php"); ?>
						<input  name="txt_softwareinstall_reg" type="hidden" id="txt_softwareinstall_reg"  value="<? echo $registros_softwareinstall?>"/> 
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("ed_etiqueta_det.php"); ?>
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("ed_asignado_det.php"); ?>
						<br>
					</div>				
				</div>
			</div>
			<script type="text/javascript">
				<!--
					var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
				//-->
			</script>
		<?
		}
		}
		?>	
	
	<tr>   	          
	</td>
  	<tr>   	
	<td colspan="2">
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $txt_obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $id?>"/> 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Actualizar" ></td></tr>  
	
</table>	  	 		  
</tr> 
<br>
<br>  
 
   </form>
</table>
</body>
</html>
<?	
	$i=1;
	echo '<script type="text/javascript">';
	echo 'function validar(form)';
	echo '{';							
			while($i<=count($campo_validacion))
			{				
				if ($tipo_campo[$i]=="1")
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
			}			
		echo 'validar_subformularios(form);';
	echo '}';		
	echo '</script>';	
?>
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
	//if ((form['txt_obj'].value) == 2)
	//{
	//	ban = 0; for (i=1;i<8;i++) { if (valor(form['tipolector['+i+']'])) ban = 1; } if (ban == 0) {alert('Especifique las unidades de Lectura/escritura'); return};
	//	ban = 0; for (i=1;i<8;i++) { if (valor(form['version['+i+']'])) ban = 1; } if (ban == 0) {alert('Especifique SO y Versión de Office OEM'); return};
	//	else
	//	{
	//		ban = 0; for (i=1;i<8;i++) { if (valor(form['idioma['+i+']'])) ban = 1; } if (ban == 0) {alert('Seleccione el idioma'); return};
	//		ban = 0; for (i=1;i<8;i++) { if (valor(form['cdkey['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba el COA de 25 caracteres'); return};
	//		ban = 0; for (i=1;i<8;i++) { if (valor(form['seriesoftwareoem['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba No. serie del COA'); return};			
	//	}		
	//	ban = 0; for (i=1;i<8;i++) { if (valor(form['txt_etiqueta'])) ban = 1; } if (ban == 0) {alert('Escriba el número de etiqueta de seguridad que corresponde a este CASE'); return};		
	//};	
	if (confirm('�Esta acción guarda y finaliza el ingreso de datos para este objeto, desea continuar?')) form.submit();
}
</script>