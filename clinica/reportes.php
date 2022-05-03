<?
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
    var fragment_url = url+'?Id='+x; 
    element.innerHTML = '<img src="../../Imagenes/loading.gif" />'; 
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
<script LANGUAGE="JavaScript">
function Validar(form)
{
if (form.date1.value > form.date2.value)
  { 
  	alert("La fecha final debe ser igual o superior a la fecha inicial"); 
	form.date2.focus(); 
	return;
  }  
 if (form.select1.value == "0" && form.txt_numero.value=="" && form.cbo_tipo_docto.value == "0")
  { 
  	alert("Debe seleccionar una categor�a de productos"); 
	form.select1.focus(); 
	return;
  }   
  if (form.cbo_tipo_docto.value == "0" && form.txt_numero.value!="")
  { 
  	alert("Seleccione el tipo de documento que desea consultar"); 
	form.cbo_tipo_docto.focus(); 
	return;
  } 
   if (form.cbo_tipo_docto.value != "0" && form.txt_numero.value=="")
  { 
  	alert("Escriba el n�mero de documento a consultar"); 
	form.txt_numero.focus(); 
	return;
  } 
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.select1.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../includes/calendar.js"></script>
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
<style type="text/css">
<!--
.style3 {font-size: xx-small}
.style4 {color: #FFFFFF}
.style5 {
	font-size: 16px;
	font-weight: bold;
}

-->
</style>
</head>

<body>
<form name="frm_solicitud" id="frm_solicitud" action="genera_reporte.php">
  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21" colspan="6"><div align="center"><strong>GENERADOR DE REPORTES </strong></div></td>
  </tr>
  <tr bgcolor="#BBC8E3">
    <td height="21" colspan="3" class="defaultfieldname"><label for="Subcategoria">TIPO DE REPORTE </label></td>
    <td height="21" colspan="3" class="defaultfieldname"><div align="right"><span class="fieldTitle">Bodega <? 
	  	conectardb($almacen);
		$qry_bodega="SELECT * FROM cat_bodega WHERE codigo_bodega=1 and activo=1 ORDER BY bodega";										
		$res_qry_bodega=$query($qry_bodega);	
		echo('<select name="cbo_bodega">');
		//$nombre=":: Seleccione ::";
		//echo'<option value="0">'.$nombre.'</option>';
		while($row_bodega=$fetch_array($res_qry_bodega))
		{
			echo'<option value="'.$row_bodega["codigo_bodega"].'">'.$row_bodega["bodega"].'</option>';
		}
		echo('</select>');				
		$free_result($res_qry_bodega);
	?>
    </span></div></td>
    </tr>
  <tr>
    <td width="15%" height="21" class="defaultfieldname"><div align="center"><span class="fieldTitle">
      <input name="otros" type="radio" value="IN" checked="CHECKED" />
  Ingresos</span></div></td>
    <td width="13%" class="defaultfieldname"><div align="center"><span class="fieldTitle">
        <input name="otros" type="radio" value="EG" /> 
      Egresos</span></div></td>
    <td width="22%" height="21" class="defaultfieldname"><div align="center"><span class="fieldTitle">
        <input name="otros" type="radio" value="KA" />
    </span>Kardex </div></td>
    <td width="18%" height="21" class="defaultfieldname"><div align="center">
      <input name="otros" type="radio" value="TI" />
  Toma de inventario</div></td>
    <td width="15%" height="21" class="defaultfieldname"><div align="center">
      <input name="otros" type="radio" value="EX" />
  Existencias</div></td>
    <td width="17%" class="defaultfieldname"><div align="center">
          <input name="otros" type="radio" value="VE" />
      Por vencer</div></td>
  </tr>
  <tr>
    <td height="21" colspan="6" class="defaultfieldname">&nbsp;</td>
  </tr>
  <tr bgcolor="#BBC8E3">
    <td height="21" colspan="6" class="defaultfieldname">RANGO DE FECHA </td>
  </tr>
  <tr>
    <td height="21" colspan="3" class="fieldTitle"><span class="defaultfieldname">Fecha inicial</span><span class="tituloproducto">
    <?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('../includes/classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date1", true);
			$myCalendar->setIcon("../images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?>
    </span></td>
    <td colspan="3"><span class="fieldTitle"><span class="tituloproducto"><span class="defaultfieldname">Fecha final&nbsp;</span>&nbsp;
          <?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('../includes/classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date2", true);
			$myCalendar->setIcon("../images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?>
        </span></span></td>
  </tr>
  <tr>
    <td height="22" colspan="6">&nbsp;</td>
  </tr>
  <tr bgcolor="#BBC8E3">
    <td height="22" colspan="6"><span class="defaultfieldname">AGRUPAR POR </span></td>
  </tr>
  <tr>
    <td height="22" colspan="6"><?
	 conectardb($almacen);
	 generaSelect(); 
	 ?>      </td>
    </tr>
  <tr>
    <td height="22" colspan="6"><div align="left">
          <select disabled="disabled" name="select2" id="select2">
            <option value="0">Seleccione Subcategoria</option>
          </select>
      </div></td>
  </tr>
  <tr>
    <td height="22" colspan="6"><div align="left">
          <select disabled="disabled" name="select3" id="select3">
            <option value="0">Seleccione producto</option>
          </select>
        </div>
        </td></tr>
  <tr bgcolor="#BBC8E3">
    <td height="22" colspan="6"><span class="defaultfieldname">REPORTE POR OPERACION REALIZADA</span></td>
  </tr>
  <tr>
    <td height="22" colspan="6"><span class="defaultfieldname">Tipo</span><span class="fieldTitle">: <span class="tituloproducto">
      <?
					conectardb($almacen);
					$qry_tipo_docto="SELECT * FROM cat_tipo_documento WHERE activo=1 ORDER BY tipo_documento";										
					$res_qry_tipo_docto=$query($qry_tipo_docto);	
					echo('<select name="cbo_tipo_docto">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_tipo_docto=$fetch_array($res_qry_tipo_docto))
					{
						echo'<option value="'.$row_tipo_docto["codigo_tipo_documento"].'">'.$row_tipo_docto["tipo_documento"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_tipo_docto);									
				?>
    </span></span><span class="defaultfieldname">N&uacute;mero:&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="fieldTitle">&nbsp;&nbsp;&nbsp;<span class="tituloproducto">
    <input name="txt_numero" type="text" id="txt_numero" size="10" />
   <!--  <span class="defaultfieldname">Movimiento</span> -->
    <?				  
    /*				conectardb($almacen);
					$qry_tipo_mov="SELECT * FROM cat_tipo_movimiento WHERE activo=1 ORDER BY tipo_movimiento";										
					$res_qry_tipo_mov=$query($qry_tipo_mov);	
					echo('<select name="cbo_tipo_mov">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_tipo_mov=$fetch_array($res_qry_tipo_mov))
					{
						echo'<option value="'.$row_tipo_mov["codigo_tipo_movimiento"].'">'.$row_tipo_mov["tipo_movimiento"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_tipo_mov);									 
	*/
				?>
</span></span></td>
    </tr>
  <tr>
    <td height="22" colspan="6">&nbsp;</td>
  </tr>
</table>
<p align="center"> 
  <input name="cmd_generar" onClick="Validar(this.form)" type="button" id="cmd_generar" value="Generar Reporte" >
</p>
</form>

<span class="fieldTitle"></span>
</body>
<?

function generaSelect()
{	
	$consulta=mssql_query("SELECT distinct(s.codigo_categoria), s.categoria FROM cat_categoria s
						  inner join tb_categoria_x_bodega c
						  on c.codigo_categoria=s.codigo_categoria
						  WHERE activo=1 and c.codigo_bodega=1 ORDER BY s.codigo_categoria");
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccione Categor�a</option>";
	while($registro=mssql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}
?>
<?
//elimina variables de sesion utilizadas
if (isset($_SESSION["rpt_bodega"]))
{
	session_unregister("rpt_bodega");
	session_unregister("no_documento");
	session_unregister("categoria");
	session_unregister("subcategoria");
	session_unregister("producto");
	session_unregister("fecha_inicial");
	session_unregister("fecha_final");
	session_unregister("tipo_movimiento");
	session_unregister("ultimo_reg_egreso");
	session_unregister("hoja_despacho");
	session_unregister("detalle_entrega");
	session_unregister("rptcategoria");	
}
?>
</html>
