<?
session_start();
require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
<?
$nombre = $_POST['nombre'];
if (strlen($nombre)>0)
{
	$query = "insert into tbl_clasificacion(nombre)
			  values ('$nombre')";
	$dbms->sql = $query;
	$dbms->QueryI();
}
$_POST['nombre']="";
$nombre = "";
?>    
<form name="form1" method="post" action="clasificacion.php">
<table width="728" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
  
  <tr>
    <td colspan="3" class="grey"><strong>Ingreso de sectores</strong></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>Nombre</td>
    <td><input name="nombre" type="text" id="nombre" size="50" class="textfield">      </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">
      <p>
        <input type="button" name="btn1" value="Guardar datos" onClick="verificar()" class="button">
      </p>
      <br>
      </div>
      <p>
	  <?
      	$vec[0] = "Sectores";
		$vec2[0] = "nombre";
		$vec2[1] = "idclasificacion";
		$vec3[0] = "width=\"15%\"";
		$vec3[1] = "width=\"35%\"";
		$vec3[2] = "width=\"25%\"";
		$vec3[3] = "width=\"25%\"";
	
		$query =" select c.nombre,c.idclasificacion
				 from
					tbl_clasificacion c
				 order by c.nombre";
		getTabla($query,1,$vec,$vec2,$vec3,$dbms,95,"clasificacionmodifica.php?idclasificacion=","clasificacionborra.php?idclasificacion=");
	  ?>
      </p>
      <p align="right"><a href=javascript:history.back()>Regresar</a></p>    </td>
    </tr>
</table>
</form> 
    </td>
  </tr>
</table>

<? 	require("../footer.php"); ?>
</BODY>
</html>