<?php 
	
	
						require ('../class/conexion.inc');
						$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						mysql_select_db($BASE_DATOS,$db);


	if(!empty($cod))
	{

	mysql_query("UPDATE detalle_contrato_bien SET codigo_medida = '$medida', cantidad = '$cantidad', codigo_presentacion = '$presentacion', codigo_bien = '$search'  WHERE codigo_detalle_contrato_bien = '$cod'");
	$codigo_detalle_contrato = mysql_query("SELECT codigo_detalle_contrato FROM detalle_contrato_bien WHERE  codigo_detalle_contrato_bien = '$cod' ");
	$consulta = mysql_fetch_array($codigo_detalle_contrato);
	$valor = $consulta[0];
	mysql_query("UPDATE tb_contrato_garantia_detalle SET codigo_abogado = '$abogado'  WHERE codigo_detalle_contrato = '$valor' ");
	}else{
		echo "Error al grabar los datos";
		//break;
	}

	mysql_close($db);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<style type="text/css">
<!--
.style9 {font-size: 10px}
-->
</style>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
	<link rel="stylesheet" type="text/css" href="../css/clasificacion.css">
	<link href="images/cssWeb.css" type=text/css rel=StyleSheet>
	<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1" />
	<script type="text/javascript" src="calendar/calendar.js"></script>
	<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
	<script type="text/javascript" src="calendar/calendar-setup.js"></script>
		
	<style>
		#search, ul { padding: 3px; width: 150px; border: 1px solid #999; font-family: verdana; arial, sans-serif; font-size: 12px;}
	ul { list-style-type: none; font-family: verdana; arial, sans-serif; font-size: 12px;  margin: 5px 0 0 0}
	li { margin: 0 0 5px 0; cursor: default; color: red;}
	li:hover { background: #ffc; }
.Estilo3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
    body {
	background-color: #f8f8f8;
	background-image: url(../imagen/bg.gif);
}
.style1 {font-family: Arial, Helvetica, sans-serif}
    .style4 {font-family: Verdana, Arial, Helvetica, sans-serif; }
    </style>
	
</head>

<body>

<h2 class="style4">&nbsp;</h2>

<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#f8f8f8" class="GrayBasicFont">
  <tr>
    <td height="285"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td></td>
        </tr>
      <tr>
        <td width="583" class="BasicFontInBorder">CLASIFICACION DE BIENES </td>
        <td width="71">&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr class="BasicFontInBorder2">
            <td class="HelpGrayOption">&nbsp;</td>
            <td colspan="7" class="HelpGrayOption">&nbsp;</td>
            </tr>
          
          <tr>
            <td width="1%" class="HelloUser">&nbsp;</td>
            <td colspan="7" rowspan="5" class="RedMsgWriting"><p>La Clasificacion fue actualizada exitosamente </p>
              <p align="center"><a href="menu.php" target="_self"><img src="../imagen/bac.jpg" alt="." width="71" height="18" border="0" /></a></p></td>
          </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            </tr>
          <tr>
            <td height="16" class="HelloUser">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<p class="style1">&nbsp;</p>

	
</body>
</html>
