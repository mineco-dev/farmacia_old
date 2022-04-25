<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
?>
<?
/*$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$telefono = $_GET['telefono'];
$ext = $_GET['ext'];
$nusuario = $_GET['nusuario'];
$clave = $_GET['clave'];*/
$usuario = $_SESSION['mtusuario'];

$dbms->sql="select count(*) cantidad from tbl_usuario where usuario = '$nusuario'";
$dbms->Query();
$Fields=$dbms->MoveNext();
if (intval($Fields["cantidad"])==0)
{
	$query = "insert into tbl_usuario(nombre1,correo,telefono,extension,usuario,clave,idtipousuario)
			  values ('$nombre','$correo','$telefono','$ext','$nusuario','$clave1',$idtipousuario)";
	$dbms->sql = $query;
	$dbms->Query();
	$mensaje = "Usuario guardado Satisfactoriamente";
}else
{
	$mensaje = "Error: el nombre de usuario \"$nusuario\" ya existe...";
}
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
