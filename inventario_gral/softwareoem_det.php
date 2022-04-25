<?	
	conectardb($inventarioopera);	
?>  
<?
function get_version_opciones($dbms2)
{	
	$qry_version = mssql_query("select * from cat_version where activo=1 order by version");																									
	if ($qry_version)
		{
			$opciones = "<option value = '0'>-- Seleccione --</option>";
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
			$opciones = "<option value = '0'>-- Seleccione --</option>";
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
	td.innerHTML = 	"<center><input name=\"cdkey["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"40\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"seriesoftwareoem["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"30\"></center>";
	
	td = tr.insertCell();
	contLin5++;
}

function borrarUltima5() {
	ultima = document.all.tabla5.rows.length - 1;
	if (ultima !=0)
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
	<th width="231" scope="col"><span class="Estilo2">CD Key (COA) </span></th>
    <th width="307" scope="col">Serie COA </th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar5()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima5()" value="Borrar l&iacute;nea">
</body>
</html>