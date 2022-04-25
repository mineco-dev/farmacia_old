    

<?

function get_discapacidad()
{
	
$query = mssql_query("select ds.id_discapacidadesU, ds.nombre, ct.nombre from dbo.tb_tabla_discapacidad  as ds inner join  dbo.tb_catalogo_discapacidades as ct
  on ds.id_discapacidades = ct.id_discapacidades  where ct.activo=1");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[2]."-".$row[1]. "</option>";
			}
			
	}
	return $opciones;
}


?>
<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?
$op = get_discapacidad();



echo '<script>
var contLin200 = 1;
function agregar200() {
	var tr, td;

	tr = document.all.tabla100.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin200 +"";


	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"discapacidad5["+contLin30+"]\" id=\"select\">';
	echo $op;
	echo '</select>";
	
     td = tr.insertCell();
	td.innerHTML = 	"<input name=\"especifica50["+contLin30+"]\" type=\"text\" id=\"textfield\" size=\"30\">";	



	contLin200++;
}

function borrarUltima200() {
	ultima = document.all.tabla100.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla100.deleteRow(ultima);
	 contLin200--;
	}
}
</script>';
?>
</head>
<body>
<table width="13%" border=0 cellspacing="0" id="tabla100">
  <tr>
    <th height="23" class="HelloUser" scope="col">&nbsp;</th>
    <th class="HelloUser" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="31" class="HelloUser" scope="col">#</th>
    <th width="359" class="HelloUser" scope="col"><div align="center">Discapacidad</div></th>
	<th width="359" class="HelloUser" scope="col"><div align="center">Especifica</div></th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar200()" value="Agregar Capaciad">
<input type="button" class="ProgressWriting" onClick="borrarUltima200()" value="Borrar Capacidad">
</body>
</html>