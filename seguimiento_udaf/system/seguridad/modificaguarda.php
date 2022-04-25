<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
?>

<?
$idusuario=$_REQUEST["idusuario"];
$clave1=$_REQUEST["clave1"];
$idtipousuario = $_REQUEST["idtipousuario"];

$cad = "";
if (intval($_SESSION['mttipousuario'])==1) $cad = ", idtipousuario = $idtipousuario";

$query = "update usuario set nombre='$nombre',
							correo='$correo',
							telefono='$telefono',
							extension='$ext',
							usuario='$nusuario',
							clave='$clave1' $cad
			where idusuario = $idusuario";
			
$query = "update tbl_usuario set clave = '$clave1' where idusuario = $idusuario";			

$dbms->sql = $query;
$dbms->Query();
$mensaje = "Usuario modificado satisfactoriamente";
?>
<head>
<link href="../estilos/default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body oncontextmenu="return false">
<p>&nbsp;</p>
<table width="481" border="0" align="center">
  <tr>
    <td colspan="2"><? print $mensaje;?></td>
  </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="379">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? print "<a href=\"javascript:history.back()\">Regresar</a>";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
