<?	
	conectardb($formularioadmin);
?>  
<?
function get_tipocampo_opciones($dbms2)
{	
	$qry_tipocampo = mssql_query("select * from tb_tipo_campo where activo=1 order by tipo_campo");																									
	if ($qry_tipocampo)
		{
			while($row_qry_tipocampo = mssql_fetch_row($qry_tipocampo))	
			{
				$opciones = $opciones."<option value = ".$row_qry_tipocampo[0]. ">".$row_qry_tipocampo[1]."</option>";
			}			
	}
	return $opciones;
}

function get_tipocombo_opciones($dbms2)
{	
	$qry_tipocombo = mssql_query("select * from cat_tipo_combo where activo=1 order by tipo_combo");																									
	if ($qry_tipocombo)
		{
			$opciones = "<option value = '0'>-SELECCIONE-</option>";			
			while($row_qry_tipocombo = mssql_fetch_row($qry_tipocombo))	
			{
				$opciones = $opciones."<option value = ".$row_qry_tipocombo[0]. ">".$row_qry_tipocombo[1]."</option>";
			}			
	}
	return $opciones;
}

function get_validar_opciones($dbms2)
{				
	$opciones = $opciones."<option value = '1'>SI</option>";
	$opciones = $opciones."<option value = '2'>NO</option>";
	return $opciones;
}


?>
<html>
<head>
<?
$llenar_tipocampo = get_tipocampo_opciones($dbms2);
$llenar_tipocombo = get_tipocombo_opciones($dbms2);
$llenar_validar=get_validar_opciones($dbms2);

