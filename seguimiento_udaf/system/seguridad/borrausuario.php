<?
	require('../includes/cnn/inc_header.inc');
	require('../includes/cnn/cls_dbms_mysql.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
?>
<?
//$usuario = $_GET['idusuario'];
$query = "delete from usuario where idusuario = $idusuario and telefono is not null";
$dbms->sql = $query;
$dbms->QueryI();
$mensaje = "Usuario borrado satisfactoriamente";
?>
<head>
<link href="../estilos/default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
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
