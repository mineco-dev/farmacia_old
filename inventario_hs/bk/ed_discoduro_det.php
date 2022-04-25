<?	
	conectardb($inventarioadmin);?>  
<?
function get_marcadisco_opciones($dbms2)
{	
	$qry_marcadisco = mssql_query("select * from cat_marca where activo=1 and codigo_tipo_objeto=4 order by marca");																									
	if ($qry_marcadisco)
		{
			while($row_marcadisco = mssql_fetch_row($qry_marcadisco))	
			{
				$opciones = $opciones."<option value = ".$row_marcadisco[0]. ">".$row_marcadisco[1]."</option>";
			}			
	}
	return $opciones;
}
function get_capacidaddisco_opciones($dbms2)
{	
	$qry_capacidaddisco = mssql_query("select * from cat_capacidad_disco where activo=1 order by capacidad_disco");																									
	if ($qry_capacidaddisco)
		{
			while($row_capacidaddisco = mssql_fetch_row($qry_capacidaddisco))	
			{
				$opciones = $opciones."<option value = ".$row_capacidaddisco[0]. ">".$row_capacidaddisco[1]."</option>";
			}			
	}
	return $opciones;
}
function get_velocidaddisco_opciones($dbms2)
{	
	$qry_velocidaddisco = mssql_query("select * from cat_velocidad_disco where activo=1 order by velocidad_disco");																									
	if ($qry_velocidaddisco)
		{
			while($row_velocidaddisco = mssql_fetch_row($qry_velocidaddisco))	
			{
				$opciones = $opciones."<option value = ".$row_velocidaddisco[0]. ">".$row_velocidaddisco[1]."</option>";
			}			
	}
	return $opciones;
}
function get_tipo_discoduro_opciones($dbms2)
{	
	$qry_tipo_discoduro = mssql_query("select * from cat_tipo_discoduro where activo=1 order by tipo_discoduro");																									
	if ($qry_tipo_discoduro)
		{
			while($row_tipo_discoduro = mssql_fetch_row($qry_tipo_discoduro))	
			{
				$opciones = $opciones."<option value = ".$row_tipo_discoduro[0]. ">".$row_tipo_discoduro[1]."</option>";
			}
			
	}
	return $opciones;
}
?>
<html>
<head>
<?
$llenar_marcadisco = get_marcadisco_opciones($dbms2);
$llenar_capacidaddisco=get_capacidaddisco_opciones($dbms2);
$llenar_velocidaddisco=get_velocidaddisco_opciones($dbms2);
$llenar_tipo_discoduro=get_tipo_discoduro_opciones($dbms2);
echo '<script>
var contLin2 = 1;
function agregar2() {
	var tr, td;

	tr = document.all.tabla2.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin2 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"marcadisco["+contLin2+"]\" id=\"select\">';
	echo $llenar_marcadisco;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"capacidaddisco["+contLin2+"]\" id=\"select\">';
	echo $llenar_capacidaddisco;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"velocidaddisco["+contLin2+"]\" id=\"select\">';
	echo $llenar_velocidaddisco;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"tipodisco["+contLin2+"]\" id=\"select\">';
	echo $llenar_tipo_discoduro;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"seriedisco["+contLin2+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	contLin2++;
}

