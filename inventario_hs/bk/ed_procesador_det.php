<?	
	conectardb($inventarioadmin);?>  
<?
function get_marcaproc_opciones($dbms2)
{	
	$qry_marca = mssql_query("select * from cat_marca where activo=1 and codigo_tipo_objeto=14 order by marca");																									
	if ($qry_marca)
		{
			while($row_marca = mssql_fetch_row($qry_marca))	
			{
				$opciones = $opciones."<option value = ".$row_marca[0]. ">".$row_marca[1]."</option>";
			}
			
	}
	return $opciones;
}
function get_socket_opciones($dbms2)
{	
	$qry_socket = mssql_query("select * from cat_tipo_slot where activo=1 order by tipo_slot");																									
	if ($qry_socket)
		{
			while($row_socket = mssql_fetch_row($qry_socket))	
			{
				$opciones = $opciones."<option value = ".$row_socket[0]. ">".$row_socket[1]."</option>";
			}			
	}
	return $opciones;
}

function get_velocidadproc_opciones($dbms2)
{	
	$qry_velocidad = mssql_query("select * from cat_velocidad_procesador where activo=1 and memoria=2 order by velocidad_procesador");																									
	if ($qry_velocidad)
		{
			while($row_velocidad = mssql_fetch_row($qry_velocidad))	
			{
				$opciones = $opciones."<option value = ".$row_velocidad[0]. ">".$row_velocidad[1]."</option>";
			}
			
	}
	return $opciones;
}

function get_tipo_procesador_opciones($dbms2)
{	
	$qry_tipo_procesador = mssql_query("select * from cat_tipo_procesador where activo=1 order by tipo_procesador");																									
	if ($qry_tipo_procesador)
		{
			while($row_tipo_procesador = mssql_fetch_row($qry_tipo_procesador))	
			{
				$opciones = $opciones."<option value = ".$row_tipo_procesador[0]. ">".$row_tipo_procesador[1]."</option>";
			}
			
	}
	return $opciones;
}

?>
<html>
<head>
<?
$llenar_marcaproc = get_marcaproc_opciones($dbms2);
$llenar_socket=get_socket_opciones($dbms2);
$llenar_velocidadproc=get_velocidadproc_opciones($dbms2);
$llenar_tipo_procesador=get_tipo_procesador_opciones($dbms2);
echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"marcaproc["+contLin4+"]\" id=\"select\">';
	echo $llenar_marcaproc;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"socket["+contLin4+"]\" id=\"select\">';
	echo $llenar_socket;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"velocidadproc["+contLin4+"]\" id=\"select\">';
	echo $llenar_velocidadproc;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"tipoproc["+contLin4+"]\" id=\"select\">';
	echo $llenar_tipo_procesador;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serieproc["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
		
	td = tr.insertCell();
	contLin4++;
}

