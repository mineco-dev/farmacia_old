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
    <th width="559" scope="col"><div align="center" class="Estilo2">Empleado visitado</div></th>
    <th width="221" scope="col"><span class="Estilo2">Confirmado el</span></th>
    <th width="162" scope="col"><span class="Estilo2">Por</span></th>
  </tr>
   <? 
  $cnt_visitas=1;
  $qry_visitas_det="select * from seg_visita_det where codigo_visita='$idv'";    
  $res_qry_visitas_det=$query($qry_visitas_det);   
  while($row_qry_visitas_det=$fetch_array($res_qry_visitas_det))
  {	 
	  echo '<tr>';
	  echo '<td>'.$cnt_visitas.'</td>';	  
	///////////////////////////////////inicia despliegue de visitas
	  echo '<td>';  	    	  
	  $id_visitado=$row_qry_visitas_det["codigo_usuario"];	 
	  $qry_cbo_visitado="SELECT asesor.idasesor, direccion.nombre as dependencia, asesor.nombre, asesor.nombre2, asesor.apellido, asesor.apellido2, asesor.activo FROM asesor LEFT JOIN tb_contratacion_gobierno on tb_contratacion_gobierno.idasesor=asesor.idasesor LEFT JOIN direccion ON tb_contratacion_gobierno.entidad_gobierno=direccion.iddireccion WHERE asesor.idasesor='$id_visitado'"; 
	  conectardb($rrhh);	 
	  $res_qry_cbo_visitado=$query($qry_cbo_visitado);	  
	  while($row_qry_cbo_visitado=$fetch_array($res_qry_cbo_visitado))
	  {
		echo $row_qry_cbo_visitado["nombre"].' '.$row_qry_cbo_visitado["nombre2"].' '.$row_qry_cbo_visitado["apellido"].' ** '.$row_qry_cbo_visitado["dependencia"];					
	  }	  
	  echo '</td>';  //finaliza despliegue de equipo
	  
	  ////////////////////////////////////////inicia despliegue de fecha de confirmacion
	  echo '<td>';
	  echo $row_qry_visitas_det["fecha_aceptado"];
	  echo '</td>';
  	  ////////////////////////////////////////inicia despliegue de usuario que confirmo
	  echo '<td>';
	  echo $row_qry_visitas_det["codigo_usuario_confirma"];
	  echo '</td>';
  	  ///////
	  echo '</tr>';
	  $cnt_visitas++;
  }
  ?> 
</table>
</body>
</html>