<?
	//require("../includes/funciones.php");
	//require("../includes/sqlcommand.inc");
	conectardb($inventarioopera);	
?>  
<?
function get_marca_opciones($dbms2)
{	
	$qry_marca = mssql_query("select * from cat_marca where activo=1 and codigo_tipo_objeto=5 order by marca");																									
	if ($qry_marca)
		{
			while($row_marca = mssql_fetch_row($qry_marca))	
			{
				$opciones = $opciones."<option value = ".$row_marca[0]. ">".$row_marca[1]."</option>";
			}
			
	}
	return $opciones;
}
function get_capacidad_opciones($dbms2)
{	
	$qry_capacidad = mssql_query("select * from cat_capacidad_memoria where activo=1 order by capacidad_memoria");																									
	if ($qry_capacidad)
		{
			while($row_capacidad = mssql_fetch_row($qry_capacidad))	
			{
				$opciones = $opciones."<option value = ".$row_capacidad[0]. ">".$row_capacidad[1]."</option>";
			}
			
	}
	return $opciones;
}

function get_velocidad_opciones($dbms2)
{	
	$qry_velocidad = mssql_query("select * from cat_velocidad_procesador where activo=1 and memoria=1 order by velocidad_procesador");																									
	if ($qry_velocidad)
		{
			while($row_velocidad = mssql_fetch_row($qry_velocidad))	
			{
				$opciones = $opciones."<option value = ".$row_velocidad[0]. ">".$row_velocidad[1]."</option>";
			}
			
	}
	return $opciones;
}

function get_tipo_memoria_opciones($dbms2)
{	
	$qry_tipo_memoria = mssql_query("select * from cat_tipo_memoria where activo=1 order by tipo_memoria");																									
	if ($qry_tipo_memoria)
		{
			while($row_tipo_memoria = mssql_fetch_row($qry_tipo_memoria))	
			{
				$opciones = $opciones."<option value = ".$row_tipo_memoria[0]. ">".$row_tipo_memoria[1]."</option>";
			}
			
	}
	return $opciones;
}

?>
<html>
<head>
<?
$llenar_marca = get_marca_opciones($dbms2);
$llenar_capacidad=get_capacidad_opciones($dbms2);
$llenar_velocidad=get_velocidad_opciones($dbms2);
$llenar_tipo_memoria=get_tipo_memoria_opciones($dbms2);
echo '<script>
var contLin1 = 1;
function agregar1() {
	var tr, td;

	tr = document.all.tabla1.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin1 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"marca["+contLin1+"]\" id=\"select\">';
	echo $llenar_marca;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"capacidad["+contLin1+"]\" id=\"select\">';
	echo $llenar_capacidad;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"velocidad["+contLin1+"]\" id=\"select\">';
	echo $llenar_velocidad;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"tipo_memoria["+contLin1+"]\" id=\"select\">';
	echo $llenar_tipo_memoria;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serie["+contLin1+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"numero_parte["+contLin1+"]\" type=\"text\" id=\"textfield\" size=\"20\"></center>";	
	
	td = tr.insertCell();
	contLin1++;
}

function borrarUltima1() {
	ultima = document.all.tabla1.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla1.deleteRow(ultima);
	 contLin1--;
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
<table width="90%" border=1 cellspacing="0" id="tabla1">
  <tr>
    <th width="12" scope="col"><span class="Estilo2">#</span></th>
    <th width="162" scope="col"><span class="Estilo2">Marca</span></th>
    <th width="208" scope="col"><div align="center" class="Estilo2">Tama&ntilde;o </div></th>
	<th width="264" scope="col">Velocidad</th>
	<th width="189" scope="col"><span class="Estilo2">Tipo</span></th>
    <th width="189" scope="col"><span class="Estilo2">Serie</span></th>
    <th width="195" scope="col"><span class="Estilo2">N&uacute;mero de parte </span></th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar1()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima1()" value="Borrar l&iacute;nea">
</body>
</html>