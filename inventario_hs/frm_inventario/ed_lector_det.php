<?	
	conectardb($inventarioadmin);
?>  
<?
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
    <th width="41" scope="col"><span class="Estilo2">#</span></th>
    <th width="298" scope="col"><span class="Estilo2">Tipo</span></th>
    <th width="537" scope="col">Activo?</th>
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
	  echo '<td align="center">';  
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