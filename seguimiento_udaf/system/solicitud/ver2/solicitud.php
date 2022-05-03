<?
	require('../../includes/cnn/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	require('../../includes/funciones.php');
?>

<!DOCTYPE html>
<html>
<head>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
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
<script type="text/javascript">
function compara (form) {
if (form.clave1.value == form.clave2.value) 
	form.img.src = "../../imagenes/yes.jpg";
else
	form.img.src = "../../imagenes/no.jpg";
}
function valida (form) {
if (form.clave1.value = form.clave2.value) form.img.src = "../../../imagenes/no.jpg";
alert("hola");
}
</script>
<script language=javascript src=../../includes/FormCheck.js></script>
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
<link href="../../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<form action="solicitudguarda.php" method="post" enctype="multipart/form-data" name="form1">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Solicitud</strong></li>
    <li class="TabbedPanelsTab" tabindex="0"><strong>Trasladar Solicitud</strong></li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <?
	$id_documento=$_REQUEST["id_documento"];
    $Fields=get_valores("d_gestion,solicitante,doct_sfp,cantidad,dictamen_no,
						observaciones,usuario_creo,cur_no,
						CONVERT(nvarchar(10), fecha_creacion, 103) as fecha,
						CONVERT(nvarchar(10), fecha_creacion, 108) as hora,
						id_ejecutora,pro_resolucion",
						"docs_udaf",
						"where id_documento = $id_documento","",$dbms);
	
	$tiposolicitud = get_valores("nombre",
								"bgestion",
								"where idgestion = ".$Fields["id_gestion"],"",$dbms);

	
							
	?>
      <table width="99%" cellspacing="4" class="mttable">
        
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top" bgcolor="#FEF8DE">Fecha y Hora de solicitud</td>
          <td colspan="2"><? print $Fields["fecha"]." ".$Fields["hora"]; ?></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top" bgcolor="#FEF8DE">Tipo de Gestion</td>
          <td colspan="2"><strong><? print $tiposolicitud["nombre"]; ?></strong></td>
        </tr>
        
        <tr>
          <td width="15" valign="top">&nbsp;</td>
          <td width="186" bgcolor="#FEF8DE">Solicitante</td>
          <td width="725" colspan="2"><? print $Fields["solicitante"]; ?></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Documento Subgerencia Financiera</td>
          <td colspan="2"><? print $Fields["doct_sfp"]; ?></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">cantidad en Quetzales</td>
          <td colspan="2"><? print $Fields["cantidad"]; ?></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dictamen No.</td>
          <td colspan="2"><? print $Fields["dictamen_no"]; ?></td>
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
          <td bgcolor="#FEF8DE">Descripción</td>
          <td colspan="2"><? print $Fields["observaciones"]; ?></td>
        </tr>
      </table>
      <div align="center"></div>
    </div>
    <div class="TabbedPanelsContent">
      <table width="98%" border="0" class="panel"><tr><td><table width="100%%" border="0"><tr><td><div align="right">
        <table width="98%" border="0" class="panel">
          <tr>
            <td><table width="100%%" border="0">
                <tr>
                  <td width="15%">&nbsp;</td>
                  <td width="15%">&nbsp;</td>
                  <td width="70%">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">&Aacute;rea de Gesti&oacute;n</div></td>
                  <td><div align="left">
                    <select name="idarea" id="idarea" onChange="javascript:cargarCombo('direccion.php', 'idarea', 'Div_direccion')">
                      <?
                    $query = "select idviceministerio,nombre from tbl_viceministerio order by nombre";
                    $dbms->sql=$query;
                    $dbms->Query();
                    print "<option value = 0>- seleccione -</option>";
                    while($Fields=$dbms->MoveNext())
                    {
                        print "<option value = ".$Fields["idviceministerio"]. ">".$Fields["nombre"]."</option>";
                    }
              	?>
                    </select>
                  </div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">Direcci&oacute;n</div></td>
                  <td><div align="left">
                    <div id="Div_direccion">
                        <select name="iddireccion"  id="iddireccion">
                        </select>
                      </div>
                  </div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">Usuario</div></td>
                  <td><div align="left">
                    <div id="Div_usuario">
                        <select name="idusuario"  id="idusuario">
                        </select>
                      </div>
                  </div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">Observaciones</div></td>
                  <td><div align="left">
                    <textarea name="observaciones" id="observaciones" cols="60" rows="7"></textarea>
                  </div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left"></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="right"></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><div align="center">
                      <input name="btn2" type="button" class="grey" onClick="verificar(this.form)" value="Guardar Solicitud">
                  </div></td>
                </tr>
            </table></td>
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
</form>

<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
