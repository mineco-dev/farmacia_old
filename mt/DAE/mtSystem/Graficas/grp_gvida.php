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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../../style.css" rel="stylesheet" type="text/css" />
<script language=javascript src="../../includes/FormCheck.js"></script>
</head>
<? require("../menu.php"); ?>
<body>
<? require("../header.php"); ?>
<p>Personas involucradas en Grupos de Vida</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="95%" border="0" align="center" class="panel">
  <tr>
    <td><form name="form1" method="post" action="">
		    <table width="99%" border="0" align="center" bgcolor="#FFFFFF" class="panel">
              <tr>
                <td>
                  <span class="errorbox">Cantidad de personas que pertenecen a grupos de vida</span>
                  <?
                  	require("gr_gvida.php");
				  ?>
                  <p>&nbsp;</p>
                  </td>
              </tr>
            </table>
    
        </form> 
    </td>
  </tr>
</table>
<? 	require("../footer.php"); ?>
</BODY>
</html>