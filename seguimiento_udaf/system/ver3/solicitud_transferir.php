<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bgerencia));	
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
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
    $Fields=get_valores("id_gestion,id_nombre,doct_sfp,cantidad,dictamen_no,
						observaciones,usuario_creo,cur_no,
						CONVERT(nvarchar(10), fecha_creacion, 103) as fecha,
						CONVERT(nvarchar(10), fecha_creacion, 108) as hora,
						id_ejecutora,pro_resolucion",
						"docs_udaf",
						"where id_documento = $id_documento","",$dbms);
	
	$tiposolicitud = get_valores("nombre",
								"bgestion",
								"where idgestion = ".$Fields["id_gestion"],"",$dbms);
								
	$nombre = get_valores("codigo_usuario, nombres+' '+apellidos as nombre, e_mail",
								"usuario",
								"where codigo_usuario = ".$Fields["id_nombre"],"",$dbms);
	
	?>
    <table width="99%" cellspacing="4" class="panel">
      <tr>
        <td colspan="5">Correlativo <strong><? print  ": $id_documento".$Fields["id_documento"];?></strong></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top" bgcolor="#FEF8DE">Fecha y Hora de solicitud</td>
        <td colspan="2"><? print $Fields["fecha"]." ".$Fields["hora"]; ?></td>
        <td width="25%" rowspan="12">
        <? require("operaciones.php");?>
          <br>
        </td>
      </tr>
      <tr>
         <td valign="top">&nbsp;</td>
          <td valign="top" bgcolor="#FEF8DE">Tipo de Gestión</td>
          <td colspan="2"><strong><? print $tiposolicitud["nombre"]; ?></strong></td>
      </tr>
      <tr>
       <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Solicitante</td>
          <td colspan="2"><? print $nombre["nombre"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Correo Electr&oacute;nico</td>
        <td colspan="2"><? print $nombre["e_mail"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Documento Subgerencia Financiera</td>
          <td colspan="2"><? print $Fields["doct_sfp"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Cantidad</td>
          <td colspan="2"><? print $Fields["cantidad"]; ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dictamen</td>
          <td colspan="2"><? print $Fields["dictamen_no"]; ?></td>
      </tr>
      
      
      <tr>
        <td valign="top">&nbsp;</td>
        <td bgcolor="#FEF8DE">Documento adjunto</td>
        <td colspan="2">&nbsp;</td>
      </tr>     
      
      <tr>
        <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Descripcion</td>
          <td colspan="3"><? print $Fields["observaciones"]; ?></td>
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
            <form action="solicitudtransferirguarda.php?id_documento=<? print $id_documento;?>" method="post" enctype="multipart/form-data" name="form1">

            <a href="solicitud_ver.php?id_documento=<? print $id_documento;?>">Regresar</a>
            	<table width="100%%" border="0">
                <tr>
                  <td width="15%">&nbsp;</td>
                  <td width="15%">&nbsp;</td>
                  <td width="70%">&nbsp;</td>
                </tr>                
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">Direcci&oacute;n</div></td>
                  <td><div align="left">
                    <div id="Div_direccion">
                        <select name="iddireccion"  id="iddireccion" onchange="javascript:cargarCombo('usuario.php','iddireccion','Div_usuario')">
                        
                        <?
					$dbms2=new DBMS(conectardb($bgerencia));	
				  	$dbms2->bdd=$database_cnn;
                    $query = "select codigo_dependencia, nombre_dependencia from dependencia order by nombre_dependencia";
                    $dbms2->sql=$query;
                    $dbms2->Query();
                    print "<option value = 0>- seleccione -</option>";
                    while($Fields=$dbms2->MoveNext())
                    {
                        print "<option value = ".$Fields["codigo_dependencia"]. ">".$Fields["nombre_dependencia"]."</option>";
                    }
              	?>
                        </select>
                      </div>
                  </div></td>
                </tr>
               <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">Usuario</div></td>
                  <td><div align="left">
                    <div id="Div_usuario">
                        <select name="idusuario">
                        </select>
                      </div>
                  </div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="left">Observaciones</div></td>
                  <td><div align="left">
                    <textarea name="descripcion" id="descripcion" cols="60" rows="7"></textarea>
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
