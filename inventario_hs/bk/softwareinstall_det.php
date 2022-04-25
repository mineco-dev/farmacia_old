<?	
	conectardb($inventarioopera);	
?>  
<?
function get_versioninstall_opciones($dbms2)
{	
	$qry_versioninstall = mssql_query("select * from cat_version where activo=1 order by version");																									
	if ($qry_versioninstall)
		{
			while($row_versioninstall = mssql_fetch_row($qry_versioninstall))	
			{
				$opciones = $opciones."<option value = ".$row_versioninstall[0]. ">".$row_versioninstall[1]."</option>";
			}			
	}
	return $opciones;
}
function get_idiomainstall_opciones($dbms2)
{	
	$qry_idiomainstall= mssql_query("select * from cat_idioma where activo=1 order by idioma");																									
	if ($qry_idiomainstall)
		{
			while($row_idiomainstall = mssql_fetch_row($qry_idiomainstall))	
			{
				$opciones = $opciones."<option value = ".$row_idiomainstall[0]. ">".$row_idiomainstall[1]."</option>";
			}			
	}
	return $opciones;
}
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
function get_tipoinstall_opciones($dbms2)
{	
	$qry_tipoinstall= mssql_query("select * from cat_tipo_software where activo=1 order by tipo_software");																									
	if ($qry_tipoinstall)
		{
			while($row_tipoinstall = mssql_fetch_row($qry_tipoinstall))	
			{
				$opciones = $opciones."<option value = ".$row_tipoinstall[0]. ">".$row_tipoinstall[1]."</option>";
			}			
	}
	return $opciones;
}

function get_licencia_opciones($dbms2)
{			
	$opciones = "<option value = '0'>-- Seleccione --</option>";
	$opciones = $opciones."<option value = '1'>SI</option>";
	$opciones = $opciones."<option value = '2'>NO</option>";
	return $opciones;
}


?>
<html>
<head>
<?
$llenar_versioninstall = get_versioninstall_opciones($dbms2);
$llenar_idiomainstall=get_idiomainstall_opciones($dbms2);
$llenar_fabricante=get_fabricante_opciones($dbms2);
$llenar_tipoinstall=get_tipoinstall_opciones($dbms2);
$llenar_licencia=get_licencia_opciones($dbms2);

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
	td.innerHTML = 	"<center><input name=\"software["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"40\"></center>";	

	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serieinstall["+contLin6+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"conlicencia["+contLin6+"]\" id=\"select\">';
	echo $llenar_licencia;
	echo '</center></select>";	
			
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
<table width="90%" border=1 cellspacing="0" id="tabla6">
  <tr>
    <th width="24" scope="col"><span class="Estilo2">#</span></th>
    <th width="151" scope="col">Fabricante</th>
    <th width="222" scope="col"><div align="center" class="Estilo2">Software</div></th>
	<th width="333" scope="col">Observaciones</th>
    <th width="138" scope="col">Posee licencia </th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar6()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima6()" value="Borrar l&iacute;nea">
</body>
</html>