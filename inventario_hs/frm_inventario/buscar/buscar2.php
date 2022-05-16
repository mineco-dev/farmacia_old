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

/* General */
   BODY {font-family: verdana,arial, sans-serif; font-size: 10pt;}

/* Contenido */
   H1 {font-size: 16pt; color: #0066CC;}
   H2 {font-size: 12pt; font-style: italic; color: black;}
   H3 {font-size: 10pt; color: black;}

/* Formulario */
   FORM.borde {border: 1px dotted #0066CC; padding: 0.5em 0.2em; width: 80%;}
   FORM P {clear: left; margin: 0.2em; padding: 0.1em;}
   FORM P LABEL {float: left; width: 25%; font-weight: bold;}
   .error {color: red;}
   
/* Tablas */
   TR {font-size: 10pt; width:100%;  color: white; background: #0066CC; text-align: left;}
   TD {font-size: 10pt; width:100%; background: #CCCCCC;}
   TD.derecha {font-size: 10pt; text-align: right; background: #FFFFFF;}
   TD.izquierda {font-size: 10pt; text-align: left; background: #FFFFFF;}

body {
	background-image:  url(../../../imagen/Theme_Marcos/marco11.gif);
}
</style>
<link href="../../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
<div align="center">
  <table width="90%"  border="0">
    <tr>
      <td class="boxTitleBgStone">Para modificar un registro, realice la b&uacute;squeda llenando los campos que considere necesarios. </td>
    </tr>
  </table>
  <p class="legal1">FORMULARIO DE B&Uacute;SQUEDA</p>
</div>
<form name="form1" method="post" action="gbuscar.php">
<table width="90%"  border="0" align="center">
  <tr>
    <td height="8" colspan="5">    
    <img src="../../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="2"><div align="right" class="tituloproducto">
        <div align="left">
    <?
		conectardb($inventarioopera);
		
		generaSelect($dependencia); 
	?>
    
    </div>
    </div></td>
    <td width="52%"><div align="center">
        <select disabled="disabled" name="select2" id="select">
          <option value="0">---- Subcategoria ----</option>
        </select>
    </div></td>
    <td width="20%" height="25" colspan="2"><div align="right">
        <?
		if (isset($obj)) //filtro objeto seleccionado
		{	
			$qry_objeto="SELECT * FROM cat_objeto where codigo_objeto='$obj'"; 
			$res_qry_objeto=$query($qry_objeto);	
			while($row_qry_objeto=$fetch_array($res_qry_objeto))
			{
				$nombre_objeto=$row_qry_objeto["objeto"];
				$cat=$row_qry_objeto["codigo_categoria"];
				$subcat=$row_qry_objeto["codigo_subcategoria"];
			}
		}
		else
		{
				$nombre_objeto="---- Seleccione ----";
		}
		?>
		<select disabled="disabled" name="select3" id="select4">
          <option value="0"><? echo $nombre_objeto ?></option>
        </select>
  </div></td>
  </tr> 
	  
	  <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			conectardb($inventarioopera);
			$qry_plantilla="SELECT p.codigo_propiedad, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, p.validar, p.texto_validacion, 
							p.campo_origen, p.campo_llave, p.tamano, p.etiqueta, p.orden, p.tb_destino, p.campo_destino, p.combo_destino, p.combo_origen, p.tipo_combo,
							pl.codigo_objeto, pl.condicion
						  FROM tb_propiedad p INNER JOIN
						  tb_plantilla pl ON pl.codigo_propiedad = p.codigo_propiedad
						  where pl.codigo_objeto='$obj'
						  order by p.orden"; 			   
			$i=1;
			$res_qry_plantilla=$query($qry_plantilla);					  
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{			
				echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'</td>';
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
				echo '</td></tr>';
			}	 //fin de creacion de campos.	
			if ($obj==2)
			{
				echo  '<tr><td class="boxTitleBgMidGrey" width="20%">No de etiqueta</td>';
				echo '<td class="boxTitleBgLightGrey"><input name="no_etiqueta" type="text" id="no_etiqueta" size="15"></td>';
			}
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



<?



/*		conectardb($inventarioadmin);
		*/

if($var == 1)
{



		
		
/*		$codigo_usuario_responsable = '371';
		print $codigo_usuario_responsable;*/
		
		$vector[0] = 'Modelo: ';
		$vector[1] = 'Color: ';
		$vector[2] = 'Inventario: ';
		$vector[3] = 'Serie: ';
		$vector[4] = 'SICOIN: ';
		$vector[5] = 'Marca: ';
		$vector[6] = 'Tipo: ';
		$vector[7] = 'Ubicacion: ';
		$vector[8] = 'RAM: ';
		$vector[9] = 'HD: ';
		$vector[10] = 'Procesador: ';
		$vector[11] = 'Software: ';
		$vector[12] = 'Usuario: ';
		$vector[13] = 'Etiqueta: ';
		
		$query = 'select mo.modelo,i.color,i.numero_inventario,i.numero_serie,i.numero_sicoin,
m.marca,o.tipo,i.ubicacion,memo.capacidad_memoria,hd.capacidad_disco,
procesador.velocidad_procesador,si.software, si.serie,i.codigo_usuario_responsable,ie.numero_etiqueta
from tb_inventario i 
left join cat_tipo_objeto o on i.codigo_tipo_objeto = o.codigo_tipo_objeto 
left join cat_marca m on i.codigo_marca = m.codigo_marca
left join cat_modelo mo on i.codigo_modelo = mo.codigo_modelo
left join cat_capacidad_memoria memo on i.codigo_capacidad_memoria = memo.codigo_capacidad_memoria
left join cat_capacidad_disco hd on i.codigo_capacidad_disco = hd.codigo_capacidad_disco
left join cat_velocidad_procesador procesador on i.codigo_velocidad_procesador = procesador.codigo_velocidad_procesador
left join tb_inventario_softwareinstall_det si on i.codigo_inventario_enc = si.codigo_inventario_enc
left join tb_inventario_etiqueta_det ie on i.codigo_inventario_enc = ie.codigo_inventario_enc where numero_etiqueta = "'.$numero_etiqueta.'"
order by o.tipo desc';


		
		$salida = mssql_query($query);
		print '<table width="100%">';

		
		$vec = mssql_fetch_row($salida);
		

			for ($x = 0;$x<14;$x++)
			{
			print '<tr width="800">';
				print '<td width="400">';
				print $vector[$x];					
				print '</td>';
				
				print '<td width="400">';
				
			/*	if ($vec[$x]==11)
				{
						
					
					conectardb($rrhh);
					$query1 = 'select (nombre+' '+nombre2+' '+apellido+' '+apellido2) from asesor where idasesor = '.$codigo_usuario_responsable;
					
					$result1 = mssql_query($query1);
					$vecres = mssql_fetch_row($result1);
					
						print $vecres[0];
					

				}else{				*/
				print $vec[$x];
//				}					
				print '</td>';
			print '</tr>';				
			}

		
		print '</table>';
		print 'Otro Software';
		print '<table width="100%">';
		
		while ($vec = mssql_fetch_row($salida))
		{	
			print '<tr>';
				print '<td width="400">';
				print $vec[11];					
				print '</td>';				
			print '</tr>';

		}
		print '</table>';
		
/*desconectardb($inventarioopera);*/
//conectardb($rrhh);
		
}	
?>


<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="buscar.php">
  Numero de Etiqueta
    <input name="numero_etiqueta" type="text" id="numero_etiqueta" />
	<input type="submit" name="btn_consulta" value="Buscar Etiqueta">
	   <input type="hidden" name="var" value="1" />
</form>



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
		ban = 0; for (i=1;i<8;i++) { if (valor(form['txt_etiqueta'])) ban = 1; } if (ban == 0) {alert('Escriba el número de etiqueta de seguridad que corresponde a este CASE'); return};		
	};	
	if (confirm('�Esta acción guarda y finaliza el ingreso de datos para este objeto, desea continuar?')) form.submit();
}
</script>