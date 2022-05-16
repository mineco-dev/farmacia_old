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
    element.innerHTML = '<img src="../images/loading.gif" />';
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
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../includes/calendar.js"></script>
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
<form name="frm_solicitud" id="frm_solicitud" action="gingreso.php">
  <table width="100%"  border="3" cellpadding="0" cellspacing="0">
  <tr>
    <td height="11" colspan="2"><div align="center"><strong>HOJA DE INGRESO DE PRODUCTOS </strong></div></td>
    </tr>
  <tr>
    <td width="50%" height="58"><table width="100%" height="67"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="13"><div align="center"><strong>DOCUMENTO DE INGRESO</strong></div></td>
      </tr>
      <tr>
        <td width="64%" height="22">Tipo Dcto.:<span class="fieldTitle"><span class="tituloproducto">
          	 <?
				  
					conectardb($almacen);											
					$qry_tipo_docto="SELECT * FROM cat_tipo_documento WHERE activo=1 and codigo_tipo_movimiento=1 ORDER BY tipo_documento";										
					$res_qry_tipo_docto=$query($qry_tipo_docto);	
					echo('<select name="cbo_tipo_docto">');
					$nombre=":: Seleccione ::";
					//echo'<option value="0">'.$nombre.'</option>';
					while($row_tipo_docto=$fetch_array($res_qry_tipo_docto))
					{
						echo'<option value="'.$row_tipo_docto["codigo_tipo_documento"].'">'.$row_tipo_docto["tipo_documento"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_tipo_docto);									 
				?>
        </span></span></td>
        </tr>
      <tr>
        <td height="22">N&uacute;mero: <span class="fieldTitle"><span class="tituloproducto">
        <input name="txt_no_ingreso" type="text" id="txt_no_ingreso3" size="10"/>
        </span></span></td>
      </tr>
      <tr>
        <td height="22"><span class="fieldTitle"><span class="tituloproducto">Fecha:
                <?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('calendar/classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date1", true);
			$myCalendar->setIcon("../images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?>
        </span></span></td>
      </tr>
    </table></td>
    <td width="50%"><table width="100%" height="71"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="13"><div align="center"><strong>DOCUMENTO DE SOLICITUD</strong></div></td>
      </tr>
      <tr>
        <td width="63%" height="22">Tipo: <span class="fieldTitle">
          <select name="cbo_doc_solicitud" id="cbo_doc_solicitud">
            <option value="1" selected>REQUISICI&Oacute;N </option>
            <option value="2">OTRO</option>
          </select>
        </span></td>
        </tr>
      <tr>
        <td height="22">N&uacute;mero: <span class="fieldTitle">
        <input name="txt_no_solicitud" type="text" id="txt_no_solicitud4" size="10" />
        </span></td>
      </tr>
      <tr>
        <td height="22">Fecha:<span class="fieldTitle"> <span class="tituloproducto">
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
        </span> </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="22">Solicitante: 
      <input name="txt_solicitante" type="text" id="txt_solicitante" value="DRA. ALEIDA MONZON" size="55" /></td>
    <td height="22">Observaciones:
      <input name="txt_observaciones" type="text" id="txt_observaciones2" value="" size="55" /></td>
  </tr>
</table>
<br>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab style3" tabindex="0">Detalle de medicamentos</li>
    <!-- <li class="TabbedPanelsTab style3" tabindex="0">Acreedor(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Bien(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Condiciones</li> -->
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <?  include("ingreso_det.php"); ?>
    <br>
    </div>
</div>

<p align="center">
  <input name="cmd_guardar" type="button"onClick="validar(this.form)" id="cmd_guardar" value="Guardar hoja de ingreso" >
</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</form>

</body>
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
function validarEntero(numero){ 
  if ((isNaN(numero)) && (numero > 0)) { 
		alert("Solo puede ingresar numeros validos en el campo");
		return "";
  }else{ 
		return numero;
  } 
}
function validar(form)
{
//////////////////////// Encabezado ///////////////////////////////////////////////////
	if ((form['cbo_tipo_docto'].value) == "0"){alert('Seleccione el tipo de documento que respalda el ingreso'); form['cbo_tipo_docto'].focus();  return};	
	if ((form['txt_no_ingreso'].value) == ""){alert('Escriba el número de documento de ingreso'); form['txt_no_ingreso'].focus();  return};	
	if ((form['txt_no_solicitud'].value) == ""){alert('Escriba el número de documento de solicitud, sino tiene escriba cero'); form['txt_no_solicitud'].focus();  return};	
    if ((form['txt_solicitante'].value) == ""){alert('Escriba el nombre del solicitante'); form['txt_solicitante'].focus();  return};	
	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};	
		ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Falta el detalle de los productos ingresados'); return};
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>
