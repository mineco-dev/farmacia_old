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
	contLin6++;
}

function borrarUltima6() {
	ultima = document.all.tabla6.rows.length - 1;
	if (ultima !=0)
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
  </div>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar6()" value="Agregar campo">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima6()" value="Borrar campo">
</body>
</html>