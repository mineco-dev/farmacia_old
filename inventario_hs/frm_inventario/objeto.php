<?
session_start();
if (!isset($_SESSION["subgerencia"])) $dependencia=33;
else $dependencia=($_SESSION["subgerencia"]);
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;
?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
body {
	background-image: url(../imagen/Theme_Marcos/marco11.gif);
}
</style>
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<script src="../../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../includes/calendar.js"></script>
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
<div align="center">TOMA DE INVENTARIO (CASE-CPU)<br>
</div>
<table width="90%"  border="0" align="center">
  <tr>
    <td height="8" colspan="5">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr> 
	  <form name="form1" method="post" action="gobjeto.php" enctype="multipart/form-data">
	  <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <?
		$obj=2;
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			conectardb($inventarioopera);
			$qry_plantilla="SELECT p.codigo_propiedad, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, p.validar, p.texto_validacion, 
							p.campo_origen, p.campo_llave, p.tamano, p.etiqueta, p.orden, p.tb_destino, p.campo_destino, p.combo_destino, p.combo_origen, p.tipo_combo,
							pl.codigo_objeto, pl.condicion
						  FROM tb_propiedad p INNER JOIN
						  tb_plantilla pl ON pl.codigo_propiedad = p.codigo_propiedad
						  where pl.codigo_objeto='$obj'
						  order by orden"; 			   
			$i=1;
			$res_qry_plantilla=$query($qry_plantilla);					  
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				if ($row_qry_plantilla["validar"]==1)
				{
					$campo_validacion[$i]=$row_qry_plantilla["propiedad"];
					$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
					$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_propiedad"];									
					$i++;		
				}						
				echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'&nbsp;';
				if ($row_qry_plantilla["validar"]==1) echo '<span class="error">**</span>';
				echo '</td>';
				echo '<td class="boxTitleBgLightGrey">';
				if ($row_qry_plantilla["codigo_tipo_propiedad"]==1)
				{
					$tabladestino=$row_qry_plantilla["tb_destino"];
					if (!isset($campodestino)) $campodestino=$row_qry_plantilla["campo_destino"];
					$qry_datos_insertados="select * from $tabladestino order by $campodestino";
					echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="text" id="'.$row_qry_plantilla["propiedad"].'" size="'.$row_qry_plantilla["tamano"].'">';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_propiedad"]==2)
				{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];							
						$condicion=$row_qry_plantilla["condicion"];		
						$nombre_div=$row_qry_plantilla["codigo_propiedad"];						
						$qry_cbo="SELECT * FROM $latabla where $condicion order by $campoorigen"; 															
						$res_qry_cbo=$query($qry_cbo);							
						if ($row_qry_plantilla["tipo_combo"]==1)							
						{
							echo('<select name="'.$row_qry_plantilla["propiedad"].'">');
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
							echo('<select name="'.$row_qry_plantilla["propiedad"].'" id="'.$row_qry_plantilla["propiedad"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["propiedad"].'\', \''.$nombre_div.'\')">');
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
							echo '<select name="'.$row_qry_plantilla["propiedad"].'"  id="'.$row_qry_plantilla["propiedad"].'" disabled>';
							echo '</select>';
							echo '</div>';
						}
						$free_result($res_qry_cbo);					
				} // fin de cada combo.
				else				
				if ($row_qry_plantilla["codigo_tipo_propiedad"]==5)
				{					
					echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="file" id="'.$row_qry_plantilla["propiedad"].'">';
        			echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';
				}
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
	<td height="22" class="boxTitleBgMidGrey">Usuario responsable <span class="error">**</span></td>       
	<td class="boxTitleBgLightGrey"><a href="javascript:void(0)" onclick="buscar=window.open('../../clinica/busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;"><input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR EL USUARIO]" size="55" disabled />
	</a></td></tr>  
	
</table>	  	 
	 
 <?
  } // fin si esta seteado el objeto
  ?>
	  
  
	<?
	if (isset($obj))
	{
		if ($obj==2)  // si es cpu, pide datos de memoria, cpu, discos, lectores y software.
		{
		?>	
		  <table width="90%"  border="0" align="center">		  
		  <tr><td><p align="center" class="titulocategoria">COMPONENTES GENERALES DEL CPU</p></td></tr>
			<tr><td height="25" colspan="3">    
    	<img src="../../images/linea.gif" width="100%" height="6"></td></tr>
		   <tr>
		   <td>
			
			<div id="TabbedPanels1" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">
				<!-- <li class="TabbedPanelsTab style3" tabindex="0">Memoria</li> 
				<li class="TabbedPanelsTab style3" tabindex="0">Procesador</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Disco Duro</li> -->
				<li class="TabbedPanelsTab style3" tabindex="0">Lectores <span class="error">**</span></li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software OEM <span class="error">**</span></li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software Instalado</li>				
				<li class="TabbedPanelsTab style3" tabindex="0">Etiqueta <span class="error">**</span></li>				
				</ul>
				<div class="TabbedPanelsContentGroup">					
					<div class="TabbedPanelsContent">
						<?  include("lector_det.php"); ?>
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<? include("softwareoem_det.php"); ?>
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("softwareinstall_det.php"); ?>
						<br>
					</div>		
					<div class="TabbedPanelsContent">
						<? include("etiqueta_det.php"); ?>
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
		?>	
	</td>   
	</tr> 
	 <tr><td height="25" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td></tr>
	</table> 
  <td width="17%"></tr> 
  <p align="center">
  <input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar información" >
  </p>
  <?
  }
  ?>  
   </form>
</table>
</body>
</html>
<?
function generaSelect($inv_dependencia)
{	
	$consulta=mssql_query("SELECT * FROM cat_categoria c
	inner join tb_inventario_x_dependencia d on c.codigo_categoria=d.codigo_categoria
	WHERE activo=1 and d.codigo_dependencia='$inv_dependencia' ORDER BY nombre_categoria");	
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>---- Categoria ----</option>";
	while($registro=mssql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[2]."</option>";
	}
	echo "</select>";
}
?>
<?	
	$i=1;
	echo '<script type="text/javascript">';
	echo 'function validar(form)';
	echo '{';							
			while($i<=count($campo_validacion))
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
			}	
		echo 'if ((form["nombre[0][1]"].value+0) == 0){alert("Seleccione el nombre del usuario a cargo del equipo"); return};';
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
	if ((form['txt_obj'].value) == 2)
	{
		ban = 0; for (i=1;i<8;i++) { if (valor(form['tipolector['+i+']'])) ban = 1; } if (ban == 0) {alert('Especifique las unidades de Lectura/escritura'); return};
		ban = 0; for (i=1;i<8;i++) { if (valor(form['version['+i+']'])) ban = 1; } if (ban == 0) {alert('Especifique SO y Versión de Office OEM'); return};
		else
		{
			ban = 0; for (i=1;i<8;i++) { if (valor(form['idioma['+i+']'])) ban = 1; } if (ban == 0) {alert('Seleccione el idioma'); return};
			ban = 0; for (i=1;i<8;i++) { if (valor(form['cdkey['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba el COA de 25 caracteres'); return};
			ban = 0; for (i=1;i<8;i++) { if (valor(form['seriesoftwareoem['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba No. serie del COA'); return};			
		}		
		ban = 0; for (i=1;i<8;i++) { if (valor(form['txt_etiqueta'])) ban = 1; } if (ban == 0) {alert('Escriba el n�mero de etiqueta de seguridad que corresponde a este CASE'); return};		
	};	
	if (confirm('�Esta acción guarda y finaliza el ingreso de datos para este objeto, desea continuar?')) form.submit();
}
</script>