<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
	$idusuario = $_SESSION['mtusuario'];
	$Fields2 = get_usuario($idusuario,$dbms);
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

function verificar () {
    if(	checkField(document.form1.nombre, isAlphanumeric, false ) &&
		checkField(document.form1.correo, isEmail, false ) &&
        checkField(document.form1.telefono, isAlphanumeric, false ) &&
		checkField(document.form1.ext, isAlphanumeric, false ) && 
        checkField(document.form1.nusuario, isAlphanumeric, false ) &&
        checkField(document.form1.clave1, isAlphanumeric, false ) &&
        checkField(document.form1.clave2, isAlphanumeric, false ))
		if (document.form1.clave1.value == document.form1.clave2.value)
		{
			document.form1.submit();
		}else
		{
			alert("No coincide la confirmación de la clave");
		}
        
		// alert( "Todo verificado con exito" );
}
</SCRIPT>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<p>&nbsp;</p>
<form name="form1" method="post" action="modificaguarda.php?idusuario=<? print $idusuario;?>">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Modificaci&oacute;n de Usuarios </strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
        <tr>
          <td colspan="3" class="grey"></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <? 
		if (intval($_SESSION['mttipousuario'])==1) 
		{
	?>
          <td>Tipo de usuario</td>
          <td><select name="idtipousuario" id="idtipousuario">
              <?
	  		$query = "select idtipousuario,nombre from tbl_tipousuario order by nombre";
			$dbms->sql=$query;
			$dbms->Query();
			while($Fields=$dbms->MoveNext())
			{
				$cad = "";
				if ($Fields["idtipousuario"]==$Fields2["idtipousuario"]) $cad = "selected";
				print "<option value = ".$Fields["idtipousuario"]. " $cad>".$Fields["nombre"]."</option>";
			}
		?>
          </select></td>
          <? 
		}
	?>
        </tr>
        <tr>
          <td width="112" valign="top">&nbsp;</td>
          <td width="94">Nombre</td>
          <td width="522"><input name="nombre" type="text" id="nombre" size="50" value="<? print $Fields2["nombre"];?>" readonly></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Correo</td>
          <td><input name="correo" type="text" id="correo" size="50" value="<? print $Fields2["correo"];?>" readonly></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Telefono</td>
          <td><input name="telefono" type="text" id="telefono" value="<? print $Fields2["telefono"];?>" readonly></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Extensi&oacute;n</td>
          <td><input name="ext" type="text" id="ext" size="10" value="<? print $Fields2["extension"];?>" readonly></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Usuario</td>
          <td><input name="nusuario" type="text" id="nusuario" size="20" value="<? print $Fields2["usuario"];?>" readonly>
            * Esta informaci&oacute;n es para accesar al sistema </td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Clave</td>
          <td><input name="clave1" type="password" id="clave1" size="20" onKeyUp="javascript:compara(this.form)"  value="<? print $Fields2["clave"];?>"></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Confirmar clave</td>
          <td><input name="clave2" type="password" id="clave2" size="20" onKeyUp="javascript:compara(this.form)"  value="<? print $Fields2["clave"];?>">
              <img src="../../imagenes/yes.jpg" alt="" name="img" width="20" height="20" id="img"></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><div align="center">
              <p>
                <input type="button" name="btn1" value="Modificar Usuario" onClick="verificar()">
              </p>
          </div>
              <p align="right"><a href=javascript:history.back()>Regresar</a></p></td>
        </tr>
      </table>
    </div>
    </div>
</div>
<p>&nbsp;</p>
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