echo '<script>
var contLin6 = 1;
function agregar6() {
	var tr, td;

	tr = document.all.tabla6.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin6 +"";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_campo["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"15\"></center>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"cbo_tipocampo["+contLin6+"]\" id=\"select\">';
	echo $llenar_tipocampo;
	echo '</center></select>";			

	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_tborigen["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"15\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_campoorigen["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"15\"></center>";

	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_campollave["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"15\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_tamano["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"2\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_etiqueta["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_orden["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"2\"></center>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_tbdestino["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"10\"></center>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_campodestino["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"10\"></center>";	

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"cbo_tipocombo["+contLin6+"]\" id=\"select\">';
	echo $llenar_tipocombo;
	echo '</center></select>";

	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"cbo_combodestino["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"2\"></center>";	

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"txt_validar["+contLin6+"]\" id=\"select\">';
	echo $llenar_validar;
	echo '</center></select>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_textovalidacion["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_tip["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_condicion["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"20\" value=\"activo=1\"></center>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"txt_posicion["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"10\" value=\"1\"></center>";	
				
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
<table width="100%" border=1 cellspacing="0" id="tabla6">
  <tr>
  <div align="center" class="Estilo2">
    <th scope="col">#</span></th>   
    <th scope="col">Campo</th>
    <th scope="col">Tipo de campo</th>
    <th scope="col">Tabla origen</th>
	<th scope="col">Campo origen</th>
	<th scope="col">Campo llave</th>
	<th scope="col">Tamaño</th>
    <th scope="col">Etiqueta</th>
    <th scope="col">Orden</th>
    <th scope="col">Tabla destino</th>
    <th scope="col">Campo destino</th>
    <th scope="col">Tipo de combo</th>
    <th scope="col">Combo destino</th>
	<th scope="col">Validar</th>
	<th scope="col">Texto validación</th>
	<th scope="col">Tip</th>	
    <th scope="col">Condici&oacute;n</th>
    <th scope="col">Pos.</th>
    <th scope="col">Activo</th>
  </div>
  </tr>
  <?
  $cnt_campos=1; 
  $qry_campos="select c.*, p.condicion from tb_campo c
			   inner join tb_plantilla p 
			   on c.codigo_campo=p.codigo_campo and p.codigo_formulario='$id'";
			   
  $res_qry_campos=$query($qry_campos);  
  $registros_ingresados=$num_rows($res_qry_campos);
  while($row_qry_campos=$fetch_array($res_qry_campos))
  {
  	  echo '<tr>';
	  echo '<td>';
	  echo $row_qry_campos["codigo_campo"];
	  echo '<input  name="txt_codigo_campo_upd['.$cnt_campos.']" type="hidden" size="3" id="txt_codigo_campo_upd['.$cnt_campos.']" value="'.$row_qry_campos["codigo_campo"].'">';
	  echo '</td>'; 
	  //////////inicia campo actual///////////
	  echo '<td>';
	  echo '<input  name="txt_campo_upd['.$cnt_campos.']" type="text" size="15" id="txt_campo_upd['.$cnt_campos.']" value="'.$row_qry_campos["campo"].'">';
	  echo '</td>'; 
	  /////////inicia despliegue de tipo de campo actual////////////////
	  echo '<td>';        
	//  echo('<input  name="rowid_softwareinstall['.$cnt_softwareinstall.']" type="hidden" id="rowid_softwareinstall['.$cnt_softwareinstall.']"  value="'.$row_qry_softwareinstall_det["rowid"].'"/>');
	  $id_tipo_campo=$row_qry_campos["codigo_tipo_campo"];	 	 
	  $qry_cbo_tipo_campo="SELECT * FROM tb_tipo_campo where codigo_tipo_campo='$id_tipo_campo'"; 
	  $res_qry_cbo_tipo_campo=$query($qry_cbo_tipo_campo);	  
	  while($row_qry_cbo_tipo_campo=$fetch_array($res_qry_cbo_tipo_campo))
	  {		
		$tipo_campo_actual=$row_qry_cbo_tipo_campo["tipo_campo"];						
//		$codigo_casa_softwareinstall_actual=$row_qry_cbo_casa_softwareinstall["codigo_casa_software"];		
	  }
	  $qry_cbo_tipo_campo="SELECT * FROM tb_tipo_campo where activo=1 and codigo_tipo_campo<>'$id_tipo_campo' order by tipo_campo"; 
	  $res_qry_cbo_tipo_campo=$query($qry_cbo_tipo_campo);
	  echo('<input  name="cbo_tipocampo_upd_temp['.$cnt_campos.']" type="hidden" id="cbo_tipocampo_upd_temp['.$cnt_campos.']"  value="'.$id_tipo_campo.'"/>');
	  echo('<select name="cbo_tipocampo_upd['.$cnt_campos.']">');		
	  echo'<option value="0">'.$tipo_campo_actual.'</option>';				
	  while($row_qry_cbo_tipo_campo=$fetch_array($res_qry_cbo_tipo_campo))
	  {
		echo'<option value="'.$row_qry_cbo_tipo_campo["codigo_tipo_campo"].'">'.$row_qry_cbo_tipo_campo["tipo_campo"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_tipo_campo);
	  echo '</td>';  //finaliza despliegue de tipo de campo actual	
	  //////////inicia tb origen actual///////////
	  echo '<td>';
	  echo '<input  name="txt_tborigen_upd['.$cnt_campos.']" type="text" size="15" id="txt_tborigen_upd['.$cnt_campos.']" value="'.$row_qry_campos["tb_origen"].'">';
	  echo '</td>'; 
	  //////////inicia campo origen actual///////////
	  echo '<td>';
	  echo '<input  name="txt_campoorigen_upd['.$cnt_campos.']" type="text" size="15" id="txt_campoorigen_upd['.$cnt_campos.']" value="'.$row_qry_campos["campo_origen"].'">';
	  echo '</td>'; 
	  //////////inicia campo llave actual///////////
	  echo '<td>';
	  echo '<input  name="txt_campollave_upd['.$cnt_campos.']" type="text" size="15" id="txt_campollave_upd['.$cnt_campos.']" value="'.$row_qry_campos["campo_llave"].'">';
	  echo '</td>'; 
      //////////inicia tamano actual///////////
	  echo '<td>';
	  echo '<input  name="txt_tamano_upd['.$cnt_campos.']" type="text" size="2" id="txt_tamano_upd['.$cnt_campos.']" value="'.$row_qry_campos["tamano"].'">';
	  echo '</td>'; 	  
	  //////////inicia etiqueta actual///////////
	  echo '<td>';
	  echo '<input  name="txt_etiqueta_upd['.$cnt_campos.']" type="text" size="15" id="txt_etiqueta_upd['.$cnt_campos.']" value="'.$row_qry_campos["etiqueta"].'">';
	  echo '</td>'; 
      //////////inicia orden actual///////////
	  echo '<td>';
	  echo '<input  name="txt_orden_upd['.$cnt_campos.']" type="text"size="2"  id="txt_orden_upd['.$cnt_campos.']" value="'.$row_qry_campos["orden"].'">';
	  echo '</td>'; 
	  //////////inicia tb_destino actual///////////
	  echo '<td>';
	  echo '<input  name="txt_tbdestino_upd['.$cnt_campos.']" type="text" size="15" id="txt_tbdestino_upd['.$cnt_campos.']" value="'.$row_qry_campos["tb_destino"].'">';
	  echo '</td>'; 
      //////////inicia campo_destino actual///////////
	  echo '<td>';
	  echo '<input  name="txt_campodestino_upd['.$cnt_campos.']" type="text" size="15" id="txt_campodestino_upd['.$cnt_campos.']" value="'.$row_qry_campos["campo_destino"].'">';
	  echo '</td>'; 
	  /////////inicia despliegue de tipo de combo actual////////////////
	  echo '<td>';        
	//  echo('<input  name="rowid_softwareinstall['.$cnt_softwareinstall.']" type="hidden" id="rowid_softwareinstall['.$cnt_softwareinstall.']"  value="'.$row_qry_softwareinstall_det["rowid"].'"/>');
	  $id_tipo_combo=$row_qry_campos["tipo_combo"];	 	 
	  $qry_cbo_tipo_combo="SELECT * FROM cat_tipo_combo where codigo_tipo_combo='$id_tipo_combo'"; 
	  $res_qry_cbo_tipo_combo=$query($qry_cbo_tipo_combo);	  
	  while($row_qry_cbo_tipo_combo=$fetch_array($res_qry_cbo_tipo_combo))
	  {		
		$tipo_combo_actual=$row_qry_cbo_tipo_combo["tipo_combo"];						
//		$codigo_casa_softwareinstall_actual=$row_qry_cbo_casa_softwareinstall["codigo_casa_software"];		
	  }
	  $qry_cbo_tipo_combo="SELECT * FROM  cat_tipo_combo where activo=1 and codigo_tipo_combo<>'$id_tipo_combo' order by tipo_combo"; 
	  $res_qry_cbo_tipo_combo=$query($qry_cbo_tipo_combo);
	  echo('<input  name="cbo_tipocombo_upd_temp['.$cnt_campos.']" type="hidden" id="cbo_tipocombo_upd_temp['.$cnt_combo.']"  value="'.$id_tipo_combo.'"/>');
	  echo('<select name="cbo_tipocombo_upd['.$cnt_campos.']">');		
	  echo'<option value="0">'.$tipo_combo_actual.'</option>';				
	  while($row_qry_cbo_tipo_combo=$fetch_array($res_qry_cbo_tipo_combo))
	  {
		echo'<option value="'.$row_qry_cbo_tipo_combo["codigo_tipo_combo"].'">'.$row_qry_cbo_tipo_combo["tipo_combo"].'</option>';
	  }
	  echo('</select>');					
	  $free_result($res_qry_cbo_tipo_combo);
	  echo '</td>';  //finaliza despliegue de tipo de campo actual	
	  //////////inicia combo_destino actual///////////
	  echo '<td>';
	  echo '<input  name="txt_combodestino_upd['.$cnt_campos.']" type="text" size="2" id="txt_combodestino_upd['.$cnt_campos.']" value="'.$row_qry_campos["combo_destino"].'">';
	  echo '</td>'; 
	   //////////inicia validar actual///////////
	  echo '<td>';
	  echo '<input  name="txt_validar_upd['.$cnt_campos.']" type="text" size="2" id="txt_validar_upd['.$cnt_campos.']" value="'.$row_qry_campos["validar"].'">';
	  echo '</td>';  
      //////////inicia texto validacion actual///////////
	  echo '<td>';
	  echo '<input  name="txt_textovalidacion_upd['.$cnt_campos.']" type="text" size="15" id="txt_textovalidacion_upd['.$cnt_campos.']" value="'.$row_qry_campos["texto_validacion"].'">';
	  echo '</td>';       
      //////////inicia ayuda actual///////////
	  echo '<td>';
	  echo '<input  name="txt_tip_upd['.$cnt_campos.']" type="text" size="15" id="txt_tip_upd['.$cnt_campos.']" value="'.$row_qry_campos["ayuda"].'">';
	  echo '</td>'; 
	  //////////inicia condicion actual///////////
	  echo '<td>';
	  echo '<input  name="txt_condicion_upd['.$cnt_campos.']" type="text" size="15" id="txt_condicion_upd['.$cnt_campos.']" value="'.$row_qry_campos["condicion"].'">';
	  echo '</td>'; 
	   //////////inicia posicion///////////
	  echo '<td>';
	  echo '<input  name="txt_posicion_upd['.$cnt_campos.']" type="text" size="1" id="txt_posicion_upd['.$cnt_campos.']" value="'.$row_qry_campos["cambio_fila"].'">';
	  echo '</td>'; 	  
	  
      //////////inicia activo///////////
	  echo '<td>';
	  echo '<input  name="txt_activo_upd['.$cnt_campos.']" type="text" size="1" id="txt_activo_upd['.$cnt_campos.']" value="'.$row_qry_campos["activo"].'">';
	  echo '</td>'; 	  
	//////////////////////////////////////////////////////////////////////////////	
	  echo '</tr>';
	  $cnt_campos++;
  }
  ?>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar6()" value="Agregar campo">
<? echo '<input name="Bot&oacute;n" type="button" onClick="borrarUltima6('.$registros_ingresados.')" value="Borrar l&iacute;nea">' ?>
</body>
</html>