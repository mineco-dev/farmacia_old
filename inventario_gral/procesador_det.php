<?	
	conectardb($inventarioopera);	
?>  
<?
function get_marcaproc_opciones($dbms2)
{	
	$qry_marca = mssql_query("select * from cat_marca where activo=1 and codigo_tipo_objeto=14 order by marca");																									
	if ($qry_marca)
		{
			while($row_marca = mssql_fetch_row($qry_marca))	
			{
				$opciones = $opciones."<option value = ".$row_marca[0]. ">".$row_marca[1]."</option>";
			}
			
	}
	return $opciones;
}
function get_socket_opciones($dbms2)
{	
	$qry_socket = mssql_query("select * from cat_tipo_slot where activo=1 order by tipo_slot");																									
	if ($qry_socket)
		{
			while($row_socket = mssql_fetch_row($qry_socket))	
			{
				$opciones = $opciones."<option value = ".$row_socket[0]. ">".$row_socket[1]."</option>";
			}			
	}
	return $opciones;
}

function get_velocidadproc_opciones($dbms2)
{	
	$qry_velocidad = mssql_query("select * from cat_velocidad_procesador where activo=1 and memoria=2 order by velocidad_procesador");																									
	if ($qry_velocidad)
		{
			while($row_velocidad = mssql_fetch_row($qry_velocidad))	
			{
				$opciones = $opciones."<option value = ".$row_velocidad[0]. ">".$row_velocidad[1]."</option>";
			}
			
	}
	return $opciones;
}

function get_tipo_procesador_opciones($dbms2)
{	
	$qry_tipo_procesador = mssql_query("select * from cat_tipo_procesador where activo=1 order by tipo_procesador");																									
	if ($qry_tipo_procesador)
		{
			while($row_tipo_procesador = mssql_fetch_row($qry_tipo_procesador))	
			{
				$opciones = $opciones."<option value = ".$row_tipo_procesador[0]. ">".$row_tipo_procesador[1]."</option>";
			}
			
	}
	return $opciones;
}

?>
<html>
<head>
<?
$llenar_marcaproc = get_marcaproc_opciones($dbms2);
$llenar_socket=get_socket_opciones($dbms2);
$llenar_velocidadproc=get_velocidadproc_opciones($dbms2);
$llenar_tipo_procesador=get_tipo_procesador_opciones($dbms2);
echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"marcaproc["+contLin4+"]\" id=\"select\">';
	echo $llenar_marcaproc;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"socket["+contLin4+"]\" id=\"select\">';
	echo $llenar_socket;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"velocidadproc["+contLin4+"]\" id=\"select\">';
	echo $llenar_velocidadproc;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"tipoproc["+contLin4+"]\" id=\"select\">';
	echo $llenar_tipo_procesador;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serieproc["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
		
	td = tr.insertCell();
	contLin4++;
}

function borrarUltima4() {
	ultima = document.all.tabla4.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla4.deleteRow(ultima);
	 contLin4--;
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
<table width="90%" border=1 cellspacing="0" id="tabla4">
  <tr>
    <th width="12" scope="col"><span class="Estilo2">#</span></th>
    <th width="162" scope="col"><span class="Estilo2">Marca</span></th>
    <th width="208" scope="col"><div align="center" class="Estilo2">Socket</div></th>
	<th width="264" scope="col">Velocidad</th>
	<th width="189" scope="col"><span class="Estilo2">Tipo</span></th>
    <th width="189" scope="col"><span class="Estilo2">Serie</span></th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">
</body>
</html>