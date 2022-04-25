<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bdespacho));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
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
<script type="text/javascript">
function compara (form) {
if (form.clave1.value == form.clave2.value) 
	form.img.src = "../../imagenes/yes.jpg";
else
	form.img.src = "../../imagenes/no.jpg";
}
function valida (form) {
if (form.clave1.value = form.clave2.value) form.img.src = "../../imagenes/no.jpg";
alert("hola");
}
</script>
<script language=javascript src=../includes/FormCheck.js></script>
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
//	alert (form['pregunta'].value.length);
/*    if(document.getElementById("pregunta").value.length == 0)
		alert("Debe Ingresar la descripcion de la informacion a solicitar");
	}else
	{
		alert("No coincide la confirmación de la clave");
	}
*/        
		// alert( "Todo verificado con exito" );
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="97%" border="0" align="center" class="panel">
  <tr>
    <td><table width="100%%" border="0" class="grey">
      <tr>
        <td><strong>Todas las solicitudes al <? print get_formatofecha(date("d")."-".date("m")."-".date("Y")); ?></strong></td>
      </tr>
    </table>
<br>
<br>
      
      <table width="95%%" border="0" align="center">
        <tr>
          <td><div id="CollapsiblePanel2" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0"><img src="imagenes/punto2.jpg" alt="" width="16" height="16"> Solicitudes en proceso</div>
            <div class="CollapsiblePanelContent"><? 
		  	$mtstatus = "6";
		  	include("../solicitud/ver5/atendidas.php");
		  ?>
            </div>
          </div></td>
        </tr>
      </table>      
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
</table>

</form>
<script type="text/javascript">
<!--

var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2", {contentIsOpen:false});

//-->
</script>
</body>
</html>
