<html>
<head>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
<script language="javascript" src="../includes/calendar.js"></script>
</head>
<body>
<table width="100%" border=1 cellspacing="0" id="tabla7">
  <tr>
    <th scope="col"><span class="Estilo2">#</span></th>
    <th scope="col"><span class="Estilo2">N&uacute;mero</span></th>
    <th scope="col"><span class="Estilo2">Fecha de colocaci&oacute;n</span></th>
    <th scope="col">Motivo</th>
    <th scope="col"><span class="Estilo2">T&eacute;cnico</span></th>
  </tr>
  <? 
  $qry_etiqueta_det="select * from tb_inventario_etiqueta_det where codigo_inventario_enc='$id'";    
  $res_qry_etiqueta_det=$query($qry_etiqueta_det);  
  $registros_etiqueta=$num_rows($res_qry_etiqueta_det);
  while($row_qry_etiqueta_det=$fetch_array($res_qry_etiqueta_det))
  {
	  echo '<tr>';
	  echo '<td>&nbsp;</td>';  	  
	  ////////////////////////////////////////inicia despliegue de serie de softwareinstall actual	 
      $cnt_etiqueta=1;	   	   	  
	  echo '<td>';
	  echo '<input  name="etiqueta_upd[$cnt_etiqueta]" type="text" id="etiqueta_upd[$cnt_etiqueta]" value="'.$row_qry_etiqueta_det["numero_etiqueta"].'" size="10" disabled>';
	  echo '</td>'; 
	  
	  ////////////////////////////////////////inicia despliegue de fecha de etiquetado actual	 
	  echo '<td>';
	  echo '<input  name="fecha_etiqueta_upd[$cnt_etiqueta]" type="text" id="fecha_etiqueta_upd[$cnt_etiqueta]" value="'.$row_qry_etiqueta_det["fecha_colocacion"].'" disabled>';
	  echo '</td>'; 
	  
      ////////////////////////////////////////inicia despliegue de motivo de colocacion de etiqueta actual	 
	  echo '<td>';
	  echo '<input  name="motivo_etiqueta_upd[$cnt_etiqueta]" type="text" id="motivo_etiqueta_upd[$cnt_etiqueta]" value="'.$row_qry_etiqueta_det["motivo"].'" size="30" disabled>';
	  echo '</td>'; 
	  
	  ////////////////////////////////////////inicia despliegue de tecnico que coloco la etiqueta actual	 
	  echo '<td>';
	  echo '<input  name="tecnico_etiqueta_upd[$cnt_etiqueta]" type="text" id="tecnico_etiqueta_upd[$cnt_etiqueta]" value="'.$row_qry_etiqueta_det["usuario_creo"].'" disabled>';
	  echo '</td>'; 
	  
	  echo '</tr>';
	  $cnt_softwareinstall++;
  }
  ?>
 <!--  <tr>
    <th width="17" scope="col">&nbsp;</th>
    <th scope="col"><input name="txt_etiqueta" type="text" id="txt_etiqueta" size="10"></th>
    <th width="330" scope="col"><div align="center" class="Estilo2">
	<?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('../includes/classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date1", true);
			$myCalendar->setIcon("../images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?></div></th>
	<th scope="col"><input name="txt_motivo" type="text" id="txt_motivo" value="INVENTARIO DE HARDWARE" size="30"></th>
	<th scope="col"><? echo $_SESSION["user_name"]; ?></th>
  </tr> -->
</table>
<br>
</body>
</html>