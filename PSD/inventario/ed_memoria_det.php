<?
	//require("../includes/funciones.php");
	//require("../includes/sqlcommand.inc");
	conectardb($inventarioadmin);
?>  
<?
function get_marca_opciones($dbms2)
{	
	$qry_marca = mssql_query("select * from cat_marca where activo=1 and codigo_tipo_objeto=5 order by marca");																									
	if ($qry_marca)
		{
			while($row_marca = mssql_fetch_row($qry_marca))	
			{
				$opciones = $opciones."<option value = ".$row_marca[0]. ">".$row_marca[1]."</option>";
			}			
	}
	return $opciones;
}
function get_capacidad_opciones($dbms2)
{	
	$qry_capacidad = mssql_query("select * from cat_capacidad_memoria where activo=1 order by capacidad_memoria");																									
	if ($qry_capacidad)
		{
			while($row_capacidad = mssql_fetch_row($qry_capacidad))	
			{
				$opciones = $opciones."<option value = ".$row_capacidad[0]. ">".$row_capacidad[1]."</option>";
			}
			
	}
	return $opciones;
}

function get_velocidad_opciones($dbms2)
{	
	$qry_velocidad = mssql_query("select * from cat_velocidad_procesador where activo=1 and memoria=1 order by velocidad_procesador");																									
	if ($qry_velocidad)
		{
			while($row_velocidad = mssql_fetch_row($qry_velocidad))	
			{
				$opciones = $opciones."<option value = ".$row_velocidad[0]. ">".$row_velocidad[1]."</option>";
			}
			
	}
	return $opciones;
}

function get_tipo_memoria_opciones($dbms2)
{	
	$qry_tipo_memoria = mssql_query("select * from cat_tipo_memoria where activo=1 order by tipo_memoria");																									
	if ($qry_tipo_memoria)
		{
			while($row_tipo_memoria = mssql_fetch_row($qry_tipo_memoria))	
			{
				$opciones = $opciones."<option value = ".$row_tipo_memoria[0]. ">".$row_tipo_memoria[1]."</option>";
			}
			
	}
	return $opciones;
}

