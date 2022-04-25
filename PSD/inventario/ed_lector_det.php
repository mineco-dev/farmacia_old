<?	
	conectardb($inventarioadmin);?>  
<?
function get_marcalector_opciones($dbms2)
{	
	$qry_marcalector = mssql_query("select * from cat_marca where activo=1 and codigo_tipo_objeto=13 order by marca");																									
	if ($qry_marcalector)
		{
			while($row_marcalector = mssql_fetch_row($qry_marcalector))	
			{
				$opciones = $opciones."<option value = ".$row_marcalector[0]. ">".$row_marcalector[1]."</option>";
			}			
	}
	return $opciones;
}
function get_velocidadlector_opciones($dbms2)
{	
	$qry_velocidadlector = mssql_query("select * from cat_velocidad_lector where activo=1 order by velocidad_lector");																									
	if ($qry_velocidadlector)
		{
			while($row_velocidadlector = mssql_fetch_row($qry_velocidadlector))	
			{
				$opciones = $opciones."<option value = ".$row_velocidadlector[0]. ">".$row_velocidadlector[1]."</option>";
			}			
	}
	return $opciones;
}
function get_tipolector_opciones($dbms2)
{	
	$qry_tipolector = mssql_query("select * from cat_tipo_lector where activo=1 order by tipo_lector");																									
	if ($qry_tipolector)
		{
			while($row_tipolector = mssql_fetch_row($qry_tipolector))	
			{
				$opciones = $opciones."<option value = ".$row_tipolector[0]. ">".$row_tipolector[1]."</option>";
			}			
	}
	return $opciones;
}
?>
<html>
<head>
<?
$llenar_marcalector = get_marcalector_opciones($dbms2);
$llenar_velocidadlector=get_velocidadlector_opciones($dbms2);
$llenar_tipolector=get_tipolector_opciones($dbms2);
echo '<script>
var contLin3 = 1;
function agregar3() {
	var tr, td;

	tr = document.all.tabla3.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin3 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"tipolector["+contLin3+"]\" id=\"select\">';
	echo $llenar_tipolector;
	echo '</center></select>";	

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"marcalector["+contLin3+"]\" id=\"select\">';
	echo $llenar_marcalector;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"velocidadlector["+contLin3+"]\" id=\"select\">';
	echo $llenar_velocidadlector;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serielector["+contLin3+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"modelolector["+contLin3+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	contLin3++;
}

function borrarUltima3(reg_actual) {
	ultima = document.all.tabla3.rows.length - 1;
	if (ultima > reg_actual)
	{
	 document.all.tabla3.deleteRow(ultima);
	 contLin3--;
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
<table width="90%" border=1 cellspacing="0" id="tabla3">
  <tr>
    <th width="16" scope="col"><span class="Estilo2">#</span></th>
    <th width="213" scope="col"><span class="Estilo2">Tipo</span></th>
    <th width="273" scope="col"><div align="center" class="Estilo2">Marca</div></th>
	<th width="295" scope="col">Velocidad</th>
	<th width="151" scope="col"><span class="Estilo2">Serie</span></th>
    <th width="151" scope="col">Modelo</th>
	<th width="151" scope="col">Activo?</th>
  </tr>
   <?
  $cnt_lector=1; 
  $qry_lector_det="select * from tb_inventario_lector_det where codigo_inventario_enc='$id'";    
  $res_qry_lector_det=$query($qry_lector_det);  
  $registros_lector=$num_rows($res_qry_lector_det);
  while($row_qry_lector_det=$fetch_array($res_qry_lector_det))
  {
	  echo '<tr>';
	  echo '<td>&nbsp;</td>';
	   ////////////////////////////////////////inicia despliegue de TIPO DE lector actual
	  echo '<td>';  
      echo('<input  name="rowid_lector['.$cnt_lector.']" type="hidden" id="rowid_disco['.$cnt_lector.']"  value="'.$row_qry_lector_det["rowid"].'"/>');
	  $id_tipo_lector=$row_qry_lector_det["codigo_tipo_lector"];	 	 
	  $qry_cbo_tipo_lector="SELECT * FROM cat_tipo_lector where codigo_tipo_lector='$id_tipo_lector'"; 
	  $res_qry_cbo_tipo_lector=$query($qry_cbo_tipo_lector);	  
	  while($row_qry_cbo_tipo_lector=$fetch_array($res_qry_cbo_tipo_lector))
	  {
		$tipo_lector_actual=$row_qry_cbo_tipo_lector["tipo_lector"];						
		$codigo_tipo_lector_actual=$row_qry_cbo_tipo_lector["codigo_tipo_lector"];	
	  }
	  $qry_cbo_tipo_lector="SELECT * FROM cat_tipo_lector where activo=1 and codigo_tipo_lector<>'$id_tipo_lector' order by tipo_lector"; 
	  $res_qry_cbo_tipo_lector=$query($qry_cbo_tipo_lector);
 	  echo('<input  name="tipo_lector_upd_temp['.$cnt_lector.']" type="hidden" id="tipo_lector_upd_temp['.$cnt_lector.']"  value="'.$codigo_tipo_lector_actual.'"/>');
	  echo('<select name="tipo_lector_upd['.$cnt_lector.']">');		
	  echo'<option value="0">'.$tipo_lector_actual.'</option>';				
	  while($row_qry_cbo_tipo_lector=$fetch_array($res_qry_cbo_tipo_lector))
	  {
		echo'<option value="'.$row_qry_cbo_tipo_lector["codigo_tipo_lector"].'">'.$row_qry_cbo_tipo_lector["tipo_lector"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_tipo_lector);
	  echo '</td>';  //finaliza despliegue de tipo de lector actual	  
	  
	///////////////////////////////////inicia despliegue de marca de lector actual
	  echo '<td>';  
	  $id_marca_lector=$row_qry_lector_det["codigo_marca"];	 
	  $qry_cbo_marca_lector="SELECT * FROM cat_marca where codigo_marca='$id_marca_lector'"; 
	  $res_qry_cbo_marca_lector=$query($qry_cbo_marca_lector);	 
	  while($row_qry_cbo_marca_lector=$fetch_array($res_qry_cbo_marca_lector))
	  {
		$marca_lector_actual=$row_qry_cbo_marca_lector["marca"];		
		$codigo_marca_lector_actual=$row_qry_cbo_marca_lector["codigo_marca"];	
	  }
	  $qry_cbo_marca_lector="SELECT * FROM cat_marca where activo=1 and codigo_marca<>'$id_marca_lector' and codigo_tipo_objeto=13  order by marca"; 
	  $res_qry_cbo_marca_lector=$query($qry_cbo_marca_lector);
  	  echo('<input  name="marca_lector_upd_temp['.$cnt_lector.']" type="hidden" id="marca_lector_upd_temp['.$cnt_lector.']"  value="'.$codigo_marca_lector_actual.'"/>');
	  echo('<select name="marca_lector_upd['.$cnt_lector.']">');		
	  echo'<option value="0">'.$marca_lector_actual.'</option>';				
	  while($row_qry_cbo_marca_lector=$fetch_array($res_qry_cbo_marca_lector))
	  {
		echo'<option value="'.$row_qry_cbo_marca_lector["codigo_marca"].'">'.$row_qry_cbo_marca_lector["marca"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_marca_lector);
	  echo '</td>';  //finaliza despliegue de marca de lector actual
	  ////////////////////////////////////////inicia despliegue de velocidad del lector actual
	  echo '<td>';  
	  $id_velocidad_lector=$row_qry_lector_det["codigo_velocidad_lector"];	 
	  $qry_cbo_velocidad_lector="SELECT * FROM cat_velocidad_lector where codigo_velocidad_lector='$id_velocidad_lector'"; 
	  $res_qry_cbo_velocidad_lector=$query($qry_cbo_velocidad_lector);	  
	  while($row_qry_cbo_velocidad_lector=$fetch_array($res_qry_cbo_velocidad_lector))
	  {
		$velocidad_lector_actual=$row_qry_cbo_velocidad_lector["velocidad_lector"];		
		$codigo_velocidad_lector_actual=$row_qry_cbo_velocidad_lector["codigo_velocidad_lector"];		
	  }
	  $qry_cbo_velocidad_lector="SELECT * FROM cat_velocidad_lector where activo=1 and codigo_velocidad_lector<>'$id_velocidad_lector' order by velocidad_lector"; 
	  $res_qry_cbo_velocidad_lector=$query($qry_cbo_velocidad_lector);
	  echo('<input  name="velocidad_lector_upd_temp['.$cnt_lector.']" type="hidden" id="velocidad_lector_upd_temp['.$cnt_lector.']"  value="'.$codigo_velocidad_lector_actual.'"/>');
	  echo('<select name="velocidad_lector_upd['.$cnt_lector.']">');		
	  echo'<option value="0">'.$velocidad_lector_actual.'</option>';				
	  while($row_qry_cbo_velocidad_lector=$fetch_array($res_qry_cbo_velocidad_lector))
	  {
		echo'<option value="'.$row_qry_cbo_velocidad_lector["codigo_velocidad_lector"].'">'.$row_qry_cbo_velocidad_lector["velocidad_lector"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_velocidad_lector);
	  echo '</td>';  //finaliza despliegue de velocidad de lector actual
	  
	  ////////////////////////////////////////inicia despliegue de serie de LECTOR actual
	  echo '<td>';
	  echo '<input  name="serie_lector_upd['.$cnt_lector.']" type="text" id="serie_lector_upd['.$cnt_lector.']" value="'.$row_qry_lector_det["serie"].'">';
	  echo '</td>'; 
	  
	  ////////////////////////////////////////inicia despliegue de modelo de LECTOR actual
	  echo '<td>';
	  echo '<input  name="modelo_lector_upd['.$cnt_lector.']" type="text" id="modelo_lector_upd['.$cnt_lector.']" value="'.$row_qry_lector_det["modelo"].'">';
	  echo '</td>';   	  
  	  ////////////////////////////////////////inicia estado del registro (activo/inactivo)
	  echo '<td align="center">';
	  $id_estado_lector=$row_qry_lector_det["activo"];
	  if ($id_estado_lector==1)
	  	echo '<input name="estado_lector_upd['.$cnt_lector.']" type="checkbox" value="1" checked>'; 
	  	else
	  		echo '<input name="estado_lector_upd['.$cnt_lector.']" type="checkbox" value="2" disabled>';  
	  echo '</td>';
	  //////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt_lector++;
  }
  ?>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar3()" value="Agregar l&iacute;nea">
<? echo '<input name="Bot&oacute;n" type="button" onClick="borrarUltima3('.$registros_lector.')" value="Borrar l&iacute;nea">' ?>

</body>
</html>