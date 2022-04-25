<?	
	conectardb($inventarioopera);	
?>  
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

function borrarUltima3() {
	ultima = document.all.tabla3.rows.length - 1;
	if (ultima !=0)
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
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar3()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima3()" value="Borrar l&iacute;nea">
</body>
</html>