?>
<html>
<head>
<?
$llenar_marca = get_marca_opciones($dbms2);
$llenar_capacidad=get_capacidad_opciones($dbms2);
$llenar_velocidad=get_velocidad_opciones($dbms2);
$llenar_tipo_memoria=get_tipo_memoria_opciones($dbms2);
echo '<script>
var contLin1 = 1;
function agregar1() {
	var tr, td;

	tr = document.all.tabla1.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin1 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"marca["+contLin1+"]\" id=\"select\">';
	echo $llenar_marca;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"capacidad["+contLin1+"]\" id=\"select\">';
	echo $llenar_capacidad;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"velocidad["+contLin1+"]\" id=\"select\">';
	echo $llenar_velocidad;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"tipo_memoria["+contLin1+"]\" id=\"select\">';
	echo $llenar_tipo_memoria;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serie["+contLin1+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"numero_parte["+contLin1+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";	
	
	td = tr.insertCell();
	contLin1++;
}

function borrarUltima1(reg_actual) {
	ultima = document.all.tabla1.rows.length - 1;
	if (ultima >reg_actual)
	{
	 document.all.tabla1.deleteRow(ultima);
	 contLin1--;
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
<table width="90%" border=1 cellspacing="0" id="tabla1">
  <tr>
    <th width="12" scope="col"><span class="Estilo2">#</span></th>
    <th width="162" scope="col"><span class="Estilo2">Marca</span></th>
    <th width="208" scope="col"><div align="center" class="Estilo2">Tama&ntilde;o </div></th>
	<th width="264" scope="col">Velocidad</th>
	<th width="189" scope="col"><span class="Estilo2">Tipo</span></th>
    <th width="189" scope="col"><span class="Estilo2">Serie</span></th>
    <th width="195" scope="col"><span class="Estilo2">N&uacute;mero de parte </span></th>
    <th width="195" scope="col"><span class="Estilo2">Activo?</span></th>
  </tr>
  <? 
  $cnt_mem=1;
  $qry_memoria_det="select * from tb_inventario_memoria_det where codigo_inventario_enc='$id'";    
  $res_qry_memoria_det=$query($qry_memoria_det);  
  $registros=$num_rows($res_qry_memoria_det);
  while($row_qry_memoria_det=$fetch_array($res_qry_memoria_det))
  {
	  echo '<tr>';
	  echo '<td>&nbsp;</td>';
	///////////////////////////////////inicia despliegue de marca de memoria actual
	  echo '<td>';  	  
  	  echo('<input  name="rowid_memoria['.$cnt_mem.']" type="hidden" id="rowid_memoria['.$cnt_mem.']"  value="'.$row_qry_memoria_det["rowid"].'"/>');
	  $id_marca_mem=$row_qry_memoria_det["codigo_marca"];	 
	  $qry_cbo_marca_mem="SELECT * FROM cat_marca where codigo_marca='$id_marca_mem'"; 
	  $res_qry_cbo_marca_mem=$query($qry_cbo_marca_mem);	  
	  while($row_qry_cbo_marca_mem=$fetch_array($res_qry_cbo_marca_mem))
	  {
		$memoria_actual=$row_qry_cbo_marca_mem["marca"];		
		$codigo_memoriaactual=$row_qry_cbo_marca_mem["codigo_marca"];	
	  }
	  $qry_cbo_marca_mem="SELECT * FROM cat_marca where activo=1 and codigo_marca<>'$id_marca_mem' and codigo_tipo_objeto=5  order by marca"; 
	  $res_qry_cbo_marca_mem=$query($qry_cbo_marca_mem);
	  echo('<input  name="marca_upd_temp['.$cnt_mem.']" type="hidden" id="marca_upd_temp['.$cnt_mem.']"  value="'.$codigo_memoriaactual.'"/>');
	  echo('<select name="marca_upd['.$cnt_mem.']">');		
	  echo'<option value="0">'.$memoria_actual.'</option>';				
	  while($row_qry_cbo_marca_mem=$fetch_array($res_qry_cbo_marca_mem))
	  {
		echo'<option value="'.$row_qry_cbo_marca_mem["codigo_marca"].'">'.$row_qry_cbo_marca_mem["marca"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_marca_mem);
	  echo '</td>';  //finaliza despliegue de marca de memoria actual
	  ////////////////////////////////////////inicia despliegue de tamaño de memoria actual
	  echo '<td>';  
	  $id_capacidad_mem=$row_qry_memoria_det["codigo_capacidad_memoria"];	 
	  $qry_cbo_capacidad_mem="SELECT * FROM cat_capacidad_memoria where codigo_capacidad_memoria='$id_capacidad_mem'"; 
	  $res_qry_cbo_capacidad_mem=$query($qry_cbo_capacidad_mem);	  
	  while($row_qry_cbo_capacidad_mem=$fetch_array($res_qry_cbo_capacidad_mem))
	  {
		$capacidad_actual=$row_qry_cbo_capacidad_mem["capacidad_memoria"];		
		$codigo_capacidadactual=$row_qry_cbo_capacidad_mem["codigo_capacidad_memoria"];	
	  }
	  $qry_cbo_capacidad_mem="SELECT * FROM cat_capacidad_memoria where activo=1 and codigo_capacidad_memoria<>'$id_capacidad_mem' order by capacidad_memoria"; 
	  $res_qry_cbo_capacidad_mem=$query($qry_cbo_capacidad_mem);
	  echo('<input  name="capacidad_upd_temp['.$cnt_mem.']" type="hidden" id="capacidad_upd_temp['.$cnt_mem.']"  value="'.$codigo_capacidadactual.'"/>');
	  echo('<select name="capacidad_upd['.$cnt_mem.']">');		
	  echo'<option value="0">'.$capacidad_actual.'</option>';				
	  while($row_qry_cbo_capacidad_mem=$fetch_array($res_qry_cbo_capacidad_mem))
	  {
		echo'<option value="'.$row_qry_cbo_capacidad_mem["codigo_capacidad_memoria"].'">'.$row_qry_cbo_capacidad_mem["capacidad_memoria"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_capacidad_mem);
	  echo '</td>';  //finaliza despliegue de capacidad memoria actual
	   ////////////////////////////////////////inicia despliegue de velocidad de memoria actual
	  echo '<td>';  
	  $id_velocidad_mem=$row_qry_memoria_det["codigo_velocidad"];	 
	  $qry_cbo_velocidad_mem="SELECT * FROM cat_velocidad_procesador where codigo_velocidad_procesador='$id_velocidad_mem'"; 
	  $res_qry_cbo_velocidad_mem=$query($qry_cbo_velocidad_mem);	  
	  while($row_qry_cbo_velocidad_mem=$fetch_array($res_qry_cbo_velocidad_mem))
	  {
		$velocidad_actual=$row_qry_cbo_velocidad_mem["velocidad_procesador"];		
		$codigo_velocidadactual=$row_qry_cbo_velocidad_mem["codigo_velocidad_procesador"];	
	  }
	  $qry_cbo_velocidad_mem="SELECT * FROM cat_velocidad_procesador where activo=1 and codigo_velocidad_procesador<>'$id_velocidad_mem' and memoria=1 order by velocidad_procesador"; 
	  $res_qry_cbo_velocidad_mem=$query($qry_cbo_velocidad_mem);
	  echo('<input  name="velocidad_upd_temp['.$cnt_mem.']" type="hidden" id="velocidad_upd_temp['.$cnt_mem.']"  value="'.$codigo_velocidadactual.'"/>');
	  echo('<select name="velocidad_upd['.$cnt_mem.']">');		
	  echo'<option value="0">'.$velocidad_actual.'</option>';				
	  while($row_qry_cbo_velocidad_mem=$fetch_array($res_qry_cbo_velocidad_mem))
	  {
		echo'<option value="'.$row_qry_cbo_velocidad_mem["codigo_velocidad_procesador"].'">'.$row_qry_cbo_velocidad_mem["velocidad_procesador"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_velocidad_mem);
	  echo '</td>';  //finaliza despliegue de velocidad memoria actual
	     ////////////////////////////////////////inicia despliegue de tipo de memoria actual
	  echo '<td>';  
	  $id_tipo_mem=$row_qry_memoria_det["codigo_tipo_memoria"];	 
	  $qry_cbo_tipo_mem="SELECT * FROM cat_tipo_memoria where codigo_tipo_memoria='$id_tipo_mem'"; 
	  $res_qry_cbo_tipo_mem=$query($qry_cbo_tipo_mem);	  
	  while($row_qry_cbo_tipo_mem=$fetch_array($res_qry_cbo_tipo_mem))
	  {
		$tipo_actual=$row_qry_cbo_tipo_mem["tipo_memoria"];		
		$codigo_tipoactual=$row_qry_cbo_tipo_mem["codigo_tipo_memoria"];	
	  }
	  $qry_cbo_tipo_mem="SELECT * FROM cat_tipo_memoria where activo=1 and codigo_tipo_memoria<>'$id_tipo_mem' order by tipo_memoria"; 
	  $res_qry_cbo_tipo_mem=$query($qry_cbo_tipo_mem);
      echo('<input  name="tipo_upd_temp['.$cnt_mem.']" type="hidden" id="velocidad_upd_temp['.$cnt_mem.']"  value="'.$codigo_tipoactual.'"/>');
	  echo('<select name="tipo_upd['.$cnt_mem.']">');		
	  echo'<option value="0">'.$tipo_actual.'</option>';				
	  while($row_qry_cbo_tipo_mem=$fetch_array($res_qry_cbo_tipo_mem))
	  {
		echo'<option value="'.$row_qry_cbo_tipo_mem["codigo_tipo_memoria"].'">'.$row_qry_cbo_tipo_mem["tipo_memoria"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_tipo_mem);
	  echo '</td>';  //finaliza despliegue de tipo de  memoria actual
	  ////////////////////////////////////////inicia despliegue de serie de memoria actual
	  echo '<td>';
	  echo '<input  name="serie_upd['.$cnt_mem.']" type="text" id="serie_upd['.$cnt_mem.']" value="'.$row_qry_memoria_det["serie"].'">';
	  echo '</td>';
  	  ////////////////////////////////////////inicia despliegue de numero de parte de memoria actual
	  echo '<td>';
	  echo '<input  name="numero_parte_upd['.$cnt_mem.']" type="text" id="serie_upd['.$cnt_mem.']" value="'.$row_qry_memoria_det["numero_parte"].'">';
	  echo '</td>';
  	  ////////////////////////////////////////inicia estado del registro (activo/inactivo)
	  echo '<td>';
	  $id_estado_mem=$row_qry_memoria_det["activo"];
	  if ($id_estado_mem==1)
	  	echo '<input name="estado_mem_upd['.$cnt_mem.']" type="checkbox" value="1" checked>'; 
	  	else
	  		echo '<input name="estado_mem_upd['.$cnt_mem.']" type="checkbox" value="2" disabled>'; 	   
	  echo '</td>';
	  //////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt_mem++;
  }
  ?>  
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar1()" value="Agregar l&iacute;nea">
<? echo '<input name="Bot&oacute;n" type="button" onClick="borrarUltima1('.$registros.')" value="Borrar l&iacute;nea">' ?>
</body>
</html>