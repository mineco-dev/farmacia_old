<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bitacora));
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

	{
		if (form['descripcion'].value.length == 0)
		{
			alert("Debe ingresar la descripcion de la información a solicitar");
		}
		
		if (form 
		else
		{
			if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
		}
	}catch (ee)	
	{
		alert("Debe ingresar la descripción de la información a solicitar");
	}
	
	
}

</SCRIPT>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<form action="solicitudguarda.php" method="post" enctype="multipart/form-data" name="form1">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Datos del solicitante</strong></li>  
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        
        <tr>
          <td valign="top"><div align="center"></div></td>
          <td valign="top">Tipo de solicitud</td>
          <td colspan="2">
          <select name="tiposolicitud" id="tiposolicitud">
			<?
                $query = "select idgestion,nombre from bgestion order by nombre";
                $dbms->sql=$query;
                $dbms->Query();
                while($Fields=$dbms->MoveNext())
                {
                    print "<option value = ".$Fields["idgestion"]. ">".$Fields["nombre"]."</option>";
                }
            ?>
			</select>          </td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Unidad Ejecutora</td>
          <td colspan="2"> <select name="cbo_ue" id="cbo_ue">
			<?
                $query = "select idunidad,nombre, descripcion from bunidad_ejecutora order by nombre";
                $dbms->sql=$query;
                $dbms->Query();
                while($Fields=$dbms->MoveNext())
                {
                    print "<option value = ".$Fields["idunidad"]. ">".$Fields["nombre"]."".$Fields["descripcion"]."</option>";
                }
            ?>
			</select>  </td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Dependencia</td>
          <td colspan="2"><div id="Div_direccion">
                        <select name="iddireccion"  id="iddireccion" onchange="javascript:cargarCombo('usuario.php','iddireccion','Div_usuario')">
                        
                        <?
					$dbms2=new DBMS(conectardb($bitacora));	
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
                      </div></td>
        </tr>
        
        <tr>
          <td width="92" valign="top">&nbsp;</td>
          <td width="191">Nombre</td>
          <td width="627" colspan="2"><div id="Div_usuario">
                        <select name="idusuario">
                        </select>
                      </div></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>No. Documento Subgerencia Financiera</td>
          <td colspan="2"><input name="docto_sf" type="text" id="docto_sf" size="50"></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Cantidad en Quetzales</td>
          <td colspan="2"><input name="cantidad" type="number" id="cantidad"></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Dictamen No.</td>
          <td colspan="2"><input name="dictamen" type="text" id="dictamen" size="50"></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>CUR Consolidado No.</td>
          <td colspan="2"><input name="cur_no" type="text" id="cur_no" size="50"></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Proyecto de Resoluci&oacute;n</td>
          <td colspan="2"><input name="resolucion" type="text" id="resolucion" size="50"></td>
        </tr>        

          <td valign="top">&nbsp;</td>
          <td>Adjunto</td>
          <td colspan="2">
          <input name="userfile" type="file" id="userfile" size="60">
          <input type="hidden" name="MAX_FILE_SIZE" value="9000000" >          </td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Descripcion</td>
          <td colspan="2"><textarea name="descripcion" id="descripcion" cols="70" rows="11"></textarea></td>
        </tr>     
        
        
        <tr>
          <td colspan="4"><div align="center">
      			<input name="btn1" type="submit" class="grey" onClick="verificar(this.form)" value="Guardar Solicitud">
			</div>		</td>
		</tr>
      </table>
      </td>
              </tr>
          </table></td>
        </tr>
      </table>  


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
