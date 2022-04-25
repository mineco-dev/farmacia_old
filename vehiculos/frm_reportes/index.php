<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo3 {color:#0000FF}
.Estilo4 {color:#000099}
.Estilo5 {color: #000066}

.titulo

{
font-size:24px;
font-family:Arial, Helvetica, sans-serif, Courier, monospace, sans-serif, sans-serif;
color:#0000FF;
}
<!--se agrego linea 18 a 24 para el titulo-->

-->
</style>
</head>
<!--se agrego style="background:#CEECF5"-->
<body style="background:#CEECF5">
<table width="100%"  border="0">
  <tr>
    <!--<td width="18%" height="25"><div align="center"><img src="../../images/pc.gif" width="129" height="126"></div></td>-->
    <td width="72%"><p align="center" class="titulocategoria titulo">SUBGERENCIA ADMINISTRATIVA </p>
    <p align="center" class="titulocategoria Estilo1"></p></td>
    <td width="10%"><div align="right"><img src="../../images/carro.gif" width="129" height="126"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <!--<img src="../../images/linea_azul.gif" width="100%" height="6"></td>-->   
  </tr>
</table>   
<p>&nbsp;</p>
<!--<table width="90%"  border="0" align="center">-->
<table width="65%"  border="10" align="center">
  <tr>
    <td height="28" colspan="4"><div align="center"><span class="titulocategoria Estilo3">REPORTES DE VEHICULOS </span></div></td>
  </tr>
  <tr>
    <!--<td width="5%">&nbsp;</td>-->
    <td width="2%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center"><? echo '<a href="javascript:void(0)" onclick="buscar=window.open(\'../rpt_buscar_vehiculo/buscar.php?tipo=1\',\'Buscar\',\'width=650,height=425,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=yes,top=100,left=250\'); return false;"><img src="../../images/iconos/ico_ir.gif" width="19" height="25" border="0"></a>'; ?></div></td>
    <td class="boxTitleBgStone Estilo Estilo5"> MANTENIMIENTOS Y COMISIONES </td>
    <td><div align="center"><a href="../rpt_buscar_vehiculo/rpt_mantenimiento_taller.php" target="_blank"><img src="../../images/iconos/ico_ir.gif" width="19" height="25" border="0"></a></div></td>
    <td class="boxTitleBgStone Estilo4 Estilo5">COSTO POR MANTENIMIENTO Y TALLER </td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
    <td class="boxTitleBgLightGrey">&nbsp;</td>
    <td><div align="center"></div></td>
    <td class="boxTitleBgLightGrey">&nbsp;</td>
  </tr>
</table>

</body>
</html>
