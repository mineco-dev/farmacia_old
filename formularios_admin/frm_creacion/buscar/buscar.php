<?
session_start();
if (!isset($_SESSION["subgerencia"])) $dependencia=33;
else $dependencia=($_SESSION["subgerencia"]);
require("../../../includes/funciones.php");
require("../../../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;
?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
body {
	background-image:  url(../../../imagen/Theme_Marcos/marco11.gif);
}
</style>
<link href="../../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<script src="../../../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../../includes/calendar.js"></script>
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
<div align="center">FORMULARIO DE BUSQUEDA</div>
<form name="form1" method="post" action="gbuscar.php">
<table width="90%"  border="0" align="center">
  <tr>
    <td height="8" colspan="5">    
    <img src="../../../images/linea.gif" width="100%" height="6"></td>   
  </tr>	  
	  <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <?
		$obj=6;
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			conectardb($formularioadmin);	
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$obj'
							order by orden"; 			   
			$i=1;
			$res_qry_plantilla=$query($qry_plantilla);					  
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{			
				echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'</td>';
				echo '<td class="boxTitleBgLightGrey">';
				if ($row_qry_plantilla["codigo_tipo_campo"]==1)
				{
					$tabladestino=$row_qry_plantilla["tb_destino"];
					if (!isset($campodestino)) $campodestino=$row_qry_plantilla["campo_destino"];
					$qry_datos_insertados="select * from $tabladestino order by $campodestino";
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="text" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'">';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==2)
				{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];							
						$condicion=$row_qry_plantilla["condicion"];		
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
				echo '</td></tr>';
			}	 //fin de creacion de campos.	
		$free_result($res_qry_plantilla);
	?>
	<tr>   	          
	</td>
  	<tr>   
	<input type="hidden" name="nombre[0][1]" id="hiddenField"/>
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_cat" type="hidden" id="txt_cat"  value="<? echo $cat?>"/> 
	<input  name="txt_subcat" type="hidden" id="txt_subcat"  value="<? echo $subcat?>"/> 		
	</tr>  
	
</table>	  	 
	 
 <?
  } // fin si esta seteado el objeto
  ?>
	  
	
		
	</td>   
	</tr> 
	 <tr><td height="25" colspan="3">    
    <img src="../../../images/linea.gif" width="100%" height="6"></td></tr>
</table> 
  <td width="17%"></tr> 
  <p align="center">
  <input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Iniciar b�squeda" >
  </p>
</form>
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