<?
session_start();
require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
$Fields2 = get_value("select nombre from tbl_clasificacion where idclasificacion=$idclasificacion",$dbms);
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../../style.css" rel="stylesheet" type="text/css" />
<script language=javascript src="../../includes/FormCheck.js"></script>
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar () {
    if(	checkField(document.form1.nombre, isAlphanumeric, false ))
			document.form1.submit();
}
</SCRIPT>
</head>
<? require("../menu.php"); ?>
<body>
<? require("../header.php"); ?>
<table width="95%" border="0" align="center">
  <tr>
    <td>
<form name="form1" method="post" action="clasificacionmodifica.php?idclasificacion=<? print $idclasificacion;?>">
<table width="728" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
  
  <tr>
    <td colspan="3" class="grey"><strong>Modificaci&oacute;n de sectores</strong></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  
  <tr>
    <td width="112" valign="top">&nbsp;</td>
    <td width="94">Nombre</td>
    <td width="522"><input name="nombre" type="text" id="nombre" size="50" class="textfield" value="<? print $Fields2["nombre"];?>"></td>
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
        <input type="button" name="btn1" value="Modificar datos" onClick="verificar()">
      </p>
      </div>
      <p align="right"><a href=javascript:history.back()>Regresar</a></p>    </td>
    </tr>
</table>
</form>
    </td>
  </tr>
</table>
<?
$nombre = $_POST['nombre'];
if (strlen($nombre)>0)
{
	$query = "update tbl_clasificacion set nombre= '$nombre' where idclasificacion = $idclasificacion";
	$dbms->sql = $query;
	$dbms->QueryI();
	cambiar_ventana("clasificacion.php");
}
$_POST['nombre']="";
$nombre = "";
?>
<? 	require("../footer.php"); ?>
</BODY>
</html>