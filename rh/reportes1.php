<?
	include('personas/conectarse.php');
	include('includes/inc_header_sistema.inc');
	
	
			function orden()
			{
				$orden = $orden."<option value=1>NINGUNO</option>";	
				$orden = $orden."<option value=2>ASC</option>";
				$orden = $orden."<option value=3>DES</option>";
				return $orden;
			}   	



			function criterio()
			{
				$criterio = $criterio."<option value=1>igual a </option>";
				$criterio = $criterio."<option value=2>como </option>";
				$criterio = $criterio."<option value=3>mayor que </option>";	
				$criterio = $criterio."<option value=3>menor que </option>";	
				return $criterio;
			}   	

?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="css/cssWeb.css" type=text/css rel=StyleSheet>

<script src="personas/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="personas/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo67 {font-size: 9px}
.Estilo68 {font-size: 16px}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo22 {font-size: 11px}
.Estilo6 {color: #FF0000}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo47 {color: #000000}
.style1 {color: #666699}
.style5 {
	font-size: 9px;
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.style6 {
	color: #000000;
	font-size: 14px;
}
.style8 {font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<p class="QuoteNameWriting">&nbsp;Generador de Reportes Base de Datos de Recursos Humanos: </p>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td width="100" bgcolor="#666666" class="LoginBgLight"><span class="slogan">Titulo:</span></td>
      <td width="827" class="TabbedPanelsTabSelected"><label>
        &nbsp;<input name="titulo" type="text" id="titulo" size="80" maxlength="200" />
      </label></td>
      <td width="80">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#666666" class="LoginBgLight"><span class="slogan">Fecha Hora: </span></td>
      <td class="TabbedPanelsTabSelected">&nbsp;<? print date("Y-m-d H:i:s");?>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
<div id="TabbedPanels1" class="TabbedPanels">
<ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Campos del Reporte</li>
      <li class="TabbedPanelsTab" tabindex="0">Niveles de Agrupacion</li>
</ul>  
   
   <div class="TabbedPanelsContentGroup">
	
     <div class="TabbedPanelsContent">	  
	 <? include('campos.php');
	 
	 
			
	 
	 ?>
	 </div>
	 
	 <div class="TabbedPanelsContent"></div>	  
	 
  </div>
   <div align="center">
     <input name="enviar" type="submit" id="enviar" value="Generar Reporte" >
   </div>
</form>


<script type="text/javascript">
<!--
			var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>


</body>
</html>
