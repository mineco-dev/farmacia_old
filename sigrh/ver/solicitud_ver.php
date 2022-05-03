<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($rrhh));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>

<!DOCTYPE html>
<html>
<head>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
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
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
	try
	{
		if (form['pregunta'].value.length == 0)
		{
			alert("Debe ingresar la descripcion de la información a solicitar");
		}else
		{
			if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
		}
	}catch (ee)	
	{
		alert("Debe ingresar la descripción de la información a solicitar");
	}
}

function imprimir()
{
//	alert(window.document.form1.opnacionalidad[0].value);
//	alert(window.document.form1.opnacionalidad[1].value);
	if (window.document.form1.opnacionalidad[0].checked)
	{
	   document.getElementById("div_extranjero").style.display = "none";
	   document.getElementById("div_nacional").style.display = "inline";
	}else
	{
		if (window.document.form1.opnacionalidad[1].checked)
		{
		   document.getElementById("div_extranjero").style.display = "inline";
		   document.getElementById("div_nacional").style.display = "none";
		}else
		{
		   document.getElementById("div_extranjero").style.display = "none";
		   document.getElementById("div_nacional").style.display = "none";
		}
	}
}
</SCRIPT>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css"></head>
<body oncontextmenu="return false">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Ficha Empleado</strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <?
	$idsolicitud=$_REQUEST["id_empleado"];
    $Fields=get_valores("id_empleado,nombre,apellido,renglon,direccion,
						,genero,CONVERT(nvarchar(10), fechahora, 103) as fecha,
						CONVERT(nvarchar(10), fechahora, 108) as hora,
						idpais,orden,registro,idmunicipio,pasaporte,idtipomaterial,numero",
						"tb_empleado",
						"where id_empleado = $id_empleado","",$dbms);
	
	$tiposolicitud = get_valores("nombre",
								"tb_empleado",
								"where id_empleado = ".$Fields["id_empleado"],"",$dbms);

	$genero = get_genero($Fields["genero"]);
	
	$nacionalidad = get_valores("pais",
							"tbl_pais",
							"where idpais = ".$Fields["idpais"],"",$dbms);

	$orden = get_valores("orden",
							"tbl_orden",
							"where idorden = ".$Fields["orden"],"",$dbms);

	$respuesta = get_valores("descripcion",
							"tbl_tipomaterial",
							"where idtipomaterial = ".$Fields["idtipomaterial"],"",$dbms);
							
	?>
      <table width="99%" cellspacing="4" class="panel">
        
        <tr>
          <td colspan="5">Solicitud No. <strong><? print "$id_empleado".$Fields["numero"];?></strong></td>
        </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top" bgcolor="#FEF8DE">Fecha y Hora </td>
          <td colspan="2"><? print $Fields["fecha"]." ".$Fields["hora"]; ?></td>
          <td width="25%" rowspan="11">
          <? require("operaciones.php");?>
          <br></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top" bgcolor="#FEF8DE">Nombre</td>
          <td colspan="2"><strong><? print $tiposolicitud["nombre"]; ?></strong></td>
          </tr>
        
        <tr>
          <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Apellido</td>
          <td colspan="2"><? print $Fields["nombre"]; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dependencia</td>
          <td colspan="2"><? print $Fields["correo"]; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Renl&oacute;n</td>
          <td colspan="2"><? print $Fields["telefono"]; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Direcci&oacute;n</td>
          <td colspan="2"><? print $Fields["direccion"]; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">&nbsp;</td>
          <td colspan="2"><? print $nacionalidad["pais"]; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Documento de identificaci&oacute;n</td>
          <td colspan="2">
          <?
          		if (intval($Fields["idpais"])==83)
				{
					if (strlen($Fields["registro"]) >0)
					{
						print "Cedula | ".$orden["orden"]."  ".$Fields["registro"];
					}
				}else
				{
					print "Pasaporte | ";
				}	
		  ?>          </td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Genero</td>
          <td colspan="2"><? print $genero; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Foto</td>
          <td colspan="2">&nbsp;</td>
          </tr>
        
<!-- 
        <tr>
          <td valign="top">&nbsp;</td>
          <td>
            <input name="opnacionalidad" type="radio" value="3" onClick="imprimir();"/>
Menor de edad </td>
          </tr>
-->          
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">&nbsp;</td>
          <td colspan="2"><? print $respuesta["descripcion"]; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">&nbsp;</td>
          <td colspan="3"><? print $Fields["pregunta"]; ?></td>
        </tr>
      </table>
      <div align="center"></div>
        <br>
        <? // require("proceso.php");?>
    </div>
    </div>
</div>
</td>
</tr>
</table>
<p>&nbsp;</p>

W
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
