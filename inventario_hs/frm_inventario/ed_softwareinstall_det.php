<?	
	conectardb($inventarioadmin);?>  
<?

function get_fabricante_opciones($dbms2)
{	
	$qry_fabricante= mssql_query("select * from cat_casa_software where activo=1 order by casa_software");																									
	if ($qry_fabricante)
		{
			while($row_fabricante = mssql_fetch_row($qry_fabricante))	
			{
				$opciones = $opciones."<option value = ".$row_fabricante[0]. ">".$row_fabricante[1]."</option>";
			}			
	}
	return $opciones;
}
?>
<html>
<head>
<?
$llenar_fabricante=get_fabricante_opciones($dbms2);


echo '<script>
var contLin6 = 1;
function agregar6() {
	var tr, td;

	tr = document.all.tabla6.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin6 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"fabricante["+contLin6+"]\" id=\"select\">';
	echo $llenar_fabricante;
	echo '</center></select>";			
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"software["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"50\"></center>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serieinstall["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"conlicencia["+contLin6+"]\" type=\"checkbox\" id=\"conlicencia\" value=\"1\"></center>";
			
	td = tr.insertCell();
	contLin6++;
}

function borrarUltima6(reg_actual) {
	ultima = document.all.tabla6.rows.length - 1;
	if (ultima > reg_actual)
	{
	 document.all.tabla6.deleteRow(ultima);
	 contLin6--;
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
<table width="90%" border=1 cellspacing="0" id="tabla6">
  <tr>
    <th width="22" scope="col"><span class="Estilo2">#</span></th>
    <th width="141" scope="col">Fabricante</th>
    <th width="307" scope="col"><div align="center" class="Estilo2">Software</div></th>
	<th width="249" scope="col">Observaciones</th>
    <th width="74" scope="col">Posee licencia </th>
    <th width="75" scope="col">Activo?</th>
  </tr>
  <?
  $cnt_softwareinstall=1; 
  $qry_softwareinstall_det="select * from tb_inventario_softwareinstall_det where codigo_inventario_enc='$id'";    
  $res_qry_softwareinstall_det=$query($qry_softwareinstall_det);  
  $registros_softwareinstall=$num_rows($res_qry_softwareinstall_det);
  while($row_qry_softwareinstall_det=$fetch_array($res_qry_softwareinstall_det))
  {
	  echo '<tr>';
	  echo '<td>&nbsp;</td>'; 
	  ////////////////////////////////////////inicia despliegue de casa de softwareinstall actual
	  echo '<td>';        
	  echo('<input  name="rowid_softwareinstall['.$cnt_softwareinstall.']" type="hidden" id="rowid_softwareinstall['.$cnt_softwareinstall.']"  value="'.$row_qry_softwareinstall_det["rowid"].'"/>');
	  $id_casa_softwareinstall=$row_qry_softwareinstall_det["codigo_casa_software"];	 	 
	  $qry_cbo_casa_softwareinstall="SELECT * FROM cat_casa_software where codigo_casa_software='$id_casa_softwareinstall'"; 
	  $res_qry_cbo_casa_softwareinstall=$query($qry_cbo_casa_softwareinstall);	  
	  while($row_qry_cbo_casa_softwareinstall=$fetch_array($res_qry_cbo_casa_softwareinstall))
	  {
		$casa_softwareinstall_actual=$row_qry_cbo_casa_softwareinstall["casa_software"];						
		$codigo_casa_softwareinstall_actual=$row_qry_cbo_casa_softwareinstall["codigo_casa_software"];		
	  }
	  $qry_cbo_casa_softwareinstall="SELECT * FROM cat_casa_software where activo=1 and codigo_casa_software<>'$id_casa_softwareinstall' order by casa_software"; 
	  $res_qry_cbo_casa_softwareinstall=$query($qry_cbo_casa_softwareinstall);
	  echo('<input  name="casa_softwareinstall_upd_temp['.$cnt_softwareinstall.']" type="hidden" id="casa_softwareinstall_upd_temp['.$cnt_softwareinstall.']"  value="'.$codigo_casa_softwareinstall_actual.'"/>');
	  echo('<select name="casa_softwareinstall_upd['.$cnt_softwareinstall.']">');		
	  echo'<option value="0">'.$casa_softwareinstall_actual.'</option>';				
	  while($row_qry_cbo_casa_softwareinstall=$fetch_array($res_qry_cbo_casa_softwareinstall))
	  {
		echo'<option value="'.$row_qry_cbo_casa_softwareinstall["codigo_casa_software"].'">'.$row_qry_cbo_casa_softwareinstall["casa_software"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_casa_softwareinstall);
	  echo '</td>';  //finaliza despliegue de casa de softwareinstall actual	
	    
	 ////////////////////////////////////////inicia despliegue de software actual
	  echo '<td>';
	  echo '<input  name="software_upd['.$cnt_softwareinstall.']" type="text" id="software_upd['.$cnt_softwareinstall.']" value="'.$row_qry_softwareinstall_det["software"].'">';
	  echo '</td>';  	   	  	 
	 
	  ////////////////////////////////////////inicia despliegue de serie de softwareinstall actual
	  echo '<td>';
	  echo '<input  name="serie_softwareinstall_upd['.$cnt_softwareinstall.']" type="text" id="serie_softwareinstall_upd['.$cnt_softwareinstall.']" value="'.$row_qry_softwareinstall_det["serie"].'">';
	  echo '</td>'; 
	  
	  ////////////////////////////////////////posee licencia
	  echo '<td align="center">';
	  $id_licencia_softwareinstall=$row_qry_softwareinstall_det["licencia"];
	  if ($id_licencia_softwareinstall==1)
	  	    echo '<input name="licencia_softwareinstall_upd['.$cnt_softwareinstall.']" type="checkbox" checked>'; 
	  	else
	  		echo '<input name="licencia_softwareinstall_upd['.$cnt_softwareinstall.']" type="checkbox">';  
	  echo '</td>';
	  	  
  	  ////////////////////////////////////////inicia estado del registro (activo/inactivo)
	  echo '<td align="center">';
	  $id_estado_softwareinstall=$row_qry_softwareinstall_det["activo"];
	  if ($id_estado_softwareinstall==1)
	  	echo '<input name="estado_softwareinstall_upd['.$cnt_softwareinstall.']" type="checkbox" value="1" checked>'; 
	  	else
	  		echo '<input name="estado_softwareinstall_upd['.$cnt_softwareinstall.']" type="checkbox" value="2" disabled>';  
	  echo '</td>';
	  //////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt_softwareinstall++;
  }
  ?>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar6()" value="Agregar l&iacute;nea">
<? echo '<input name="Bot&oacute;n" type="button" onClick="borrarUltima6('.$registros_softwareinstall.')" value="Borrar l&iacute;nea">' ?>
</body>
</html>