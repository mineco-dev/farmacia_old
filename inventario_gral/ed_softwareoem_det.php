<?	
	conectardb($inventarioadmin);?>  
<?
function get_version_opciones($dbms2)
{	
	$qry_version = mssql_query("select * from cat_version where activo=1 order by version");																									
	if ($qry_version)
		{
			while($row_version = mssql_fetch_row($qry_version))	
			{
				$opciones = $opciones."<option value = ".$row_version[0]. ">".$row_version[1]."</option>";
			}			
	}
	return $opciones;
}
function get_idioma_opciones($dbms2)
{	
	$qry_idioma= mssql_query("select * from cat_idioma where activo=1 order by idioma");																									
	if ($qry_idioma)
		{
			while($row_idioma = mssql_fetch_row($qry_idioma))	
			{
				$opciones = $opciones."<option value = ".$row_idioma[0]. ">".$row_idioma[1]."</option>";
			}			
	}
	return $opciones;
}
?>
<html>
<head>
<?
$llenar_version = get_version_opciones($dbms2);
$llenar_idioma=get_idioma_opciones($dbms2);
echo '<script>
var contLin5 = 1;
function agregar5() {
	var tr, td;

	tr = document.all.tabla5.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin5 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"version["+contLin5+"]\" id=\"select\">';
	echo $llenar_version;
	echo '</center></select>";	

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"idioma["+contLin5+"]\" id=\"select\">';
	echo $llenar_idioma;
	echo '</center></select>";		
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"cdkey["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"seriesoftwareoem["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	contLin5++;
}

function borrarUltima5(reg_actual) {
	ultima = document.all.tabla5.rows.length - 1;
	if (ultima > reg_actual)
	{
	 document.all.tabla5.deleteRow(ultima);
	 contLin5--;
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
<table width="90%" border=1 cellspacing="0" id="tabla5">
  <tr>
    <th width="23" scope="col"><span class="Estilo2">#</span></th>
    <th width="290" scope="col"><span class="Estilo2">Versi&oacute;n</span></th>
    <th width="248" scope="col"><div align="center" class="Estilo2">Idioma</div></th>
	<th width="231" scope="col"><span class="Estilo2">CD Key </span></th>
    <th width="307" scope="col">Serie</th>	
  </tr>
   <? 
  $cnt_software=1;
  $qry_software_det="select * from tb_inventario_software_det where codigo_inventario_enc='$id'";    
  $res_qry_software_det=$query($qry_software_det);  
  $registros_software=$num_rows($res_qry_software_det);
  while($row_qry_software_det=$fetch_array($res_qry_software_det))
  {
	  echo '<tr>';
	  echo '<td>&nbsp;</td>';
	   ////////////////////////////////////////inicia despliegue de TIPO DE software actual
	  echo '<td>';  
      echo('<input  name="rowid_software['.$cnt_software.']" type="hidden" id="rowid_disco['.$cnt_software.']"  value="'.$row_qry_software_det["rowid"].'"/>');
	  $id_software=$row_qry_software_det["codigo_version"];	 	 
	  $qry_cbo_version_software="SELECT * FROM cat_version where codigo_version='$id_software'"; 
	  $res_qry_cbo_version_software=$query($qry_cbo_version_software);	  
	  while($row_qry_cbo_version_software=$fetch_array($res_qry_cbo_version_software))
	  {
		$version_software_actual=$row_qry_cbo_version_software["version"];				
		$codigo_version_software_actual=$row_qry_cbo_version_software["codigo_version"];			
	  }
	  $qry_cbo_version_software="SELECT * FROM cat_version where activo=1 and codigo_version<>'$id_software' order by version"; 
	  $res_qry_cbo_version_software=$query($qry_cbo_version_software);
   	  echo('<input  name="version_software_upd_temp['.$cnt_software.']" type="hidden" id="version_software_upd_temp['.$cnt_software.']"  value="'.$codigo_version_software_actual.'"/>');
	  echo('<select name="version_software_upd['.$cnt_software.']">');		
	  echo'<option value="0">'.$version_software_actual.'</option>';				
	  while($row_qry_cbo_version_software=$fetch_array($res_qry_cbo_version_software))
	  {
		echo'<option value="'.$row_qry_cbo_version_software["codigo_version"].'">'.$row_qry_cbo_version_software["version"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_version_software);
	  echo '</td>';  //finaliza despliegue de version de software actual	  
	  
	///////////////////////////////////inicia despliegue de idioma actual
	  echo '<td>';  
	  $id_idioma_software=$row_qry_software_det["codigo_idioma"];	 
	  $qry_cbo_idioma_software="SELECT * FROM cat_idioma where codigo_idioma='$id_idioma_software'"; 
	  $res_qry_cbo_idioma_software=$query($qry_cbo_idioma_software);	 
	  while($row_qry_cbo_idioma_software=$fetch_array($res_qry_cbo_idioma_software))
	  {
		$idioma_software_actual=$row_qry_cbo_idioma_software["idioma"];		
		$codigo_idioma_software_actual=$row_qry_cbo_idioma_software["codigo_idioma"];	
	  }
	  $qry_cbo_idioma_software="SELECT * FROM cat_idioma where activo=1 and codigo_idioma<>'$id_idioma_software' order by idioma"; 
	  $res_qry_cbo_idioma_software=$query($qry_cbo_idioma_software);
   	  echo('<input  name="idioma_software_upd_temp['.$cnt_software.']" type="hidden" id="idioma_software_upd_temp['.$cnt_software.']"  value="'.$codigo_idioma_software_actual.'"/>');
	  echo('<select name="idioma_software_upd['.$cnt_software.']">');		
	  echo'<option value="0">'.$idioma_software_actual.'</option>';				
	  while($row_qry_cbo_idioma_software=$fetch_array($res_qry_cbo_idioma_software))
	  {
		echo'<option value="'.$row_qry_cbo_idioma_software["codigo_idioma"].'">'.$row_qry_cbo_idioma_software["idioma"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_idioma_software);
	  echo '</td>';  //finaliza despliegue de idioma de software actual	  
	  ////////////////////////////////////////inicia despliegue de cdkey de software actual
	  echo '<td>';
	  echo '<input  name="cdkey_software_upd['.$cnt_software.']" type="text" id="cdkey_software_upd['.$cnt_software.']" value="'.$row_qry_software_det["cdkey"].'">';
	  echo '</td>';   	  
	  ////////////////////////////////////////inicia despliegue de serie de software actual
	  echo '<td>';
	  echo '<input  name="serie_software_upd['.$cnt_software.']" type="text" id="serie_software_upd['.$cnt_software.']" value="'.$row_qry_software_det["serie"].'">';
	  echo '</td>'; 
	  	  
  	  ////////////////////////////////////////inicia estado del registro (activo/inactivo)
	  /*echo '<td align="center">';
	  $id_estado_software=$row_qry_software_det["activo"];
	  if ($id_estado_software==1)
	  	echo '<input name="estado_software_upd[$cnt_software]" type="checkbox" value="1" checked>'; 
	  	else
	  		echo '<input name="estado_software_upd[$cnt_software]" type="checkbox" value="2" disabled>';  
	  echo '</td>';*/
	  //////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt_software++;
  }
  ?>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar5()" value="Agregar l&iacute;nea">
<? echo '<input name="Bot&oacute;n" type="button" onClick="borrarUltima5('.$registros_software.')" value="Borrar l&iacute;nea">' ?>
</body>
</html>