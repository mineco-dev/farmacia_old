<?	
	conectardb($inventarioopera);	
?>  
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

function borrarUltima2() {
	ultima = document.all.tabla2.rows.length - 1;
	if (ultima !=0)
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
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar2()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima2()" value="Borrar l&iacute;nea">
</body>
</html>