function borrarUltima2(reg_actual) {
	ultima = document.all.tabla2.rows.length - 1;
	if (ultima > reg_actual)
	{
	 document.all.tabla2.deleteRow(ultima);
	 contLin2--;
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
<table width="90%" border=1 cellspacing="0" id="tabla2">
  <tr>
    <th width="12" scope="col"><span class="Estilo2">#</span></th>
    <th width="162" scope="col"><span class="Estilo2">Marca</span></th>
    <th width="208" scope="col"><div align="center" class="Estilo2">Tama&ntilde;o </div></th>
	<th width="264" scope="col">Velocidad</th>
	<th width="189" scope="col"><span class="Estilo2">Tipo</span></th>
    <th width="189" scope="col"><span class="Estilo2">Serie</span></th>
    <th width="189" scope="col"><span class="Estilo2">Activo?</span></th>
  </tr>
  <?  
  $cnt_disco=1; 
  $qry_disco_det="select * from tb_inventario_disco_det where codigo_inventario_enc='$id'";    
  $res_qry_disco_det=$query($qry_disco_det);  
  $registros_disco=$num_rows($res_qry_disco_det);
  while($row_qry_disco_det=$fetch_array($res_qry_disco_det))
  {
	  echo '<tr>';
	  echo '<td>&nbsp;</td>';
	///////////////////////////////////inicia despliegue de marca de disco duro actual
	  echo '<td>';  
  	  echo('<input  name="rowid_disco['.$cnt_disco.']" type="hidden" id="rowid_disco['.$cnt_disco.']"  value="'.$row_qry_disco_det["rowid"].'"/>');
	  $id_marca_disco=$row_qry_disco_det["codigo_marca"];	 
	  $qry_cbo_marca_disco="SELECT * FROM cat_marca where codigo_marca='$id_marca_disco'"; 
	  $res_qry_cbo_marca_disco=$query($qry_cbo_marca_disco);
	
	  while($row_qry_cbo_marca_disco=$fetch_array($res_qry_cbo_marca_disco))
	  {
		$marca_disco_actual=$row_qry_cbo_marca_disco["marca"];		
		$codigo_marca_disco_actual=$row_qry_cbo_marca_disco["codigo_marca"];	
	  }
	  $qry_cbo_marca_disco="SELECT * FROM cat_marca where activo=1 and codigo_marca<>'$id_marca_disco' and codigo_tipo_objeto=4  order by marca"; 
	  $res_qry_cbo_marca_disco=$query($qry_cbo_marca_disco);
      echo('<input  name="marca_disco_upd_temp['.$cnt_disco.']" type="hidden" id="marca_disco_upd_temp['.$cnt_disco.']"  value="'.$codigo_marca_disco_actual.'"/>');
	  echo('<select name="marca_disco_upd['.$cnt_disco.']">');		
	  echo'<option value="0">'.$marca_disco_actual.'</option>';				
	  while($row_qry_cbo_marca_disco=$fetch_array($res_qry_cbo_marca_disco))
	  {
		echo'<option value="'.$row_qry_cbo_marca_disco["codigo_marca"].'">'.$row_qry_cbo_marca_disco["marca"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_marca_disco);
	  echo '</td>';  //finaliza despliegue de marca de disco duro actual
   ////////////////////////////////////////inicia despliegue de tamaño de disco actual
	  echo '<td>';  
	  $id_capacidad_disco=$row_qry_disco_det["codigo_capacidad_disco"];	 
	  $qry_cbo_capacidad_disco="SELECT * FROM cat_capacidad_disco where codigo_capacidad_disco='$id_capacidad_disco'"; 
	  $res_qry_cbo_capacidad_disco=$query($qry_cbo_capacidad_disco);	  
	  while($row_qry_cbo_capacidad_disco=$fetch_array($res_qry_cbo_capacidad_disco))
	  {
		$capacidad_disco_actual=$row_qry_cbo_capacidad_disco["capacidad_disco"];		
		$codigo_capacidad_disco_actual=$row_qry_cbo_capacidad_disco["codigo_capacidad_disco"];
	  }
	  $qry_cbo_capacidad_disco="SELECT * FROM cat_capacidad_disco where activo=1 and codigo_capacidad_disco<>'$id_capacidad_disco' order by capacidad_disco"; 
	  $res_qry_cbo_capacidad_disco=$query($qry_cbo_capacidad_disco);
      echo('<input  name="capacidad_disco_upd_temp['.$cnt_disco.']" type="hidden" id="capacidad_disco_upd_temp['.$cnt_disco.']"  value="'.$codigo_capacidad_disco_actual.'"/>');
	  echo('<select name="capacidad_disco_upd['.$cnt_disco.']">');		
	  echo'<option value="0">'.$capacidad_disco_actual.'</option>';				
	  while($row_qry_cbo_capacidad_disco=$fetch_array($res_qry_cbo_capacidad_disco))
	  {
		echo'<option value="'.$row_qry_cbo_capacidad_disco["codigo_capacidad_disco"].'">'.$row_qry_cbo_capacidad_disco["capacidad_disco"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_capacidad_disco);
	  echo '</td>';  //finaliza despliegue de tamaño de  disco actual
	  ////////////////////////////////////////inicia despliegue de velocidad del disco actual
	  echo '<td>';  
	  $id_velocidad_disco=$row_qry_disco_det["codigo_velocidad_disco"];	 
	  $qry_cbo_velocidad_disco="SELECT * FROM cat_velocidad_disco where codigo_velocidad_disco='$id_velocidad_disco'"; 
	  $res_qry_cbo_velocidad_disco=$query($qry_cbo_velocidad_disco);	  
	  while($row_qry_cbo_velocidad_disco=$fetch_array($res_qry_cbo_velocidad_disco))
	  {
		$velocidad_disco_actual=$row_qry_cbo_velocidad_disco["velocidad_disco"];				
		$codigo_velocidad_disco_actual=$row_qry_cbo_velocidad_disco["codigo_velocidad_disco"];
	  }
	  $qry_cbo_velocidad_disco="SELECT * FROM cat_velocidad_disco where activo=1 and codigo_velocidad_disco<>'$id_velocidad_disco' order by velocidad_disco"; 
	  $res_qry_cbo_velocidad_disco=$query($qry_cbo_velocidad_disco);
	  echo('<input  name="velocidad_disco_upd_temp['.$cnt_disco.']" type="hidden" id="velocidad_disco_upd_temp['.$cnt_disco.']"  value="'.$codigo_velocidad_disco_actual.'"/>');
	  echo('<select name="velocidad_disco_upd['.$cnt_disco.']">');		
	  echo'<option value="0">'.$velocidad_disco_actual.'</option>';				
	  while($row_qry_cbo_velocidad_disco=$fetch_array($res_qry_cbo_velocidad_disco))
	  {
		echo'<option value="'.$row_qry_cbo_velocidad_disco["codigo_velocidad_disco"].'">'.$row_qry_cbo_velocidad_disco["velocidad_disco"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_velocidad_disco);
	  echo '</td>';  //finaliza despliegue de velocidad de disco actual
	  ////////////////////////////////////////inicia despliegue de TIPO DE disco actual
	  echo '<td>';  
	  $id_tipo_disco=$row_qry_disco_det["codigo_tipo"];	 	 
	  $qry_cbo_tipo_disco="SELECT * FROM cat_tipo_discoduro where codigo_tipo_discoduro='$id_tipo_disco'"; 
	  $res_qry_cbo_tipo_disco=$query($qry_cbo_tipo_disco);	  
	  while($row_qry_cbo_tipo_disco=$fetch_array($res_qry_cbo_tipo_disco))
	  {
		$tipo_disco_actual=$row_qry_cbo_tipo_disco["tipo_discoduro"];				
		$codigo_tipo_disco_actual=$row_qry_cbo_tipo_disco["codigo_tipo_discoduro"];			
	  }
	  $qry_cbo_tipo_disco="SELECT * FROM cat_tipo_discoduro where activo=1 and codigo_tipo_discoduro<>'$id_tipo_disco' order by tipo_discoduro"; 
	  $res_qry_cbo_tipo_disco=$query($qry_cbo_tipo_disco);
  	  echo('<input  name="tipo_disco_upd_temp['.$cnt_disco.']" type="hidden" id="tipo_disco_upd_temp['.$cnt_disco.']"  value="'.$codigo_tipo_disco_actual.'"/>');
	  echo('<select name="tipo_disco_upd['.$cnt_disco.']">');		
	  echo'<option value="0">'.$tipo_disco_actual.'</option>';				
	  while($row_qry_cbo_tipo_disco=$fetch_array($res_qry_cbo_tipo_disco))
	  {
		echo'<option value="'.$row_qry_cbo_tipo_disco["codigo_tipo_discoduro"].'">'.$row_qry_cbo_tipo_disco["tipo_discoduro"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_tipo_disco);
	  echo '</td>';  //finaliza despliegue de tipo de disco actual	  
	  ////////////////////////////////////////inicia despliegue de serie de disco actual
	  echo '<td>';
	  echo '<input  name="serie_disco_upd['.$cnt_disco.']" type="text" id="serie_disco_upd['.$cnt_disco.']" value="'.$row_qry_disco_det["serie"].'">';
	  echo '</td>';  	  
  	  ////////////////////////////////////////inicia estado del registro (activo/inactivo)
	  echo '<td>';
	  $id_estado_disco=$row_qry_disco_det["activo"];
	  if ($id_estado_disco==1)
	  	echo '<input name="estado_disco_upd['.$cnt_disco.']" type="checkbox" value="1" checked>'; 
	  	else
	  		echo '<input name="estado_disco_upd['.$cnt_disco.']" type="checkbox" value="2" disabled>'; 	   
	  echo '</td>';
	  //////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt_disco++;
  }
  ?> 
  
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar2()" value="Agregar l&iacute;nea">
<? echo '<input name="Bot&oacute;n" type="button" onClick="borrarUltima2('.$registros_disco.')" value="Borrar l&iacute;nea">' ?>
</body>
</html>