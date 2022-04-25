<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
?>
<?
$usuario = $_SESSION['mtusuario'];
$psw1 = $_GET['psw1'];
$psw2 = $_GET['psw2'];
$psw3 = $_GET['psw3'];


if (intval($_SESSION['tipo_usuario'])==0 || intval($_SESSION['tipo_usuario'])==1 || intval($_SESSION['tipo_usuario'])==2)
{
	$dbms->sql="select clave from tbl_usuario where idusuario = ".$_SESSION['mtusuario'];
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	if (strcmp($Fields["clave"],$psw1)==0)
	{
		if (strcmp($psw2,$psw3)==0)
		{
			$query = "update tbl_usuario set clave = '$psw2' where idusuario = $usuario";
			$dbms->sql=$query;
			$dbms->Query();
			$mensaje = "Password Modificado Satisfactoriamente";
		}else
		{
			$mensaje = "No es valida la confirmación del nuevo Password";
		}
	}else
	{
		$mensaje = "El password introducido no coincide ";
	}
}else
{
	$mensaje = "No tiene permisos para cambiar el Password";
}
?>
<head>
<link href="../stilos/default.css" rel="stylesheet" type="text/css" media="screen" />
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
    <td colspan="2"><? print "<a href=\"../menu.php\">Menu</a>";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
