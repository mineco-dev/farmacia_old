<?
	require('includes/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	require('includes/funciones.php');
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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

<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="solicitud/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="solicitud/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="includes/calendar.js"></script>
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
<span class="style5">Formulario de solicitud de constitucion de garantia</span><br>
<br>
<form name="frm_solicitud" id="frm_solicitud" action="solicitud_guarda.php">
<table width="61%" border="0" cellspacing="0">
  <tr>
    <td width="238" class="fieldTitle">Datos del Solicitante </td>
    <td width="330">&nbsp;</td>
  </tr>
</table>
<br />
<table  width="95%" border="0">
  <tr>
    <td width="9%">Nombre</td>
    <td><input name="nombre[0][0]" type="text" id="textfield3" size="100" readonly="readonly"/></td>
    <td colspan="2"><a href="javascript:void(0)" onclick="buscar=window.open('buscar/bpersonas.php?tipo=nombre&posi=0','Buscar','width=580,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;">Buscar</a></td>
  </tr>
  <tr>
    <td><input type="hidden" name="nombre[0][1]" id="hiddenField"/></td>
    <td width="70%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
  </tr>
  <tr>
    <td>Actua como</td>
    <td colspan="3">
    <select name="actuacion" id="actuacion" onChange="javascript:cargarCombo('solicitud/actuacion.php', 'actuacion', 'Div_actuacion')">
            <?
	  		$query = "select 
						codigo_actuacion,nombre_actuacion 
					  from 
					  	tb_actuacion_persona 
					  where
					    solicitante_num = 1
					  order by codigo_actuacion";
			$dbms->sql=$query;
			$dbms->Query();
			print "<option value = 0>- Seleccione -</option>";
			while($Fields=$dbms->MoveNext())
			{
				print "<option value = ".$Fields["codigo_actuacion"]. ">".$Fields["nombre_actuacion"]."</option>";
			}
		?>
    </select>    </td>
  </tr>
  <tr>
    <td colspan="4">
    <div id="Div_actuacion">	</div>    </td>
  </tr>
</table>
<br>
<br>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab style3" tabindex="0">Deudor(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Acreedor(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Bien(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Condiciones</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <?  include("solicitud/deudor.php"); ?>
    <br>
    </div>
    <div class="TabbedPanelsContent">
	<?  include("solicitud/acreedor.php"); ?>
    </div>
    <div class="TabbedPanelsContent">
    <?  include("solicitud/bien.php"); ?>  
    </div>
    <div class="TabbedPanelsContent">
      <table width="100%" border="0">
        <tr>
          <td colspan="4" bgcolor="#666666"><div align="center" class="style4">Lugar y Fecha de celebraci&oacute;n del contrato</div></td>
        </tr>
        <tr>
          <td width="24%">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td width="29%">&nbsp;</td>
          <td width="31%">&nbsp;</td>
        </tr>
        <tr>
          <td>Departamento</td>
          <td>
          <select name="departamento" id="departamento" onChange="javascript:cargarCombo('solicitud/municipio.php', 'departamento', 'Div_municipio')">
            <?
	  		$query = "select codigo_departamento,nombre_departamento from tb_departamento order by nombre_departamento";
			$dbms->sql=$query;
			$dbms->Query();
			print "<option value = 0>- Seleccione -</option>";
			while($Fields=$dbms->MoveNext())
			{
				print "<option value = ".$Fields["codigo_departamento"]. ">".$Fields["nombre_departamento"]."</option>";
			}
		?>
          </select>          </td>
          <td>
            <div id="Div_municipio">
		  Municipio<select name="municipio"  id="select3">

		  </select>
	  </div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Fecha de celebraci&oacute;n del contrato</td>
          <td colspan="2">
          <?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date1", true);
			$myCalendar->setIcon("images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?>          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Edificio</td>
          <td><input type="text" name="edificio" id="edificio" /></td>
          <td>Colonia
          <input type="text" name="colonia" id="colonia" /></td>
          <td>Zona
          <select name="zona" id="zona">
            <?
				$query = "select codigo_zona,numero_zona from tb_zona order by numero_zona +0";
				$dbms->sql=$query;
				$dbms->Query();
				print "<option value = 0>- Seleccione -</option>";
				while($Fields=$dbms->MoveNext())
				{
					print "<option value = ".$Fields["codigo_zona"]. ">".$Fields["numero_zona"]."</option>";
				}
			?>
          </select>          </td>
        </tr>
        <tr>
          <td>Aldea/caserio</td>
          <td><input type="text" name="aldea" id="textfield5" /></td>
          <td>Calle/Avenida
          <input type="text" name="calle" id="textfield6" /></td>
          <td>Casa No.
          <input type="text" name="casa" id="textfield7" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#666666"><div align="center" class="style4">Resumen de los t&eacute;rminos generales del contrato</div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Monto Max. garantizado</td>
          <td><input type="text" name="monto" id="textfield8" /></td>
          <td colspan="2">Inter&eacute;s
          
          <input name="imensual" type="text" id="textfield10" size="10" />
          % Mensual
          <input name="ianual" type="text" id="textfield11" size="10" />
          % Anual</td>
        </tr>
        <tr>
          <td>Plazo o Condici&oacute;n</td>
          <td colspan="3"><input name="plazo" type="text" id="textfield12" size="100" /></td>
        </tr>
        
        <tr>
          <td>Tipo de garant�a</td>
          <td><select name="tipo_garantia" id="select6">
            <?
				$query = "select codigo_tipo_garantia,descripcion from tb_tipo_garantia order by descripcion";
				$dbms->sql=$query;
				$dbms->Query();
				while($Fields=$dbms->MoveNext())
				{
					print "<option value = ".$Fields["codigo_tipo_garantia"]. ">".$Fields["descripcion"]."</option>";
				}
			?>
          </select></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#666666"><div align="center" class="style4">Informaci&oacute;n de Pago</div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><div align="center">
            <?  include("solicitud/banco.php");?>
            </div></td>
          </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
</div>
<p>&nbsp;</p>
<p align="center">
  <input name="cmd_guardar" type="button"onClick="validar(this.form)" id="cmd_guardar" value="Guardar solicitud de inscripción" >
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
function validar(form)
{
//////////////////////// Solicitante ///////////////////////////////////////////////////
	if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Deudor ///////////////////////////
	ban = 0; for (i=1;i<100;i++) { if (valor(form['deudor['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos a un Deudor'); return};
//////////////////////// Acreedor //////////////////////////////////////////////////////
	ban = 0; for (i=1;i<100;i++) { if (valor(form['acreedor['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos a un Acreedor'); return};
//////////////////////// Bien //////////////////////////////////////////////////////////	
	ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos un bien para garantia'); return};
//////////////////////// Condiciones (lugar de celebracion del contrato) ///////////////
	if (form['departamento'].selectedIndex == 0){alert('Debe seleccionar el departamento donde se celebro el contrato'); return};
	if (form['zona'].selectedIndex == 0){alert('Debe seleccionar la zona donde se celebro el contrato'); return};
//////////////////////// Condiciones (numero de boleta y valor de boleta) //////////////
	ban = 0; for (i=1;i<100;i++) { if (valor(form['boleta['+i+']'])) if (valor(form['valor['+i+']'])){ban = 1;} else {ban = 0 }} if (ban == 0) {alert('Debe ingresar la boleta de pago con un valor valido'); return};
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>
