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
</head>
<? require("../menu.php"); ?>
<body>
<? require("../header.php"); ?>
<table width="95%" border="0" align="center" bgcolor="#FFFFFF" class="panel">
  <tr>
    <td>
    <span class="errorbox">Bienvenido al Sistema</span>
      <p align="center"><img src="../img/bienvenida.jpg" border="0" /></p>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<? 	require("../footer.php"); ?>
</BODY>
</html>