function borrarUltima4(reg_actual) {
	ultima = document.all.tabla4.rows.length - 1;
	if (ultima > reg_actual)
	{
	 document.all.tabla4.deleteRow(ultima);
	 contLin4--;
	}
}
</script>';
?>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
</head>
<body>
<table width="90%" border=1 cellspacing="0" id="tabla4">
  <tr>
    <th width="12" scope="col"><span class="Estilo2">#</span></th>
    <th width="162" scope="col"><span class="Estilo2">Marca</span></th>
    <th width="208" scope="col"><div align="center" class="Estilo2">Socket</div></th>
	<th width="264" scope="col">Velocidad</th>
	<th width="189" scope="col"><span class="Estilo2">Tipo</span></th>
    <th width="189" scope="col"><span class="Estilo2">Serie</span></th>
    <th width="189" scope="col"><span class="Estilo2">Activo?</span></th>
  </tr>
  <?
  $cnt_proc=1;
  $qry_procesador_det="select * from tb_inventario_procesador_det where codigo_inventario_enc='$id'";    
  $res_qry_procesador_det=$query($qry_procesador_det);  
  $registros_proc=$num_rows($res_qry_procesador_det);
  while($row_qry_procesador_det=$fetch_array($res_qry_procesador_det))
  {
	   
	  echo '<tr>';
	  echo '<td>&nbsp;</td>';
	///////////////////////////////////inicia despliegue de marca de PROCESADOR actual
	  echo '<td>'; 
	   echo('<input  name="rowid_procesador['.$cnt_proc.']" type="hidden" id="rowid_procesador['.$cnt_proc.']"  value="'.$row_qry_procesador_det["rowid"].'"/>'); 
	  $id_marca_proc=$row_qry_procesador_det["codigo_marca"];	 
	  $qry_cbo_marca_proc="SELECT * FROM cat_marca where codigo_marca='$id_marca_proc'"; 
	  $res_qry_cbo_marca_proc=$query($qry_cbo_marca_proc);
	 
	  while($row_qry_cbo_marca_proc=$fetch_array($res_qry_cbo_marca_proc))
	  {
		$marca_proc_actual=$row_qry_cbo_marca_proc["marca"];		
		$codigo_marca_proc_actual=$row_qry_cbo_marca_proc["codigo_marca"];	
	  }
	  $qry_cbo_marca_proc="SELECT * FROM cat_marca where activo=1 and codigo_marca<>'$id_marca_proc' and codigo_tipo_objeto=14  order by marca"; 
	  $res_qry_cbo_marca_proc=$query($qry_cbo_marca_proc);
	  echo('<input  name="marca_proc_upd_temp['.$cnt_proc.']" type="hidden" id="marca_proc_upd_temp['.$cnt_proc.']"  value="'.$codigo_marca_proc_actual.'"/>');
	  echo('<select name="marca_proc_upd['.$cnt_proc.']">');		
	  echo'<option value="0">'.$marca_proc_actual.'</option>';				
	  while($row_qry_cbo_marca_proc=$fetch_array($res_qry_cbo_marca_proc))
	  {
		echo'<option value="'.$row_qry_cbo_marca_proc["codigo_marca"].'">'.$row_qry_cbo_marca_proc["marca"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_marca_proc);
	  echo '</td>';  //finaliza despliegue de marca de PROCESADOR actual
	  
	  ////////////////////////////////////////inicia despliegue de tipo de slot actual
	  echo '<td>';  
	  $id_slot=$row_qry_procesador_det["codigo_tipo_slot"];	 
	  $qry_cbo_slot="SELECT * FROM cat_tipo_slot where codigo_tipo_slot='$id_slot'"; 
	  $res_qry_cbo_slot=$query($qry_cbo_slot);	  
	  while($row_qry_cbo_slot=$fetch_array($res_qry_cbo_slot))
	  {
		$slot_actual=$row_qry_cbo_slot["tipo_slot"];	
		$codigo_tipo_slot_actual=$row_qry_cbo_slot["codigo_tipo_slot"];		
	  }
	  $qry_cbo_slot="SELECT * FROM cat_tipo_slot where activo=1 and codigo_tipo_slot<>'$id_slot' order by tipo_slot"; 
	  $res_qry_cbo_slot=$query($qry_cbo_slot);
	  echo('<input  name="slot_upd_temp['.$cnt_proc.']" type="hidden" id="slot_upd_temp['.$cnt_proc.']"  value="'.$codigo_tipo_slot_actual.'"/>'); 
	  echo('<select name="slot_upd['.$cnt_proc.']">');		
	  echo'<option value="0">'.$slot_actual.'</option>';				
	  while($row_qry_cbo_slot=$fetch_array($res_qry_cbo_slot))
	  {
		echo'<option value="'.$row_qry_cbo_slot["codigo_tipo_slot"].'">'.$row_qry_cbo_slot["tipo_slot"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_slot);
	  echo '</td>';  //finaliza despliegue de slot actual
	   ////////////////////////////////////////inicia despliegue de velocidad de procesador actual
	  echo '<td>';  
	  $id_velocidad_proc=$row_qry_procesador_det["codigo_velocidad_procesador"];	 
	  $qry_cbo_velocidad_proc="SELECT * FROM cat_velocidad_procesador where codigo_velocidad_procesador='$id_velocidad_proc'"; 
	  $res_qry_cbo_velocidad_proc=$query($qry_cbo_velocidad_proc);	  
	  while($row_qry_cbo_velocidad_proc=$fetch_array($res_qry_cbo_velocidad_proc))
	  {
		$velocidad_proc_actual=$row_qry_cbo_velocidad_proc["velocidad_procesador"];		
		$codigo_velocidad_proc_actual=$row_qry_cbo_velocidad_proc["codigo_velocidad_procesador"];		
	  }
	  $qry_cbo_velocidad_proc="SELECT * FROM cat_velocidad_procesador where activo=1 and codigo_velocidad_procesador<>'$id_velocidad_proc' and memoria=2 order by velocidad_procesador"; 
	  $res_qry_cbo_velocidad_proc=$query($qry_cbo_velocidad_proc);
      echo('<input  name="velocidad_proc_upd_temp['.$cnt_proc.']" type="hidden" id="velocidad_proc_upd_temp['.$cnt_proc.']"  value="'.$codigo_velocidad_proc_actual.'"/>'); 
	  echo('<select name="velocidad_proc_upd['.$cnt_proc.']">');		
	  echo'<option value="0">'.$velocidad_proc_actual.'</option>';				
	  while($row_qry_cbo_velocidad_proc=$fetch_array($res_qry_cbo_velocidad_proc))
	  {
		echo'<option value="'.$row_qry_cbo_velocidad_proc["codigo_velocidad_procesador"].'">'.$row_qry_cbo_velocidad_proc["velocidad_procesador"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_velocidad_proc);
	  echo '</td>';  //finaliza despliegue de velocidad PROCESADOR actual
	     ////////////////////////////////////////inicia despliegue de tipo de PROCESADOR actual
	  echo '<td>';  
	  $id_tipo_proc=$row_qry_procesador_det["codigo_tipo_procesador"];	 
	  $qry_cbo_tipo_proc="SELECT * FROM cat_tipo_procesador where codigo_tipo_procesador='$id_tipo_proc'"; 
	  $res_qry_cbo_tipo_proc=$query($qry_cbo_tipo_proc);	  
	  while($row_qry_cbo_tipo_proc=$fetch_array($res_qry_cbo_tipo_proc))
	  {
		$tipo_proc_actual=$row_qry_cbo_tipo_proc["tipo_procesador"];	
		$codigo_tipo_proc_actual=$row_qry_cbo_tipo_proc["codigo_tipo_procesador"];		
	  }
	  $qry_cbo_tipo_proc="SELECT * FROM cat_tipo_procesador where activo=1 and codigo_tipo_procesador<>'$id_tipo_proc' order by tipo_procesador"; 
	  $res_qry_cbo_tipo_proc=$query($qry_cbo_tipo_proc);
      echo('<input  name="tipo_proc_upd_temp['.$cnt_proc.']" type="hidden" id="tipo_proc_upd_temp['.$cnt_proc.']"  value="'.$codigo_tipo_proc_actual.'"/>'); 
	  echo('<select name="tipo_proc_upd['.$cnt_proc.']">');		
	  echo'<option value="0">'.$tipo_proc_actual.'</option>';				
	  while($row_qry_cbo_tipo_proc=$fetch_array($res_qry_cbo_tipo_proc))
	  {
		echo'<option value="'.$row_qry_cbo_tipo_proc["codigo_tipo_procesador"].'">'.$row_qry_cbo_tipo_proc["tipo_procesador"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_tipo_proc);
	  echo '</td>';  //finaliza despliegue de tipo de  memoria actual
	  ////////////////////////////////////////inicia despliegue de serie de memoria actual
	  echo '<td>';
	  echo '<input  name="serie_proc_upd['.$cnt_proc.']" type="text" id="serie_proc_upd['.$cnt_proc.']" value="'.$row_qry_procesador_det["serie"].'">';
	  echo '</td>';  	  
  	  ////////////////////////////////////////inicia estado del registro (activo/inactivo)
	  echo '<td>';
	  $id_estado_proc=$row_qry_procesador_det["activo"];
	  if ($id_estado_proc==1)
	  	echo '<input name="estado_proc_upd['.$cnt_mem.']" type="checkbox" value="1" checked>'; 
	  	else
	  		echo '<input name="estado_proc_upd['.$cnt_mem.']" type="checkbox" value="2" disabled>'; 	   
	  echo '</td>';
	  //////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt_proc++;
  }
  ?> 
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<? echo '<input name="Bot&oacute;n" type="button" onClick="borrarUltima4('.$registros_proc.')" value="Borrar l&iacute;nea">' ?>

</body>
</html>