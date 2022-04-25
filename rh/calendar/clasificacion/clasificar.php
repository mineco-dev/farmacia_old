<?php 
	
	
						require ('../class/conexion.inc');
						$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						mysql_select_db($BASE_DATOS,$db);

	$consulta = mysql_query("select descripcion,numero_unico_identificacion from detalle_contrato_bien where codigo_detalle_contrato = '$codigo'");
	if ($consulta)
	{
		$vector = mysql_fetch_row($consulta);
		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	<link rel="stylesheet" type="text/css" href="../css/clasificacion.css">
	
	<script type="text/javascript" src="../js/clasificar.js"></script>
	<script type="text/javascript" src="../js/prototype.js"></script>
	<script type="text/javascript" src="../js/effects.js"></script>
	<script type="text/javascript" src="../js/controls.js"></script>
	
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
.style3 {
	font-size: 13px;
	font-weight: bold;
}
    .style4 {font-family: Verdana, Arial, Helvetica, sans-serif; }
.style8 {font-family: Geneva, Arial, Helvetica, sans-serif; color: #990000; font-size: 12px;}
    </style>
	
</head>

<body>

<h2 class="style4">&nbsp;</h2>
<table width="97%" height="172" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#f8f8f8" class="GrayBasicFont">
  <tr>
    <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0.">
      <tr>
        <td>&nbsp;</td>
        <td><div align="center"><a href="repdoctos.php" target="_self"><img src="../imagen/bac.jpg" width="71" height="18" border="0" /></a></div></td>
      </tr>
      <tr>
        <td width="583"><img src="../imagen/clasifica.png" alt="." width="237" height="30" /></td>
        <td width="71">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;
        <table width="98%" border="0" cellspacing="8" cellpadding="0">
          <tr>
            <td width="31%" class="TuringHelp">Descripcion General del Bien </td>
            <td width="56%"><textarea name="descripcion" cols="50" rows="6"> <? print $vector[0];?></textarea></td>
          <td width="3%">&nbsp;</td>
          </tr>
          <tr>
            <td class="TuringHelp">Numero de Identificacion Unico </td>
            <td><input name="numerounico" type="text"   size="50" value="<? print $vector[1];?>" />
          &nbsp;</td>
          <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="TuringHelp">Escriba la Clasificacion General de Bien </td>
            <td><span class="VDottedLine">
              <input name="search" type="text" id="ingreso" size="25" maxlenght="100" />
			  <input type="hidden" name="codigo"  id="codigo" value="<? print $codigo;?>" />
<button type="button" id="botonIngreso" onclick="nuevoEvento('ingreso')">Insertar            
          

           
            <td><div class="mensaje" id="error"></div></td>
          </tr>
        </td>
            <tr>
              <td class="TuringHelp">Medida</td>
              <td><input name="medida" type="text" id="medida" /></td>
            </tr>
            <tr>
              <td class="TuringHelp">Cantidad</td>
              <td><select name="cantidad" id="cantidad">
			  	<option value="1">Kilogramo (s)</option>
			  	<option value="2">Metro (s)</option>
			  	<option value="3">Segundo (s)</option>
			  </select></td>
            </tr>
            <tr>
              <td class="TuringHelp">Presentacion</td>
              <td></td>
            </tr>
            <tr>
			
             <td class="TuringHelp">Presentacion</td>
              <td><input name="presentacion1" type="text">&nbsp;</td>
            </tr>
            <td width="10%">
            <tr>						
              <td>            
      </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
  </tr>
</table>
<p class="style1">&nbsp;</p>
<div id="hint">
	  <script type="text/javascript">	
		new Ajax.Autocompleter("search","hint","server.php");
	  </script>
</div>
	
</body>
</html>
