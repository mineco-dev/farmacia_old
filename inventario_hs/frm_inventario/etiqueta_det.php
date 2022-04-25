<html>
<head>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
<script language="javascript" src="../../includes/calendar.js"></script>
</head>
<body>
<table width="100%" border=1 cellspacing="0" id="tabla7">
  <tr>
    <th scope="col"><span class="Estilo2">#</span></th>
    <th scope="col"><span class="Estilo2">N&uacute;mero de etiqueta</span></th>
    <th scope="col"><span class="Estilo2">Fecha de colocaci&oacute;n</span></th>
    <th scope="col">Motivo</th>
    <th scope="col"><span class="Estilo2">T&eacute;cnico</span></th>
  </tr>
  <tr>
    <th width="17" scope="col">&nbsp;</th>
    <th scope="col"><input name="txt_etiqueta" type="text" id="txt_etiqueta" size="10"></th>
    <th width="331" scope="col"><div align="center" class="Estilo2">
	<?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('../../includes/classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date1", true);
			$myCalendar->setIcon("../../images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?></div></th>
	<th  scope="col"><input name="txt_motivo" type="text" id="txt_motivo" value="INVENTARIO DE HARDWARE" size="40"></th>
	<th  scope="col"><? echo $_SESSION["user_name"]; ?></th>
  </tr>
</table>
<br>
</body>
</html>