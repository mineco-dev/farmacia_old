<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($uipopera));	
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

function cargarCombo (url, combomForma,comboTipoRespuesta,soli, element_id) {
    //Obtenemos el contenido del div
    //donde se cargaran los resultados
    var element =  document.getElementById(element_id);
    //Obtenemos el valor seleccionado del combo anterior
    var valordepende1 = document.getElementById(combomForma);
    var x = valordepende1.value;
    var valordepende2 = document.getElementById(comboTipoRespuesta);
    var x2 = valordepende2.value;
    var valordepende3 = document.getElementById(soli);
    var x3 = valordepende3.value;
    //construimos la url definitiva
    //pasando como parametro el valor seleccionado
    var fragment_url = url+'?Id1='+x+'&Id2='+x2+'&Id3='+x3;
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
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
	form.submit();
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1>
<meta http-equiv="Script-Content-Type" content="text/javascript; charset=iso-8859-1">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<script language='javascript' src="popcalendar.js"></script>
</head>
<body oncontextmenu="return false">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Solicitud de informaci&oacute;n</strong></li>
    <li class="TabbedPanelsTab" tabindex="0"><strong>Resoluci&oacute;n</strong></li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <?
	$idsolicitud=$_REQUEST["idsolicitud"];
    $Fields=get_valores("idtiposolicitud,nombre,correo,telefono,direccion,
						pregunta,idusuario,genero,
						CONVERT(nvarchar(10), fechahora, 103) as fecha,
						CONVERT(nvarchar(10), fechahora, 108) as hora,
						idpais,orden,registro,idmunicipio,pasaporte,idtipomaterial,numero",
						"tbl_solicitud",
						"where idsolicitud = $idsolicitud","",$dbms);
	
	$tiposolicitud = get_valores("nombre",
								"tbl_tiposolicitud",
								"where idtiposolicitud = ".$Fields["idtiposolicitud"],"",$dbms);

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
        <td colspan="5">Solicitud No. <strong><? print "$idsolicitud/SAIP-".$Fields["numero"];?></strong></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top" bgcolor="#FEF8DE">Fecha y Hora de solicitud</td>
        <td colspan="2"><? print $Fields["fecha"]." ".$Fields["hora"]; ?></td>
        <td width="25%" rowspan="11">
        <? require("operaciones.php");?>
          <br>
        </td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top" bgcolor="#FEF8DE">Forma de solicitud</td>
        <td colspan="2"><strong><? print $tiposolicitud["nombre"]; ?></strong></td>
      </tr>
      <tr>
        <td width="8" valign="top">&nbsp;</td>
        <td width="134" bgcolor="#FEF8DE">Solicitante</td>
        <td colspan="2"><? print $Fields["nombre"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Correo</td>
        <td colspan="2"><? print $Fields["correo"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Telefono</td>
        <td colspan="2"><? print $Fields["telefono"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Direcci&oacute;n</td>
        <td colspan="2"><? print $Fields["direccion"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Nacionalidad de solicitante</td>
        <td colspan="2"><? print $nacionalidad["pais"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Documento de identificaci&oacute;n</td>
        <td colspan="2"><?
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
		  ?>
        </td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Sexo</td>
        <td colspan="2"><? print $genero; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Documento adjunto</td>
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
        <td bgcolor="#FEF8DE">Respuesta en forma de</td>
        <td colspan="2"><? print $respuesta["descripcion"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Solicitud de informaci&oacute;n de</td>
        <td colspan="3"><? print $Fields["pregunta"]; ?></td>
      </tr>
    </table>
    <div align="center"></div>
    <br>
     <? require("proceso.php");?>
    </div>
    <div class="TabbedPanelsContent">
      <table width="98%" border="0" class="panel"><tr><td><table width="100%%" border="0"><tr><td><div align="right">
        <table width="98%" border="0" class="panel">
          <tr>
            <td align="left">
            <form action="solicitudrespuestaguarda.php?idsolicitud=<? print $idsolicitud;?>" method="post" enctype="multipart/form-data" name="form1">

            <a href="solicitud_ver.php?idsolicitud=<? print $idsolicitud;?>">Regresar</a>
            	<input type="hidden" name="mtsolicitud" id="mtsolicitud" value="<? print $idsolicitud;?>">
            	<table width="100%%" border="0">
                <tr>
                  <td width="15%">&nbsp;</td>
                  <td width="15%">Forma de entrega</td>
                  <td width="70%">
<select name="midforma" id="midforma" onChange="javascript:cargarCombo('resolucion.php', 'midforma','idtiporespuesta','mtsolicitud','Div_formulario')">
                    <?
                    print "<option value = 0>- seleccione -</option>";
                    print "<option value = 1>Personal</option>";
                    print "<option value = 2>Electronica</option>";
              	?>
                  </select> </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">Tipo de respuesta</div></td>
                  <td><div align="left">				  
                    <select name="idtiporespuesta" id="idtiporespuesta" onChange="javascript:cargarCombo('resolucion.php', 'midforma','idtiporespuesta','mtsolicitud','Div_formulario')">
                      <?
						$dbms2=new DBMS(conectardb($uipopera));	
						$dbms2->bdd=$database_cnn;
						$query = "select idtiporespuesta,nombre from tbl_tiporespuesta order by nombre";
						$dbms2->sql=$query;
						$dbms2->Query();
						print "<option value = 0>- seleccione -</option>";
						while($Fields=$dbms2->MoveNext())
						{
							print "<option value = ".$Fields["idtiporespuesta"]. ">".$Fields["nombre"]."</option>";
						}
              		?>
                    </select> 
                  </div></td>
                </tr>
                
                <tr>
                  <td colspan="3"><hr></td>
                  </tr>
                <tr>
                  <td colspan="3">
                  <div id="Div_formulario">                  </div>                  </td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="right"></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><div align="center">
                      <input name="btn2" type="button" class="grey" onClick="verificar(this.form)" value="Guardar Resoluci??n">
                  </div></td>
                </tr>
            </table>
            </form>
            </td>
          </tr>
        </table>
      </div></td>
              </tr>
    </table></td>
        </tr>
    </table>
    </div>
  </div>
  </div>
</td>
</tr>
</table>

<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
