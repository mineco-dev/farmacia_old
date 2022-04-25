<?
	
	conectardb($visitantes);
	session_unregister("egreso");
	session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>
<html>
<head>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
</head>
<body>
<table width="100%" border=1 cellspacing="0" id="tabla5">
  <tr>
    <th width="15" height="19" scope="col"><span class="Estilo2">#</span></th>
    <th width="239" scope="col"><div align="center" class="Estilo2">Equipo</div></th>
    <th width="314" scope="col"><span class="Estilo2">Serie</span></th>
    <th width="349" scope="col"><span class="Estilo2">Movimiento</span></th>
    <th width="36" scope="col"><span class="Estilo2">Sale</span></th>
  </tr>
   <? 
  $cnt=1;
  $qry_equipo_det="select * from seg_equipo_det where codigo_visita='$idv'";    
  $res_qry_equipo_det=$query($qry_equipo_det);   
  while($row_qry_equipo_det=$fetch_array($res_qry_equipo_det))
  {	 
	  echo '<tr>';
	  echo '<td>'.$cnt.'</td>';
	  echo('<input  name="rowid_equipo_det['.$cnt.']" type="hidden" id="rowid_equipo_det['.$cnt.']"  value="'.	$row_qry_equipo_det["codigo_equipo_det"].'"/>');
	///////////////////////////////////inicia despliegue de equipo
	  echo '<td>';  	    	  
	  $id_equipo=$row_qry_equipo_det["codigo_equipo"];	 
	  $qry_cbo_equipo="SELECT * FROM seg_equipo where codigo_equipo='$id_equipo'"; 
	  $res_qry_cbo_equipo=$query($qry_cbo_equipo);	  
	  while($row_qry_cbo_equipo=$fetch_array($res_qry_cbo_equipo))
	  {
		echo $row_qry_cbo_equipo["nombre_equipo"];					
	  }	  
	  echo '</td>';  //finaliza despliegue de equipo
	  
	  ////////////////////////////////////////inicia despliegue de serie 
	  echo '<td>';
	  echo $row_qry_equipo_det["numero_serie"];
	  echo '</td>';
  	  ////////////////////////////////////////inicia despliegue de movimiento de equipo
	  echo '<td>';  	    	  
	  $id_mov_equipo=$row_qry_equipo_det["codigo_mov_equipo"];	 
	  $qry_cbo_mov_equipo="SELECT * FROM seg_mov_equipo where codigo_mov_equipo='$id_mov_equipo'"; 
	  $res_qry_cbo_mov_equipo=$query($qry_cbo_mov_equipo);	  
	  while($row_qry_cbo_mov_equipo=$fetch_array($res_qry_cbo_mov_equipo))
	  {
		echo $row_qry_cbo_mov_equipo["descripcion"];					
	  }	  
	  echo '</td>';  //finaliza despliegue de equipo
  	  ////////////////////////////////////////inicia estado del registro (activo/inactivo)
	  echo '<td>';
	  echo('<select name="cbo_sale['.$cnt.']" id="cbo_sale['.$cnt.']">');
	  echo '<option value="0">S/N</option>';
      echo '<option value="1">SI</option>';
	  echo '<option value="2">NO</option>';
 	  echo '</select>';
	  echo '</td>';
	  //////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt++;
  }
  ?> 
</table>
</body>
</html>