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
    <th width="5%" rowspan="2" scope="col"><span class="Estilo2">#</span></th>
    <th colspan="2" scope="col"><span class="Estilo2">Fecha</span></th>
    <th width="12%" rowspan="2" scope="col"><span class="Estilo2">Comentado por</span></th>
    <th width="20%" rowspan="2" scope="col"><span class="Estilo2">Motivo</span></th>
    <th width="45%" rowspan="2" scope="col"><span class="Estilo2">Descripci&oacute;n</span></th>
  </tr>
  <tr>
    <th width="8%" scope="col"><span class="Estilo2">Ingreso</span></th>
    <th width="10%" scope="col"><span class="Estilo2">Egreso</span></th>
  </tr>
  <? 
  $qry_historial="select seg_visita_det.codigo_dependencia, seg_visita_det.especifique_motivo, 
       				seg_visita_det.usuario_comento, seg_visita_det.fecha_comento, seg_visita.fecha_ingreso, seg_visita.fecha_egreso,
       seg_motivo_visita.motivo_visita, seg_visita.codigo_visita, seg_visita.codigo_visitante
from seg_visita_det
left join seg_motivo_visita on seg_motivo_visita.codigo_motivo=seg_visita_det.codigo_motivo
inner join seg_visita on seg_visita.codigo_visita=seg_visita_det.codigo_visita
where seg_visita.codigo_visitante='$id' order by seg_visita.fecha_ingreso desc";    
  $res_qry_historial=$query($qry_historial);  
  $j=1;
  while($row_qry_historial=$fetch_array($res_qry_historial))
  {
	  echo '<tr>';
	  echo '<td><span class="Estilo2">'.$j.'</span></td>';  	  	    	   	   	  

	  echo '<td><span class="Estilo2">';
	  print $row_qry_historial["fecha_ingreso"];
	  echo '</span></td>'; 	 
	  
	  echo '<td><span class="Estilo2">';
	  print $row_qry_historial["fecha_egreso"];
	  echo '</span></td>';  
	  
	echo '<td><span class="Estilo2">';
	  print $row_qry_historial["usuario_comento"];
	 echo '</span></td>'; 	    
	  
	echo '<td><span class="Estilo2">';
	  print $row_qry_historial["motivo_visita"];
	  echo '</span></td>'; 	  	  
	  
	 echo '<td><span class="Estilo2">';
	  print $row_qry_historial["especifique_motivo"];
	 echo '</span></td>'; 	    
	  echo '</tr>';
	  $j++;	   
  }
  ?> 
</table>
<br>
</body>
</html>